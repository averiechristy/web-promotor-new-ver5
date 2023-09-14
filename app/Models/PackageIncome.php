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
        'created_by',
        'updated_by',
       
        
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

    public static function boot()
    {
        parent::boot();
    
        // Event "updating" dipicu ketika entitas diperbarui
        static::updating(function ($item) {
            // Ambil ID pengguna yang saat ini sedang masuk
            $loggedInUser = auth()->user();
            $loggedInUsername = $loggedInUser->nama; 
        
            // Set kolom "updated_by" dengan ID pengguna yang sedang masuk
            $item->updated_by = $loggedInUsername;
        });
    }
    
}
