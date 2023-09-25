<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaderBoard extends Model
{

    use HasFactory;

 public static function getLeaderboardForRole($role)
    {
        return self::whereDate('created_at', now()->toDateString())
            ->where('role_id', $role)
            ->orderBy('total', 'desc')
            ->take(3) // Ambil 3 pemimpin teratas.
            ->get();
    }

 public static function getLeaderboardUser($role)
    {
        return self::whereDate('created_at', now()->toDateString())
            ->where('role_id', $role)
            ->orderBy('total', 'desc')
            ->take(10) // Ambil 10 leaderboard
            ->get();
    }

    protected $fillable = [
        'no',
        'role_id',
        'user_id',
        'nama',
        'pencapaian',
        'income',
        'total',// Kolom JSON yang baru ditambahkan
    ];

    protected $casts = [
        'pencapaian' => 'array',
    ];

    public function User()
    {
        return $this->belongsTo(User::class); // Pastikan sesuaikan dengan nama kolom yang sesuai di tabel Leaderboard.
    }

    public function Role()
    {

        return $this->belongsTo(UserRole::class);
    }
}
