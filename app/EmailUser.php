<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailUser extends Model
{
    protected $guarded=['id'];

    protected $table='email_users';
}
