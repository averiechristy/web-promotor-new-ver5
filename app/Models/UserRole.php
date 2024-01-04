<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'akses_id',
        'kode_role',
        'jenis_role',
        'created_by',
        'updated_by',
        
    ];

    public function User()
    {

        return $this->hasMany(User::class);
    }

    public function Skema()
    {

        return $this->hasMany(Skema::class);
    }

    public function LeaderBoard()
    {

        return $this->hasMany(LeaderBoard::class);
    }

    public function Biaya_Operasional()
    {

        return $this->hasMany(BiayaOperasional::class);
    }

    public function Product()
    {

        return $this->hasMany(Product::class);
    }

    public function Reward()
    {

        return $this->hasMany(Reward::class);
    }


    public function Package()
    {

        return $this->hasMany(PackageIncome::class);
    }

    public function Akses()
    {

        return $this->belongsTo(Akses::class);
    }
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
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
    
    
        
    
    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

}
