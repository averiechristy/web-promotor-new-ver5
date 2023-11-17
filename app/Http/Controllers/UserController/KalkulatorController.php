<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;

class KalkulatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $userKodeRole = auth()->user()->Role->kode_role;
        $produk= Product::where('role_id', $user->role_id)->get();
        
        if (strtolower($userKodeRole) === 'me') {
            return view('user.kalkulator', [
                'produk' => $produk
            ]);
        } elseif (strtolower($userKodeRole) === 'tm') {
            return view('user.kalkulatorTM', [
                'produk' => $produk
            ]);
        } elseif (strtolower($userKodeRole) === 'ms') {
            return view('user.kalkulatorMS', [
                'produk' => $produk
            ]);
        } else {
            return view('user.kalkulatorMS', [
                'produk' => $produk
            ]);
        }  
    }

    public function calculate(Request $request)
    {
        $user = Auth::user();

        $produk= Product::where('role_id', $user->role_id)->get();

        $productQuantities = $request->input('product_quantity');
        
        $products = Product::all();       
        $totalPoints = 0;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Ambil data dari form dan simpan dalam sesi
            foreach ($_POST["product_quantity"] as $produkId => $quantity) {
                $_SESSION["product_quantity"][$produkId] = $quantity;
            }
        }
       
        foreach ($products as $product) {
            if (isset($productQuantities[$product->id])) {
                $quantity = $productQuantities[$product->id];
                $totalPoints += $quantity * $product->poin_produk;
            }
        }

        if ($totalPoints < 72) {
            $totalPoints = 0;
            $hasil = 0;
            $totalPoints = 0;
            $hasil = 0;
            $error = ($totalPoints < 72) ? "Poin anda kurang dari 72, silakan input ulang jumlah produk" : null;
            

            return view('user.kalkulator', compact('hasil', 'produk', 'totalPoints', 'error'));
            
                    } elseif ($totalPoints >72 && $totalPoints < 120 ) {
           $insentif = ($totalPoints - 72) * 40000;
           $hasil = $insentif + 3600000;
           $error = ($totalPoints < 72) ? : null;
            
           return view('user.kalkulator', compact('hasil', 'produk', 'totalPoints', 'error'));    
        }  elseif ($totalPoints == 72) {
            $hasil = 3600000;
            $error = ($totalPoints < 72) ? : null;
            
            return view('user.kalkulator', compact('hasil', 'produk', 'totalPoints', 'error'));
        } elseif ($totalPoints == 120) {
            $hasil = 6000000;
            $error = ($totalPoints < 72) ? : null;
            
            return view('user.kalkulator', compact('hasil', 'produk', 'totalPoints', 'error'));
        } elseif ($totalPoints > 120) {
            $insentif = ($totalPoints - 120) * 40000;
            $hasil = $insentif + 6000000;
            $error = ($totalPoints < 72) ? : null;
            
            return view('user.kalkulator', compact('hasil', 'produk', 'totalPoints', 'error'));        }
        
        // return view('user.result', ['totalPoints' => $totalPoints]);
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
