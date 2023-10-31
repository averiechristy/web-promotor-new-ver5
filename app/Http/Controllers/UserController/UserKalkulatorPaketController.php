<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;

class UserKalkulatorPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = Auth::user();
        $userKodeRole = auth()->user()->Role->kode_role;
        $barang= Product::where('role_id', $user->role_id)->get();
        
        if (strtolower($userKodeRole) === 'mr') {
            return view('user.paketkalkulator', [
                'barang' => $barang
            ]);
        } elseif (strtolower($userKodeRole) === 'tm') {
            return view('user.paketkalkulatorlainnya', [
                 'barang' => $barang
            ]);
        } elseif (strtolower($userKodeRole) === 'ms') {
            return view('user.paketkalkulatorlainnya', [
                 'barang' => $barang
            ]);
        } else {
            return view('user.paketkalkulatorlainnya', [
                 'barang' => $barang
            ]);
        }  


     
    }


     public function hitung(Request $request)
    {

          $user = Auth::user();

        $barang= Product::where('role_id', $user->role_id)->get();

        $user = Auth::user();
        $userKodeRole = auth()->user()->Role->kode_role;
        $product= Product::where('role_id', $user->role_id)->get();


        // Ambil data dari formulir
        $cicilanInputs = $request->input('cicilan');

        $productPersen = $request->input('product_persen');

        $cicilanInputs = $request->input('cicilan');
        $productPersen = $request->input('product_persen');
        $selectedBarang = $request->input('nama_barang');
    
        // Validasi bahwa barang yang dipilih tidak boleh sama
        if (count($selectedBarang) !== count(array_unique($selectedBarang))) {
            return redirect()->back()->with('error', 'Barang yang dipilih tidak boleh sama');
        }

        

        $totalCicilan = 0;

        

        // Hitung total cicilan
        foreach ($cicilanInputs as $cicilan) {
            if (is_numeric($cicilan)) {
                $totalCicilan += (int)$cicilan;
            }
        }

        // Tambahkan 3 juta ke total cicilan
        $totalCicilan += 3000000;

        // Hitung total poin
        $totalPoin = 0;

        if ($totalCicilan <= 3600000) {
            $totalPoin = ceil($totalCicilan / 50000);
        } elseif ($totalCicilan <= 6000000) {
            $totalPoin = 72 + ceil(($totalCicilan - 3600000) / 40000);
        } else {
            $totalPoin = 120 + ceil(($totalCicilan - 6000000) / 40000);
        }
        
        $totalPersen = 0;
foreach ($productPersen as $productId => $persen) {
    if (is_numeric($persen)) {
        $totalPersen += (int)$persen;
    }
}



if ($totalPersen != 100) {
    return redirect()->back()->with('error', 'Total persen produk harus sama dengan 100%');
}

        $jumlahProduk = [];
        foreach ($product as $produk) {
            $productId = $produk->id;
            $jumlahProduk[$productId] = intval(ceil(($productPersen[$productId] * $totalPoin / 100)/$produk->poin_produk));
        }
     
        $request->session()->put('totalCicilan', $totalCicilan);
        $request->session()->put('totalPoin', $totalPoin);
        
        $request->session()->put('jumlahProduk', $jumlahProduk);
        $request->session()->put('formInput', $request->all());
        // Simpan data poin ke dalam sesi jika diperlukan
        // Misalnya: session(['total_poin' => $totalPoin]);
        $request->session()->put('inputData', $request->all());
        $request->session()->push('addedItems', $request->input());
        
        

        // Tampilkan hasil perhitungan ke tampilan
        return redirect()->back()->withInput();   
    
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
