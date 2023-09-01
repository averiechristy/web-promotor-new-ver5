<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
    
        'number',
        'nama_produk',
        'poin_produk',
        'gambar_produk',
        'deskripsi_produk',
        'kode_produk',
        
    ];
    public function Role()
    {

        return $this->belongsTo(UserRole::class);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function($model){
            $model->number = static::where('role_id', $model->role_id)->max('number') + 1;
            $model->kode_produk = $model->Role->kode_role . '-' . str_pad($model->number, 5, '0', STR_PAD_LEFT);
        });
    
        static::updating(function($model){
            if ($model->isDirty('role_id')) {
                $model->number = static::where('role_id', $model->role_id)->max('number') + 1;
                $model->kode_produk = $model->Role->kode_role . '-' . str_pad($model->number, 5, '0', STR_PAD_LEFT);
            }
        });
    }
    

    public function paket()
    {
        return $this->belongsTo(PackageDetail::class);
    }
 
}
