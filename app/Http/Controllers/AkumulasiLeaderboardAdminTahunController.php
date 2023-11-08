<?php

namespace App\Http\Controllers;

use App\Models\LeaderBoard;
use Illuminate\Http\Request;

class AkumulasiLeaderboardAdminTahunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $role_id)
    {
      
        $rankingsYear = LeaderBoard::  getLeaderboardForRole2YearBefore($role_id);
        
    
        $selectedMonth = $request->input('selected_month');
        return view('admin.akumulasiallranktahun', 
        [
         'role_id' => $role_id,
          'rankingsYear' => $rankingsYear, 
        'selectedMonth' => $selectedMonth,]);
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
