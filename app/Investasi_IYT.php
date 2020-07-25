<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investasi_IYT extends Model
{
    protected $fillable = [
       'nama_investasi', 'investee_id', 'status', 'bank', 'no_rekening', 'atas_nama',
       'deskripsi_bisnis', 'roi_top', 'roi_bot', 'tgl_jatuh_tempo', 'berkas_porposal_investasi',
       'berkas_laporan_keuangan', 'admin_id',
    ];
}
