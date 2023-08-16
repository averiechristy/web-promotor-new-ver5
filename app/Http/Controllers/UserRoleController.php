<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRole;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dtUserRole = UserRole::all();
        return view('admin.userrole.index', [
            'dtUserRole' => $dtUserRole
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('admin.userrole.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        UserRole::create([
            'kode_role'=> $request->kode_role,
            'jenis_role'=> $request->jenis_role,
        ]);

        $request->session()->flash('success', 'A new User Role has been created');

        return redirect(route('admin.userrole.index'))->with('sucess','new role has been added!');
    }

    /**
     * Display the specified resource.
     */

     public function tampildata ($id){
        $data = UserRole::find($id);
        
        // return view('tampildata',[
        //     'data'->$data
        // ]);

        return view('admin.userrole.edit', [
            'data' => $data
        ]);
     }

     public function updatedata(Request $request, $id){
        $data = UserRole::find($id);
        $data->update($request->all());

        $request->session()->flash('success', "{$data->jenis_role} has been updated");
        return redirect(route('admin.userrole.index'))->with('sucess','role has been updated!');

     }

     public function destroy (Request $request, $id) {
       $userrole = UserRole::find($id);
        $userrole->delete();

        $request->session()->flash('error', "{$userrole->jenis_role} has been deleted");

        return redirect(route('admin.userrole.index'))->with('sucess','role has been deleted!');

     }
     
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
   
}
