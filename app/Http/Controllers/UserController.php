<?php

namespace App\Http\Controllers;

use App\Models\Akses;
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
            'password' => Hash::make('12345678'),
                                    'phone_number'=> $request->phone_number,
            'number' => $request->number,
            'kode_user' => $request->kode_user,
            

        ]);
        $request->session()->flash('success', 'A new User Account has been created');

        return redirect(route('admin.useraccount.index'));
    }


    public function tampiluser ($id){
        $data = User::find($id);
        $akses = Akses::all();
        $role = UserRole::all();
       
        
        // return view('tampildata',[
        //     'data'->$data
        // ]);

        return view('admin.useraccount.edit', [
            'data' => $data,
            'akses' => $akses,
            'role' => $role,
        ]);
     }

     public function updateuser(Request $request, $id){
       
        $data = User::find($id);
       $data->akses_id    = $request->akses_id;
       $data->role_id  = $request->role_id;
       $data->nama  = $request->nama;
       $data->username  = $request->username;
       $data->email = $request->email;
       $data->password = $request->password;
       $data->phone_number  = $request->phone_number;
      

       $data->save();

       $request->session()->flash('success', "User Account has been updated");

        return redirect(route('admin.useraccount.index'))->with('sucess','role has been updated!');

        

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
                return redirect()->route('admin.useraccount.index')->with('error', 'You cannot delete your own admin account.');
            }

            $adminCount = User::whereHas('Akses', function ($query) {
                $query->where('jenis_akses', 'Admin');
            })->count();

            if ($adminCount <= 1) {
                return redirect()->route('admin.useraccount.index')->with('error', 'Cannot delete the last admin user.');
            }
        }

        $useraccount->delete();

        $request->session()->flash('error', "{$useraccount->nama} has been deleted");

        return redirect()->route('admin.useraccount.index')->with('success', 'User has been deleted!');
    }



    public function showChangePasswordForm()
    {
        return view('admin.changepassword');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        // dd($request);

        $user = Auth::user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);
            return redirect()->route('change-password')->with('success', 'Password changed successfully.');
        } else {
            return redirect()->route('change-password')->withErrors(['current_password' => 'Current password is incorrect.']);
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

    public function updateProfile(Request $request)
    {
       
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'phone_number' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

       
        $user = Auth::user();
        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);

       

        return redirect()->route('edit-profile')->with('success', 'Profile updated successfully.');
    }

    
}
