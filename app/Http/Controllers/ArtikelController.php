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

    public function updateartikel(Request $request, $id){
       
        $ubah = Artikel::findorfail($id);
        $awal = $ubah->gambar_artikel;
  
        $dtArtikel = [
          'judul_artikel'=>$request->judul_artikel,
          'isi_artikel'=>$request->isi_artikel,
          'gambar_artikel'=>$awal,
        ];
  
        $request->gambar_artikel->move(public_path().'/img',$awal);
        $ubah->update($dtArtikel);
        
        return redirect(route('admin.artikel.index'))->with('sucess','Artikel has been updated!');
  
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
