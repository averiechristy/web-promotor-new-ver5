<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'judul_paket',
        'deskripsi_paket',
       
        
    ];

    public function produk() {
        return $this->belongsTo(Product::class, 'produk_id');
    }
    public function package()
    {
        return $this->belongsTo(PackageIncome::class);
    }
}

