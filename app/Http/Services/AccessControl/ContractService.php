<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 18/06/18
 * Time: 03:34 PM
 */

namespace App\Http\Services\AccessControl;


use App\Http\Services\Tatuco\TatucoService;
use App\Models\AccessControl\Contract;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContractService extends TatucoService
{
    public function __construct()
    {
        $this->name = 'contract';
        $this->model = new Contract();
        $this->namePlural = 'contracts';
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        //consulto los permisos
        if (($this->checkPermission('index.'.$this->name)) == false ) {
            return  response()->json(["message" => "no tienes permiso index.$this->name"], 403)
                ->setStatusCode(403, 'no tienes permiso para listar registros de este modulo');
        }
        $user = $this->currentUSer();
        $query = Contract::from('contracts as c')
            ->select('c.id as cont_id', 'c.date_sta', 'c.date_end', 'c.use_nic','c.sta_id',
                'u.use_nam as name', 's.name as sta_des')
            ->join('users as u','u.use_nic','c.use_nic')
            ->leftJoin('status as s','s.sta_id','c.sta_id')
            ->where('c.active',true)
//            ->toSql();
            ->get();
        return response()->json($query, 200);
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function store(Request $request)
    {
        //consulto los permisos
        if (($this->checkPermission('index.'.$this->name)) == false ) {
            return  response()->json(["message" => "No tienes para crear vehiculos"], 403)
                ->setStatusCode(403, 'No tienes para crear vehiculos');
        }else{
            $contract = $this->model;
            $contract->date_sta = $request->date_sta;
            $contract->date_end = $request->date_end;
            $contract->use_nic = $request->use_nic;
            $contract->sta_id = $request->sta_id;
            $contract->contract = $request->contract;
            return $contract->save() ? $contract : false;
        }

    }

}