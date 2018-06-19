<?php

namespace App\Models\AccessControl;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tatuco\TatucoModel;

class Status extends TatucoModel
{
    public $timestamps = true;
    protected $primaryKey = 'sta_id';
    protected $table ="status";
    protected $fillable = [
        //mapeo de columnas de la base de datos
        'sta_id', 'name', 'ent_id', 'active','acc_id'
    ];

}

