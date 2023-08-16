<?php

namespace App\Http\Controllers;

use App\Models\PackageIncome;
use App\Models\Product;
use App\Models\UserRole;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dtPackage = PackageIncome::all();
        $role = UserRole::with('Role');
        $produk = Product::with('Role');
        
        return view('admin.package.index', [
            'dtPackage' => $dtPackage,
             'produk' => $produk,
            'role' => $role,
        ]);
    }
  
   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produk = Product::all();
        $role = UserRole::all();
        return view ('admin.package.create',[
            'produk' => $produk,
            'role' => $role,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {  
        dd($request->all());
        
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
