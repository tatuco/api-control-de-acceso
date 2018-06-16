<?php

namespace App\Http\Controllers\AccessControl;

use App\Http\Controllers\Tatuco\TatucoController;
use App\Http\Services\AccessControl\VehicleService;
use Illuminate\Http\Request;

class VehicleController extends TatucoController
{
    public function __construct()
    {
        $this->service = new VehicleService(); //instaciar el servicio
        $this->namePrimaryKey = 'plate';//llave primaria
        $this->status = 'active';//campo de activo o eliminado
    }

    /**
     * @return index de vehicleService
     */
    public function index(Request $request)
    {
        return $this->service->index($request);
    }

    /**
     * @param Request $request
     * @return store de vehicleService
     */
    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    /**
     * @param $x_pk = valor de la llave primaria
     * @param Request $request
     * @return update de vehicleService
     */
    public function update($x_pk, Request $request)
    {
        return $this->service->update($this->namePrimaryKey, $x_pk, $this->status, $request);
    }

    /**
     * @param $x_pk = valor de la llave primaria
     * @return destroy de vehicleService
     */
    public function destroy($x_pk)
    {
        return $this->service->destroy($this->namePrimaryKey, $x_pk, $this->status);
    }

    /**
     * @return selectVehicle de vehicleService
     */
    public function selectVehicle()
    {
        return $this->service->selectVehicle();

    }

}
