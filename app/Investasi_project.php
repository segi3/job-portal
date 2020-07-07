<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investasi_project extends Model
{
    protected $fillable = [
        'nama_investasi', 'investee_id', 'status', 'status_tempo', 'bank', 'no_rekening', 'atas_nama',
        'deskripsi_bisnis', 'roi_top', 'roi_bot', 'lembar_total', 'lembar_terbeli', 'tgl_jatuh_tempo',
        'harga_saham', 'berkas_porposal_investasi', 'berkas_laporan_keuangan', 'admin_id',
    ];
}
