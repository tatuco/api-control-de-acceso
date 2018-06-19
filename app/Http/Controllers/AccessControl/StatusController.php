<?php

namespace App\Http\Controllers\AccessControl;

use Illuminate\Http\Request;

use App\Http\Controllers\Tatuco\TatucoController;
use App\Http\Services\AccessControl\StatusService;
use App\Models\AccessControl\Status;

class StatusController extends TatucoController
{
    public function __construct()
    {
        $this->service = new StatusService();
        $this->campo = 'sta_id';//llave primaria
        $this->status = 'sta_act';//campo de activo o eliminado
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
    public function statusByEntity(Request $request)
    {
        return $this->service->status($request);
    }
}
