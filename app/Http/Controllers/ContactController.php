<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
{

    $contacts = ContactUs::orderBy('created_at', 'desc')->paginate(3); // Ubah 10 dengan jumlah data per halaman yang Anda inginkan
    return view('admin.contact-us.index', compact('contacts'));
}

public function show($id)
{
    $contacts = ContactUs::orderBy('created_at', 'desc')->get();

    $kontak = ContactUs::findOrFail($id);
    return view('admin.contact-us.show', compact('kontak','contacts'));
}

public function markAsRead($id)
{
    $contact = ContactUs::findOrFail($id);
    $contact->update(['read' => true]);
    return back();}

   
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
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',

        ], [
            'name.required' => 'Input nama terlebih dahulu',
            'email.required' => 'Input email terlebih dahulu',
            'email.email' => 'Format email tidak sesuai',
            'message.required' => 'Input pesan terlebih dahulu',
            'subject.required' => 'Input subject terlebih dahulu',

        ]);

        $data = $request->all();
        $data['read'] = false; // Set 'read' to false when creating a new message

        // Simpan data dalam basis data
        ContactUs::create($data);

        return redirect()->route('user.home', ['#contact'])->with('success', 'Pesan berhasil terkirim!');

    }

    public function delete(Request $request, $id)
{
    $contact = ContactUs::findOrFail($id);
    $contact->delete();

    $request->session()->flash('success', "Pesan sudah di hapus");

    return redirect()->route('admin.contact-us.index')->with('success', 'Contact message berhasil dihapus!');
}

    /**
     * Display the specified resource.
     */
    
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
