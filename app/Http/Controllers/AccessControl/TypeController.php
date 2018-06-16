<?php

namespace App\Http\Controllers\AccessControl;

use Illuminate\Http\Request;
use App\Http\Controllers\Tatuco\TatucoController;
use App\Http\Services\AccessControl\TypeService;
use App\Models\AccessControl\Type;


class TypeController extends TatucoController
{
    public function __construct()
    {
        $this->service = new TypeService();
        $this->campo = 'id';//llave primaria
        $this->status = 'active';//campo de activo o eliminado
    }

    /**
     * @param Request $request
     * @return store de statusService
     */
    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    /**
     * @return status de tatucoService
     */
    public function typeByEntity(Request $request)
    {
        return $this->service->type($request);
    }
}
