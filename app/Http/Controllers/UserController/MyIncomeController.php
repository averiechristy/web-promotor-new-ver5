<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\BiayaOperasional;
use App\Models\DetailInsentif;
use App\Models\LeaderBoard;
use App\Models\Product;
use App\Models\Reward;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyIncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = auth()->user()->id;
        $currentRole = auth()->user()->role;
       
        $kodeRole = strtolower($currentRole->kode_role);

        $tanggalBerjalan = Carbon::now();
        
        $user = Auth::user();
       
        // Jika tidak ada tanggal yang dipilih, tampilkan total pendapatan dan total poin pada bulan berjalan
       
            // Menghitung total pendapatan dan total poin pada bulan berjalan
            $currentMonth = now()->format('Y-m');
            // $totalIncomeThisMonth = Leaderboard::where('user_id', $userId)
            //     ->whereYear('tanggal', now()->year)
            //     ->whereMonth('tanggal', now()->month)
            //     ->sum('income');
            
            $totalPointsThisMonth = Leaderboard::where('user_id', $userId)
                ->whereYear('tanggal', now()->year)
                ->whereMonth('tanggal', now()->month)
                ->sum('total');


   if ($kodeRole == 'me') {
                if ($totalPointsThisMonth <= 0) {
                    $hasil = 0;
                } else if ($totalPointsThisMonth < 72) {
                    $hasil = 3600000;
                } else if ($totalPointsThisMonth > 72 && $totalPointsThisMonth < 120) {
                    $insentif = ($totalPointsThisMonth - 72) * 40000;
                    $hasil = $insentif + 3600000;
                } else if ($totalPointsThisMonth == 72) {
                    $hasil = 3600000;
                } elseif ($totalPointsThisMonth == 120) {
                    $hasil = 6000000;
                } elseif ($totalPointsThisMonth > 120) {
                    $insentif = ($totalPointsThisMonth - 120) * 40000;
                    $hasil = $insentif + 6000000;
                }

            }else if ($kodeRole == 'tm') {

                $hasil = 0;


        $detailsInsentif = DetailInsentif::where('role_id', $user->role_id)
        ->where('tanggal_mulai', '<=', $tanggalBerjalan)
        ->where('tanggal_selesai', '>=', $tanggalBerjalan)
        ->distinct()
        ->get(['min_qty', 'max_qty', 'insentif', 'allowance', 'status']);
        
      
        $maxQtyPrevious = null;
        $minQtyPrevious = null;
        $insentifPrevious = null;
        $statusPrevious = null;

        $tiers = []; 

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
            
            
            if ($status == 'Aktif' && $totalPointsThisMonth >= $minqty && ($maxqty === null || $totalPointsThisMonth <= $maxqty)) {
                $insentifresult = ($totalPointsThisMonth - ($minqty-1)) * $detail->insentif;
                
            
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
                $insentifresult = $insentif * $totalPointsThisMonth;
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
    
            
           $hasil = $allowance + $resultaktif;
          
        } else if (isset($resulttidakaktif) && $resulttidakaktif > 0) {
            $allowance = DetailInsentif::where('role_id', $user->role_id)
            ->where('tanggal_mulai', '<=', $tanggalBerjalan)
            ->where('tanggal_selesai', '>=', $tanggalBerjalan)
            ->where('status', 'Tidak Aktif') // Menambahkan kondisi status aktif
                    ->distinct() // Menambahkan fungsi distinct
                    ->value('allowance'); // Mengambil nilai langsung
    
           $hasil = $allowance + $resulttidakaktif;

        }
    

            
            
                
            
            }   else if  ($kodeRole == 'ms') { 

                $currentRole = auth()->user()->role;
       
                $kodeRole = strtolower($currentRole->kode_role);
        
                $roleid = $currentRole->id;

                $userId = auth()->user()->id;
             
  $produk = LeaderBoard::where('user_id', $userId)
  ->whereYear('tanggal', now()->year)
  ->whereMonth('tanggal', now()->month)
  ->get(['pencapaian_flag','tanggal']);


  

$pencapaianArray = json_decode($produk, true);

// Fetch product names and IDs from the "Product" table
$products = Product::all();

// Map product names to product IDs in $pencapaianArray

  $totalPerProduk = [];

  foreach ($pencapaianArray as $pencapaian) {
      foreach ($pencapaian['pencapaian_flag'] as $produk => $jumlah) {
          // Jika produk sudah ada dalam $totalPerProduk, tambahkan jumlahnya
          if (isset($totalPerProduk[$produk])) {
              $totalPerProduk[$produk] += (int)$jumlah;
          } else {
              // Jika produk belum ada, inisialisasi dengan jumlah dari pencapaian saat ini
              $totalPerProduk[$produk] = (int)$jumlah;
          }
      }
  }
  $weekTotalPerProduk = [];



  foreach ($pencapaianArray as $pencapaian) {
      // Ambil informasi minggu dari tanggal pencapaian
      $weekNumber = date('W', strtotime($pencapaian['tanggal']));
  
      foreach ($pencapaian['pencapaian_flag'] as $produk => $jumlah) {
          // Tambahkan kondisi untuk memeriksa produk ID
          if ($produk == 121) {
              // Buat kunci unik untuk setiap produk berdasarkan minggu
              $key = $produk . '_week_' . $weekNumber;
  
              // Jika produk sudah ada dalam $weekTotalPerProduk, tambahkan jumlahnya
              if (isset($weekTotalPerProduk[$key])) {
                  $weekTotalPerProduk[$key] += (int)$jumlah;
              } else {
                  // Jika produk belum ada, inisialisasi dengan jumlah dari pencapaian saat ini
                  $weekTotalPerProduk[$key] = (int)$jumlah;
              }
          }
      }
  }

  
  
  // Hasil akhir hanya berisi data dengan produk ID 121
  $productQuantities = $totalPerProduk;
  $weeklyProductQuantities = $weekTotalPerProduk;




            // Fetch product names and IDs from the "Product" table
       
      
            
            // Map product names to product IDs in $pencapaianArray
          
             
      
            $hasil = 0;


            foreach ($products as $product) {
                if (isset($productQuantities[$product->id]) && $productQuantities[$product->id] != 0) {
                                $quantity = $productQuantities[$product->id];
                              
                   
        
                                if($product->id == 121){
        
                                  
        
                                    $weeklyResults=[];
                foreach ($weeklyProductQuantities as $key => $quantity) {
                    // Ambil minggu dari kunci
                    $week = substr($key, strpos($key, '_week_') + 6);
                
                    // Insentif dan Allowance
                    $insentif = 50000;
                  
        
                    if($quantity >=5){
                        $allowance = 250000;
                    } else if ($quantity<5){
                        $allowance=0;
                    }
                    // Hitung hasil berdasarkan rumus yang diberikan
                    $result = ($quantity * $insentif) +$allowance;
                
                    // Tetapkan hasil ke dalam array atau variabel sesuai kebutuhan Anda
                    $weeklyResults[$key] = $result;
                }
                
             
                // Sekarang $weeklyResults berisi hasil untuk setiap minggu berdasarkan rumus yang diberikan.
                
                $result = array_sum($weeklyResults);
        
                                  
        
                                } else {
                                  
                    $detailsInsentif = DetailInsentif::where('produk_id', $product->id)
                    ->where('tanggal_mulai', '<=', $tanggalBerjalan)
                    ->where('tanggal_selesai', '>=', $tanggalBerjalan)
                    ->get(['min_qty', 'max_qty', 'insentif', 'allowance', 'status']);
        
                    
        
                    
                    $maxQtyPrevious = null;
                    $minQtyPrevious = null;
                    $insentifPrevious = null;
                    $statusPrevious = null;
            
           
            foreach ($detailsInsentif as $detail) {
                $minqty = $detail->min_qty;
                $maxqty = $detail->max_qty;
                $insentif = $detail->insentif;
                $status = $detail -> status;
        
                
               
                if ($product->id == 121) {
                    $allowance =0;
                } else {
                $allowance = $detail -> allowance;
        
                }
        
        
                
               
             
                
                
                if ($status == 'Aktif' && $quantity >= $minqty && ($maxqty === null || $quantity <= $maxqty)) {
                    $insentifresult = ($quantity - ($minqty-1)) * $detail->insentif;
                    
                   
                    if ($statusPrevious == 'Aktif'){
                        // $minQtyPrevious = ($minQtyPrevious === null || $minQtyPrevious == 1) ? 0 : $minQtyPrevious;
                
                        $tiersebelumnya = ($maxQtyPrevious - ($minQtyPrevious-1)) * $insentifPrevious;
        
                    } else if  ($statusPrevious == 'Tidak Aktif') {
                        $tiersebelumnya = 0;
                    } else {
                        // Tambahan pengecekan jika tiering pertama
                        $tiersebelumnya = 0;
                    }
        
                    
                    $result = $tiersebelumnya + $insentifresult + $allowance;
                    
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
        }
        
        
                    $hasil += $result ;
                   
        
                    
                }
        
             
            }
        
        
                $message = "Asumsi  minimal menjual 5 aplikasi per minggu dalam 1 bulan";   
            
            }


                
                $totalIncomeThisMonth = $hasil;
    
            // Menghitung poin yang dibutuhkan lagi untuk mencapai reward
    
            return view('user.myincome', [
                'totalIncomeThisMonth' => $totalIncomeThisMonth,
                'totalPointsThisMonth' => $totalPointsThisMonth,

            ]);
      
    }
    

    public function filterIncome(Request $request)
{
    $currentRole = auth()->user()->role;
    $roleid = $currentRole->id;
    
    $currentRole = auth()->user()->role;
    $userId = auth()->user()->id;
    
    $kodeRole = strtolower($currentRole->kode_role);

    // Ambil data bulan dan tahun yang dipilih dari request
    $selectedMonth = $request->input('selectedMonth');
    
    // Parsing bulan dan tahun dari string yang diterima
    $selectedDate = Carbon::createFromFormat('Y-m', $selectedMonth);


    // Mengambil data pendapatan dan poin sesuai dengan bulan dan tahun yang dipilih
  
    
    $totalPoints = Leaderboard::where('user_id', auth()->user()->id)
        ->whereYear('tanggal', $selectedDate->year)
        ->whereMonth('tanggal', $selectedDate->month)
        ->sum('total');

        $produk = LeaderBoard::where('user_id', $userId)
        ->whereYear('tanggal', $selectedDate->year)
        ->whereMonth('tanggal', $selectedDate->month)
        ->get(['pencapaian_flag','tanggal']);


        
    
    $pencapaianArray = json_decode($produk, true);
    
    // Fetch product names and IDs from the "Product" table
    $products = Product::where('role_id', $roleid)->pluck('nama_produk', 'id');

    
    // Map product names to product IDs in $pencapaianArray
  
        $totalPerProduk = [];

        foreach ($pencapaianArray as $pencapaian) {
            foreach ($pencapaian['pencapaian_flag'] as $produk => $jumlah) {
                // Jika produk sudah ada dalam $totalPerProduk, tambahkan jumlahnya
                if (isset($totalPerProduk[$produk])) {
                    $totalPerProduk[$produk] += (int)$jumlah;
                } else {
                    // Jika produk belum ada, inisialisasi dengan jumlah dari pencapaian saat ini
                    $totalPerProduk[$produk] = (int)$jumlah;
                }
            }
        }
        $weekTotalPerProduk = [];

  
    
        foreach ($pencapaianArray as $pencapaian) {
            // Ambil informasi minggu dari tanggal pencapaian
            $weekNumber = date('W', strtotime($pencapaian['tanggal']));
        
            foreach ($pencapaian['pencapaian_flag'] as $produk => $jumlah) {
                // Tambahkan kondisi untuk memeriksa produk ID
                if ($produk == 121) {
                    // Buat kunci unik untuk setiap produk berdasarkan minggu
                    $key = $produk . '_week_' . $weekNumber;
        
                    // Jika produk sudah ada dalam $weekTotalPerProduk, tambahkan jumlahnya
                    if (isset($weekTotalPerProduk[$key])) {
                        $weekTotalPerProduk[$key] += (int)$jumlah;
                    } else {
                        // Jika produk belum ada, inisialisasi dengan jumlah dari pencapaian saat ini
                        $weekTotalPerProduk[$key] = (int)$jumlah;
                    }
                }
            }
        }

        
        
        // Hasil akhir hanya berisi data dengan produk ID 121
        $productQuantities = $totalPerProduk;
        
       
        $weeklyProductQuantities = $weekTotalPerProduk;


       
        if ($totalPoints <= 0) {
            $hasil = 0;
        } else {

        if ($kodeRole == 'me') {
        if ( $totalPoints  <= 0) {
            $hasil = 0;
        } else if ( $totalPoints  < 72) {
            $hasil = 3600000;
        } else if ( $totalPoints  > 72 &&  $totalPoints  < 120) {
            $insentif = ( $totalPoints  - 72) * 40000;
            $hasil = $insentif + 3600000;
        } else if ( $totalPoints  == 72) {
            $hasil = 3600000;
        } elseif ( $totalPoints  == 120) {
            $hasil = 6000000;
        } elseif ( $totalPoints  > 120) {
            $insentif = ( $totalPoints  - 120) * 40000;
            $hasil = $insentif + 6000000;
        }
    

    } else if  ($kodeRole == 'tm') {
        $user = Auth::user();
        $hasil = 0;


        $detailsInsentif = DetailInsentif::where('role_id', $user->role_id)
        ->where('tanggal_mulai', '<=', $selectedDate)
        ->where('tanggal_selesai', '>=', $selectedDate)
        ->distinct()
        ->get(['min_qty', 'max_qty', 'insentif', 'allowance', 'status']);
        
        
      
        $maxQtyPrevious = null;
        $minQtyPrevious = null;
        $insentifPrevious = null;
        $statusPrevious = null;
        $tiers = []; 


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
            
            
            if ($totalPoints  == 90){
                $hasil = $allowance;
            }
            else if ($status == 'Aktif' && $totalPoints >= $minqty && ($maxqty === null || $totalPoints <= $maxqty)) {
                $insentifresult = ($totalPoints - ($minqty-1)) * $detail->insentif;
                
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
                $insentifresult = $insentif * $totalPoints;
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
            ->where('tanggal_mulai', '<=', $selectedDate)
            ->where('tanggal_selesai', '>=', $selectedDate)
            
            ->where('status', 'Aktif') // Menambahkan kondisi status aktif
                    ->distinct() // Menambahkan fungsi distinct
                    ->value('allowance'); // Mengambil nilai langsung
    
            
           $hasil = $allowance + $resultaktif;
          
        } else if (isset($resulttidakaktif) && $resulttidakaktif > 0) {
            $allowance = DetailInsentif::where('role_id', $user->role_id)
            ->where('tanggal_mulai', '<=', $selectedDate)
            ->where('tanggal_selesai', '>=', $selectedDate)
            ->where('status', 'Tidak Aktif') // Menambahkan kondisi status aktif
                    ->distinct() // Menambahkan fungsi distinct
                    ->value('allowance'); // Mengambil nilai langsung
    
           $hasil = $allowance + $resulttidakaktif;

        }
    }

    else if  ($kodeRole == 'ms') { 


        $user = Auth::user();
         $userId = auth()->user()->id;
    $products = Product::where('role_id', $user->role_id)->get();
  

    $hasil = 0;


    foreach ($products as $product) {
        if (isset($productQuantities[$product->id]) && $productQuantities[$product->id] != 0) {
                        $quantity = $productQuantities[$product->id];
                      
           

                        if($product->id == 121){

                          

                            $weeklyResults=[];
        foreach ($weeklyProductQuantities as $key => $quantity) {
            // Ambil minggu dari kunci
            $week = substr($key, strpos($key, '_week_') + 6);
        
            // Insentif dan Allowance
            $insentif = 50000;
          

            if($quantity >=5){
                $allowance = 250000;
            } else if ($quantity<5){
                $allowance=0;
            }
            // Hitung hasil berdasarkan rumus yang diberikan
            $result = ($quantity * $insentif) +$allowance;
        
            // Tetapkan hasil ke dalam array atau variabel sesuai kebutuhan Anda
            $weeklyResults[$key] = $result;
        }
        
     
        // Sekarang $weeklyResults berisi hasil untuk setiap minggu berdasarkan rumus yang diberikan.
        
        $result = array_sum($weeklyResults);

                          

                        } else {
                          
            $detailsInsentif = DetailInsentif::where('produk_id', $product->id)
            ->where('tanggal_mulai', '<=', $selectedDate)
            ->where('tanggal_selesai', '>=', $selectedDate)
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

        
        $tiers[] = [
            'minQty' => $minQtyPrevious,
            'maxQty' => $maxQtyPrevious,
            'insentif' => $insentifPrevious,
            'status' => $statusPrevious,
        ];

        if ($product->id == 121) {
            $allowance =0;
        } else {
        $allowance = $detail -> allowance;

        }


        
       
     
        
        
        if ($status == 'Aktif' && $quantity >= $minqty && ($maxqty === null || $quantity <= $maxqty)) {
            $insentifresult = ($quantity - ($minqty-1)) * $detail->insentif;

         
            
           
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
                      
          
            $result = $tiersebelumnya + $insentifresult + $allowance;
            
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
}


            $hasil += $result ;
           

            
        }

     
    }

  

        $message = "Asumsi  minimal menjual 5 aplikasi per minggu dalam 1 bulan";   
    
    }
}
        
        $totalIncome = $hasil;

    return response()->json([
        'totalIncome' => $totalIncome,
        'totalPoints' => $totalPoints,
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
