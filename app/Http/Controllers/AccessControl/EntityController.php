<?php

namespace App\Http\Controllers\AccessControl;

use App\Http\Controllers\Tatuco\TatucoController;
use App\Http\Services\AccessControl\EntityService;
use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;

class EntityController extends TatucoController
{
    public function __construct()
    {
        $this->service = new EntityService(); //instaciar el servicio
        $this->namePrimaryKey = 'id';//llave primaria
        $this->status = 'active';//campo de activo o eliminado
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->service->index($request);
    }

    public function store(Request $request)
    {
        return $this->service->store($request);
    }


}
