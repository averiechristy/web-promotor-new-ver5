<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\LeaderBoard;
use App\Models\Reward;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MyIncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mengambil data pendapatan dan poin untuk pengguna yang login
        $userId = auth()->user()->id;
        // Mengambil data tanggal awal dan akhir dari request
        $currentRole = auth()->user()->role; // Gantilah ini dengan cara Anda mengambil peran pengguna saat ini
       
        // Jika tidak ada tanggal yang dipilih, tampilkan total pendapatan dan total poin pada bulan berjalan
       
            // Menghitung total pendapatan dan total poin pada bulan berjalan
            $currentMonth = now()->format('Y-m');
            // $totalIncomeThisMonth = Leaderboard::where('user_id', $userId)
            //     ->whereYear('tanggal', now()->year)
            //     ->whereMonth('tanggal', now()->month)
            //     ->sum('income');
            $totalPointsThisMonth = Leaderboard::where('user_id', $userId)
                ->whereYear('tanggal', now()->year)
                ->whereMonth('tanggal', now()->month)
                ->sum('total');

                if ($totalPointsThisMonth <= 0) {
                    $hasil = 0;
                } else if ($totalPointsThisMonth < 72) {
                    $hasil = 3600000;
                } else if ($totalPointsThisMonth > 72 && $totalPointsThisMonth < 120) {
                    $insentif = ($totalPointsThisMonth - 72) * 40000;
                    $hasil = $insentif + 3600000;
                } else if ($totalPointsThisMonth == 72) {
                    $hasil = 3600000;
                } elseif ($totalPointsThisMonth == 120) {
                    $hasil = 6000000;
                } elseif ($totalPointsThisMonth > 120) {
                    $insentif = ($totalPointsThisMonth - 120) * 40000;
                    $hasil = $insentif + 6000000;
                }
                
                $totalIncomeThisMonth = $hasil;
    
            // Menghitung poin yang dibutuhkan lagi untuk mencapai reward
    
            return view('user.myincome', [
                'totalIncomeThisMonth' => $totalIncomeThisMonth,
                'totalPointsThisMonth' => $totalPointsThisMonth,

            ]);
      
    }
    

    public function filterIncome(Request $request)
{
    // Ambil data bulan dan tahun yang dipilih dari request
    $selectedMonth = $request->input('selectedMonth');
    
    // Parsing bulan dan tahun dari string yang diterima
    $selectedDate = Carbon::createFromFormat('Y-m', $selectedMonth);

    // Mengambil data pendapatan dan poin sesuai dengan bulan dan tahun yang dipilih
  
    
    $totalPoints = Leaderboard::where('user_id', auth()->user()->id)
        ->whereYear('tanggal', $selectedDate->year)
        ->whereMonth('tanggal', $selectedDate->month)
        ->sum('total');


        if ( $totalPoints  <= 0) {
            $hasil = 0;
        } else if ( $totalPoints  < 72) {
            $hasil = 3600000;
        } else if ( $totalPoints  > 72 &&  $totalPoints  < 120) {
            $insentif = ( $totalPoints  - 72) * 40000;
            $hasil = $insentif + 3600000;
        } else if ( $totalPoints  == 72) {
            $hasil = 3600000;
        } elseif ( $totalPoints  == 120) {
            $hasil = 6000000;
        } elseif ( $totalPoints  > 120) {
            $insentif = ( $totalPoints  - 120) * 40000;
            $hasil = $insentif + 6000000;
        }
        
        $totalIncome = $hasil;

    return response()->json([
        'totalIncome' => $totalIncome,
        'totalPoints' => $totalPoints,
    ]);
}


    /**
     * Show the form for creating a new resource.
     */

 public function create()
    {
        
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
