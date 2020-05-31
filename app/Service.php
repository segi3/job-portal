<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name', 'description', 'status', 'student_id', 'job_category_id', 'admin_id',
    ];
}
