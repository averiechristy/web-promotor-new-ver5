<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Artikel extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'judul_artikel',
        'gambar_artikel',
        'isi_artikel',
        
        
    ];
}
