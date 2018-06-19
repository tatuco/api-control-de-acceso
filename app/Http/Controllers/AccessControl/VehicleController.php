<?php

namespace App\Http\Controllers\AccessControl;

use App\Http\Controllers\Tatuco\TatucoController;
use App\Http\Services\AccessControl\CodeService;
use App\Http\Services\AccessControl\VehicleService;
use App\Models\AccessControl\Code;
use App\Models\AccessControl\Vehicle;
use Illuminate\Http\Request;
use DB;

class VehicleController extends TatucoController
{
    public function __construct()
    {
        $this->service = new VehicleService(); //instaciar el servicio
        $this->namePrimaryKey = 'plate';//llave primaria
        $this->status = 'active';//campo de activo o eliminad
    }

    /**
     * @return index de vehicleService
     */
    public function index(Request $request)
    {
        return $this->service->index($request);
    }

    /**
     * @param Request $request
     * @return store de vehicleService
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
//          verificar si el vehiculo existe
            if ($this->service->FindVehicle($request->plate) != false){
                return  response()->json(["message" => 'La placa '.$request->plate. ' ya esta registrada'], 500)
                    ->setStatusCode(500, 'La placa '.$request->plate. ' ya esta registrada');
            }
            //Validar que mande un tag
            if (!empty($request->json(['tag']))) {
//            verificar si el tag existe
                $tag = $this->service->ValidateTag($request->code);
//                Si el tag existe
                if ($tag != false) {
                    $vehiculeTag = $this->service->TagAssignamentVehicle($tag->id);
//                    si el tag esta asignado
                    if ($vehiculeTag) {
                        return response()->json(["message" => 'El Tag ya esta Asignado'], 500)
                            ->setStatusCode(500, 'El Tag ya esta Asignado');
                    }else {
                        $request->merge(['cod_id' => $tag->id]);
                    }
                }elseif ($tag == false){
//                  crear el tag
                    $codeService = new  CodeService();
                    $code = $codeService->storeTag($request);
//                  si occurrio un error al guardar el tag
                    if (is_null($code)) {
                        return response()->json(["message" => 'Error al Registrar el vehiculo'], 500)
                            ->setStatusCode(500, 'Error al Registrar el vehiculo');
                    } else {
                        $request->merge(['cod_id' => $code->id]);
                    }
                }
            }

            if (!$this->service->store($request)){
                return  response()->json(["message" => 'Ocurrio un error al registrar el Vehiculo'], 500)
                    ->setStatusCode(500, 'Ocurrio un error al registrar el Vehiculo');
            }

            if (!empty($request->json(['owner_nic']))){
//                Crear una asignacion del vechiculo
                if (!$this->service->AssigtVehicle($request->json(['plate']), $request->json(['owner_nic']))){
                    return  response()->json(["message" => 'Ocurrio un error al registrar el Vehiculo'], 500)
                        ->setStatusCode(500, 'Ocurrio un error al registrar el Vehiculo');
                }
            }
            DB::commit();
            return  response()->json(["message" => 'Registro agregado de forma exitosa'], 200)
                ->setStatusCode(200, 'Registro agregado de forma exitosa');

        }catch (\Exception $e){
            DB::rollback();
            return  response()->json(["message" => "Ocurrio un error al registrar el Vehiculo"], 500)
                ->setStatusCode(500, 'Ocurrio un error al registrar el Vehiculo');

        }
    }

    /**
     * @param $x_pk = valor de la llave primaria
     * @param Request $request
     * @return update de vehicleService
     */
    public function update($x_pk, Request $request)
    {
        try{
            DB::beginTransaction();
//        validar que traiga un tag
            if (!empty($request->json(['tag']))){
                //validar que traiga un tag diferente al asociado

                $codeService = new  CodeService();
                $codes = $codeService->findCode($request->json(['tag']));
//              si el tag no esta registrado
                if ($codes == false){
//                Registrat Tag

                    $code = $codeService->storeTag($request);
//                  si occurrio un error al guardar el tag
                    if (is_null($code)) {
                        return response()->json(["message" => 'Error al Registrar el vehiculo'], 500)
                            ->setStatusCode(500, 'Error al Registrar el vehiculo');
                    } else {
                        $request->merge(['cod_id' => $code->id]);
                    }
                }elseif ($codes->code != $request->json(['tag'])){
//                  validar q el tag q trae no este asignado a otro vehiculo
                    $vehiculeTag = $this->service->TagAssignamentVehicle($codes->id);
//                  si el tag esta asignado
                    if ($vehiculeTag) {
                        return response()->json(["message" => 'El Tag ya esta Asignado'], 500)
                            ->setStatusCode(500, 'El Tag ya esta Asignado');
                    }else {
                        $request->merge(['cod_id' => $codes->id]);
                    }
                }
            }
            //validar q traiga un propietario diferente
            if (!empty($request->json(['owner_nic']))){
                $vehicle = Vehicle::find($x_pk);
//          verificar si el propietario es diferente
                if ($vehicle->owner_nic !=  $request->json(['owner_nic'])){
//              eliminar la asignacion si existe
                    if (!$this->service->destroyAssigVehicle($x_pk)){
                        return response()->json(["message" => 'Error al modificar el propietario del vehiculo'], 500)
                            ->setStatusCode(500, 'Error al modificar el propietario del vehiculo');
                    }
//              Crear la asignacion
                    if (!$this->service->AssigtVehicle($x_pk, $request->json(['owner_nic']))){
                        return  response()->json(["message" => 'Ocurrio un error al modificar el Vehiculo'], 500)
                            ->setStatusCode(500, 'Ocurrio un error al modificar el Vehiculo');
                    }
                }
            }
            if (!$this->service->update($x_pk, $request)){
                return  response()->json(["message" => 'Ocurrio un error al modificar el Vehiculo'], 500)
                    ->setStatusCode(500, 'Ocurrio un error al modificar el Vehiculo');
            }
            DB::commit();
            return  response()->json(["message" => 'Registro modificado de forma exitosa'], 200)
                ->setStatusCode(200, 'Registro modificado de forma exitosa');

        }catch (\Exception $e){
            DB::rollback();
            return  response()->json(["message" => "Ocurrio un error al modificar el Vehiculo"], 500)
                ->setStatusCode(500, 'Ocurrio un error al modificar el Vehiculo');
        }
    }

    /**
     * @param $x_pk = valor de la llave primaria
     * @return destroy de vehicleService
     */
    public function destroy($x_pk)
    {
//        verificar si tiene alguna asignacion activa

        // verificar y eliminar que el vechiculo tenga una asignacion
        if (!$this->service->destroyAssigVehicle($x_pk)){
            return  response()->json(["message" => 'Ocurrio un error al eliminar el Vehiculo (ASIGNACION)'], 500)
                ->setStatusCode(500, 'Ocurrio un error al eleminar el Vehiculo');
        }
//        verificar si tiene un tag asociado
        $vehicle =  $this->service->FindVehicle($x_pk);
        if($vehicle){
            $code = Code::find($vehicle->cod_id);
            if ($code){
                $code->active = false;
                if(!$code->update()){
                    return  response()->json(["message" => 'Ocurrio un error al eliminar el Vehiculo ()'], 500)
                        ->setStatusCode(500, 'Ocurrio un error al eleminar el Vehiculo');
                }
            }

        }
//      verificar y eliminar el codigo de un vehiculo
        return $this->service->destroy($this->namePrimaryKey, $x_pk, $this->status);
    }

    /**
     * @return selectVehicle de vehicleService
     */
    public function selectVehicle()
    {
        return $this->service->selectVehicle();

    }
}
