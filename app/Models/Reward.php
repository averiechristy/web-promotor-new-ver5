<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'role_id',
        'judul_reward',
        'poin_reward',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'created_by',
        'updated_by',


    ];

    public function Role()
    {

        return $this->belongsTo(UserRole::class);
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
