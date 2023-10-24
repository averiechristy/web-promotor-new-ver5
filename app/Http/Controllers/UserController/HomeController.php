<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\LeaderBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $artikel = Artikel::all();

        $artikel= Artikel::orderBy('created_at', 'desc')->paginate(6); // Ubah 10 dengan jumlah data per halaman yang Anda inginkan
        $userRole = Auth::user()->role_id; // Mengambil peran pengguna yang login
        $leaderboardData = Leaderboard::getLeaderboardForRole($userRole);

       

        return view('user.home',[
            'artikel' => $artikel,
            'leaderboardData' => $leaderboardData

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
