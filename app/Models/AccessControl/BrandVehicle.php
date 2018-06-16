<?php

namespace App\Models\AccessControl;

use App\Models\Tatuco\TatucoModel;

class BrandVehicle extends TatucoModel
{
    public $timestamps = true;
    protected $primaryKey = 'bra_id';
    protected $table ="brands_vehicles";
    protected $fillable = [
        //mapeo de columnas de la base de datos
        'bra_id', 'bra_des', 'use_nic', 'active', 'acc_id'
    ];
}
