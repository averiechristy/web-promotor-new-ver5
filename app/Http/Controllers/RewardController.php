<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RewardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reward = Reward::all();
        return view ('admin.reward.index',[
            'reward' => $reward,
        ]);
    }

    public function create()
    {
        $role = UserRole::all();
        return view ('admin.reward.create',[
            'role' => $role,
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
  

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul_reward' => 'required|string',
            'poin_reward' => 'required|integer',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);
    
        $loggedInUser = auth()->user();
        $loggedInUsername = $loggedInUser->nama; // Ganti "name" sesuai dengan kolom yang sesuai di tabel pengguna.
       
        // Membuat reward
        $reward = new Reward([
            'judul_reward' => $request->input('judul_reward'),
            'poin_reward' => $request->input('poin_reward'),
            'tanggal_mulai' => $request->input('tanggal_mulai'),
            'tanggal_selesai' => $request->input('tanggal_selesai'),
            'role_id' => $request->input('role_id'),
           'created_by' => $loggedInUsername,
        ]);
    
        // Menghitung status berdasarkan tanggal mulai dan tanggal selesai


        $currentDate = now();
        $endDate = Carbon::parse($reward->tanggal_selesai)->endOfDay(); // Mengambil akhir hari dari tanggal selesai
        
        if ($currentDate >= $reward->tanggal_mulai && $currentDate <= $endDate) {
            $reward->status = 1; // Aktif
        } else {
            $reward->status = 0; // Tidak Aktif
        }
        
    
        // Menyimpan reward
       
        $reward->save();
    
        $request->session()->flash('success', 'Reward berhasil ditambahkan.');

        return redirect(route('admin.reward.index'))->withInput();
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Reward::find($id);

        $role = UserRole::all();
       
        return view('admin.reward.edit', [
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
    public function updatereward(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'judul_reward' => 'required|string',
            'poin_reward' => 'required|integer',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);
    
        $loggedInUser = auth()->user();
        $loggedInUsername = $loggedInUser->nama; // Ganti "name" sesuai dengan kolom yang sesuai di tabel pengguna.
    
        // Mengambil reward yang akan diupdate
        $reward = Reward::find($id);
    
        if (!$reward) {
            return redirect(route('admin.reward.index'))->with('error', 'Reward tidak ditemukan.');
        }
    
        // Memperbarui informasi reward
        $reward->judul_reward = $request->input('judul_reward');
        $reward->poin_reward = $request->input('poin_reward');
        $reward->tanggal_mulai = $request->input('tanggal_mulai');
        $reward->tanggal_selesai = $request->input('tanggal_selesai');
        $reward->role_id = $request->input('role_id');
        $reward->updated_by = $loggedInUsername;
    
        // Menghitung status berdasarkan tanggal mulai dan tanggal selesai
        $currentDate = now();
        $endDate = Carbon::parse($reward->tanggal_selesai)->endOfDay();
    
        if ($currentDate >= $reward->tanggal_mulai && $currentDate <= $endDate) {
            $reward->status = 1; // Aktif
        } else {
            $reward->status = 0; // Tidak Aktif
        }
    
        // Menyimpan perubahan pada reward
        $reward->save();
    
        $request->session()->flash('success', 'Reward berhasil diedit.');

        return redirect(route('admin.reward.index'))->withInput();    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
       $reward = Reward::find($id);
       $reward->delete();

        $request->session()->flash('error', "Reward berhasil dihapus.");

        return redirect(route('admin.reward.index'));
    }
}
