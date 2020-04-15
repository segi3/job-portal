<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'name', 'mobile_no', 'email', 'password',
    ];

    // one to many jobs
    public function jobs()
    {
        return $this->hasMany('App\Job');
    }

    // one to many employers
    public function employers()
    {
        return $this->hasMany('App\Employer');
    }

    // one to many seminar
    public function seminars()
    {
        return $this->hasMany('App\Seminar');
    }
}
