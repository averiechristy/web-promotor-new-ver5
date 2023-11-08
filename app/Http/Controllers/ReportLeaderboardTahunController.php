<?php

namespace App\Http\Controllers;

use App\Models\LeaderBoard;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportLeaderboardTahunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = UserRole::all();
        
        $today = Carbon::now();
    // Ambil tahun sebelumnya
    $lastYear = $today->subYear();

    // Set tanggal awal ke 1 Januari tahun sebelumnya
    $startDate = $lastYear->startOfYear()->toDateString();

    // Set tanggal akhir ke 31 Desember tahun sebelumnya
    $endDate = $lastYear->endOfYear()->toDateString();
        
        // Ambil data dari periode bulan berjalan (tanggal mulai sampai tanggal selesai)
        $leaderboardData = LeaderBoard::whereBetween('tanggal', [$startDate, $endDate])
        ->select('user_id', 'role_id', 'nama', 'kode_sales', \DB::raw('SUM(total) as total_poin'))
        ->groupBy('user_id', 'role_id', 'nama', 'kode_sales')
        ->orderBy('total_poin', 'desc')
        ->get();
        return view("admin.reportleaderboardtahun",[
            "role"=> $role,
            "leaderboardData"=> $leaderboardData
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
