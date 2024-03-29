<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    protected $fillable = [
        'name', 'description', 'fee', 'location', 'contact_person', 'contact_no', 'seminar_category_id',
        'employer_id', 'admin_id','berkas_verifikasi', 'poster', 'profil_pembicara', 'target', 'materi',
        'waktu',
    ];

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

    // many to one category
    public function category()
    {
        return  $this->belongsTo('App\SeminarCategory');
    }
}
