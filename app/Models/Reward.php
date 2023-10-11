<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Reward extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'role_id',
        'judul_reward',
        'poin_reward',
        'deskripsi_reward',
        'gambar_reward',
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

    protected static function booted()
    {
        parent::booted();

        static::saving(function ($reward) {
            $currentDate = now();
            $endDate = Carbon::parse($reward->tanggal_selesai)->endOfDay();

            if ($currentDate >= $reward->tanggal_mulai && $currentDate <= $endDate) {
                $reward->status = 'Sedang berjalan';
            } elseif ($currentDate < $reward->tanggal_mulai) {
                $reward->status = 'Akan datang';
            } else {
                $reward->status = 'Tidak Aktif';
            }
        });
    }
}
