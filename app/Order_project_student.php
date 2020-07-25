<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_project_student extends Model
{
    protected $fillable = [
        'student_id', 'project_id', 'status', 'lembar_beli', 'total_harga', 'oder_date', 'payment_due', 'snap_token',
        'order_id',
    ];
    
    protected $table = 'order_student_project';
}
