<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailTemp extends Model
{
    protected $guarded=['id'];

    protected $table='email_temps';
}
