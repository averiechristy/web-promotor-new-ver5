<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\LeaderBoard;
use App\Models\Reward;
use Auth;
use Illuminate\Http\Request;
use DB;

class HistoryRewardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $user = auth()->user();
    $userId = auth()->user()->id;
    $role_id = $user->role_id;

    // Mengambil semua reward yang sudah berakhir sesuai dengan role_id
    $rewards = Reward::where('role_id', $role_id)
        ->where('tanggal_selesai', '<', now())
        ->orderBy('created_at', 'desc')
        ->get();
        

    // Inisialisasi array untuk menyimpan reward yang telah dicapai
    $achievedRewards = [];

    
    foreach ($rewards as $reward) {
        $userRoleId = Auth::user()->role_id;

        
        // Menghitung total poin pengguna selama periode reward berjalan
        $totalUserPoints = LeaderBoard::where('user_id', $userId)
            ->where('tanggal', '>=', $reward->tanggal_mulai) // Tanggal mulai reward
            ->where('tanggal', '<=', $reward->tanggal_selesai) // Tanggal selesai reward
            ->sum('total');

            $totalUsers = LeaderBoard::selectRaw('user_id, SUM(total) as total_points')
    ->where('tanggal', '>=', $reward->tanggal_mulai)
    ->where('tanggal', '<=', $reward->tanggal_selesai)
    ->where('role_id', $userRoleId) // Ganti $userRoleId dengan nilai yang sesuai
    ->groupBy('user_id')
    ->having('total_points', '>=', $reward->poin_reward)
    ->distinct('user_id')
    ->count();
    
    
           
    $userRankQuery = LeaderBoard::select('user_id', DB::raw('SUM(total) as total_points'))
    ->where('tanggal', '>=', $reward->tanggal_mulai)
    ->where('tanggal', '<=', $reward->tanggal_selesai)
    ->where('role_id', $userRoleId)
    ->groupBy('user_id')
    ->orderByDesc('total_points');

$userRank = $userRankQuery->pluck('user_id')->search($userId);

$userRankRewardPeriod[$reward->id] = $userRank !== false ? $userRank + 1 : null;
$totalpoinuser[$reward->id] = $totalUserPoints;

            $totalUsersRewardPeriod[$reward->id] = $totalUsers;
        

            if ($totalUserPoints >= $reward->poin_reward) {
                // Menambahkan reward yang telah dicapai
                $achievedRewards[] = $reward;
            }
        
            if ($userRank !== false && $userRank + 1 <= $reward->kuota) {
                // Menambahkan reward yang telah dicapai dengan status "Reward Tercapai"
                $reward->status = '<i style="color:white;" class="fas fa-check-circle"></i> Reward Tercapai';
            } else {
                // Menambahkan reward yang tidak tercapai dengan status "Reward Tidak Tercapai"
                $reward->status = '<i style="color:white;" class="fas fa-times-circle"></i> Reward Tidak Tercapai';
            }
    }


    return view("user.historyreward", [
        "rewards" => $achievedRewards,
        'userRankRewardPeriod' => $userRankRewardPeriod,
        'totalUsersRewardPeriod' => $totalUsersRewardPeriod,
        'totalpoinuser' => $totalpoinuser,
        'userRank' => $userRank
       

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
