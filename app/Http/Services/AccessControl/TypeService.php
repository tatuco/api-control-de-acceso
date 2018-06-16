<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 12/06/18
 * Time: 02:04 PM
 */

namespace App\Http\Services\AccessControl;

use App\Models\AccessControl\Type;
use App\Http\Services\Tatuco\TatucoService;
use App\Query\QueryBuilder;
use Illuminate\Http\Request;
class TypeService extends TatucoService
{
    public function __construct()
    {
        $this->name = 'Type';
        $this->model = new Type();
        $this->namePlural = 'Types';
    }

    /**
     * @param $request
     * @return _store de tatucoService
     */
    public function store($request)
    {
        return $this->_store($request);
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
        return $this->_update($g_namePrimaryKey, $x_pk, $g_status, $request);
    }

    /**
     * metodo que consulta los status dependiendo del la entidad, 1=user...
     * @param $x_tabStatus = valor de sta_tab ejem: 1=user...
     * @return json con los status segun la entidad
     */
    public function type(Request $request)
    {
        //llama a userService
        //consulto el account logueado
        $user = $this->currentUSer();
        $select = QueryBuilder::for(Type::class)
            ->select('types.id as value','types.name as text', 'e.name as entity')
            ->join('entities  as e','e.id', '=','types.ent_id')
            ->doWhere($request["where"])
            ->get();
        return response()->json($select, 200);
    }

}