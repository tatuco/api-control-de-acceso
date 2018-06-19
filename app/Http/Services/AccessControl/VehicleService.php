<?php
namespace app\Http\Services\AccessControl;

use App\Http\Services\Tatuco\TatucoService;
use App\Http\Services\AccessControl\CodeService;
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
            ->select('v.plate as placa', 'v.owner_nic as owner_nic', 't.name as typ_des', 'v.typ_id','bv.bra_des',
                'v.bra_id','v.mod_id','mv.mod_des', 'v.color', 'v.year', 'v.sta_id','s.name as sta_des', 'v.cod_id',
                'c.code as tag', 'c.supervised')
            ->leftJoin('users as u','u.use_nic','v.owner_nic')
            ->leftJoin('types as t','t.id','v.typ_id')
            ->leftJoin('codes as c','c.id','v.cod_id')
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
     * @throws \Exception
     */
    public function store(Request $request)
    {
        //consulto los permisos
        if (($this->checkPermission('index.'.$this->name)) == false ) {
            return  response()->json(["message" => "No tienes para crear vehiculos"], 403)
                ->setStatusCode(403, 'No tienes para crear vehiculos');
        }else{
            return Vehicle::create($request->all());
        }

    }

    /**
     * @param $g_namePrimaryKey = nombre de la llave primaria
     * @param $x_pk = valor de la llave primaria
     * @param $g_status = nombre del campo status
     * @param Request $request
     * @return _update de tatucoService
     */
    public function update($x_pk, Request $request)
    {
        if($request->json(['mod_id'])==0){
            $pass =null;
            $request->merge(['mod_id' => $pass]);
        }
        if($request->json(['bra_id'])==0){
            $pass =null;
            $request->merge(['bra_id' => $pass]);
        }

        if (($this->checkPermission('update.'.$this->name)) == false ) {
            return  response()->json(["message" => "no tienes permiso update.$this->name"], 403)
                ->setStatusCode(403, 'no tienes permiso para modificar registros de este modulo');
        }
        $vehicle = $this->model::find($x_pk);
        return $vehicle->update($request->all());

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


        return $this->_destroy($g_namePrimaryKey, $x_pk, $g_status);
    }

    /**
     * metodo que consulta los vehiculos para el comboselect del front
     * @return json con los vehiculos
     */
    public function selectVehicle(){
        $user = $this->currentUSer();
        $query = $this->model::select('veh_pla as value', 'veh_pla as text')
            ->where('acc_id',$user->acc_id)
            ->where('active', true)
            ->get();
        return response()->json($query, 200);

    }

    /**
     * asignar  un un vehiculo a un usuario
     * @param $plate
     * @param $owner_nic
     * @param null $date
     * @return bool
     */
    public function  AssigtVehicle($plate, $owner_nic, $date = NULL){

        $user = parent::currentUSer();
        $assignment = new AssignmentVehicle();
        $assignment->date_sta = (is_null($date))? Carbon::now()->format('Y-m-d'): $date;
        $assignment->veh_pla = $plate;
        $assignment->use_nic = $owner_nic;
        $assignment->acc_id = $user->acc_id;
        return  $assignment->save();
    }

    /**
     * buscar un vehiculo
     * @param $plate
     * @return bool
     */
    public function FindVehicle($plate){
        $vehicle = $this->model::where("plate",strtoupper($plate))->first();
        return ($vehicle) ? $vehicle : false;
    }
    /**
     * validar q el tag exista
     * @param $code
     * @return bool
     */
    public function ValidateTag($code){
        $tag = Code::where('code',$code)->first();
        return ($tag) ? $tag : false;

    }

    /**
     * Buscar si el tag ya esta asignado a un vechiculo
     * @param $codeId
     * @return bool
     */
    public function TagAssignamentVehicle($codeId){
         $resp = $this->model::where("cod_id",$codeId)->first();
        return ($resp) ? true : false;
    }

    /**
     * eliminado logico de las asignaciones de vechiculo
     * @param $request
     * @return mixed
     */
    public function destroyAssigVehicle($placa)
    {
        $assignment = AssignmentVehicle::where("veh_pla",$placa)->where('active',true)->first();
        if (is_null($assignment)){
            return true;
        }
        $assignment->active = false;
        return $assignment->update();
    }
}