<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaporanKemajuan extends Model
{
    protected $table = 'laporan_kemajuan';

    protected $fillable = [
        'iyt_invoice',
        'bulan', 'tahun',
        'berkas_laporan_rekapitulasi',
        'berkas_laporan_kemajuan',
    ];
}
