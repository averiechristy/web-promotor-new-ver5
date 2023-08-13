<?php

namespace App\Http\Controllers;

use App\Models\Akses;
use App\Models\UserRole;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $dtUser = User::all();
        $akses = User::with('Akses');
        $role = UserRole::with('Role');
        
        return view('admin.useraccount.index', [
            'dtUser' => $dtUser,
             'akses' => $akses,
            'role' => $role,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $akses = Akses::all();
        $role = UserRole::all();
        return view ('admin.useraccount.create',[
            'akses' => $akses,
            'role' => $role,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create([
            'akses_id'=> $request->akses_id,
            'role_id'=> $request->role_id,
            'nama'=> $request->nama,
            'username'=>$request->username,
            'email'=> $request->email,
            'password'=> $request->password,
            'phone_number'=> $request->phone_number,

        ]);

        return redirect(route('admin.useraccount.index'));
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
