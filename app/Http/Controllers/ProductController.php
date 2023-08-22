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
        $dtProduk->number = $request->number;
        $dtProduk->kode_produk = $request->kode_produk;

        $dtProduk->gambar_produk = $namaFile;


        $nm->move(public_path().'/img', $namaFile);
        $dtProduk->save();

        $request->session()->flash('success', 'A new Product has been created');

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

     public function updateproduct(Request $request, $id)
     {
         $ubah = Product::findOrFail($id);
     
         // Cek apakah ada file gambar yang diunggah
         if ($request->hasFile('gambar_produk')) {
             $path = public_path('img');
     
             // Hapus gambar lama jika ada
             if ($ubah->gambar_produk != '' && $ubah->gambar_produk != null) {
                 $file_old = $path.'/'.$ubah->gambar_produk;
                 unlink($file_old);
             }
     
             // Upload gambar baru
             $file = $request->file('gambar_produk');
             $filename = $file->getClientOriginalName();
             $file->move($path, $filename);
     
             // Update nama gambar pada record
             $ubah->update(['gambar_produk' => $filename]);
         }
     
         // Update informasi lainnya
         $dtProduk = [
             'role_id' => $request->role_id,
             'nama_produk' => $request->nama_produk,
             'poin_produk' => $request->poin_produk,
             'deskripsi_produk' => $request->deskripsi_produk,
         ];
     
         // Jika tidak ada perubahan file gambar, gunakan gambar yang lama
         if (!$request->hasFile('gambar_produk')) {
             $dtProduk['gambar_produk'] = $ubah->gambar_produk;
         }
     
         // Update informasi produk
         $ubah->update($dtProduk);
     
         // Flash message
         $request->session()->flash('success', "Product has been updated");
     
         // Redirect
         return redirect(route('admin.product.index'))->with('success', 'Product has been updated!');
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
    public function destroy(Request $request, $id)
    {
        $produk = Product::find($id);
        $produk->delete();
 
         $request->session()->flash('error', "{$produk->nama_produk} has been deleted");
 
         return redirect(route('admin.product.index'))->with('sucess','user has been deleted!');
    }

    
}
