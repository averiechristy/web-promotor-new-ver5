<?php

namespace App\Http\Controllers;

use App\Models\LeaderBoard;
use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportLeaderboardAkumulasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $selectedMonth = $request->input('selected_month');
        $role = UserRole::all();
        
        $today = Carbon::now();
    // Ambil tahun saat ini
    $currentYear = $today->year;

    // Set tanggal awal ke 1 Januari tahun saat ini
    $startDate = Carbon::create($currentYear, 1, 1)->startOfDay()->toDateString();

    // Set tanggal akhir ke hari ini
    $endDate = $today->toDateString();
        
        // Ambil data dari periode bulan berjalan (tanggal mulai sampai tanggal selesai)
        $leaderboardData = LeaderBoard::whereBetween('tanggal', [$startDate, $endDate])
        ->select('user_id', 'role_id', 'nama', 'kode_sales', \DB::raw('SUM(total) as total_poin'))
        ->groupBy('user_id', 'role_id', 'nama', 'kode_sales')
        ->orderBy('total_poin', 'desc')
        ->get();
        return view("admin.reportleaderboardakumulasi",[
            "role"=> $role,
            "leaderboardData"=> $leaderboardData,
            "selectedMonth"=> $selectedMonth,
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
