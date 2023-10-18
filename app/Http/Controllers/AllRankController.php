<?php

namespace App\Http\Controllers;

use App\Models\LeaderBoard;
use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AllRankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = UserRole::all();
        $today = Carbon::now();

        if ($today->isMonday()) {
            // Jika hari ini adalah Senin, ambil data dari Jumat sebelumnya.
            $dateToQuery = $today->subDays(3)->toDateString();
        }else {
            // Jika hari biasa, ambil data dari hari sebelumnya.
            $dateToQuery = $today->subDay()->toDateString();
        }
    
        $leaderboardData = LeaderBoard::whereDate('tanggal', $dateToQuery)
            ->orderBy('total', 'desc')
            ->get();
    

        return view('admin.allrank', [
            'leaderboardData' => $leaderboardData,
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
