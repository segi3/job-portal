<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class iyt_mentoring extends Model
{
    protected $fillable = [
        'judul', 'tgl_mentoring', 'link', 'mentor_id','batch_id'
    ];
}
