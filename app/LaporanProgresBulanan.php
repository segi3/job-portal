<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaporanProgresBulanan extends Model
{
    protected $table = 'laporan_progres_bulanan';

    protected $fillable = [
        'iyt_id',
        'berkas_laporan_keuangan',
        'bulan',
        'tahun',
        '1a', '1b', '1c', '2a', '2b', '2c', '3a', '3b', '3c', '4a', '4b', '4c', '5a', '5b', '5c',
        '6a', '6b', '6c', '7a', '7b', '7c', '8a', '8b', '8c', '9a', '9b', '9c', '10a', '10b', '10c',
        '11a', '11b', '11c', '12a', '12b', '12c', '13a', '13b', '13c', '14a', '14b', '14c', '15a', '15b', '15c',
        '16a', '16b', '16c',
    ];
}
