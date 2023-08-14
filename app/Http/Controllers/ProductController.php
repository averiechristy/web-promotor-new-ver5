<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $dtProduct = Product::all();
        return view('admin.product.index', [
            'dtProduct' => $dtProduct
        ]);
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = UserRole::all();
        

        return view ('admin.product.create',[
            'role' => $role,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
    
        Product::create([
            'gambar_produk'     => $request->gambar_produk,
            'role_id'     => $request->role_id,
            'nama_produk'   => $request->nama_produk,
            'poin_produk'   => $request->poin_produk,
            'deskripsi_produk'   => $request->deskripsi_produk,

        ]);

        return redirect(route('admin.product.index'))->with('sucess','new product has been added!');


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
