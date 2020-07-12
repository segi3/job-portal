<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investasi_funding extends Model
{
    protected $fillable = [
        'nama_investasi', 'investee_id', 'status', 'bank', 'no_rekening', 'atas_nama', 'target',
        'deskripsi_bisnis', 'tgl_jatuh_tempo', 'berkas_proposal_investasi', 'berkas_laporan_keuangan',
        'admin_id',
    ];
    protected $table = 'investasi_funding';
}
