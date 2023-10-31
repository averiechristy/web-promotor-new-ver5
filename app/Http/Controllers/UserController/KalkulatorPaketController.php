<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;

class KalkulatorPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = Auth::user();
        $userKodeRole = auth()->user()->Role->kode_role;
        $produk= Product::where('role_id', $user->role_id)->get();
        return view('user.kalkulatorpaket', [
            'produk' => $produk
        ]);
    }

    
    // public function hitungCicilan(Request $request)
    // {

    //       $user = Auth::user();

    //     $produk= Product::where('role_id', $user->role_id)->get();
    //     // Ambil data dari formulir
    //     $cicilanInputs = $request->input('cicilan');
    //     $totalCicilan = 0;

    //     // Hitung total cicilan
    //     foreach ($cicilanInputs as $cicilan) {
    //         if (is_numeric($cicilan)) {
    //             $totalCicilan += (int)$cicilan;
    //         }
    //     }

    //     // Tambahkan 3 juta ke total cicilan
    //     $totalCicilan += 3000000;

    //     // Hitung total poin
    //     $totalPoin = 0;

    //     if ($totalCicilan <= 3600000) {
    //         $totalPoin = ceil($totalCicilan / 50000);
    //     } elseif ($totalCicilan <= 6000000) {
    //         $totalPoin = 72 + ceil(($totalCicilan - 3600000) / 40000);
    //     } else {
    //         $totalPoin = 120 + ceil(($totalCicilan - 6000000) / 40000);
    //     }
        
     

    //     // Simpan data poin ke dalam sesi jika diperlukan
    //     // Misalnya: session(['total_poin' => $totalPoin]);

    //     // Tampilkan hasil perhitungan ke tampilan
    //     return view('hasil_perhitungan', ['totalCicilan' => $totalCicilan, 'totalPoin' => $totalPoin]);
    // }
    

    // public function hitungTotalCicilan(Request $request)
    // {
    //     // Ambil data produk dan cicilan dari request
    //     $produk = $request->input('produk');

    //     $cicilan = $request->input('cicilan');
    
    //     // Lakukan perhitungan total cicilan
    //     $totalCicilan = 0;
    //     for ($i = 0; $i < count($produk); $i++) {
    //         $totalCicilan += intval($cicilan[$i]);
    //     }
    
    //     return view('user.kalkulatorpaket', ['totalCicilan' => $totalCicilan]);
    // }
    
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
