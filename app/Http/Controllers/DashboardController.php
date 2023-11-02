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
       

        $today = Carbon::now();
        $endOfMonth = $today->endOfMonth()->toDateString();
        $startOfMonth = $today->startOfMonth()->toDateString();
        
        // Ambil data dari periode bulan berjalan (tanggal mulai sampai tanggal selesai)
        $leaderboardData = LeaderBoard::whereBetween('tanggal', [$startOfMonth, $endOfMonth])
        ->select('user_id', 'role_id', 'nama', 'kode_sales', \DB::raw('SUM(total) as total_poin'))
        ->groupBy('user_id', 'role_id', 'nama', 'kode_sales')
        ->orderBy('total_poin', 'desc')
       
        ->get();
        
        
    
    
        $activeRewards = Reward::where(function($query) {
            $today = now();
            $query->whereDate('tanggal_mulai', '<=', $today->toDateString())
                  ->whereDate('tanggal_selesai', '>=', $today->toDateString());
        })
            ->get();
    
        // Inisialisasi array untuk menyimpan informasi pengguna yang mencapai 50% target poin

        // Loop melalui setiap reward yang sedang berjalan
        $usersReached50Percent = [];

        $totalUsersReached50Percent = 0;
    
        // Loop melalui setiap reward yang sedang berjalan
        foreach ($activeRewards as $reward) {
            // Menghitung target poin yang diperlukan untuk mencapai 50%
            $target50Percent = $reward->poin_reward / 2;
            
            $userIds = LeaderBoard::select('user_id')
            ->where('tanggal', '>=', $reward->tanggal_mulai) // Start date of the reward period
            ->where('tanggal', '<=', $reward->tanggal_selesai) // End date of the reward period
            ->groupBy('user_id')
            ->havingRaw('SUM(total) >= ?', [$target50Percent])
            ->pluck('user_id')
            ->toArray();
    
        
            // Mengambil pengguna yang telah mencapai 50% target poin untuk reward ini
            $usersReached50Percent[$reward->id] = [];
            foreach ($userIds as $userId) {
                $user = User::find($userId);
                if ($user) {

                    $rewardRoleId = $reward->role_id;

                    if ($user->role_id == $rewardRoleId) {

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
                    $totalUsersReached50Percent += count($userIds);
                }
            }
            }
           
        }
    
        return view('admin.dashboard', [
            'role' => $role,
            'leaderboardData' => $leaderboardData,
            'activeRewards' => $activeRewards,
            'usersReached50Percent' => $usersReached50Percent,
            'totalUsersReached50Percent' => $totalUsersReached50Percent, 
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
