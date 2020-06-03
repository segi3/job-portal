<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'name', 'status', 'pekerjaan', 'mobile_no', 'email', 'password','status_gs','berkas_verifikasi'
    ];
}
