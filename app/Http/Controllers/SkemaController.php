<?php

namespace App\Http\Controllers;

use App\Models\DetailInsentif;
use App\Models\Product;
use App\Models\Skema;
use App\Models\UserRole;
use Illuminate\Http\Request;

class SkemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skema = Skema::orderBy('created_at', 'desc')->get();
        return view ('admin.skema.index',[
           'skema' => $skema
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = UserRole::all();
        $produk = Product::all();


        return view('admin.skema.create',[
            'role' => $role,
            'produk' => $produk
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $skema = new Skema();
        $skema->role_id = $request->role_id;
        $skema->produk_id = $request->produk_id;
        // $skema->biaya_operasional = $request->biaya_operasional;
        $skema->tanggal_mulai = $request->tanggal_mulai;
        $skema->tanggal_selesai = $request->tanggal_selesai;
        $skema->poin_produk = $request->poin_produk;
        $skema->keterangan = $request->keterangan;

     

        $skema->save();


        $insentifData = [];

        foreach ($request->insentif as $key => $insentif) {
           
                $insentifData[] = [
                    'skema_id' => $skema->id,
                    'produk_id' => $request->produk_id, 
                    'insentif' => $insentif,
                    'min_qty' => $request->min_qty[$key],
                    'max_qty' => $request->max_qty[$key],
                    'tanggal_mulai' => $request->tanggal_mulai,
                    'tanggal_selesai' => $request->tanggal_selesai,
                    'role_id' => $request->role_id,
                ];
            
        }
        

        // Mass insert data insentif
        if (!empty($insentifData)) {
           DetailInsentif::insert($insentifData);
        }

        $request->session()->flash('success', 'Skema berhasil ditambahkan.');
        return redirect(route('admin.skema.index'));
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function tampildetailinsentif( $id)
    {
        $data = Skema::find($id);
    
        // Ambil semua data dari tabel PackageDetail
        // $detail = PackageDetail::all();
    
        // Ambil data produk yang terhubung dengan tabel PackageDetail
        $insentif = DetailInsentif::with('skema')->where('skema_id', $id)->get();

        return view('admin.skema.detail', [
            'data' => $data,
            'insentif' => $insentif,

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
