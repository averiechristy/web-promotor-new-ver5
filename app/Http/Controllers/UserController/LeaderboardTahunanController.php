<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\LeaderBoard;
use Auth;
use Illuminate\Http\Request;

class LeaderboardTahunanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userRole = Auth::user()->role_id;
        $userId = auth()->user()->id;
        $leaderboardData = LeaderBoard::getLeaderboardUserYear($userRole);
        $userRank = LeaderBoard::getRankForUserYear($userId, $userRole);
        $totalUsersWithSameRole = LeaderBoard::getTotalUsersWithSameRoleYear($userRole);

        

       
        return view('user.userleaderboardtahun',[
            'leaderboardData' => $leaderboardData,
            'userRank'=> $userRank,
            'totalUsersWithSameRole'=> $totalUsersWithSameRole
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
