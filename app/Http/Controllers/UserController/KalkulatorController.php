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
        $produk= Product::where('role_id', $user->role_id)->get();
        return view('user.kalkulator',[
            'produk' => $produk
        ]);
    }

    public function calculate(Request $request)
    {
        $productQuantities = $request->input('product_quantity');
        $products = Product::all();       
        $totalPoints = 0;
      
       
        foreach ($products as $product) {
            if (isset($productQuantities[$product->id])) {
                $quantity = $productQuantities[$product->id];
                $totalPoints += $quantity * $product->poin_produk;
            }
        }

        if ($totalPoints < 72) {
            return redirect()->back()->with('error', "Poin anda kurang dari 72, silahkan input ulang jumlah produk");
        } elseif ($totalPoints >72 && $totalPoints < 120 ) {
           $insentif = ($totalPoints - 72) * 40000;
           $hasil = $insentif + 3600000;
        return view('user.result',  ['hasil' => $hasil, 'totalPoints' => $totalPoints]);
    
        }  elseif ($totalPoints == 72) {
            $hasil = 3600000;
            return view('user.result', ['hasil' => $hasil, 'totalPoints' => $totalPoints]);

        } elseif ($totalPoints == 120) {
            $hasil = 6000000;
            return view('user.result',  ['hasil' => $hasil, 'totalPoints' => $totalPoints]);

        } elseif ($totalPoints > 120) {
            $insentif = ($totalPoints - 120) * 40000;
            $hasil = $insentif + 6000000;
            return view('user.result',  ['hasil' => $hasil, 'totalPoints' => $totalPoints]);
        }
        
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
