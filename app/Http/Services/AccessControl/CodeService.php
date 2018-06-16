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
        $this->name = 'conde';
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
        $code->sta_id = 7;
        $code->typ_id = 2;
        $code->acc_id = $user->acc_id;

        if ($code->save()){
            return $code;
        }else{
            return NULL;
        }
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
        $code->sta_id = 7;
        $code->typ_id = 1;
        $code->acc_id = $user->acc_id;

        if ($code->save()){
            return $code;
        }else{
            return NULL;
        }
    }
}