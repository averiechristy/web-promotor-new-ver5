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
        $nm = $request->gambar_produk;
        $namaFile = $nm->getClientOriginalName();

        

        $dtProduk = new Product;
        $dtProduk->nama_produk = $request->nama_produk;
        $dtProduk->role_id = $request->role_id;
        $dtProduk->poin_produk = $request->poin_produk;
        $dtProduk->deskripsi_produk = $request->deskripsi_produk;
        $dtProduk->gambar_produk = $namaFile;


        $nm->move(public_path().'/img', $namaFile);
        $dtProduk->save();

        return redirect(route('admin.product.index'))->with('sucess','product has been updated!');

        // dd($request->all());



    }

    public function tampilproduct ($id){
        $data = Product::find($id);
      
        $role = UserRole::all();
       
        
        // return view('tampildata',[
        //     'data'->$data
        // ]);

        return view('admin.product.edit', [
            'data' => $data,
            'role' => $role,
        ]);
     }

     public function updateproduct(Request $request, $id){
       
      $ubah = Product::findorfail($id);
      $awal = $ubah->gambar_produk;

      $dtProduk = [
        'role_id'=>$request->role_id,
        'nama_produk'=>$request->nama_produk,
        'poin_produk'=>$request->poin_produk,
        'gambar_produk'=>$awal,
        'deskripsi_produk'=>$request->deskripsi_produk,
      ];

      $request->gambar_produk->move(public_path().'/img',$awal);
      $ubah->update($dtProduk);
      
      return redirect(route('admin.product.index'))->with('sucess','product has been updated!');

     }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
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
        Product::find($id)->delete();

        return redirect(route('admin.product.index'))->with('sucess','role has been deleted!');

    }

    
}
