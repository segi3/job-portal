<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'name', 'position', 'description', 'job_type', 'location', 'expected_salary',
        'required_skill', 'minimal_qualification', 'extra_skill',
    ];

    // many to many students
    public function students()
    {
        return $this->belongsToMany('App\Student')->withPivot('status', 'motivation_letter', 'cv');
    }

    // many to one category
    public function category()
    {
        return  $this->belongsTo('App\JobCategory');
    }

    // many to one employer
    public function employer()
    {
        return  $this->belongsTo('App\Employer');
    }

    // many to one admin
    public function admin()
    {
        return  $this->belongsTo('App\Admin');
    }
}
