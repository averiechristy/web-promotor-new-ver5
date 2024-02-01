<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\BiayaOperasional;
use App\Models\DetailInsentif;
use App\Models\Product;
use App\Models\Skema;
use Auth;
use Carbon\Carbon;
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
            return view('user.paketkalkulatorlainnya', [
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
        $tanggalBerjalan = Carbon::now();
       
        foreach ($products as $product) {
            if (isset($productQuantities[$product->id])) {
                $quantity = $productQuantities[$product->id];           
                $poinproduk = Skema::where('produk_id', $product->id)
                    ->where('tanggal_mulai', '<=', $tanggalBerjalan)
                    ->where('tanggal_selesai', '>=', $tanggalBerjalan)
                    ->first();
                
                $poin = $poinproduk ? $poinproduk->poin_produk : 0;
        
                $totalNTB += round($quantity * $poin, 0, PHP_ROUND_HALF_DOWN);
        
                // Check if the decimal part ends with 9
                $decimalPart = fmod($totalNTB, 1);
                if ($decimalPart == 0.9) {
                    $totalNTB = ceil($totalNTB);
                }
            }
        }
         
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


        $detailsInsentif = DetailInsentif::where('role_id', $user->role_id)
        ->where('tanggal_mulai', '<=', $tanggalBerjalan)
        ->where('tanggal_selesai', '>=', $tanggalBerjalan)
        ->distinct()
        ->get(['min_qty', 'max_qty', 'insentif', 'allowance', 'status']);
        
        
      
        $maxQtyPrevious = null;
        $minQtyPrevious = null;
        $insentifPrevious = null;
        $statusPrevious = null;
        $tiers = []; // Menyimpan tier yang memenuhi kondisi


        foreach ($detailsInsentif as $detail) {
            $minqty = $detail->min_qty;
            $maxqty = $detail->max_qty;
            $insentif = $detail->insentif;
            $status = $detail -> status;
            $allowance = $detail -> allowance;

          
        $tiers[] = [
            'minQty' => $minQtyPrevious,
            'maxQty' => $maxQtyPrevious,
            'insentif' => $insentifPrevious,
            'status' => $statusPrevious,
        ];

        
            if ($totalNTB  == 90){
                $result = $allowance;
            }
           else if ($status == 'Aktif' && $totalNTB >= $minqty && ($maxqty === null || $totalNTB <= $maxqty)) {
                $insentifresult = ($totalNTB - ($minqty-1)) * $detail->insentif;
                
                $tiersebelumnya = 0;


foreach ($tiers as $tier) {
    $minQty = $tier['minQty'];
    $maxQty = $tier['maxQty'];
    $insentif = $tier['insentif'];
    $status = $tier['status'];

    if ($status == 'Aktif') {
        $tierResult = ($maxQty - ($minQty - 1)) * $insentif;
        $tiersebelumnya += $tierResult;
    }
}


            
            
            // Menambahkan allowance ke hasil akhir
            $totalResult = $tiersebelumnya ;
          
            
              
            
                $resultaktif = $tiersebelumnya + $insentifresult;
                break;

               
    
            }
             else if ($status == 'Tidak Aktif') {
                $insentifresult = $insentif * $totalNTB;
                $resulttidakaktif = $insentifresult ;
                break;
            }
            
            // Simpan nilai maxqty untuk iterasi berikutnya
            $maxQtyPrevious = $maxqty;
            $minQtyPrevious = $minqty;
            $insentifPrevious = $insentif;
            $statusPrevious = $status;
        }
     
        if (isset($resultaktif) && $resultaktif > 0) {
            $allowance = DetailInsentif::where('role_id', $user->role_id)
            ->where('tanggal_mulai', '<=', $tanggalBerjalan)
            ->where('tanggal_selesai', '>=', $tanggalBerjalan)
            
            ->where('status', 'Aktif') // Menambahkan kondisi status aktif
                    ->distinct() // Menambahkan fungsi distinct
                    ->value('allowance'); // Mengambil nilai langsung
    
            
           $result = $allowance + $resultaktif;
          
        } else if (isset($resulttidakaktif) && $resulttidakaktif > 0) {
            $allowance = DetailInsentif::where('role_id', $user->role_id)
            ->where('tanggal_mulai', '<=', $tanggalBerjalan)
            ->where('tanggal_selesai', '>=', $tanggalBerjalan)
            ->where('status', 'Tidak Aktif') // Menambahkan kondisi status aktif
                    ->distinct() // Menambahkan fungsi distinct
                    ->value('allowance'); // Mengambil nilai langsung
    
           $result = $allowance + $resulttidakaktif;

        }

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

    $hasil = 0;
    $tanggalBerjalan = Carbon::now();
    $products = Product::all();



    foreach ($products as $product) {
        if (isset($productQuantities[$product->id])) {
            $quantity = $productQuantities[$product->id];

          

            $detailsInsentif = DetailInsentif::where('produk_id', $product->id)
            ->where('tanggal_mulai', '<=', $tanggalBerjalan)
            ->where('tanggal_selesai', '>=', $tanggalBerjalan)
            ->get(['min_qty', 'max_qty', 'insentif', 'allowance', 'status']);


            
            $maxQtyPrevious = null;
            $minQtyPrevious = null;
            $insentifPrevious = null;
            $statusPrevious = null;
            $tiers = []; // Menyimpan tier yang memenuhi kondisi

    
           
    foreach ($detailsInsentif as $detail) {
        $minqty = $detail->min_qty;
        $maxqty = $detail->max_qty;
        $insentif = $detail->insentif;
        $status = $detail -> status;
        $allowance = $detail -> allowance;
       
        

        if ($product->id == 121) {

           
          
           if($quantity < 5){

            $allowance = 0;

           } else if ($quantity >=5 && $quantity <10){
            $allowance = $allowance * 1;
           }else if ($quantity >=10 && $quantity <15){
            $allowance = $allowance * 2;
           }else if ($quantity >=15 && $quantity <20){
            $allowance = $allowance * 3;
           }
           else if ($quantity>=20){
            $allowance = $allowance * 4;
           }

          
        }

       
        $tiers[] = [
            'minQty' => $minQtyPrevious,
            'maxQty' => $maxQtyPrevious,
            'insentif' => $insentifPrevious,
            'status' => $statusPrevious,
        ];

        if ($status == 'Aktif' && $quantity >= $minqty && ($maxqty === null || $quantity <= $maxqty)) {
            $insentifresult = ($quantity - ($minqty-1)) * $detail->insentif;

       
$totalTierResult = 0;


foreach ($tiers as $tier) {
    $minQty = $tier['minQty'];
    $maxQty = $tier['maxQty'];
    $insentif = $tier['insentif'];
    $status = $tier['status'];

    if ($status == 'Aktif') {
        $tierResult = ($maxQty - ($minQty - 1)) * $insentif;
        $totalTierResult += $tierResult;
    }
}


            
            
            // Menambahkan allowance ke hasil akhir
            $totalResult = $totalTierResult ;
          

            
        if  ($statusPrevious == 'Tidak Aktif') {
                $tiersebelumnya = 0;
                $remainingQuantity = 0;
            } else {
                // Tambahan pengecekan jika tiering pertama
                $tiersebelumnya = 0;
            }

            
            $result = $totalTierResult + $insentifresult + $allowance;
            
        }

      

         else if ($status == 'Tidak Aktif') {
            $insentifresult = $insentif * $quantity;
            $result = $insentifresult + $allowance ;
        }
        
        
        // Simpan nilai maxqty untuk iterasi berikutnya
        $maxQtyPrevious = $maxqty;
        $minQtyPrevious = $minqty;
        $insentifPrevious = $insentif;
        $statusPrevious = $status;
    }

 
            
$hasil += $result;
            
        }
    }

   
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil data dari form dan simpan dalam sesi
        foreach ($_POST["product_quantity"] as $produkId => $quantity) {
            $_SESSION["product_quantity"][$produkId] = $quantity;
        }
    }
    

    // $hasil = ($biayaOperasional * 4) + $totalNtb;
    $message = "Untuk NTB Reguler minimal menjual 5 aplikasi per minggu dalam 1 bulan untuk mendapatkan allowance";

    
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
