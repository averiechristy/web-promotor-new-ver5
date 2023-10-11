<?php

namespace App\Http\Controllers;

use App\Models\Akses;
use App\Models\LeaderBoard;
use App\Models\Reward;
use App\Models\User;
use App\Models\UserRole;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = UserRole::all();
        $userRole = Auth::user()->role_id;
       
        $today = Carbon::today();
    
        $leaderboardData = LeaderBoard::whereDate('created_at', $today)
            ->orderBy('total', 'desc')
            ->get();
    
        $activeRewards = Reward::where('status', 'Sedang berjalan')
            ->where('tanggal_selesai', '>=', now()->endOfDay())
            ->get();
    
        // Inisialisasi array untuk menyimpan informasi pengguna yang mencapai 50% target poin
        $usersReached50Percent = [];
    
        // Loop melalui setiap reward yang sedang berjalan
        foreach ($activeRewards as $reward) {
            // Menghitung target poin yang diperlukan untuk mencapai 50%
            $target50Percent = $reward->poin_reward / 2;
            
            $userIds = LeaderBoard::where('total', '>=', $target50Percent)
                ->where('tanggal', '<=', $reward->tanggal_selesai)
                ->pluck('user_id')
                ->toArray();
    
            // Mengambil pengguna yang telah mencapai 50% target poin untuk reward ini
            $usersReached50Percent[$reward->id] = [];
            foreach ($userIds as $userId) {
                $user = User::find($userId);
                if ($user) {
                    $totalPointsRewardPeriod = LeaderBoard::where('user_id', $userId)
                        ->whereYear('tanggal', '>=', now()->year)
                        ->whereMonth('tanggal', '>=', now()->month)
                        ->where('tanggal', '<=', $reward->tanggal_selesai)
                        ->sum('total');
    
                    $target100Percent = $reward->poin_reward;
                    $progressPercentage = ($totalPointsRewardPeriod >= $target100Percent)
                    ? '100%'
                    : number_format(($totalPointsRewardPeriod / $target100Percent * 100), 1) . '%';
                
                    // Simpan informasi progressPercentage untuk pengguna ini
                    $usersReached50Percent[$reward->id][$userId] = [
                        'nama' => $user->nama,
                        'progressPercentage' => $progressPercentage,
                    ];
                }
            }
        }
    
        return view('admin.dashboard', [
            'role' => $role,
            'leaderboardData' => $leaderboardData,
            'activeRewards' => $activeRewards,
            'usersReached50Percent' => $usersReached50Percent,
        ]);
    }
    
    

    // public function getLeaderboard($role_id)
    // {
    //     // Ambil data leaderboard sesuai dengan role yang dipilih

        
    //     $leaderboardData = Leaderboard::getLeaderboardUserAdminDashboard($role_id);

        
       
    //     // Kirim data sebagai respons JSON
    //     return response()->json($leaderboardData);
    // }

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
