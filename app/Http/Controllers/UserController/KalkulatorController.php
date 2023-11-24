<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


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
            
            return view('user.kalkulator', compact('hasil', 'produk', 'totalPoints', 'error'));   
             }
        
        // return view('user.result', ['totalPoints' => $totalPoints]);
    }


    public function calculateTM(Request $request) {

        $user = Auth::user();

        $produk= Product::where('role_id', $user->role_id)->get();

        $productQuantities = $request->input('product_quantity');

        // Initialize totalNTB variable
        $totalNTB = 0;

        $products = Product::all();       
        // Calculate totalNTB <input type="number" class="form-control" style="width: 300px" name="ntb_reg[{{ $produk->id }}]" value="{{ old('ntb_reg.' . $produk->id, session('product_quantity.' . $produk->id)) }}"> based on the given conditions
        // foreach ($ntbReg as $productId => $ntb) {
        //     // Ensure the input is numeric
        //     $ntb = is_numeric($ntb) ? $ntb : 0;

        //     if ($sosmed[$productId] % 3 !== 0) {
        //         // If not divisible, set result to 0 and return with an error message
        //         $request->session()->flash('erroruser', 'Jumlah sosmed tidak habis dibagi 3, silakan input ulang jumlah sosmed.');
        //         return redirect(route('user.kalkulator'));           
        //     }

        //     // Calculate totalNTB by adding NTB and 1/3 of Sosmed
        //     $totalNTB += $ntb + ($sosmed[$productId] / 3);
        // }

        foreach ($products as $product) {
            if (isset($productQuantities[$product->id])) {
                $quantity = $productQuantities[$product->id];
                $totalNTB += ceil($quantity * $product->poin_produk);
            }
        }
        
      
        


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Ambil data dari form dan simpan dalam sesi
            foreach ($_POST["product_quantity"] as $produkId => $quantity) {
                $_SESSION["product_quantity"][$produkId] = $quantity;
            }
        }
        // Initialize result variable
        $result = 0;

        // Determine the result based on totalNTB
        if ($totalNTB <= 90) {
            $result = 4901800;
        } elseif ($totalNTB >= 91 && $totalNTB <= 155) {
            $insentif = ($totalNTB - 90) * 12000;
            $result = 4901800 + $insentif;
        } elseif ($totalNTB > 155) {
            $insentif = ($totalNTB - 155) * 15500;
            $result = 4901800 + 768000 + $insentif;
        }

        // Return the result to the view
        return view('user.kalkulatorTM', ['hasil' => $result,
    'produk' => $produk]);

    }


    public function calculateMS (Request $request){
        $user = Auth::user();
    $produk = Product::where('role_id', $user->role_id)->get();

    $productQuantities = $request->input('product_quantity');


    $totalNtb = 0;

    // foreach ($produk as $p) {
    //     $insentifNtbReg = $ntbReg[$p->id] * 50000;
    //     $insentifNtbSosmed = $sosmed[$p->id] * 20000;
    //     $insentifNtbPersonal = $personal[$p->id] * 10000;

    //     $totalNtb += $insentifNtbReg + $insentifNtbSosmed + $insentifNtbPersonal;
    // }

    $products = Product::all();     
    foreach ($products as $product) {
        if (isset($productQuantities[$product->id])) {
            $quantity = $productQuantities[$product->id];
            $totalNtb += $quantity * $product->poin_produk;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil data dari form dan simpan dalam sesi
        foreach ($_POST["product_quantity"] as $produkId => $quantity) {
            $_SESSION["product_quantity"][$produkId] = $quantity;
        }
    }

    $hasil = (250000 * 4) + $totalNtb;
    $message = "Asumsi minimal menjual 5 aplikasi per minggu";

        return view('user.kalkulatorMS', ['#hasil','hasil' => $hasil,
        'produk' => $produk, 
    'message' => $message]);
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
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
