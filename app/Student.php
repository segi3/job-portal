<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name', 'nrp', 'email', 'password', 'gender',
        'birthdate', 'address', 'city', 'province',
    ];

    // many to many jobs
    public function jobs()
    {
        return $this->belongsToMany('App\Job')->withPivot('status', 'motivation_letter', 'cv');
    }
}
