<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{


    public function detailartikel($id) {
        // Ambil data dari tabel PackageIncome berdasarkan id
        $data = Artikel::find($id);
    
        // Ambil semua data dari tabel PackageDetail
    
        // Ambil data produk yang terhubung dengan tabel PackageDetail
    
        return view('admin.artikel.detail', [
            'data' => $data,
            
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dtArtikel = Artikel::all();
        return view('admin.artikel.index', [
            'dtArtikel' => $dtArtikel
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.artikel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //   dd($request->all());

        $this->validate($request, [
            'judul_artikel' => 'required',
            'isi_artikel' => 'required',
            'gambar_artikel' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048', // Validasi file gambar

        ], [
           
            'judul_artikel.required' => 'Input Judul Artikel terlebih dahulu',
            'gambar_artikel.required' => 'Pilih gambar artikel untuk diunggah.',
            'gambar_artikel.image' => 'File harus berupa gambar.',
            'gambar_artikel.mimes' => 'Format gambar yang diizinkan: jpeg, png, jpg, gif.',
            'gambar_artikel.max' => 'Ukuran gambar tidak boleh lebih dari 5MB.',
            'isi_artikel.required' => 'Input Isi Artikel terlebih dahulu',

        ]);

          $nm = $request->gambar_artikel;
        $namaFile = $nm->getClientOriginalName();

        $dtArtikel = new Artikel;
        $dtArtikel->judul_artikel = $request->judul_artikel;
        $dtArtikel->isi_artikel = $request->isi_artikel;
        $dtArtikel->gambar_artikel = $namaFile;


        $nm->move(public_path().'/img', $namaFile);
        $dtArtikel->save();

        $request->session()->flash('success', 'Artikel berhasil ditambahkan.');

        return redirect(route('admin.artikel.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Artikel::find($id);
        
        // return view('tampildata',[
        //     'data'->$data
        // ]);

        return view('admin.artikel.edit', [
            'data' => $data
        ]);
    }

    public function updateartikel(Request $request, $id)
     {
        $ubah = Artikel::findOrFail($id);

        $this->validate($request, [
            'judul_artikel' => 'required',
            'isi_artikel' => 'required',
            'gambar_artikel' => 'image|mimes:jpeg,png,jpg,gif|max:5048', // Validasi file gambar

        ], [
           'judul_artikel.required' => 'Input Judul Artikel terlebih dahulu',
            'gambar_artikel.image' => 'File harus berupa gambar.',
            'gambar_artikel.mimes' => 'Format gambar yang diizinkan: jpeg, png, jpg, gif.',
            'gambar_artikel.max' => 'Ukuran gambar tidak boleh lebih dari 5MB.',
            'isi_artikel.required' => 'Input Isi Artikel terlebih dahulu',

        ]);
     
         // Cek apakah ada file gambar yang diunggah
         if ($request->hasFile('gambar_artikel')) {
             $path = public_path('img');
     
             // Hapus gambar lama jika ada
             if ($ubah->gambar_artikel != '' && $ubah->gambar_artikel != null) {
                 $file_old = $path.'/'.$ubah->gambar_artikel;
                 unlink($file_old);
             }
     
             // Upload gambar baru
             $file = $request->file('gambar_artikel');
             $filename = $file->getClientOriginalName();
             $file->move($path, $filename);
     
             // Update nama gambar pada record
             $ubah->update(['gambar_artikel' => $filename]);
         }
     
         // Update informasi lainnya
         $dtProduk = [
             
             'judul_artikel' => $request->judul_artikel,
             'isi_artikel' => $request->isi_artikel,
             
         ];
     
         // Jika tidak ada perubahan file gambar, gunakan gambar yang lama
         if (!$request->hasFile('gambar_artikel')) {
             $dtProduk['gambar_artikel'] = $ubah->gambar_artikel;
         }
     
         // Update informasi produk
         $ubah->update($dtProduk);
     
         // Flash message
         $request->session()->flash('success', "Artikel berhasil diupdate.");
     
         // Redirect
         return redirect(route('admin.artikel.index'));
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
       $artikel = Artikel::find($id);
       $artikel->delete();

        $request->session()->flash('error', "Artikel berhasil dihapus.");

        return redirect(route('admin.artikel.index'));
    }
}
