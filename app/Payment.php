<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'invoice',
        'amount', 'method', 'status', 'token', 'payload', 'payment_type', 'va_number', 'vendor_name',
        'biller_code', 'bill_key',
    ];
    
    protected $table = 'payment_notifications';
}
