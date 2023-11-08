<?php

namespace App\Http\Controllers;

use App\Models\LeaderBoard;
use App\Models\Reward;
use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportHistoryRewardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = UserRole::all();
        $currentDate = Carbon::now();

    $rewards = Reward::whereDate('tanggal_selesai', '<', $currentDate)
        ->get();

    $usersReached100Percent = [];

    foreach ($rewards as $reward) {
        // Calculate the target 100% points
        $target100Percent = $reward->poin_reward;

        // Get the users who have reached 100% for this reward
     $userIds = LeaderBoard::select('leader_boards.user_id')
     ->join('users', 'leader_boards.user_id', '=', 'users.id')
     ->where('leader_boards.tanggal', '>=', $reward->tanggal_mulai)
     ->where('leader_boards.tanggal', '<=', $reward->tanggal_selesai)
     ->where('users.role_id', '=', $reward->role_id)
     ->groupBy('leader_boards.user_id')
     ->havingRaw('SUM(total) >= ?', [$target100Percent])
     ->orderByRaw('SUM(total) DESC') 
     ->pluck('leader_boards.user_id')
     ->toArray();

        // Store the users who reached 100% for this reward
        $usersReached100Percent[$reward->id] = $userIds;
    }

    
    // Calculate the total number of users who reached 100% for all rewards
    $totalUsersReached100Percent = count(array_merge(...array_values($usersReached100Percent)));

    return view('admin.reporthistoryreward', [
        'rewards' => $rewards,
        'usersReached100Percent' => $usersReached100Percent,
        'totalUsersReached100Percent' => $totalUsersReached100Percent,
        'role' => $role,
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
