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

    public function getAllLeaderboardToday()
{
    $leaderboardData = LeaderBoard::whereDate('created_at', now()->toDateString())
        ->orderBy('total', 'desc')
        ->take(10) // Ambil 10 leaderboard
        ->get();

    return $leaderboardData;
}
    
 public static function getLeaderboardUser($role)
    {
        return self::whereDate('created_at', now()->toDateString())
            ->where('role_id', $role)
            ->orderBy('total', 'desc')
            ->take(10) // Ambil 10 leaderboard
            ->get();
    }


    public static function getLeaderboardUserAdminDashboard($role)
    {
        return self::whereDate('created_at', now()->toDateString())
            ->where('role_id', $role)
            ->orderBy('total', 'desc')
            ->take(10) // Ambil 10 leaderboard
            ->get();
    }

    public static function getLeaderboardUserDasboard($role)
    {
        return self::whereDate('created_at', now()->toDateString())
            ->where('role_id', $role)
            ->orderBy('total', 'desc')
            ->get();
    }

    public static function getTotalUsersWithSameRole($role)
{
    return self::whereDate('created_at', now()->toDateString())
        ->where('role_id', $role)
        ->count();
}


public static function getRankForUser($userId, $role)
{
    // Check if there is any data for the given role in the database.
    $roleDataExists = self::whereDate('created_at', now()->toDateString())
        ->where('role_id', $role)
        ->exists();

    if (!$roleDataExists) {
        // Handle the case where no data exists for the given role.
        return null; // You can return null or an appropriate value indicating no data.
    }

    $userTotal = self::whereDate('created_at', now()->toDateString())
        ->where('role_id', $role)
        ->where('user_id', $userId)
        ->value('total');

    if ($userTotal === null) {
        return null;
    }

    $rank = self::whereDate('created_at', now()->toDateString())
        ->where('role_id', $role)
        ->where('total', '>', $userTotal)
        ->count();

    // Karena peringkat dimulai dari 1, tambahkan 1 ke hasil perhitungan.
    return $rank + 1;
}



    protected $fillable = [
        'no',
        'role_id',
        'user_id',
        'nama',
        'pencapaian',
        'tanggal',
        'income',
        'kode_sales',
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
