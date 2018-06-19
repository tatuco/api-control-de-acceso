<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 11/06/18
 * Time: 11:14 AM
 */

namespace App\Http\Services\AccessControl;


use App\Http\Services\Tatuco\TatucoService;
use App\Models\AccessControl\Code;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;

class CodeService extends TatucoService
{
    public function __construct()
    {
        $this->name = 'code';
        $this->model = new Code();
        $this->namePlural = 'codes';
    }

    /**
     * @param $request
     * @return _store de tatucoService
     */
    public function storeQr(Request $request)
    {
        $user = parent::currentUSer(); //consulto usuario logueado
        $code = $this->model;
        $code->code = Uuid::generate();
        $code->typ_id = 2;
        $code->acc_id = $user->acc_id;

        return $code->save() ? $code : NULL;
    }

    /**
     *  Registar codigo tag
     * @param Request $request
     * @return Code|null
     * @throws \Exception
     */
    public function storeTag(Request $request)
    {
        $user = parent::currentUSer(); //consulto usuario logueado
        $code = $this->model;
        $code->code = $request->json(['tag']);
        $code->typ_id = 1;
        $code->acc_id = $user->acc_id;

        return $code->save() ? $code : NULL;
    }


    /**
     * Buscar un codigo por codigo
     * @param $code
     * @return bool
     */
    public function findCode($code)
    {
        $codes = $this->model::where("code",$code)->first();
        return ($codes)? $codes : false;
    }

    /**
     * eliminado logico del codigo
     * @param $g_namePrimaryKey
     * @param $x_pk
     * @param $g_status
     * @return \App\Http\Services\Tatuco\json|\Illuminate\Http\JsonResponse
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
}