<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investasi_IYT extends Model
{
    protected $fillable = [
       'nama_kelompok', 'status','student_id', 'nama_ketua','berkas_pitch_desk','berkas_proposal_bisnis', 'admin_id','batch_id', 'invoice_iyt'
    ];
    protected $table = 'investasi_iyt';
}
