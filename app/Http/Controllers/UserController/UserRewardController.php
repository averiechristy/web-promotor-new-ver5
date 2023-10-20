<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use Auth;
use Illuminate\Http\Request;

class UserRewardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan role_id dari pengguna yang login
        $role_id = auth()->user()->role_id;
    
        // Query untuk mengambil Reward sesuai dengan role_id
        $reward = Reward::where('role_id', $role_id)
                       ->orderBy('created_at', 'desc')
                       ->get();
    
        return view('user.reward', [
            'reward' => $reward,
        ]);
    }
    
    
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
        //
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
