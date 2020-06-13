<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investasi extends Model
{
    protected $table = 'investasi';

    protected $fillable = [
        'employer_id', 'status', 'status_tempo', 'bank', 'no_rekening', 'deskripsi_bisnis', 'roi_top', 'roi_bot',
        'lembar_total', 'lembar_terbeli', 'harga_saham', 'tgl_jatuh_tempo',
        'berkas_proposal_investasi', 'berkas_laporan_keuangan', 'nama_investasi', 'atas_nama',
    ];

}
