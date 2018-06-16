<?php
namespace app\Http\Services\AccessControl;

use App\Http\Services\Tatuco\TatucoService;
use App\Models\AccessControl\AssignmentVehicle;
use App\Models\AccessControl\Code;
use App\Models\AccessControl\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Scalar\String_;

class VehicleService extends TatucoService
{
    public function __construct()
    {
        $this->name = 'vehicle';
        $this->model = new Vehicle();
        $this->namePlural = 'vehicles';
    }

    /**
     * @return json con el listado de registros
     */
    public function index(Request $request)
    {
        //consulto los permisos
        if (($this->checkPermission('index.'.$this->name)) == false ) {
            return  response()->json(["message" => "no tienes permiso index.$this->name"], 403)
                ->setStatusCode(403, 'no tienes permiso para listar registros de este modulo');
        }
        $user = $this->currentUSer();
        $query = Vehicle::from('vehicles as v')
            ->select('v.plate as placa','u.use_nam','t.name as typ_des'
                ,'bv.bra_des','mv.mod_des','v.color','v.year','s.name as sta_des')
            ->leftJoin('users as u','u.use_nic','v.owner_nic')
            ->leftJoin('types as t','t.id','v.typ_id')
            ->leftJoin('brands_vehicles as bv','bv.bra_id','v.bra_id')
            ->leftJoin('models_vehicles as mv','mv.mod_id','v.mod_id')
            ->leftJoin('status as s','s.sta_id','v.sta_id')
            ->where('v.active',true)
            ->where('v.acc_id',$user->acc_id)
            ->orderBy('v.plate')
//            ->toSql();
            ->get();

        return response()->json($query, 200);
    }

    /**
     * @param Request $request
     * @return _store de tatucoService
     */
    public function store(Request $request)
    {
//        try{
            $plate = $request->plate;
            $vehicle= Vehicle::where("plate",$plate)
                ->first();
            DB::beginTransaction();
            if($vehicle){
                return  response()->json(["message" => 'La placa '.$plate. ' ya esta registrada.'], 500)
                    ->setStatusCode(500, 'La placa '.$plate. ' ya esta registrada.');
            }
            //validar que traiga un tag $request->json(['password'])
            if (!empty($request->json(['tag']))){
//            buscar el tag
                $tag = Code::where('code',"=",$request->json(['tag']))->first();
//            si existe el tag no permitir el registro
                if (!empty($tag)){
                    return  response()->json(["message" => 'El codigo TAG ya esta registrado'.$tag], 500)
                        ->setStatusCode(500, 'El codigo TAG ya esta registrado'.$tag);
                }else{
                    //registro el tag
                    $codeService = new CodeService();
                    $code = $codeService->storeTag($request);

                    $request->merge(['cod_id' => $code->id]);
                }
            }
            //guardar vehiculo
            Vehicle::create($request->all());
            DB::commit();
            return  response()->json(["message" => "Registro guardado con exito"], 201)
                ->setStatusCode(201, 'Registro guardado con exito');

//        }catch (\Exception $e){
//            DB::rollback();
//            return  response()->json(["message" => "Ocurrio un error al registrar el Vehiculo"], 500)
//                ->setStatusCode(500, 'Ocurrio un error al registrar el Vehiculo');
//
//        }


    }

    /**
     * @param $g_namePrimaryKey = nombre de la llave primaria
     * @param $x_pk = valor de la llave primaria
     * @param $g_status = nombre del campo status
     * @param Request $request
     * @return _update de tatucoService
     */
    public function update($g_namePrimaryKey, $x_pk, $g_status, Request $request)
    {
        if($request->json(['mod_id'])==0){
            $pass =null;
            $request->merge(['mod_id' => $pass]);
        }
        //envio a tatuco service
        return $this->_update($g_namePrimaryKey, $x_pk, $g_status, $request);
    }

    /**
     * @param $g_namePrimaryKey = nombre de la llave primaria
     * @param $x_pk = valor de la llave primaria
     * @param $g_status = nombre del campo status
     * @return _destroy de tatucoService
     */
    public function destroy($g_namePrimaryKey, $x_pk, $g_status)
    {
        //consulto los permisos
        if (($this->checkPermission('delete.'.$this->name)) == false ) {
            return  response()->json(["message" => "no tienes permiso delete.$this->name"], 403)
                ->setStatusCode(403, 'no tienes permiso para eliminar registros de este modulo');
        }
        //consulto el account logueado
        $user = $this->currentUSer();
        $select = Assignment::where("veh_pla","=",$x_pk)
            ->where("ass_act","=",true)
            ->where("acc_id","=",$user->acc_id)
            ->first();
        if($select){
            $id = $select->ass_id;
            //si esta asignado modificio la asignacion a false
            $update = Assignment::find($id);
            $update->ass_act = false;
            $update->save();
        }
        return $this->_destroy($g_namePrimaryKey, $x_pk, $g_status);
    }

    /**
     * metodo que consulta los vehiculos para el comboselect del front
     * @return json con los vehiculos
     */
    public function selectVehicle(){
        $user = $this->currentUSer();
        $query = Vehicle::select('veh_pla as value', 'veh_pla as text')
            ->where('acc_id',$user->acc_id)
            ->where('veh_act', true)
            ->where('sta_id', 5)
            ->get();

        return response()->json($query, 200);

    }

}