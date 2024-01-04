<?php

namespace App\Http\Controllers;

use App\Models\BiayaOperasional;
use App\Models\UserRole;
use Illuminate\Http\Request;

class BiayaOperasionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $biayaoperasional = BiayaOperasional::orderBy('created_at', 'desc')->get();

        return view ('admin.biaya-operasional.index',[
           'biayaoperasional' => $biayaoperasional,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = UserRole::all();
        return view ('admin.biaya-operasional.create',[
            'role' => $role,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        BiayaOperasional::create([
            'role_id'=> $request->role_id,
            'biaya_operasional'=> $request->biaya_operasional,
            'tanggal_mulai'=> $request->tanggal_mulai,
            'tanggal_selesai'=> $request->tanggal_selesai,

            
            
        ]);
        $request->session()->flash('success', 'Biaya Operasional berhasil ditambahkan.');

        return redirect(route('admin.biayaoperasional.index'))->withInput();

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
