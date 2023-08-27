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
    $contacts = ContactUs::orderBy('created_at', 'desc')->get();
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
        $data = $request->all();
        $data['read'] = false; // Set 'read' to false when creating a new message

        // Simpan data dalam basis data
        ContactUs::create($data);

        return redirect()->back()->with('success', 'Message sent successfully!');

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
