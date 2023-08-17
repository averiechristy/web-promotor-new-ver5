<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PackageIncome extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'judul_paket',
        'deskripsi_paket',
       
        
    ];

    protected $casts = [
        'produk' => 'array',
        ];

    public function Role()
    {

        return $this->belongsTo(UserRole::class);
    }
}
