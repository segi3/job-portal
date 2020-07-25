<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progres_project extends Model
{
    protected $fillable = [
        'investee_id', 'project_id', 'tgl', 'berkas_laporan', 'deskripsi_laporan', 'keterangan_tambahan',
    ];
    protected $table = 'progres_project';
}
