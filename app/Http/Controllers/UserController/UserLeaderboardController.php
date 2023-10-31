<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\LeaderBoard;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserLeaderboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userRole = Auth::user()->role_id;
        $userId = auth()->user()->id;
        $leaderboardData = LeaderBoard::getLeaderboardUser($userRole);
        $userRank = LeaderBoard::getRankForUser($userId, $userRole);
        $totalUsersWithSameRole = LeaderBoard::getTotalUsersWithSameRole($userRole);



        return view('user.leaderboard',[
            'leaderboardData' => $leaderboardData,
            'userRank' => $userRank,
            'totalUsersWithSameRole' => $totalUsersWithSameRole,


        ]);
    }

    

    

    

    // LeaderboardController.php
public function view(Request $request)
{
    $userRole = Auth::user()->role_id;
    $selectedMonth = $request->input('selected_month');
    
    // Pastikan $selectedMonth adalah dalam format tahun-bulan (YYYY-MM).
    
    // Ambil tahun dan bulan dari input.
    list($year, $month) = explode('-', $selectedMonth);
    
    // Buat tanggal awal dan akhir berdasarkan tahun dan bulan yang dipilih.
    $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth()->toDateString();
    $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth()->toDateString();

    $leaderboardData = LeaderBoard::getLeaderboardUserForMonth($userRole, $startDate, $endDate);
    $userRank = LeaderBoard::getRankForUserForMonth(Auth::user()->id, $userRole, $startDate, $endDate);
    $totalUsersWithSameRole = LeaderBoard::getTotalUsersWithSameRoleForMonth($userRole, $startDate, $endDate);

    return view('user.leaderboard', [
        'leaderboardData' => $leaderboardData,
        'userRank' => $userRank,
        'totalUsersWithSameRole' => $totalUsersWithSameRole,
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
