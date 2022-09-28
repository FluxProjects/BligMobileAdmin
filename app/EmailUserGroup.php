<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailUserGroup extends Model
{
    protected $guarded=['id'];

    protected $table='email_user_group';
}
