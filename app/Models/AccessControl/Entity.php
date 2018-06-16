<?php

namespace App\Models\AccessControl;

use App\Models\Tatuco\TatucoModel;
use Illuminate\Database\Eloquent\Model;

class Entity extends TatucoModel
{
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $table ="entities";
    protected $fillable = [
        //mapeo de columnas de la base de datos
        'id', 'name', 'active', 'acc_id'
    ];
}
