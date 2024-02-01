<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\BiayaOperasional;
use App\Models\DetailInsentif;
use App\Models\LeaderBoard;
use App\Models\Product;
use App\Models\Reward;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class UserDashboardController extends Controller
{
    /**
     *
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->user()->id;

        $currentRole = auth()->user()->role;
       
        $kodeRole = strtolower($currentRole->kode_role);

        $roleid = $currentRole->id;

        $user = Auth::user();

        $tanggalBerjalan = Carbon::now();
             $today = Carbon::now();

        if ($today->isMonday()) {
            // Jika hari ini adalah Senin, ambil data dari Jumat sebelumnya.
            $dateToQuery = $today->subDays(3)->toDateString();
        }else {
            // Jika hari biasa, ambil data dari hari sebelumnya.
            $dateToQuery = $today->subDay()->toDateString();
        }
        $activeRewards = Reward::where('role_id', $currentRole->id)
        ->where(function($query) {
            $today = now();
            $query->whereDate('tanggal_mulai', '<=', $today->toDateString())
                  ->whereDate('tanggal_selesai', '>=', $today->toDateString());
        })
        ->get();
    
             
        // // Menghitung total pendapatan bulan ini
        // $totalIncomeThisMonth = LeaderBoard::where('user_id', $userId)
        //     ->whereYear('tanggal', now()->year)
        //     ->whereMonth('tanggal', now()->month)
        //     ->sum('income');
      

        // Menghitung total poin bulan ini
        $totalPointsThisMonth = LeaderBoard::where('user_id', $userId)
        ->whereYear('tanggal', now()->year)
        ->whereMonth('tanggal', now()->month)
        ->sum('total');
        
        
    
      

   
  $produk = LeaderBoard::where('user_id', $userId)
        ->whereYear('tanggal', now()->year)
        ->whereMonth('tanggal', now()->month)
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

      





$products = Product::all();


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

} else if ($kodeRole == 'tm') {

    // $biayaOperasional = BiayaOperasional::where('role_id', $currentRole->id)->where('tanggal_mulai', '<=', $tanggalBerjalan)
    // ->where('tanggal_selesai', '>=', $tanggalBerjalan)
    // ->value('biaya_operasional');


    // $detailsInsentif = DetailInsentif::where('role_id', $currentRole->id)
    // ->where('tanggal_mulai', '<=', $tanggalBerjalan)
    // ->where('tanggal_selesai', '>=', $tanggalBerjalan)
    // ->distinct()
    // ->get(['min_qty', 'max_qty', 'insentif']);



    // foreach ($detailsInsentif as $detail) {
    //     $minqty = $detail->min_qty;
    //     $maxqty = $detail->max_qty;
    //     $insentif = $detail->insentif;
    
        
        
    //     if ($totalPointsThisMonth >= $minqty && ($maxqty === null || $totalPointsThisMonth <= $maxqty)) {
    //         $insentifresult = ($totalPointsThisMonth - ($minqty-1)) * $detail->insentif;
    //         $hasil = $biayaOperasional + (($maxQtyPrevious-$minQtyPrevious) * $insentifPrevious ) +  $insentifresult ;
         
    //     }
       
    
    //     // Simpan nilai maxqty untuk iterasi berikutnya
    //     $maxQtyPrevious = $maxqty;
    //     $minQtyPrevious = $minqty;
    //     $insentifPrevious = $insentif;
    // }

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
            
          
            if ($totalPointsThisMonth  == 90){
                $hasil = $allowance;
            }
            else if ($status == 'Aktif' && $totalPointsThisMonth >= $minqty && ($maxqty === null || $totalPointsThisMonth <= $maxqty)) {
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
    

} else  if ($kodeRole == 'ms') {


    
    
    $products = Product::where('role_id', $user->role_id)->get();
  

    $hasil = 0;


    foreach ($products as $product) {
        if (isset($productQuantities[$product->id]) && $productQuantities[$product->id] != 0) {
                        $quantity = $productQuantities[$product->id];
                      
           

                        if($product->id == 121){

                                            
            $detailsInsentif = DetailInsentif::where('produk_id', $product->id)
            ->where('tanggal_mulai', '<=', $tanggalBerjalan)
            ->where('tanggal_selesai', '>=', $tanggalBerjalan)
            ->get(['min_qty', 'max_qty', 'insentif', 'allowance', 'status']);

                            $weeklyResults=[];

                            foreach ($detailsInsentif as $detail) {
        foreach ($weeklyProductQuantities as $key => $quantity) {
            // Ambil minggu dari kunci
            $week = substr($key, strpos($key, '_week_') + 6);
        
            // Insentif dan Allowance
            $insentif = $detail->insentif;
          

            if($quantity >=5){
                $allowance = $detail->allowance;
            } else if ($quantity<5){
                $allowance=0;
            }
            // Hitung hasil berdasarkan rumus yang diberikan
            $result = ($quantity * $insentif) +$allowance;
        
            // Tetapkan hasil ke dalam array atau variabel sesuai kebutuhan Anda
            $weeklyResults[$key] = $result;
        }
        
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

    


}
    
    $totalIncomeThisMonth = $hasil;
    

        // Menghitung total pendapatan bulan lalu
        $lastMonth = now()->subMonth();
       
    
        // Menghitung total poin bulan lalu
        $totalPointsLastMonth = LeaderBoard::where('user_id', $userId)
            ->whereYear('tanggal', $lastMonth->year)
            ->whereMonth('tanggal', $lastMonth->month)
            ->sum('total');


         
    
            
        // Menghitung total poin hari ini
        $totalPointsToday = LeaderBoard::where('user_id', $userId)
            ->whereDate('tanggal', $dateToQuery) // Mengambil data hanya untuk hari ini
            ->sum('total');

            $yesterday = Carbon::parse($dateToQuery)->subDay();

           
                
        
            // Menghitung total poin hari kemarin
            $totalPointsYesterday = LeaderBoard::where('user_id', $userId)
                ->whereDate('tanggal', $yesterday) // Mengambil data hanya untuk hari kemarin
                ->sum('total');



        // Menentukan apakah total pendapatan naik atau turun dibandingkan dengan bulan lalu
        

    // Menentukan apakah total poin naik atau turun dibandingkan dengan hari kemarin
    $pointsChange = ($totalPointsToday > $totalPointsYesterday) ? 'Naik' : 'Turun';
    
        // Menghitung poin yang diperlukan untuk mencapai reward
        $requiredPoints = [];
    
        foreach ($activeRewards as $reward) {
            $requiredPoints[$reward->id] = $reward->poin_reward - $totalPointsThisMonth;

            $totalPointsRewardPeriod = LeaderBoard::where('user_id', $userId)
            ->where('tanggal', '>=', $reward->tanggal_mulai) // Menggunakan tanggal mulai reward
            ->where('tanggal', '<=', $reward->tanggal_selesai) // Menggunakan tanggal selesai reward
            ->sum('total');
    
    // Menghitung persentase poin yang sudah dicapai
    $progressWidth = ($totalPointsRewardPeriod >= $reward->poin_reward) ? '100%' : ($totalPointsRewardPeriod / $reward->poin_reward * 100) . '%';
        }
    

   
        $remainingTime = [];

        foreach ($activeRewards as $reward) {
            $endDate = Carbon::parse($reward->tanggal_selesai)->endOfDay(); // Akhiri hari pada tanggal selesai (pukul 23:59:59)
            $remainingTime[$reward->id] =  now()->diffInDays($endDate) . ' hari';
        }

    // 
    
$totalPointsRewardPeriod = [];
$progressWidthPerReward = [];
$userRankRewardPeriod = []; 
$totalUsersRewardPeriod =[];

foreach ($activeRewards as $activeReward) {

    $userRoleId = Auth::user()->role_id;

    // Menghitung total poin pengguna selama periode reward berjalan
    $totalPointsReward = LeaderBoard::where('user_id', $userId)
        ->where('tanggal', '>=', $activeReward->tanggal_mulai)
        ->where('tanggal', '<=', $activeReward->tanggal_selesai)
        ->sum('total');

        $totalUsers = LeaderBoard::where('tanggal', '>=', $activeReward->tanggal_mulai)
        ->where('tanggal', '<=', $activeReward->tanggal_selesai)
        ->where('role_id', '=', $userRoleId) // Ganti $userRoleId dengan nilai yang sesuai
        ->distinct('user_id')
        ->count();


        $userRank = LeaderBoard::where('tanggal', '>=', $activeReward->tanggal_mulai)
        ->where('tanggal', '<=', $activeReward->tanggal_selesai)
        ->selectRaw('user_id, SUM(total) as total_points')
        ->groupBy('user_id')
        ->orderByDesc('total_points')
        ->pluck('user_id')
        ->search($userId);
    
    

    // Simpan total poin untuk reward ini dalam array
    $totalPointsRewardPeriod[$activeReward->id] = $totalPointsReward;
    $userRankRewardPeriod[$activeReward->id] = $userRank;
    $totalUsersRewardPeriod[$activeReward->id] = $totalUsers;


    // Menghitung persentase poin yang sudah dicapai untuk reward ini
    $progressWidth = ($totalPointsReward >= $activeReward->poin_reward) ? '100%' : number_format(($totalPointsReward / $activeReward->poin_reward * 100), 1) . '%';

    // Simpan progressWidth untuk reward ini dalam array dengan ID reward sebagai kunci
    $progressWidthPerReward[$activeReward->id] = $progressWidth;

    // Anda dapat menggunakan $progressWidth sesuai kebutuhan di sini atau menyimpannya untuk digunakan nanti.
    

}



// Sekarang, Anda memiliki $progressWidthPerReward yang berisi persentase progressWidth per ID reward.

        $userRole = Auth::user()->role_id;
        $userId = Auth::user()->id;
        $leaderboardData = LeaderBoard::getLeaderboardUserDasboard($userRole);
        $userRank = LeaderBoard::getRankForUser($userId, $userRole);
        $totalUsersWithSameRole = LeaderBoard::getTotalUsersWithSameRole($userRole);
        

        return view('user.userdashboard', [
            'totalIncomeThisMonth' => $totalIncomeThisMonth,
            'totalPointsThisMonth' => $totalPointsThisMonth,
            'activeRewards' => $activeRewards,
            'requiredPoints' => $requiredPoints,
            
            'pointsChange' => $pointsChange,
            'totalPointsLastMonth' => $totalPointsLastMonth,
         'totalPointsToday' => $totalPointsToday,
         'totalPointsYesterday' =>   $totalPointsYesterday,
            'remainingTime' => $remainingTime,
            'leaderboardData' => $leaderboardData,
            'userRank' => $userRank,
            'totalUsersWithSameRole' => $totalUsersWithSameRole,
            'totalPointsRewardPeriod' => $totalPointsRewardPeriod,
            'progressWidthPerReward' => $progressWidthPerReward,
            'userRankRewardPeriod' => $userRankRewardPeriod,
           'totalUsersRewardPeriod' => $totalUsersRewardPeriod
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
