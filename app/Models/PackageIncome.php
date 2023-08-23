<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PackageIncome extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'produk_id',
        'qty_produk',
       
        
    ];

    // protected $casts = [
    //     'produk' => 'array',
    //     ];

        

    public function Role()
    {

        return $this->belongsTo(UserRole::class);
    }

    
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function details()
    {
        return $this->hasMany(PackageDetail::class);
    }

    
}
