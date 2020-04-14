<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    protected $fillable = [
        'name', 'description',
    ];

    // one to many jobs
    public function jobs()
    {
        return $this->hasMany('App\Job');
    }
}
