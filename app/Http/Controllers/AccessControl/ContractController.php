<?php

namespace App\Http\Controllers\AccessControl;

use App\Http\Controllers\Tatuco\TatucoController;
use App\Http\Services\AccessControl\ContractService;
use App\Models\AccessControl\Contract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class ContractController extends TatucoController
{
    public function __construct()
    {
        $this->service = new ContractService(); //instaciar el servicio
        $this->namePrimaryKey = 'id';//llave primaria
        $this->status = 'active';//campo de activo o eliminado
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->service->index($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contrato = $this->service->store($request);
        if($contrato == false){
            return  response()->json(["message" => 'Error al registrar el contrato'], 500)
                ->setStatusCode(500, 'Error al registrar el contrato');
        }

        $contract = Contract::find($contrato->id);
        $contract->relationships()->attach($request->use_nic, ['relationship' => 'madre', 'active' => true]);

        return  response()->json(["message" => 'Verificar'], 200)
            ->setStatusCode(200, 'Verificar');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($x_pk, Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($x_pk)
    {
        //
    }
}
