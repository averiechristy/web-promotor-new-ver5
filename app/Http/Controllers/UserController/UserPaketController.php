<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\PackageDetail;
use App\Models\PackageIncome;
use Auth;
use Illuminate\Http\Request;

class UserPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $paket= PackageIncome::where('role_id', $user->role_id)->get();
        return view('user.package',[
            'paket' => $paket
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
        
        $data = PackageIncome::find($id);
     
    
        // Ambil semua data dari tabel PackageDetail
        // $detail = PackageDetail::all();
    
        // Ambil data produk yang terhubung dengan tabel PackageDetail
        $produk = PackageDetail::with('produk')->where('package_id', $id)->get();
       
        return view('user.income', [
            'data' => $data,
            // 'detail' => $detail,
            'produk' => $produk,
        ]);
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
