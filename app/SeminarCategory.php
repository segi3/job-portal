<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeminarCategory extends Model
{
    protected $fillable = [
        'name', 'description',
    ];

    // one to many jobs
    public function seminars()
    {
        return $this->hasMany('App\Seminar');
    }
}
