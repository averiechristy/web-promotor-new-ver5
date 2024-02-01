<?php

namespace App\Http\Controllers;

use App\Models\Akses;
use App\Models\LeaderBoard;
use App\Models\UserRole;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function findForPassport($username)
     {
         return $this->where('username', $username)->first();
     }
    public function index()
    {
        
        $dtUser = User::orderBy('created_at', 'desc')->get();
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
    $roles = UserRole::all()->groupBy('akses_id');

    return view('admin.useraccount.create', [
        'akses' => $akses,
        'roles' => $roles,
    ]);
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'akses_id' => 'required',
            'role_id' => 'required',
            'nama' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'phone_number' => 'required',

        ], [
            'akses_id.required' => 'Pilih akses terlebih dahulu.', 
            'role_id.required' => 'Pilih role terlebih dahulu.', 
            'nama.required' => 'Input nama terlebih dahulu',
            'username.required' => 'Input Username terlebih dahulu',
            'email.required' => 'Input email terlebih dahulu',
            'phone_number.required' => 'Input no hp terlebih dahulu',
            'email.email' => 'Format email tidak valid.',

        ]);

        $loggedInUser = auth()->user();
        $loggedInUsername = $loggedInUser->nama; 

        User::create([
            'akses_id'=> $request->akses_id,
            'role_id'=> $request->role_id,
            'nama'=> $request->nama,
            'username'=>$request->username,
            'email'=> $request->email,
            'password' => Hash::make('12345678'),
           'phone_number'=> $request->phone_number,
            'number' => $request->number,
            'kode_user' => $request->kode_user,
            'created_by' => $loggedInUsername,
            

        ]);
        $request->session()->flash('success', 'Akun User berhasil ditambahkan');

        return redirect(route('admin.useraccount.index'));
    }


    public function tampiluser ($id){

        $data = User::find($id);
        $akses = Akses::all();
        $role = UserRole::all();
        $roles = UserRole::all()->groupBy('akses_id');

        
        // return view('tampildata',[
        //     'data'->$data
        // ]);

        return view('admin.useraccount.edit', [
            'data' => $data,
            'akses' => $akses,
            'role' => $role,
            'roles'=>$roles,
        ]);
     }

     // Di dalam controller admin
public function resetPassword(User $user, Request $request)
{
    $user->update([
        'password' => Hash::make('12345678'), // Ganti 'password_awal' dengan password yang Anda inginkan
    ]);

    $request->session()->flash('success', 'Password berhasil direset');

    return redirect()->route('admin.useraccount.index');
}


    public function updateuser(Request $request, $id) {


    $this->validate($request, [
        'akses_id' => 'required',
        'role_id' => 'required',
        'nama' => 'required',
        'username' => 'required',
        'email' => 'required|email',
        'phone_number' => 'required',
    ], [
        'akses_id.required' => 'Pilih akses terlebih dahulu.', 
        'role_id.required' => 'Pilih role terlebih dahulu.', 
        'nama.required' => 'Input nama terlebih dahulu',
        'username.required' => 'Input Username terlebih dahulu',
        'email.required' => 'Input email terlebih dahulu',
        'phone_number.required' => 'Input no handphone terlebih dahulu',
        'email.email' => 'Format email tidak valid.',
    ]);

    $data = User::find($id);
    $loggedInUser = auth()->user();
    $loggedInUsername = $loggedInUser->nama; 
    $data->akses_id = $request->akses_id;
    $data->role_id = $request->role_id;
    $data->nama = $request->nama;
    $data->username = $request->username;
    $data->email = $request->email;
    $data->phone_number = $request->phone_number;
    $data->updated_by = $loggedInUsername;

    $data->save();

    $request->session()->flash('success', "Akun User berhasil diupdate");

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
    public function destroy(Request $request, $id)
    {
        $useraccount = User::find($id);

        if ($useraccount->Akses->jenis_akses === 'Admin') {
            if ($useraccount->id === Auth::id()) {
                return redirect()->route('admin.useraccount.index')->with('error', 'Tidak dapat menghapus akun anda sendiri.');
            }

            $adminCount = User::whereHas('Akses', function ($query) {
                $query->where('jenis_akses', 'Admin');
            })->count();

            if ($adminCount <= 1) {
                return redirect()->route('admin.useraccount.index')->with('error', 'Tidak dapat menghapus akun admin terakhir.');
            }
        }

        if (LeaderBoard::where('user_id', $useraccount->id)->exists()) {
            $request->session()->flash('error', "Tidak dapat menghapus user, karena masih ada data pencapaian yang berhubungan.");
            return redirect()->route('admin.useraccount.index');
        }

        $useraccount->delete();

        $request->session()->flash('error', "Akun User Berhasil dihapus.");

        return redirect()->route('admin.useraccount.index');
    }



    public function showChangePasswordForm()
    {
        return view('admin.changepassword');
    }


    public function adminchangePassword(Request $request)
    {
        $request->validate([
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        return $fail(__('Current Password Salah.'));
                    }
                },
            ],         
            'new_password' => 'required|min:8|different:current_password|confirmed',
        ], [
            'current_password.required' => 'Masukan current password terlebih dahulu.', 
            'new_password.required' => 'Masukan password baru terlebih dahulu.', 
            'new_password.min' => 'Password minimal terdiri dari 8 karakter', 
            'new_password.different' => 'Password baru harus berbeda dengan current password.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak sesuai.',
        ]);
    

        // dd($request);

        $user = Auth::user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);
            return redirect()->route('password')->with('success', 'Password berhasil diubah.');
        } else {
            return redirect()->route('password');
        }
    }

    public function UserChangePasswordForm()
    {
        return view('user.changepassword');
    }


    public function editProfileForm()
    {
        $user = Auth::user();
        return view('user.editprofil',[
            'user' => $user,
            
        ]);;
    }

     public function changePassword(Request $request)
    {
       
        $request->validate([
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        return $fail(__('Current Password Salah.'));
                    }
                },
            ],         
            'new_password' => 'required|min:8|different:current_password|confirmed',
        ], [
            'current_password.required' => 'Masukan current password terlebih dahulu.', 
            'new_password.required' => 'Masukan password baru terlebih dahulu.', 
            'new_password.min' => 'Password minimal terdiri dari 8 karakter', 
            'new_password.different' => 'Password baru harus berbeda dengan current password.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak sesuai.',
        ]);
    

        // dd($request);

        $user = Auth::user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);
            return redirect()->route('change-password')->with('success', 'Password berhasil diubah.');
        } else {
            return redirect()->route('change-password');
        }
    }
    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:5048', // Validasi file gambar
    
        ], [
            'nama.required' => 'Input nama terlebih dahulu',
            'email.required' => 'Input email terlebih dahulu',
            'phone_number.required' => 'Input no handphone terlebih dahulu',
            'avatar.image' => 'File harus berupa gambar.',
            'avatar.mimes' => 'Format gambar yang diizinkan: jpeg, png, jpg, gif.',
            'avatar.max' => 'Ukuran gambar tidak boleh lebih dari 5MB.',
        ]);
    
        $user = Auth::user();
        $filename = $user->avatar; // Tetap gunakan gambar lama jika tidak ada gambar yang diunggah
    
        if ($request->hasFile('avatar')) {
            $path = public_path('img');
            
            // Upload gambar baru
            $file = $request->file('avatar');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
        }
    
        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'avatar' => $filename,
        ]);
    
        return redirect()->route('edit-profile')->with('success', 'Profil berhasil diupdate.');
    }
    
    
}
