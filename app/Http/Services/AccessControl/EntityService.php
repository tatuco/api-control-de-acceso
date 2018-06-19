<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 05/06/18
 * Time: 09:25 AM
 */

namespace App\Http\Services\AccessControl;


use App\Http\Services\Tatuco\TatucoService;
use App\Models\AccessControl\Entity;
use Illuminate\Http\Request;

class EntityService extends TatucoService
{
    public function __construct()
    {
        $this->name = 'entity';
        $this->model = new Entity();
        $this->namePlural = 'entities';
    }
    public function index(Request $request){
        $query = Entity::all();
        return response()->json($query, 200);
    }

    /**
     * @param $request
     * @return _store de tatucoService
     */
    public function store(Request $request)
    {
         $this->model::Create($request->all());

        return  response()->json(["message" => "Registro guardado con exito"], 200)
            ->setStatusCode(200,"Registro guardado con exito");
    }

}