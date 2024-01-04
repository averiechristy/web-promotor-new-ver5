<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\BiayaOperasional;
use App\Models\DetailInsentif;
use App\Models\Product;
use App\Models\Skema;
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


    // public function calculateTM(Request $request) {
    //     $user = Auth::user();

    //     $produk= Product::where('role_id', $user->role_id)->get();

    //     $productQuantities = $request->input('product_quantity');

    //     $totalNTB = 0;

    //     $products = Product::all();       
       
    //     foreach ($products as $product) {
    //         if (isset($productQuantities[$product->id])) {
    //             $quantity = $productQuantities[$product->id];
    //             $totalNTB += ceil($quantity * $product->poin_produk);
    //         }
    //     }
        
    //     if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //         // Ambil data dari form dan simpan dalam sesi
    //         foreach ($_POST["product_quantity"] as $produkId => $quantity) {
    //             $_SESSION["product_quantity"][$produkId] = $quantity;
    //         }
    //     }
    //     $result = 0;

    //     if ($totalNTB <= 90) {
    //         $result = 4901800;
    //     } elseif ($totalNTB >= 91 && $totalNTB <= 155) {
    //         $insentif = ($totalNTB - 90) * 12000;
    //         $result = 4901800 + $insentif;
    //     } elseif ($totalNTB > 155) {
    //         $insentif = ($totalNTB - 155) * 15500;
    //         $result = 4901800 + 768000 + $insentif;
    //     }

    //     // Return the result to the view
    //     return view('user.kalkulatorTM', [
    //         'hasil' => $result,
    //         'produk' => $produk]);
    // }

    public function calculateTM(Request $request) {
        $user = Auth::user();

        $produk= Product::where('role_id', $user->role_id)->get();

        $productQuantities = $request->input('product_quantity');

        $totalNTB = 0;

        $products = Product::all();       
       
        foreach ($products as $product) {
            if (isset($productQuantities[$product->id])) {
                $quantity = $productQuantities[$product->id];           
                $poinproduk = Skema::where('produk_id', $product->id)->first();
                $poin = $poinproduk ? $poinproduk->poin_produk : 0;

                $totalNTB += ceil($quantity * $poin);
            }
        }

        $biayaOperasional = BiayaOperasional::where('role_id', $user->role_id)->value('biaya_operasional');

        // $minqtys = DetailInsentif::where('role_id', $user->role_id)->distinct()->pluck('min_qty');

        // $maxqtys = DetailInsentif::where('role_id', $user->role_id)->distinct()->pluck('max_qty');

        // $insentifs = DetailInsentif::where('role_id', $user->role_id)->distinct()->pluck('insentif');

        // dd($insentifs);

        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Ambil data dari form dan simpan dalam sesi
            foreach ($_POST["product_quantity"] as $produkId => $quantity) {
                $_SESSION["product_quantity"][$produkId] = $quantity;
            }
        }
    
        $result = 0;

        // if ($totalNTB <= 90) {
        //     $result =     $biayaOperasional;
        // } elseif ($totalNTB >= 91 && $totalNTB <= 155) {
        //     $insentif = ($totalNTB - 90) * 12000;
        //     $result =     $biayaOperasional + $insentif;
        // } elseif ($totalNTB > 155) {
        //     $insentif = ($totalNTB - 155) * 15500;
        //     $result =     $biayaOperasional + 768000 + $insentif;
        // }
        
$minqtys = DetailInsentif::where('role_id', $user->role_id)->distinct()->pluck('min_qty')->toArray();
$maxqtys = DetailInsentif::where('role_id', $user->role_id)->distinct()->pluck('max_qty')->toArray();
$insentifs = DetailInsentif::where('role_id', $user->role_id)->distinct()->pluck('insentif')->toArray();


$detailsInsentif = DetailInsentif::where('role_id', $user->role_id)->distinct()->get(['min_qty', 'max_qty', 'insentif']);
$maxQtyPrevious = null;
$minQtyPrevious = null;
$insentifPrevious = null;

