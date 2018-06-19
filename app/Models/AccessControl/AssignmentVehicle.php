<?php

namespace App\Models\AccessControl;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tatuco\TatucoModel;

class AssignmentVehicle extends TatucoModel
{
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $table = "assignment_vehicles";
    protected $fillable = [
        //mapeo de columnas de la base de datos
        'id', 'date_sta', 'date_end', 'veh_pla', 'use_nic', 'acc_id', 'active'
    ];
}
