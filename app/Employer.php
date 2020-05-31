<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    protected $fillable = [
        'name', 'website', 'address', 'city', 'province', 'fax',
        'contact_person', 'contact_no', 'email', 'password', 'status', 'admin_id',
    ];

    // one to many jobs
    public function jobs()
    {
        return $this->hasMany('App\Job');
    }

    // many to one admin
    public function admin()
    {
        return  $this->belongsTo('App\Admin');
    }

    // one to many seminars
    public function seminars()
    {
        return $this->hasMany('App\Seminar');
    }
}
