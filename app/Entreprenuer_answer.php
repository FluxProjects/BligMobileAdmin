<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entreprenuer_answer extends Model
{
    protected $guarded=['id'];

    function _question(){
            return $this->hasOne(\App\E_question::class,'id','question_id');
    }
    function _user(){
            return $this->hasOne(\App\Users2::class,'id','user_id');
    }
}
