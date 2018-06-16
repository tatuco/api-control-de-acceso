<?php

namespace App\Models\AccessControl;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tatuco\TatucoModel;

class Code extends TatucoModel
{
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $table ="codes";
    protected $fillable = [
        //mapeo de columnas de la base de datos
        'id', 'code', 'typ_id', 'sta_id', 'acc_id', 'supervised','dat_end','active'
    ];
}

