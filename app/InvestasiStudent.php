<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvestasiStudent extends Model
{
    protected $table = 'investasi_student';

    protected $fillable = [
      'student_id', 'investasi_id', 'lembar_beli', 'berkas_ktp', 'berkas_bukti_pembayaran',
      'status_bayar', 'status_uang_balik',
    ];

}
