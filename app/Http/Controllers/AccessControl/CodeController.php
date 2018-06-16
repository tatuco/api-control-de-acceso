<?php

namespace App\Http\Controllers\AccessControl;

use App\Http\Controllers\Tatuco\TatucoController;
use App\Http\Services\AccessControl\CodeService;
use App\Models\AccessControl\Code;
use App\Models\Tatuco\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class CodeController extends TatucoController
{
    public function __construct()
    {
        $this->service = new CodeService(); //instaciar el servicio
        $this->namePrimaryKey = 'id';//llave primaria
        $this->status = 'active';//campo de activo o eliminado
    }

    /**
     * Storeqr crea un nevo codigo qr y desacticva el existente para el usuario.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeQr(Request $request)
    {
        try{
            DB::beginTransaction();
//        eliminar logicamente el codigo actual del usuario
            $code = Code::find($request->json(['cod_id']));
            $code->active = false;
            $code->update();

//        se crea un nuevo codigo
            $codeNew = $this->service->storeQr($request);

//        verifica que se creo correctamente
            if (is_null($codeNew)){
                return  response()->json(["message" => "Error al actualizar el QR"], 500)
                    ->setStatusCode(500, 'Error al actualizar el QR');
            }else{

                $users = User::find($request->json(['id']));
                $users->cod_id = $codeNew->id;
                $users->update();
                DB::commit();
                return response()->json(["message"=> "QR actualizado con exito"],200)
                    ->setStatusCode(200,'QR actualizado con exito');
           }

        }catch (\Exception $e){
            DB::rollback();
            return  response()->json(["message" => "Error al actualizar el QR"], 500)
                ->setStatusCode(500, 'Error al actualizar el QR');
        }

    }

    /**
     * storeTag registra un tag para un vehiculo
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeTag(Request $request)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
//    public function update(Request $request, $id)
//    {
//        return $this->service->update($request);
//    }
}