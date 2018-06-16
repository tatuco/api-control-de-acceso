<?php

namespace App\Models\AccessControl;

use App\Models\Tatuco\TatucoModel;

class ModelVehicle extends TatucoModel
{
    public $timestamps = true;
    protected $primaryKey = 'mod_id';
    protected $table ="models_vehicles";
    protected $fillable = [
        //mapeo de columnas de la base de datos
        'mod_id', 'bra_id', 'use_nic', 'mod_des','active', 'acc_id'
    ];
}
