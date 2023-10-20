<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\LeaderBoard;
use App\Models\Reward;
use Illuminate\Http\Request;

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
    
        // Tanggal saat ini
        $currentDate = now();
        $oneMonthAgo = now()->subMonth(); // Tanggal satu bulan yang lalu
    
        // Mengambil semua reward sesuai dengan role_id
        $rewards = Reward::where('role_id', $role_id)
            ->orderBy('created_at', 'desc')
            ->get();
    
        // Inisialisasi array untuk menyimpan reward yang telah dicapai
        $achievedRewards = [];
    
        // Menghitung total poin yang diperoleh pengguna selama periode reward
        foreach ($rewards as $reward) {
            $totalUserPoints = LeaderBoard::where('user_id', $userId)
                ->whereYear('tanggal', '>=', now()->year)
                ->whereMonth('tanggal', '>=', now()->month)
                ->where('tanggal', '<=', $reward->tanggal_selesai)
                ->sum('total');
    
            if ($totalUserPoints >= $reward->poin_reward && $reward->tanggal_selesai >= $oneMonthAgo) {
                // Menambahkan reward yang telah dicapai dan berakhir dalam satu bulan
                $achievedRewards[] = $reward;
            }
        }
    
        return view("user.historyreward", [
            "rewards" => $achievedRewards
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
