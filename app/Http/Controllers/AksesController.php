<?php

namespace App\Http\Controllers;

use App\Models\Akses;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

class AksesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dtAkses = Akses::all();
        return view('admin.akses.index', [
            'dtAkses' => $dtAkses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('admin.akses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Akses::create([
            'jenis_akses'=> $request->jenis_akses,
            
        ]);
        $request->session()->flash('success', 'A new  Akses has been created');

        return redirect(route('admin.akses.index'));

    }


    public function tampilakses($id){
        $data = Akses::find($id);
        
        // return view('tampildata',[
        //     'data'->$data
        // ]);

        return view('admin.akses.edit', [
            'data' => $data
        ]);
     }


     public function updateakses(Request $request, $id){
        $data = Akses::find($id);
        $data->update($request->all());

        $request->session()->flash('success', "Akses Account has been updated");
        

        return redirect(route('admin.akses.index'))->with('sucess','akses has been updated!');

        

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
    public function destroy (Request $request, $id) {
        $akses = Akses::find($id);

        if (!$akses) {
            $request->session()->flash('error', 'Role not found.');
            return redirect()->route('admin.akses.index');
        }
        
        // Cek apakah ada data yang terkait dengan peran dalam tabel user account
        if (User::where('akses_id', $akses->id)->exists()) {
            $request->session()->flash('error', "Cannot delete this Akses because it has related records in another tabel.");
            return redirect()->route('admin.akses.index');
        }

        if (UserRole::where('akses_id', $akses->id)->exists()) {
            $request->session()->flash('error', "Cannot delete this Akses because it has related records in another tabel.");
            return redirect()->route('admin.akses.index');
        }
        
        $akses->delete();
        
        $request->session()->flash('success', "{$akses->jenis_role} has been deleted");
        
        return redirect()->route('admin.akses.index')->with('success', 'Role has been deleted!');

     }
}
