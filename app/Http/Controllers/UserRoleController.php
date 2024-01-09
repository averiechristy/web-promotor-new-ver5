<?php

namespace App\Http\Controllers;

use App\Models\Akses;
use App\Models\BiayaOperasional;
use App\Models\PackageIncome;
use App\Models\Product;
use App\Models\Reward;
use App\Models\Skema;
use Illuminate\Http\Request;
use App\Models\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
     public function index()
     {
         $dtUserRole = UserRole::orderBy('created_at', 'desc')->get();
         return view('admin.userrole.index', [
             'dtUserRole' => $dtUserRole
         ]);
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $akses = Akses::all();

        return view ('admin.userrole.create',[
            'akses' => $akses,
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $this->validate($request, [
        'akses_id' => 'required',
        'kode_role' => 'required|unique:user_roles', // Tambah aturan unique di sini
        'jenis_role' => 'required', 
    ], [
        'akses_id.required' => 'Pilih akses terlebih dahulu.', 
        'kode_role.required' => 'Masukan Kode Role terlebih dahulu.',
        'kode_role.unique' => 'Kode Role sudah digunakan.',
        'jenis_role.required' => 'Masukan Jenis Role terlebih dahulu.', 
    ]);
    $loggedInUser = auth()->user();
    $loggedInUsername = $loggedInUser->nama; 

    
    // $createdBy = auth()->user()->id;

    UserRole::create([
        'akses_id'=> $request->akses_id,
        'kode_role'=> $request->kode_role,
        'jenis_role'=> $request->jenis_role,
        'created_by' => $loggedInUsername,
        
        
        
    ]);

    $request->session()->flash('success', 'User Role berhasil ditambahkan.');

    return redirect(route('admin.userrole.index'));
}

    /**
     * Display the specified resource.
     */

     public function tampildata ($id){
        $data = UserRole::find($id);
        $akses = Akses::all();

        // return view('tampildata',[
        //     'data'->$data
        // ]);

        return view('admin.userrole.edit', [
            'data' => $data,
            'akses' => $akses
        ]);
     }

     public function updatedata(Request $request, $id){

        $this->validate($request, [
            'akses_id' => 'required',
            'kode_role' => 'required|unique:user_roles,kode_role,' . $id,
            'jenis_role' => 'required', 
        ], [
            'akses_id.required' => 'Pilih akses terlebih dahulu.', 
            'kode_role.required' => 'Masukan Kode Role terlebih dahulu.',
            'kode_role.unique' => 'Kode Role sudah digunakan.',
            'jenis_role.required' => 'Masukan Jenis Role terlebih dahulu.', 
        ]);
        
        $data = UserRole::find($id);
        // $updatedBy = auth()->user()->id;
        $loggedInUser = auth()->user();
        $loggedInUsername = $loggedInUser->nama; 

        $data->akses_id    = $request->akses_id;
        $data->kode_role = $request->kode_role;
        $data->jenis_role  = $request->jenis_role;
        $data->updated_by = $loggedInUsername;

       
 
        $data->save();
        $request->session()->flash('success', "User Role berhasil diupdate.");
        return redirect(route('admin.userrole.index'));

     }

     public function destroy (Request $request, $id) {
        $userrole = UserRole::find($id);

        if (!$userrole) {
            $request->session()->flash('error', 'Role not found.');
            return redirect()->route('admin.userrole.index');
        }
        
        // Cek apakah ada data yang terkait dengan peran dalam tabel user account
        if (User::where('role_id', $userrole->id)->exists()) {
            $request->session()->flash('error', "Tidak dapat menghapus role, karena masih ada data user accout yang berhubungan.");
            return redirect()->route('admin.userrole.index');
        }

        if (Product::where('role_id', $userrole->id)->exists()) {
            $request->session()->flash('error', "Tidak dapat menghapus role, karena masih ada data produk yang berhubungan.");
            return redirect()->route('admin.userrole.index');
        }

        if (PackageIncome::where('role_id', $userrole->id)->exists()) {
            $request->session()->flash('error', "Tidak dapat menghapus role, karena masih ada data paket pendapatan yang berhubungan.");
            return redirect()->route('admin.userrole.index');
        }

        if (BiayaOperasional::where('role_id', $userrole->id)->exists()) {
            $request->session()->flash('error', "Tidak dapat menghapus role, karena masih ada data biaya operasional yang berhubungan.");
            return redirect()->route('admin.userrole.index');
        }

        if (Skema::where('role_id', $userrole->id)->exists()) {
            $request->session()->flash('error', "Tidak dapat menghapus role, karena masih ada data skema yang berhubungan.");
            return redirect()->route('admin.userrole.index');
        }

        
        // if (Reward::where('role_id', $userrole->id)->exists()) {
        //     $request->session()->flash('error', "Tidak dapat menghapus role, karena masih ada data reward yang berhubungan.");
        //     return redirect()->route('admin.userrole.index');
        // }
        
        $userrole->delete();
        
        $request->session()->flash('error', "User Role berhasil dihapus.");
        
        return redirect()->route('admin.userrole.index');
        

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
