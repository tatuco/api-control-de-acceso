<?php

namespace App\Models\AccessControl;

use App\Models\Tatuco\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tatuco\TatucoModel;

class Contract extends Model
{
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $table ="contracts";
    protected $fillable = [
        //mapeo de columnas de la base de datos
        'id', 'date_sta', 'date_end', 'use_nic', 'sta_id', 'active','contract'
    ];

    /**
     * table  pivote
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function relationships()
    {
        return $this->belongsToMany('App\Models\Tatuco\User', 'menber_relationship','cont_id', 'use_nic')
            ->withPivot('relationship', 'active')
            ->withTimestamps();
    }
}