foreach ($detailsInsentif as $detail) {
    $minqty = $detail->min_qty;
    $maxqty = $detail->max_qty;
    $insentif = $detail->insentif;

    
    // Pengecekan kondisi totalNTB berada di antara minqty dan maxqty
    if ($totalNTB >= $minqty && $totalNTB <= $maxqty) {
        // Menghitung insentifresult
        $insentifresult = ($totalNTB - $maxQtyPrevious) * $detail->insentif;

        $result = $biayaOperasional + (($maxQtyPrevious-$minQtyPrevious) * $insentifPrevious ) +  $insentifresult ;
        // Gunakan dd untuk menampilkan hasil
      
    }

    // Simpan nilai maxqty untuk iterasi berikutnya
    $maxQtyPrevious = $maxqty;
    $minQtyPrevious = $minqty;
    $insentifPrevious = $insentif;
}

// if ($totalNTB >= $minqtys[0] && $totalNTB <= $maxqtys[0]) {
//     $insentif = ($totalNTB - $minqtys[0]) * $insentifs[0];
//     $result = $biayaOperasional + $insentif;
// } elseif ($totalNTB >= $minqtys[1]  ) {
//     $insentif = ($totalNTB - $maxqtys[0]) * $insentifs[1];
//     $result = $biayaOperasional + ( ($maxqtys[0]-$minqtys[0]) * $insentifs[0]) + $insentif;
// }





        // Return the result to the view
        return view('user.kalkulatorTM', [
            'hasil' => $result,
            'produk' => $produk]);
    }

    


    // public function calculateMS (Request $request){
    //     $user = Auth::user();
    // $produk = Product::where('role_id', $user->role_id)->get();

    // $productQuantities = $request->input('product_quantity');

    // $totalNtb = 0;

    // $products = Product::all();     
    // foreach ($products as $product) {
    //     if (isset($productQuantities[$product->id])) {
    //         $quantity = $productQuantities[$product->id];
    //         $totalNtb += $quantity * $product->poin_produk;
    //     }
    // }

    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     // Ambil data dari form dan simpan dalam sesi
    //     foreach ($_POST["product_quantity"] as $produkId => $quantity) {
    //         $_SESSION["product_quantity"][$produkId] = $quantity;
    //     }
    // }

    // $hasil = (250000 * 4) + $totalNtb;
    // $message = "Asumsi minimal menjual 5 aplikasi per minggu dalam 1 bulan";

    //     return view('user.kalkulatorMS', ['#hasil','hasil' => $hasil,
    //     'produk' => $produk, 
    // 'message' => $message]);
    // }

    public function calculateMS(Request $request)
{
    $user = Auth::user();
    $produk = Product::where('role_id', $user->role_id)->get();
    $productQuantities = $request->input('product_quantity');
    $totalNtb = 0;

    $products = Product::all();

    foreach ($products as $product) {
        if (isset($productQuantities[$product->id])) {
            $quantity = $productQuantities[$product->id];

            // Assuming DetailInsentif model has a column named 'incentif'
            $detailInsentif = DetailInsentif::where('produk_id', $product->id)->first();
            $incentif = $detailInsentif ? $detailInsentif->insentif : 0;

            $totalNtb += $quantity * $incentif;
        }
    }
    $biayaOperasional = BiayaOperasional::where('role_id', $user->role_id)->value('biaya_operasional');

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil data dari form dan simpan dalam sesi
        foreach ($_POST["product_quantity"] as $produkId => $quantity) {
            $_SESSION["product_quantity"][$produkId] = $quantity;
        }
    }
    

    $hasil = $biayaOperasional + $totalNtb;
    $message = "Asumsi minimal menjual 5 aplikasi per minggu dalam 1 bulan";

    
    return view('user.kalkulatorMS', [
        'hasil' => $hasil,
        'produk' => $produk,
        'message' => $message
    ]);
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
