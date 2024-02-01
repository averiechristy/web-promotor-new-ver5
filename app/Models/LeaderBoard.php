<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;



class LeaderBoard extends Model
{

    use HasFactory;


    public static function getTotalUsersWithSameRoleYearNow($role)
    {
        $today = Carbon::now();
    // Ambil tahun saat ini
    $currentYear = $today->year;

    // Set tanggal awal ke 1 Januari tahun saat ini
    $startDate = Carbon::create($currentYear, 1, 1)->startOfDay()->toDateString();

    // Set tanggal akhir ke hari ini
    $endDate = $today->toDateString();
    
        return self::whereBetween('tanggal', [$startDate, $endDate])
            ->where('role_id', $role)
            ->take(10)
            ->distinct('user_id') // Menghindari penghitungan ganda user dengan ID yang sama.
            ->count();
    }

    public static function getRankForUserYearNow($userId, $role)
{
    $today = Carbon::now();
    // Ambil tahun saat ini
    $currentYear = $today->year;

    // Set tanggal awal ke 1 Januari tahun saat ini
    $startDate = Carbon::create($currentYear, 1, 1)->startOfDay()->toDateString();

    // Set tanggal akhir ke hari ini
    $endDate = $today->toDateString();
    
    // Query untuk menghitung peringkat pengguna berdasarkan total income dan total point.
    $userRankQuery = self::select('user_id', 
        DB::raw('SUM(total) as total_point'))
        ->whereBetween('tanggal', [$startDate, $endDate])
        ->where('role_id', $role)
        ->groupBy('user_id')
        ->orderBy('total_point', 'desc');

    // Query untuk mengambil peringkat pengguna tertentu.
    $userRank = $userRankQuery->pluck('user_id')->search($userId);

    if ($userRank === false) {
        // Handle the case where no data exists for the given user.
        return null; // You can return null or an appropriate value indicating no data.
    }

    // Karena peringkat dimulai dari 0, tambahkan 1 ke hasil perhitungan.
    return $userRank + 1;
}
    public static function getLeaderboardUserYearNow($role)
{
    $today = Carbon::now();
    // Ambil tahun saat ini
    $currentYear = $today->year;

    // Set tanggal awal ke 1 Januari tahun saat ini
    $startDate = Carbon::create($currentYear, 1, 1)->startOfDay()->toDateString();

    // Set tanggal akhir ke hari ini
    $endDate = $today->toDateString();

    return self::select('user_id', 
                DB::raw('SUM(total) as total_point'))
        ->whereBetween('tanggal', [$startDate, $endDate])
        ->where('role_id', $role)
        ->groupBy('user_id')
        ->take(10)
        ->orderBy('total_point', 'desc') // Ambil 10 pemimpin teratas.
        ->get();
}


    public static function getTotalUsersWithSameRoleYear($role)
    {
       $today = Carbon::now();
    // Ambil tahun sebelumnya
    $lastYear = $today->subYear();

    // Set tanggal awal ke 1 Januari tahun sebelumnya
    $startDate = $lastYear->startOfYear()->toDateString();

    // Set tanggal akhir ke 31 Desember tahun sebelumnya
    $endDate = $lastYear->endOfYear()->toDateString();
    
        return self::whereBetween('tanggal', [$startDate, $endDate])
            ->where('role_id', $role)
            ->distinct('user_id') // Menghindari penghitungan ganda user dengan ID yang sama.
            ->count();
    }

