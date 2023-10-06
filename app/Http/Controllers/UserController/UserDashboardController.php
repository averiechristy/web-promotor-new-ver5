<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\LeaderBoard;
use App\Models\Reward;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class UserDashboardController extends Controller
{
    /**
     *
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->user()->id;
        $currentRole = auth()->user()->role;
    
        // Mengambil semua reward dengan status "Sedang berjalan"
        $activeRewards = Reward::where('role_id', $currentRole->id)
            ->where('status', 'Sedang berjalan')
            ->where('tanggal_selesai', '>=', now())
            ->get();
    
        // Menghitung total pendapatan bulan ini
        $totalIncomeThisMonth = LeaderBoard::where('user_id', $userId)
            ->whereYear('tanggal', now()->year)
            ->whereMonth('tanggal', now()->month)
            ->sum('income');
    
        // Menghitung total poin bulan ini
        $totalPointsThisMonth = LeaderBoard::where('user_id', $userId)
            ->whereYear('tanggal', now()->year)
            ->whereMonth('tanggal', now()->month)
            ->sum('total');
    
        // Menghitung total pendapatan bulan lalu
        $lastMonth = now()->subMonth();
        $totalIncomeLastMonth = LeaderBoard::where('user_id', $userId)
            ->whereYear('tanggal', $lastMonth->year)
            ->whereMonth('tanggal', $lastMonth->month)
            ->sum('income');
    
        // Menghitung total poin bulan lalu
        $totalPointsLastMonth = LeaderBoard::where('user_id', $userId)
            ->whereYear('tanggal', $lastMonth->year)
            ->whereMonth('tanggal', $lastMonth->month)
            ->sum('total');
    
        // Menentukan apakah total pendapatan naik atau turun dibandingkan dengan bulan lalu
        $incomeChange = ($totalIncomeThisMonth > $totalIncomeLastMonth) ? 'Naik' : 'Turun';
    
        // Menentukan apakah total poin naik atau turun dibandingkan dengan bulan lalu
        $pointsChange = ($totalPointsThisMonth > $totalPointsLastMonth) ? 'Naik' : 'Turun';
    
        // Menghitung poin yang diperlukan untuk mencapai reward
        $requiredPoints = [];
    
        foreach ($activeRewards as $reward) {
            $requiredPoints[$reward->id] = $reward->poin_reward - $totalPointsThisMonth;

            $totalPointsRewardPeriod = LeaderBoard::where('user_id', $userId)
        ->whereYear('tanggal', '>=', now()->year)
        ->whereMonth('tanggal', '>=', now()->month)
        ->where('tanggal', '<=', $reward->tanggal_selesai)
        ->sum('total');
    
    // Menghitung persentase poin yang sudah dicapai
    $progressWidth = ($totalPointsRewardPeriod >= $reward->poin_reward) ? '100%' : ($totalPointsRewardPeriod / $reward->poin_reward * 100) . '%';
        }
    
        $remainingTime = [];

        foreach ($activeRewards as $reward) {
            $endDate = Carbon::parse($reward->tanggal_selesai)->endOfDay(); // Akhiri hari pada tanggal selesai
       $remainingTime[$reward->id] = now()->diffInMonths($endDate) . ' bulan ' . now()->diffInDays($endDate) . ' hari';
        }
    
        $totalPointsRewardPeriod = [];

foreach ($activeRewards as $activeReward) {
    // Menghitung total poin pengguna selama periode reward berjalan
    $totalPointsReward = LeaderBoard::where('user_id', $userId)
        ->whereYear('tanggal', '>=', now()->year)
        ->whereMonth('tanggal', '>=', now()->month)
        ->where('tanggal', '<=', $activeReward->tanggal_selesai)
        ->sum('total');

    // Simpan total poin untuk reward ini dalam array
    $totalPointsRewardPeriod[$activeReward->id] = $totalPointsReward;

    // Menghitung persentase poin yang sudah dicapai untuk reward ini
    $progressWidth = ($totalPointsReward >= $activeReward->poin_reward) ? '100%' : ($totalPointsReward / $activeReward->poin_reward * 100) . '%';

    // Simpan progressWidth untuk reward ini dalam array dengan ID reward sebagai kunci
    $progressWidthPerReward[$activeReward->id] = $progressWidth;

    // Anda dapat menggunakan $progressWidth sesuai kebutuhan di sini atau menyimpannya untuk digunakan nanti.
}

// Sekarang, Anda memiliki $progressWidthPerReward yang berisi persentase progressWidth per ID reward.

        $userRole = Auth::user()->role_id;
        $userId = Auth::user()->id;
        $leaderboardData = LeaderBoard::getLeaderboardUserDasboard($userRole);
        $userRank = LeaderBoard::getRankForUser($userId, $userRole);
        $totalUsersWithSameRole = LeaderBoard::getTotalUsersWithSameRole($userRole);


        
        return view('user.userdashboard', [
            'totalIncomeThisMonth' => $totalIncomeThisMonth,
            'totalPointsThisMonth' => $totalPointsThisMonth,
            'activeRewards' => $activeRewards,
            'requiredPoints' => $requiredPoints,
            'incomeChange' => $incomeChange,
            'pointsChange' => $pointsChange,
            'totalIncomeLastMonth' => $totalIncomeLastMonth,
            'totalPointsLastMonth' => $totalPointsLastMonth,
            'remainingTime' => $remainingTime, // Tambahkan ini
            'leaderboardData' => $leaderboardData,
            'userRank' => $userRank,
            'totalUsersWithSameRole' => $totalUsersWithSameRole,
          'totalPointsRewardPeriod' => $totalPointsRewardPeriod,
         'progressWidthPerReward' => $progressWidthPerReward,         
        ]);
    }
    
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
