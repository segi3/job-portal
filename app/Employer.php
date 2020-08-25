<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    protected $fillable = [
        'name','logo', 'website', 'address', 'city', 'province', 'fax',
        'contact_person', 'contact_no', 'email', 'password', 'status', 'admin_id',
        'berkas_verifikasi', 'order_rekrutmen'
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