    public static function getRankForUserYear($userId, $role)
{
    $today = Carbon::now();
    // Ambil tahun sebelumnya
    $lastYear = $today->subYear();

    // Set tanggal awal ke 1 Januari tahun sebelumnya
    $startDate = $lastYear->startOfYear()->toDateString();

    // Set tanggal akhir ke 31 Desember tahun sebelumnya
    $endDate = $lastYear->endOfYear()->toDateString();
    
    // Query untuk menghitung peringkat pengguna berdasarkan total income dan total point.
    $userRankQuery = self::select('user_id', 
        DB::raw('SUM(total) as total_point'))
        ->whereBetween('tanggal', [$startDate, $endDate])
        ->where('role_id', $role)
        ->groupBy('user_id')
        ->orderBy('total_point', 'desc');

    // Query untuk mengambil peringkat pengguna tertentu.
    $userRank = $userRankQuery->pluck('user_id')->search($userId);

    if ($userRank === false) {
        // Handle the case where no data exists for the given user.
        return null; // You can return null or an appropriate value indicating no data.
    }

    // Karena peringkat dimulai dari 0, tambahkan 1 ke hasil perhitungan.
    return $userRank + 1;
}
    public static function getLeaderboardUserYear($role)
{
    $today = Carbon::now();
    // Ambil tahun sebelumnya
    $lastYear = $today->subYear();

    // Set tanggal awal ke 1 Januari tahun sebelumnya
    $startDate = $lastYear->startOfYear()->toDateString();

    // Set tanggal akhir ke 31 Desember tahun sebelumnya
    $endDate = $lastYear->endOfYear()->toDateString();

    return self::select('user_id', 
                DB::raw('SUM(total) as total_point'))
        ->whereBetween('tanggal', [$startDate, $endDate])
        ->take(10)
        ->where('role_id', $role)
        ->groupBy('user_id')
        ->orderBy('total_point', 'desc') // Ambil 10 pemimpin teratas.
        ->get();
}


