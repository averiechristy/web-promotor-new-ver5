<?php

namespace App\Http\Controllers;

use App\Models\PackageDetail;
use App\Models\Product;
use App\Models\Skema;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function detailproduct($id) {
        // Ambil data dari tabel PackageIncome berdasarkan id
        $data = Product::find($id);
    
        // Ambil semua data dari tabel PackageDetail
    
        // Ambil data produk yang terhubung dengan tabel PackageDetail
    
        return view('admin.product.detail', [
            'data' => $data,
            
        ]);
    }
    public function index()
    {

        $dtProduct = Product::orderBy('created_at', 'desc')->get();
        return view('admin.product.index', [
            'dtProduct' => $dtProduct
        ]);
       
    }

    public function getProductsByRole($roleId)
{
    $products = Product::where('role_id', $roleId)->get();

    return response()->json($products);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = UserRole::all();
        $data = Product::all();

        return view ('admin.product.create',[
            'role' => $role,
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

       
        
  // Validasi
$request->validate([
    'role_id' => 'required',
    'nama_produk' => [
        'required',
        'string',
        // Validasi kustom untuk memeriksa nama produk yang sama dengan role yang sama
        function ($attribute, $value, $fail) use ($request) {
            $existingProduct = Product::where('nama_produk', $value)
                ->where('role_id', $request->input('role_id'))
                ->first();

            if ($existingProduct) {
                $fail('Nama produk ini sudah digunakan untuk role yang sama.');
            }
        },
    ],
    'gambar_produk' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048', // Validasi file gambar
    'deskripsi_produk' => 'required',
], [
    'role_id.required' => 'Pilih role terlebih dahulu.', 
    'nama_produk.required' => 'Input nama produk dahulu',
    'gambar_produk.required' => 'Upload Gambar Produk dahulu.',
    'gambar_produk.image' => 'File harus berupa gambar.',
    'gambar_produk.mimes' => 'Format gambar yang diizinkan: jpeg, png, jpg, gif.',
    'gambar_produk.max' => 'Ukuran gambar tidak boleh lebih dari 5MB.',
    'deskripsi_produk.required' => 'Input Deskripsi produk terlebih dahulu',
]);

// Simpan gambar_produk dalam session jika validasi gagal
if ($request->session()->has('errors')) {
    $gambarProduk = $request->file('gambar_produk'); // Mendapatkan file gambar dari permintaan
    $request->session()->put('gambar_produk', $gambarProduk);
    return redirect()->back()->withInput();
}


    
        
        $nm = $request->gambar_produk;
        $namaFile = $nm->getClientOriginalName();

        $loggedInUser = auth()->user();
        $loggedInUsername = $loggedInUser->nama; 


        $dtProduk = new Product;
        $dtProduk->nama_produk = $request->nama_produk;
        $dtProduk->role_id = $request->role_id;
        // $dtProduk->poin_produk = $request->poin_produk;
        $dtProduk->deskripsi_produk = $request->deskripsi_produk;
        $dtProduk->number = $request->number;
        $dtProduk->kode_produk = $request->kode_produk;
        $dtProduk->created_by = $loggedInUsername;

        $dtProduk->gambar_produk = $namaFile;


        $nm->move(public_path().'/img', $namaFile);
        $dtProduk->save();
        $request->session()->forget('gambar_produk');


        $request->session()->flash('success', 'Produk berhasil ditambahkan.');

        return redirect(route('admin.product.index'))->withInput();

        // dd($request->all());



    }
    public function restoreFileInput(Request $request)
    {
        // Periksa jika ada nama file yang sudah diunggah sebelumnya dalam session atau database
        $gambarProdukPath = session('gambar_produk_path') ?? '';
    
        return response()->json(['gambar_produk' => $gambarProdukPath]);
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
     
         $loggedInUser = auth()->user();
         $loggedInUsername = $loggedInUser->nama; 

         $poinValue = $request->input('poin_produk');
         $isPoinEnabled = $request->has('flexSwitchCheckChecked');

         
         
         if (!$isPoinEnabled) {
             // Jika checkbox tidak dicentang, set nilai poin ke null atau nilai yang sesuai
             $poinValue = null;
         }
 

         // Update informasi lainnya
         $dtProduk = [
             'role_id' => $request->role_id,
             'nama_produk' => $request->nama_produk,
             'poin_produk' => $poinValue,
             'deskripsi_produk' => $request->deskripsi_produk,
             'updated_by' => $loggedInUsername,
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

        if (Skema::where('produk_id', $produk->id)->exists()) {
            $request->session()->flash('error', "Tidak bisa menghapus data produk karena masih ada pada skema.");
            return redirect()->route('admin.product.index');
        }

        $produk->delete();

         $request->session()->flash('error', "Produk berhasil dihapus.");
 
         return redirect(route('admin.product.index'));
    }

    
}
