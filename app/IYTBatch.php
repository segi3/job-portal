<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IYTBatch extends Model
{
    //
    protected $fillable = [
        'IYTname','batch','status', 'start_date', 'end_date'
    ];
}
