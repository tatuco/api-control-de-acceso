<?php
/**
 * Created by PhpStorm.
 * User: zippyttech
 * Date: 06/04/18
 * Time: 02:13 PM
 */

namespace App\Http\Services\Tatuco;


use App\Models\Tatuco\Param;
use Illuminate\Http\Request;

class ParamService extends TatucoService
{
    public function __construct()
    {
        $this->name = 'param';
        $this->model = new Param();
        $this->namePlural = 'params';
    }

    public function store(Request $request){

        return $this->_store($request);
    }
    public function update($campo,$id,$status,Request $request)
    {
        return $this->_update($campo, $id, $status, $request);
    }

    public function findValueForKey($key)
    {
        try{
            $value = $this->model->select('par_val')
                ->where('par_key','=',$key)->first();
//            echo "Valor ParamService =".$value->par_val;
            return $value->par_val;

        }catch(\Exception $e){
            return parent::errorException($e);
        }
    }

}
