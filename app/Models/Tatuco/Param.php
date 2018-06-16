<?php
/**
 * Created by PhpStorm.
 * User: zippyttech
 * Date: 06/04/18
 * Time: 02:08 PM
 */

namespace App\Models\Tatuco;


class Param extends TatucoModel
{
    protected $table = 'params';
    protected $fillable = [
        'par_id', 'par_cod', 'par_tit','par_key','par_val','par_des','active'
    ];
    protected $primaryKey='par_id';

    public function setKeyAttribute($value)
    {
        $this->attributes['par_key'] = strtoupper($value);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['par_tit'] = strtoupper($value);
    }

}