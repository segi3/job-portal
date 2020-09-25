<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notulensi extends Model
{
    protected $fillable = [
        'mentoring_id', 'iyt_id', 'dokumentasi', 'komentar','notulensi',
    ];
    protected $table = 'notulensi';
}
