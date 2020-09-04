<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    //
    protected $fillable = [
        'name', 'nip', 'mobile_no', 'email', 'password',
    ];
}