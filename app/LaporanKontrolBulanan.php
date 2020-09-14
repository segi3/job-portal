<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaporanKontrolBulanan extends Model
{
    protected $table = 'laporan_kontrol_bulanan';

    protected $fillable = [
        'iyt_id',
        'berkas_laporan_keuangan', 'berkas_laporan_dokumentasi',
        'bulan', 'tahun',

        'indikator-1a', 'nilai-1a', 'komentar-1a',
        'indikator-1b', 'nilai-1b', 'komentar-1b',

        'indikator-2a', 'nilai-2a', 'komentar-2a',
        'indikator-2b', 'nilai-2b', 'komentar-2b',
        'indikator-2c', 'nilai-2c', 'komentar-2c',
        'indikator-2d', 'nilai-2d', 'komentar-2d',

        'indikator-3a', 'nilai-3a', 'komentar-3a',
        'indikator-3b', 'nilai-3b', 'komentar-3b',

    ];
}
