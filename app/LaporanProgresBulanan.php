<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaporanProgresBulanan extends Model
{
    protected $table = 'laporan_bulanan';

    protected $fillable = [
        'iyt_invoice',
        'berkas_laporan_keuangan', 'berkas_kwitansi',
        'bulan',
        'tahun',
        'indikator_1a', 'indikator_1b', 'indikator_1c', 'indikator_2a', 'indikator_2b', 'indikator_2c', 'indikator_3a', 'indikator_3b', 'indikator_3c', 'indikator_4a', 'indikator_4b', 'indikator_4c', 'indikator_5a', 'indikator_5b', 'indikator_5c',
        'indikator_6a', 'indikator_6b', 'indikator_6c', 'indikator_7a', 'indikator_7b', 'indikator_7c', 'indikator_8a', 'indikator_8b', 'indikator_8c', 'indikator_9a', 'indikator_9b', 'indikator_9c', 'indikator_10a', 'indikator_10b', 'indikator_10c',
        'indikator_11a', 'indikator_11b', 'indikator_11c', 'indikator_12a', 'indikator_12b', 'indikator_12c', 'indikator_13a', 'indikator_13b', 'indikator_13c', 'indikator_14a', 'indikator_14b', 'indikator_14c', 'indikator_15a', 'indikator_15b', 'indikator_15c',
        'indikator_16a', 'indikator_16b', 'indikator_16c',
    ];
}
