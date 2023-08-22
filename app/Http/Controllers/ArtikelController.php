<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
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

          $nm = $request->gambar_artikel;
        $namaFile = $nm->getClientOriginalName();

        $dtArtikel = new Artikel;
        $dtArtikel->judul_artikel = $request->judul_artikel;
        $dtArtikel->isi_artikel = $request->isi_artikel;
        $dtArtikel->gambar_artikel = $namaFile;


        $nm->move(public_path().'/img', $namaFile);
        $dtArtikel->save();

        $request->session()->flash('success', 'A new Article has been created');

        return redirect(route('admin.artikel.index'))->with('sucess','Artikel has been Added!');
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
         $request->session()->flash('success', "Artikel has been updated");
     
         // Redirect
         return redirect(route('admin.artikel.index'))->with('success', 'Product has been updated!');
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

        $request->session()->flash('error', "{$artikel->judul_artikel} has been deleted");

        return redirect(route('admin.artikel.index'))->with('sucess','user has been deleted!');
    }
}
