<?php

namespace App\Http\Controllers;

use App\Models\Akses;
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
        Akses::find($id)->delete();

        return redirect(route('admin.akses.index'))->with('sucess','akses has been deleted!');

     }
}
