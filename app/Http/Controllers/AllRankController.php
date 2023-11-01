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
    public function index(Request $request, $role_id)
    {
        $rankings = LeaderBoard::getLeaderboardForRole2($role_id);
        
    
        $selectedMonth = $request->input('selected_month');
        return view('admin.allrank', ['rankings' => $rankings, 'role_id' => $role_id,  'selectedMonth' => $selectedMonth,]);
    }
    


    public function viewhistory(Request $request, $role_id)
{
   
    $selectedMonth = $request->input('selected_month');
   
    
    
    // Pastikan $selectedMonth adalah dalam format tahun-bulan (YYYY-MM).
    
    // Ambil tahun dan bulan dari input.
    list($year, $month) = explode('-', $selectedMonth);
    
    // Buat tanggal awal dan akhir berdasarkan tahun dan bulan yang dipilih.
    $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth()->toDateString();
    $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth()->toDateString();



    $rankings = LeaderBoard::getLeaderboardForRoleMonth($role_id, $startDate, $endDate);
   

    return view('admin.allrank', ['rankings' => $rankings, 'role_id' => $role_id,  'selectedMonth' => $selectedMonth,]);

    
    
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
