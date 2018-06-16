<?php

namespace App\Models\AccessControl;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tatuco\TatucoModel;


class Pass extends TatucoModel
{
    public  $timestamps =true;
    protected $primaryKey = 'id';
    protected $table = "passes";
    protected $fillable = [
        'id','date_sta','date_end','host_nic','guest_nic','use_nic','sch_id','acc_id','active'
    ];
}
