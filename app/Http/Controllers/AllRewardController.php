<?php

namespace App\Http\Controllers;

use App\Models\LeaderBoard;
use App\Models\Reward;
use App\Models\User;
use Illuminate\Http\Request;

class AllRewardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   


    public function index($rewardId)
    {
        // Temukan reward berdasarkan $rewardId
        $reward = Reward::find($rewardId);

        
     $target50Percent = $reward->poin_reward /2;

     $userIds = LeaderBoard::select('leader_boards.user_id')
     ->join('users', 'leader_boards.user_id', '=', 'users.id')
     ->where('leader_boards.tanggal', '>=', $reward->tanggal_mulai)
     ->where('leader_boards.tanggal', '<=', $reward->tanggal_selesai)
     ->where('users.role_id', '=', $reward->role_id)
     ->groupBy('leader_boards.user_id')
     ->havingRaw('SUM(leader_boards.total) >= ?', [$target50Percent])
     ->pluck('leader_boards.user_id')
     ->toArray();


        // Kirim data reward ke view untuk ditampilkan
        $users = User::whereIn('id', $userIds)->paginate(10);
       

        

        $progressPercentage = [];

    $target100Percent = $reward->poin_reward;

    foreach ($users as $user) {
        $totalPointsRewardPeriod =  LeaderBoard::where('user_id', $user->id)
        ->where('tanggal', '>=', $reward->tanggal_mulai) // Menggunakan tanggal mulai reward
        ->where('tanggal', '<=', $reward->tanggal_selesai) // Menggunakan tanggal selesai reward
        ->sum('total');

        $progress = ($totalPointsRewardPeriod >= $target100Percent)
            ? '100%'
            : number_format(($totalPointsRewardPeriod / $target100Percent * 100), 1) . '%';


            $progress = ($totalPointsRewardPeriod >= $target100Percent) ? '100%' : number_format(($totalPointsRewardPeriod / $target100Percent * 100), 1) . '%';

        $progressPercentage[$user->id] = $progress;
    }
        

        // Kirim data reward dan users ke view untuk ditampilkan
        return view('admin.allreward', ['reward' => $reward, 'users' => $users, 'progressPercentage' => $progressPercentage]);

        
    }/**
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
