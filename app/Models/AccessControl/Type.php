<?php

namespace App\Models\AccessControl;

use App\Models\Tatuco\TatucoModel;
use Illuminate\Database\Eloquent\Model;

class Type extends TatucoModel
{
    public  $timestamps =true;
    protected $primaryKey = 'id';
    protected $table = "types";
    protected $fillable = [
        'id','name','ent_id','acc_id','active'
    ];

    public function getNameAttribute($value)
    {
        if (empty($value)){
            return $this->attributes['name'] = '';
        }else{
            return $this->attributes['name'];
        }
    }
}


