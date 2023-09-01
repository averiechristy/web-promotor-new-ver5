<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Auth;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required',
            'message' => 'required',
        ], [
            'message.required' => 'Input pesan terlebih dahulu',
            'subject.required' => 'Input subject terlebih dahulu',
        ]);
    
        $data = $request->all();
        $data['read'] = false; // Set 'read' to false when creating a new message
    
        // Ambil informasi nama dan email dari pengguna yang sudah login
        $user = Auth::user();
        $data['name'] = $user->nama;
        $data['email'] = $user->email;
    
        // Simpan data dalam basis data
        ContactUs::create($data);
    
        return redirect()->route('user.contact')->with('success', 'Pesan berhasil terkirim.');

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
