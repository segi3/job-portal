<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investee extends Model
{
    protected $fillable = [
        'admin_id', 'nama', 'address', 'city', 'province', 'fax', 'contact_person',
        'contact_no', 'email', 'berkas_verifikasi', 'student_id',
    ];

    protected $table = 'investee';
}
