<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skema extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'produk_id',
        'poin_produk',
        'tanggal_mulai',
        'tanggal_selesai',
        'role_id',
        'keterangan',
        'created_by',
        'updated_by',

    ];


    public function Role()
    {

        return $this->belongsTo(UserRole::class);
    }


    public function Produk()
    {

        return $this->belongsTo(Product::class);
    }

    public function insentifdetails()
    {
        return $this->hasMany(DetailInsentif::class);
    }

  // Skema.php (Model)
public function hasPoinProduk()
{
    // Sesuaikan dengan logika bisnis Anda
    return $this->poin_produk !== null;
}

    
}
