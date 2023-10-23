<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class LeaderBoard extends Model
{

    use HasFactory;

    
    public static function getLeaderboardForRole($role)
    {
        $today = Carbon::now();
    
        // Ambil tanggal awal bulan ini
        $startDate = $today->startOfMonth()->toDateString();
    
        // Ambil tanggal akhir bulan ini
        $endDate = $today->endOfMonth()->toDateString();
    
        return self::whereBetween('tanggal', [$startDate, $endDate])
            ->where('role_id', $role)
            ->orderBy('income', 'desc')
            ->orderBy('total', 'desc') // Gantilah 'kriteria_lain' dengan nama kolom yang sesuai
            ->take(3) // Ambil 3 pemimpin teratas.
            ->get();
    }
    

    public function getAllLeaderboardToday()
{
    $today = Carbon::now();

    if ($today->isMonday()) {
        // Jika hari ini adalah Senin, ambil data dari Jumat sebelumnya.
        $dateToQuery = $today->subDays(3)->toDateString();
    }else {
        // Jika hari biasa, ambil data dari hari sebelumnya.
        $dateToQuery = $today->subDay()->toDateString();
    }
    
    $leaderboardData = LeaderBoard::whereDate('tanggal', $dateToQuery)
        ->orderBy('total', 'desc')
        ->take(10) // Ambil 10 leaderboard
        ->get();

    return $leaderboardData;
}
    
 public static function getLeaderboardUser($role)
    {

        $today = Carbon::now();

     
            // Jika hari biasa, ambil data dari hari sebelumnya.
            $dateToQuery = $today->subDay()->toDateString();
        

        return self::whereDate('tanggal', $dateToQuery)
            ->where('role_id', $role)
            ->orderBy('total', 'desc')
            ->take(10) // Ambil 10 leaderboard
            ->get();
    }


    public static function getLeaderboardUserAdminDashboard($role)
    {
        $today = Carbon::now();


            // Jika hari biasa, ambil data dari hari sebelumnya.
            $dateToQuery = $today->subDay()->toDateString();
        
        
        return self::whereDate('tanggal', $dateToQuery)
            ->where('role_id', $role)
            ->orderBy('total', 'desc')
            ->take(10) // Ambil 10 leaderboard
            ->get();
    }

    public static function getLeaderboardUserDasboard($role)
    {
        $today = Carbon::now();

     
            // Jika hari biasa, ambil data dari hari sebelumnya.
            $dateToQuery = $today->subDay()->toDateString();
      
        return self::whereDate('tanggal', $dateToQuery)
            ->where('role_id', $role)
            ->orderBy('total', 'desc')
            ->get();
    }

    public static function getTotalUsersWithSameRole($role)
{
    $today = Carbon::now();

   
        // Jika hari biasa, ambil data dari hari sebelumnya.
        $dateToQuery = $today->subDay()->toDateString();
    
    return self::whereDate('tanggal', $dateToQuery)
        ->where('role_id', $role)
        ->count();
}


public static function getRankForUser($userId, $role)
{
    $today = Carbon::now();

 
        // Jika hari biasa, ambil data dari hari sebelumnya.
        $dateToQuery = $today->subDay()->toDateString();
    
    // Check if there is any data for the given role in the database.
    $roleDataExists = self::whereDate('tanggal', $dateToQuery)
        ->where('role_id', $role)
        ->exists();

    if (!$roleDataExists) {
        // Handle the case where no data exists for the given role.
        return null; // You can return null or an appropriate value indicating no data.
    }

    $userTotal = self::whereDate('tanggal', $dateToQuery)
        ->where('role_id', $role)
        ->where('user_id', $userId)
        ->value('total');

    if ($userTotal === null) {
        return '-';
    }

    $rank = self::whereDate('tanggal', $dateToQuery)
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
