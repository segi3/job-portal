<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class iyt_mentoring extends Model
{
    protected $fillable = [
        'judul', 'tgl_mentoring', 'dokumentasi', 'komentar','mentor_id','investasi_iyt_id'
    ];
}
