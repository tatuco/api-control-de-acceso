<?php

namespace App\Models\AccessControl;



use App\Models\Tatuco\TatucoModel;

class Vehicle extends TatucoModel
{
    public $timestamps = true;
    protected $primaryKey = 'plate';
    protected $table ="vehicles";
    protected $fillable = [
        //mapeo de columnas de la base de datos
        'plate', 'year', 'color','bra_id','mod_id', 'owner_nic', 'cod_id', 'acc_id', 'typ_id','active', 'sta_id'
    ];


    /**
     * @return array
     */
    public function getYearAttribute($value)
    {
        if (is_null($value)){
            return $this->attributes['year'] = '';
        }else{
            return $this->attributes['year'];
        }
    }


    /**
     * @return array
     */
    public function getColorAttribute($value)
    {
        if (is_null($value)){
            return $this->attributes['color'] = '';
        }else{
            return $this->attributes['color'];
        }
    }

}