    public static function getLeaderboardForRole($role)
{
    $today = Carbon::now();
    
    // Ambil tanggal awal bulan ini
    $startDate = $today->startOfMonth()->toDateString();
    
    // Ambil tanggal akhir bulan ini
    $endDate = $today->endOfMonth()->toDateString();
    
    return self::select('user_id', 
            
                DB::raw('SUM(total) as total_point'))
        ->whereBetween('tanggal', [$startDate, $endDate])
        ->where('role_id', $role)
        ->groupBy('user_id')
        ->orderBy('total_point', 'desc')
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

public static function getLeaderboardForRole2($role)
{
    $today = Carbon::now();

    // Ambil tanggal awal bulan ini
    $startDate = $today->startOfMonth()->toDateString();

    // Ambil tanggal akhir bulan ini
    $endDate = $today->endOfMonth()->toDateString();

    return self::select('user_id', 
                DB::raw('SUM(total) as total_point'))
        ->whereBetween('tanggal', [$startDate, $endDate])
        ->where('role_id', $role)
        ->groupBy('user_id')
        ->orderBy('total_point', 'desc')
        ->get();
}

public static function getLeaderboardForRole2YearNow($role)
{
    $today = Carbon::now();
    // Ambil tahun saat ini
    $currentYear = $today->year;

    // Set tanggal awal ke 1 Januari tahun saat ini
    $startDate = Carbon::create($currentYear, 1, 1)->startOfDay()->toDateString();

    // Set tanggal akhir ke hari ini
    $endDate = $today->toDateString();

    return self::select('user_id', 
                DB::raw('SUM(total) as total_point'))
        ->whereBetween('tanggal', [$startDate, $endDate])
        ->where('role_id', $role)
        ->groupBy('user_id')
        ->orderBy('total_point', 'desc')
        ->get();
}

public static function getLeaderboardForRole2YearBefore($role)
{
    $today = Carbon::now();
    // Ambil tahun sebelumnya
    $lastYear = $today->subYear();

    // Set tanggal awal ke 1 Januari tahun sebelumnya
    $startDate = $lastYear->startOfYear()->toDateString();

    // Set tanggal akhir ke 31 Desember tahun sebelumnya
    $endDate = $lastYear->endOfYear()->toDateString();

    return self::select('user_id', 
                DB::raw('SUM(total) as total_point'))
        ->whereBetween('tanggal', [$startDate, $endDate])
        ->where('role_id', $role)
        ->groupBy('user_id')
        ->orderBy('total_point', 'desc')
        ->get();
}
    
 
public static function getLeaderboardUser($role)
    {
        $today = Carbon::now();
        // Ambil tanggal awal bulan ini
        $startDate = $today->startOfMonth()->toDateString();
        
        
        // Ambil tanggal akhir bulan ini
        $endDate = $today->endOfMonth()->toDateString();
        
        return self::select('user_id', 
                    DB::raw('SUM(total) as total_point'))
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->where('role_id', $role)
            ->groupBy('user_id')
            ->orderBy('total_point', 'desc')
            ->take(10) // Ambil 3 pemimpin teratas.
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
        // Ambil tanggal awal bulan ini
        $startDate = $today->startOfMonth()->toDateString();
        
        
        // Ambil tanggal akhir bulan ini
        $endDate = $today->endOfMonth()->toDateString();
        
        return self::select('user_id', 
                    DB::raw('SUM(total) as total_point'))
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->where('role_id', $role)
            ->groupBy('user_id')
            ->orderBy('total_point', 'desc')
            ->get();
    }

    public static function getTotalUsersWithSameRole($role)
    {
        $today = Carbon::now();
    
        // Jika hari ini adalah tanggal awal bulan, kita perlu mengambil data dari bulan sebelumnya.
        $startDate = $today->startOfMonth();
      
    
        // Ambil tanggal awal bulan dan akhir bulan dari startDate
        $startDate = $startDate->toDateString();
        $endDate = $today->endOfMonth()->toDateString();
    
        return self::whereBetween('tanggal', [$startDate, $endDate])
            ->where('role_id', $role)
            ->distinct('user_id') // Menghindari penghitungan ganda user dengan ID yang sama.
            ->count();
    }
    
    
public static function getRankForUser($userId, $role)
{
    $today = Carbon::now();
    
    // Ambil tanggal awal bulan ini
    $startDate = $today->startOfMonth()->toDateString();

    
    // Ambil tanggal akhir bulan ini
    $endDate = $today->endOfMonth()->toDateString();
    
    // Query untuk menghitung peringkat pengguna berdasarkan total income dan total point.
    $userRankQuery = self::select('user_id', 
        DB::raw('SUM(total) as total_point'))
        ->whereBetween('tanggal', [$startDate, $endDate])
        ->where('role_id', $role)
        ->groupBy('user_id')
        ->orderBy('total_point', 'desc');

        

    // Query untuk mengambil peringkat pengguna tertentu.
    $userRank = $userRankQuery->pluck('user_id')->search($userId);

    
    if ($userRank === false) {
        // Handle the case where no data exists for the given user.
        return null; // You can return null or an appropriate value indicating no data.
    }

    // Karena peringkat dimulai dari 0, tambahkan 1 ke hasil perhitungan.
    return $userRank + 1;
}

// LeaderBoard.php
public static function getLeaderboardUserForMonth($role, $startDate, $endDate)
{
    return self::select('user_id', 
                    DB::raw('SUM(total) as total_point'))
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->where('role_id', $role)
            ->groupBy('user_id')
            ->orderBy('total_point', 'desc')
            ->take(10)
            ->get();
}

public static function getTotalUsersWithSameRoleForMonth($role, $startDate, $endDate)
{
    return self::whereBetween('tanggal', [$startDate, $endDate])
        ->where('role_id', $role)
        ->distinct('user_id')
        ->count();
}

public static function getRankForUserForMonth($userId, $role, $startDate, $endDate)
{
    $userRankQuery = self::select('user_id', 
        DB::raw('SUM(total) as total_point'))
        ->whereBetween('tanggal', [$startDate, $endDate])
        ->where('role_id', $role)
        ->groupBy('user_id')
        ->orderBy('total_point', 'desc');

    $userRank = $userRankQuery->pluck('user_id')->search($userId);

    if ($userRank === false) {
        return null;
    }

    return $userRank + 1;
}

public static function getLeaderboardForRoleMonth($role, $startDate, $endDate)
{
   
    return self::select('user_id', 
                DB::raw('SUM(total) as total_point'))
        ->whereBetween('tanggal', [$startDate, $endDate])
        ->where('role_id', $role)
        ->groupBy('user_id')
        ->orderBy('total_point', 'desc')
        ->get();
}

    protected $fillable = [
        'no',
        'role_id',
        'user_id',
        'nama',
        'pencapaian',
        'tanggal',
        'pencapaian_flag',
        'kode_sales',
        'ntb_reg_flag',
        'totalflag',
        'total',// Kolom JSON yang baru ditambahkan
    ];

    protected $casts = [
        'pencapaian' => 'array',
        'pencapaian_flag' => 'array',
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
