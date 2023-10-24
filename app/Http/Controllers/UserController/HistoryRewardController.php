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

    // Mengambil semua reward yang sudah berakhir sesuai dengan role_id
    $rewards = Reward::where('role_id', $role_id)
        ->where('tanggal_selesai', '<', now())
        ->orderBy('created_at', 'desc')
        ->get();

    // Inisialisasi array untuk menyimpan reward yang telah dicapai
    $achievedRewards = [];

    foreach ($rewards as $reward) {
        // Menghitung total poin pengguna selama periode reward berjalan
        $totalUserPoints = LeaderBoard::where('user_id', $userId)
            ->where('tanggal', '>=', $reward->tanggal_mulai) // Tanggal mulai reward
            ->where('tanggal', '<=', $reward->tanggal_selesai) // Tanggal selesai reward
            ->sum('total');

        if ($totalUserPoints >= $reward->poin_reward) {
            // Menambahkan reward yang telah dicapai
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
