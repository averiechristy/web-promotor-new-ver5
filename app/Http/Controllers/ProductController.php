<?php

namespace App\Http\Controllers;

use App\Models\PackageDetail;
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

        
        
        $this->validate($request, [
            'role_id' => 'required',
            'nama_produk' => 'required|unique_per_role:nama_produk,role_id,' . $request->role_id,
                        'poin_produk' => 'required',
            'gambar_produk' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048', // Validasi file gambar
                        'deskripsi_produk' => 'required',

        ], [
            'role_id.required' => 'Pilih role terlebih dahulu.', 
            'nama_produk.required' => 'Input nama produk dahulu',
            'nama_produk.unique_per_role' =>'Nama Produk tidak boleh sama',
            'poin_produk.required' => 'Input poin terlebih dahulu',
            'gambar_produk.required' => 'Pilih gambar produk untuk diunggah.',
            'gambar_produk.image' => 'File harus berupa gambar.',
            'gambar_produk.mimes' => 'Format gambar yang diizinkan: jpeg, png, jpg, gif.',
            'gambar_produk.max' => 'Ukuran gambar tidak boleh lebih dari 5MB.',
            'deskripsi_produk.required' => 'Input Deskripsi produk terlebih dahulu',

        ]);
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

        $request->session()->flash('success', 'Produk berhasil ditambahkan.');

        return redirect(route('admin.product.index'));

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
        $ubah = Product::find($id);
      

        $this->validate($request, [
            'role_id' => 'required',
            'nama_produk' => 'required',
            'poin_produk' => 'required',
            'gambar_produk' => 'image|mimes:jpeg,png,jpg,gif|max:5048', // Validasi file gambar
                        'deskripsi_produk' => 'required',

        ], [
            'role_id.required' => 'Pilih role terlebih dahulu.', 
            'nama_produk.required' => 'Input nama produk dahulu',
            'poin_produk.required' => 'Input poin produk dahulu',
            'gambar_produk.image' => 'File harus berupa gambar.',
            'gambar_produk.mimes' => 'Format gambar yang diizinkan: jpeg, png, jpg, gif.',
            'gambar_produk.max' => 'Ukuran gambar tidak boleh lebih dari 5MB.',
            'deskripsi_produk.required' => 'Input Deskripsi produk terlebih dahulu',

        ]);     
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


         if ($request->role_id != $ubah->role_id) {
            $relatedPackages = PackageDetail::where('produk_id', $id)->exists();
            if ($relatedPackages) {
                $request->session()->flash('error', "Tidak dapat mengubah kode role karena produk memiliki data terkait di tabel paket detail.");
                return redirect()->route('admin.product.index');            }
        }
      

         // Update informasi produk
         $ubah->update($dtProduk);

         // Flash message
         $request->session()->flash('success', "Produk berhasil diupdate.");
     
         // Redirect
         return redirect(route('admin.product.index'));
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
        
 

        if (!$produk) {
            $request->session()->flash('error', 'Produk tidak ditemukan.');
            return redirect()->route('admin.product.index');
        }
        
        // Cek apakah ada data yang terkait dengan peran dalam tabel user account
        if (PackageDetail::where('produk_id', $produk->id)->exists()) {
            $request->session()->flash('error', "Tidak bisa menghapus data produk karena masih ada pada package income.");
            return redirect()->route('admin.product.index');
        }
        $produk->delete();

         $request->session()->flash('error', "Produk berhasil dihapus.");
 
         return redirect(route('admin.product.index'));
    }

    
}
