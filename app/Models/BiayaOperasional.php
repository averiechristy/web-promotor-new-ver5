<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiayaOperasional extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'role_id',
        'biaya_operasional',
        'tanggal_mulai',
        'tanggal_selesai'
    ];

    public function Role()
    {

        return $this->belongsTo(UserRole::class);
    }

}
