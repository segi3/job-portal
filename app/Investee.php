<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investee extends Model
{
    protected $fillable = [
        'admin_id', 'name', 'address', 'city', 'province', 'fax', 'contact_person',
        'contact_no', 'email', 'berkas_verifikasi',
    ];
}
