<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'role_id',
        'nama_produk',
        'poin_produk',
        'gambar_produk',
        'deskripsi_produk',
        
    ];
    public function Role()
    {

        return $this->belongsTo(UserRole::class);
    }
 
}
