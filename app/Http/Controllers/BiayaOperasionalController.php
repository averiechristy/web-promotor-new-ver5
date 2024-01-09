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

        return view ('admin.biayaoperasional.index',[
           'biayaoperasional' => $biayaoperasional,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = UserRole::all();
        return view ('admin.biayaoperasional.create',[
            'role' => $role,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $existingEntry = BiayaOperasional::where('role_id', $request->role_id)
        ->where(function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('tanggal_mulai', '<=', $request->tanggal_mulai)
                    ->where('tanggal_selesai', '>=', $request->tanggal_mulai);
            })
            ->orWhere(function ($q) use ($request) {
                $q->where('tanggal_mulai', '<=', $request->tanggal_selesai)
                    ->where('tanggal_selesai', '>=', $request->tanggal_selesai);
            });
        })
        ->first();

    
        if ($existingEntry) {
            $request->session()->flash('error', 'Gagal Menyimpan Data, Biaya Operasional dengan role dan rentang tanggal yang sama sudah ada');

            return redirect(route('admin.biayaoperasional.index'))->withInput();
        }
    
      
        $loggedInUser = auth()->user();
        $loggedInUsername = $loggedInUser->nama; 
    
        BiayaOperasional::create([
            'role_id'=> $request->role_id,
            'biaya_operasional'=> $request->biaya_operasional,
            'tanggal_mulai'=> $request->tanggal_mulai,
            'tanggal_selesai'=> $request->tanggal_selesai,
            'created_by' => $loggedInUsername,
            
        ]);
        $request->session()->flash('success', 'Biaya Operasional berhasil ditambahkan.');

        return redirect(route('admin.biayaoperasional.index'))->withInput();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = BiayaOperasional::find($id);
         
        $role = UserRole::all();
        return view ('admin.biayaoperasional.edit', [
            'data' => $data,
            'role' => $role,
           
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
        $biayaop = BiayaOperasional::find($id);

        $existingEntry = BiayaOperasional::where('role_id', $request->role_id)
        ->where('id', '!=', $id) // Exclude the current entry being updated
        ->where(function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('tanggal_mulai', '<=', $request->tanggal_mulai)
                    ->where('tanggal_selesai', '>=', $request->tanggal_mulai);
            })
            ->orWhere(function ($q) use ($request) {
                $q->where('tanggal_mulai', '<=', $request->tanggal_selesai)
                    ->where('tanggal_selesai', '>=', $request->tanggal_selesai);
            });
        })
        ->first();

    if ($existingEntry) {
        $request->session()->flash('error', 'Gagal Menyimpan Data, Biaya Operasional dengan role dan rentang tanggal yang sama sudah ada');
        return redirect(route('admin.biayaoperasional.index'))->withInput();
    }


        $loggedInUser = auth()->user();
        $loggedInUsername = $loggedInUser->nama; 

        $biayaop->update([
          'role_id' => $request -> role_id,
          'biaya_operasional' => $request-> biaya_operasional,
          'tanggal_mulai' => $request -> tanggal_mulai,
          'tanggal_selesai' => $request -> tanggal_selesai,
          'update_by' => $loggedInUsername,
        ]);

        $request->session()->flash('success', "Biaya Operasional berhasil diupdate.");
     
        // Redirect
        return redirect(route('admin.biayaoperasional.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $biayaop = BiayaOperasional::find($id);
        $biayaop->delete();
 
         $request->session()->flash('error', "Biaya Operasional berhasil dihapus.");
 
         return redirect(route('admin.biayaoperasional.index'));
    }
}
