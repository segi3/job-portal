<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaporanKontrolBulanan extends Model
{
    protected $table = 'laporan_kontrol_bulanan';

    protected $fillable = [
        'iyt_invoice',
        'berkas_laporan_keuangan', 'berkas_laporan_dokumentasi',
        'bulan', 'tahun',

        'indikator_1a', 'nilai_1a', 'komentar_1a',
        'indikator_1b', 'nilai_1b', 'komentar_1b',

        'indikator_2a', 'nilai_2a', 'komentar_2a',
        'indikator_2b', 'nilai_2b', 'komentar_2b',
        'indikator_2c', 'nilai_2c', 'komentar_2c',
        'indikator_2d', 'nilai_2d', 'komentar_2d',

        'indikator_3a', 'nilai_3a', 'komentar_3a',
        'indikator_3b', 'nilai_3b', 'komentar_3b',

    ];
}
