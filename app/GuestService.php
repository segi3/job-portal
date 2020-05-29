<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestService extends Model
{
    protected $fillable = [
        'name', 'description',
    ];
}
