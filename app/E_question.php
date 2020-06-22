<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class E_question extends Model
{
    protected $guarded=['id'];

    function _multi_opt(){
            return $this->hasMany(\App\Entreprenuer_q_input::class,'f_key');
    }
    function _serviceSector(){
            return $this->hasOne(\App\ServiceSector::class,'id','service_sector_id');
    }
}
