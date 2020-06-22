<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ans_score extends Model
{
    protected $guarded=['id'];

    protected $table='ans_scores';

    function user_has_role(){
            return $this->hasMany(\App\User_role::class,'user_id','created_by');
    }
}
