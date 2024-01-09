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

class UserKalkulatorPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $userKodeRole = auth()->user()->Role->kode_role;
        $barang= Product::where('role_id', $user->role_id)->get();
        
        if (strtolower($userKodeRole) === 'me') {
            return view('user.paketkalkulator', [
                'barang' => $barang
            ]);
        } elseif (strtolower($userKodeRole) === 'tm') {
            return view('user.paketkalkulatorTM', [
                 'barang' => $barang
            ]);
        } elseif (strtolower($userKodeRole) === 'ms') {
            return view('user.paketkalkulatorMS', [
                 'barang' => $barang
            ]);
        } else {
            return view('user.paketkalkulatorlainnya', [
                 'barang' => $barang
            ]);
        }  
    }


     public function hitung(Request $request)
    {
          $user = Auth::user();

        $barang= Product::where('role_id', $user->role_id)->get();

        $user = Auth::user();
        $userKodeRole = auth()->user()->Role->kode_role;
        $product= Product::where('role_id', $user->role_id)->get();


        // Ambil data dari formulir
        $cicilanInputs = $request->input('cicilan');

        $productPersen = $request->input('product_persen');

        $cicilanInputs = $request->input('cicilan');
        $productPersen = $request->input('product_persen');
        $selectedBarang = $request->input('nama_barang');
    
        // Validasi bahwa barang yang dipilih tidak boleh sama
        if (count($selectedBarang) !== count(array_unique($selectedBarang))) {
            return redirect()->back()->with('error', 'Barang yang dipilih tidak boleh sama');
        }

        
        $totalCicilan = 0;
        $cicilanInputs = $request->input('cicilan');
        $filteredCicilanInputs = [];
        

        foreach ($cicilanInputs as $cicilan) {
            // Hapus karakter non-digit dan tambahkan ke dalam array baru
            $cicilanValue = filter_var($cicilan, FILTER_SANITIZE_NUMBER_INT);
            $filteredCicilanInputs[] = $cicilanValue;
        }


        foreach ($filteredCicilanInputs as $cicilan) {
            if (is_numeric($cicilan)) {
                $totalCicilan += (int)$cicilan;
            }
        }

        // Tambahkan 3 juta ke total cicilan
        $totalCicilan += 3000000;

        // Hitung total poin
        $totalPoin = 0;

        if ($totalCicilan <= 3600000) {
            $totalPoin = ceil($totalCicilan / 50000);
        } elseif ($totalCicilan <= 6000000) {
            $totalPoin = 72 + ceil(($totalCicilan - 3600000) / 40000);
        } else {
            $totalPoin = 120 + ceil(($totalCicilan - 6000000) / 40000);
        }
        
        $totalPersen = 0;
foreach ($productPersen as $productId => $persen) {
    if (is_numeric($persen)) {
        $totalPersen += (int)$persen;
    }
}

if ($totalPersen != 100) {
    return redirect()->back()->with('error', 'Total persen produk harus sama dengan 100%')->withInput();
}

        $jumlahProduk = [];
        foreach ($product as $produk) {
            $productId = $produk->id;
            $jumlahProduk[$productId] = intval(ceil(($productPersen[$productId] * $totalPoin / 100)/$produk->poin_produk));
        }
     
        $request->session()->put('totalCicilan', $totalCicilan);
        $request->session()->put('totalPoin', $totalPoin);
        
        $request->session()->put('jumlahProduk', $jumlahProduk);
        $request->session()->put('formInput', $request->all());
        // Simpan data poin ke dalam sesi jika diperlukan
        // Misalnya: session(['total_poin' => $totalPoin]);
        $request->session()->put('inputData', $request->all());
        $request->session()->push('addedItems', $request->input());

        
        
        // Tampilkan hasil perhitungan ke tampilan
        // return redirect()->back()->withInput();   

        return view('user.hasilhitungproduk', [
            'totalCicilan' => $totalCicilan,
            'totalPoin' => $totalPoin,
            'jumlahProduk' => $jumlahProduk,

       ]);
    
    }

    
    public function hitungTM(Request $request)
    {

 $user = Auth::user();

        $barang= Product::where('role_id', $user->role_id)->get();

        $user = Auth::user();
        $userKodeRole = auth()->user()->Role->kode_role;
        $product= Product::where('role_id', $user->role_id)->get();

        $tanggalBerjalan = Carbon::now();
        // Ambil data dari formulir
        $cicilanInputs = $request->input('cicilan');

        $productPersen = $request->input('product_persen');
    
        $cicilanInputs = $request->input('cicilan');
        $productPersen = $request->input('product_persen');
        $selectedBarang = $request->input('nama_barang');
    
        // Validasi bahwa barang yang dipilih tidak boleh sama
        if (count($selectedBarang) !== count(array_unique($selectedBarang))) {
            return redirect()->back()->with('error', 'Barang yang dipilih tidak boleh sama');
        }

        $totalCicilan = 0;
        $cicilanInputs = $request->input('cicilan');
        $filteredCicilanInputs = [];
        

        foreach ($cicilanInputs as $cicilan) {
            // Hapus karakter non-digit dan tambahkan ke dalam array baru
            $cicilanValue = filter_var($cicilan, FILTER_SANITIZE_NUMBER_INT);
            $filteredCicilanInputs[] = $cicilanValue;
        }


        foreach ($filteredCicilanInputs as $cicilan) {
            if (is_numeric($cicilan)) {
                $totalCicilan += (int)$cicilan;
            }
        }

        // Tambahkan 3 juta ke total cicilan
        $totalCicilan += 4900000;


        $biayaOperasional = BiayaOperasional::where('role_id', $user->role_id)->where('tanggal_mulai', '<=', $tanggalBerjalan)
        ->where('tanggal_selesai', '>=', $tanggalBerjalan)
        ->value('biaya_operasional');
        
        
        $detailsInsentif = DetailInsentif::where('role_id', $user->role_id)
        ->where('tanggal_mulai', '<=', $tanggalBerjalan)
        ->where('tanggal_selesai', '>=', $tanggalBerjalan)
        ->distinct()
        ->get(['min_qty', 'max_qty', 'insentif']);
        
    
        $insentifnext = null;
    $minqtynext = null;
    $maxqtynext = null;
    $rangenext = null;

    $selisih = ceil($totalCicilan - $biayaOperasional);

    $totalntb = 0; // Inisialisasi nilai totalntb di luar loop
    
    $selisih = ceil($totalCicilan - $biayaOperasional);
    $totalntb = 0; // Inisialisasi nilai totalntb di luar loop
    
    // foreach ($detailsInsentif as $key => $detail) {
    //     // Accessing values from the current and next elements
    //     $minqty = $detail->min_qty;
    //     $maxqty = $detail->max_qty;
    //     $insentif = $detail->insentif;
    //     $range = ceil(($maxqty - $minqty) * $insentif);

    //     if (isset($detailsInsentif[$key + 1])) {
    //         $minqtynext = $detailsInsentif[$key + 1]->min_qty;
    //         $maxqtynext = $detailsInsentif[$key + 1]->max_qty;
    //         $insentifnext = $detailsInsentif[$key + 1]->insentif;
    
    //         $rangenext = ceil(($maxqtynext - $minqtynext) * $insentifnext);

    //         if ($selisih < $range ) {
    //             $totalntb = ceil(($minqty - 1) + ($selisih / $insentif));
                
    //             break;
    //         } elseif ($selisih >= $range ){
    //             $totalntb = ceil(($minqtynext - 1) + (($selisih - $range) / $insentifnext));
    //             dd($totalntb);
    //             break;
    //         }
    //     }
    // }

    foreach ($detailsInsentif as $key => $detail) {
        // Accessing values from the current and next elements
        $minqty = $detail->min_qty;
        $maxqty = $detail->max_qty;
        $insentif = $detail->insentif;
    
        // Handling the case where maxqty is null (unbounded)
        if ($maxqty === null) {
            $range = PHP_INT_MAX; // A very large number to represent unbounded range
            
        } else {
            $range = ceil(($maxqty - $minqty) * $insentif);
        }
    
        if (isset($detailsInsentif[$key + 1])) {
            $minqtynext = $detailsInsentif[$key + 1]->min_qty;
            $maxqtynext = $detailsInsentif[$key + 1]->max_qty;
            $insentifnext = $detailsInsentif[$key + 1]->insentif;
    
            // Handling the case where maxqtynext is null (unbounded)
            if ($maxqtynext === null) {
                $rangenext = PHP_INT_MAX; // A very large number to represent unbounded range
            } else {
                $rangenext = ceil(($maxqtynext - $minqtynext) * $insentifnext);
            }
    
            if ($selisih < $range) {
                // Jika selisih kurang dari rentang, hitung totalntb berdasarkan rumus pertama
                $totalntb = ceil(($minqty - 1) + ($selisih / $insentif));
                break;
            } elseif ($selisih >= $range && $selisih <  $rangenext) {
                // Jika selisih lebih dari atau sama dengan rentang dan kurang dari rentang + rentang selanjutnya,
                // hitung totalntb berdasarkan rumus kedua
                $totalntb = ceil(($minqtynext - 1) + (($selisih - $range) / $insentifnext));
              
                break;
            }
        } else {
            // Handling the case where there is no next range
            if ($selisih >= $range) {
                // Jika selisih lebih dari atau sama dengan rentang untuk range terakhir,
                // hitung totalntb berdasarkan rumus untuk range terakhir
                $totalntb = ceil(($minqty - 1) + ($selisih / $insentif));
               
                break;
            }
        }
    }
    
      
        // if ($index + 1 < count($detailsInsentif)) {
        //     $insentifnext = $detailsInsentif[$index+1]->insentif;                 
        //     $totalntb = $maxqty + ceil(($selisih-$range) / $insentifnext);

           
        // }

          // if ($totalCicilan <= $biayaOperasional) {
        //     $totalntb = 90;
        // } 
        // elseif ($totalCicilan > $biayaOperasional) {
        //     $selisih = ceil($totalCicilan - $biayaOperasional);
        //     if( $selisih <768000) {
        //         $totalntb = 90 + ceil($selisih /12000);
        //     } else if ($selisih >= 768000){
        //          $totalntb = 90 + 64 + ceil(($selisih-768000) / 15500);
        //      }
        //  }

    // Validasi persentase tidak boleh kurang dari 0 atau lebih dari 100
    foreach ($productPersen as $barangId => $persen) {
        if ($persen < 0 || $persen > 100) {
            return redirect()->back()->with('error', 'Persentase harus berada antara 0 dan 100')->withInput();
        }
    }

    $totalPersen = 0;
    foreach ($productPersen as $productId => $persen) {
        if (is_numeric($persen)) {
            $totalPersen += (int)$persen;
        }
    }

    if ($totalPersen != 100) {
        return redirect()->back()->with('error', 'Total persen produk harus sama dengan 100%')->withInput();
    }



   

$jumlahProduk = [];
foreach ($product as $produk) {
    $productId = $produk->id;
    
    $poinproduk = Skema::where('produk_id', $produk->id)->first();
    $poin = $poinproduk ? $poinproduk->poin_produk : 0;
    

    $jumlahProduk[$productId] = intval(ceil(($productPersen[$productId] * $totalntb / 100)/$poin));
}



// Tampilkan hasil perhitungan

$request->session()->put('totalCicilan', $totalCicilan);
$request->session()->put('totalntb', $totalntb);

$request->session()->put('jumlahProduk', $jumlahProduk);
$request->session()->put('formInput', $request->all());
// Simpan data poin ke dalam sesi jika diperlukan
// Misalnya: session(['total_poin' => $totalPoin]);
$request->session()->put('inputData', $request->all());
$request->session()->push('addedItems', $request->input());


return view('user.hasilhitungprodukTM', [
    'totalCicilan' => $totalCicilan,
'jumlahProduk' => $jumlahProduk,
    'product' => $product,

]);
   
}

// public function hitungMS (Request $request) {
//     $user = Auth::user();

//         $barang= Product::where('role_id', $user->role_id)->get();

//         $user = Auth::user();
//         $userKodeRole = auth()->user()->Role->kode_role;
//         $product= Product::where('role_id', $user->role_id)->get();


//         // Ambil data dari formulir
//         $cicilanInputs = $request->input('cicilan');

       

//         $cicilanInputs = $request->input('cicilan');
//         $productPersen = $request->input('product_persen');
//         $selectedBarang = $request->input('nama_barang');
    
//         // Validasi bahwa barang yang dipilih tidak boleh sama
//         if (count($selectedBarang) !== count(array_unique($selectedBarang))) {
//             return redirect()->back()->with('error', 'Barang yang dipilih tidak boleh sama');
//         }

//         $totalCicilan = 0;
//         $cicilanInputs = $request->input('cicilan');
//         $filteredCicilanInputs = [];
        

//         foreach ($cicilanInputs as $cicilan) {
//             // Hapus karakter non-digit dan tambahkan ke dalam array baru
//             $cicilanValue = filter_var($cicilan, FILTER_SANITIZE_NUMBER_INT);
//             $filteredCicilanInputs[] = $cicilanValue;
//         }


//         foreach ($filteredCicilanInputs as $cicilan) {
//             if (is_numeric($cicilan)) {
//                 $totalCicilan += (int)$cicilan;
//             }
//         }

//         // Tambahkan 3 juta ke total cicilan
//         $totalCicilan += 3000000;


//         // Validasi bahwa persentase tidak boleh kurang dari 0 atau lebih dari 100
//         foreach ($productPersen as $barangId => $persen) {
//             if ($persen < 0 || $persen > 100) {
//                 return redirect()->back()->with('error', 'Persentase harus berada antara 0 dan 100')->withInput();
//             }
//         }
    
//         $totalPersen = 0;
//         foreach ($productPersen as $productId => $persen) {
//             if (is_numeric($persen)) {
//                 $totalPersen += (int)$persen;
//             }
//         }
    
//         if ($totalPersen != 100) {
//             return redirect()->back()->with('error', 'Total persen produk harus sama dengan 100%')->withInput();
//         }




// $insentif = $totalCicilan - 1000000;

// // foreach ($product as $produk) { 
// //     $productId = $produk->id;

// //     // Perhitungan jumlah produk untuk kategori ntb
// //     $jumlahProdukntb[$productId] = intval(ceil((($ntbPersenInputs[$productId] * $insentif) / 100) / 50000));

// //     // Perhitungan jumlah produk untuk kategori sosmed
// //     $jumlahProduksosmed[$productId] = intval(ceil((($sosmedPersenInputs[$productId] *  $insentif ) / 100) / 20000));

// //     $jumlahProdukpersonal[$productId] = intval(ceil((($personalPersenInputs[$productId] *  $insentif ) / 100 )/10000));

// // }

// $jumlahProduk = [];
// foreach ($product as $produk) {
//     $productId = $produk->id;
//     $jumlahProduk[$productId] = intval(ceil(($productPersen[$productId] * $insentif / 100)/$produk->poin_produk));
// }


// return view('user.hasilhitungprodukMS', [
//     'totalCicilan' => $totalCicilan,
//   'jumlahProduk' => $jumlahProduk,
//     'product' => $product,

// ]);
   

// }

public function hitungMS (Request $request) {
    $user = Auth::user();

        $barang= Product::where('role_id', $user->role_id)->get();

        $user = Auth::user();
        $userKodeRole = auth()->user()->Role->kode_role;
        $product= Product::where('role_id', $user->role_id)->get();
        $tanggalBerjalan = Carbon::now();

        // Ambil data dari formulir
        $cicilanInputs = $request->input('cicilan');

       

        $cicilanInputs = $request->input('cicilan');
        $productPersen = $request->input('product_persen');
        $selectedBarang = $request->input('nama_barang');
    
        // Validasi bahwa barang yang dipilih tidak boleh sama
        if (count($selectedBarang) !== count(array_unique($selectedBarang))) {
            return redirect()->back()->with('error', 'Barang yang dipilih tidak boleh sama');
        }

        $totalCicilan = 0;
        $cicilanInputs = $request->input('cicilan');
        $filteredCicilanInputs = [];
        

        foreach ($cicilanInputs as $cicilan) {
            // Hapus karakter non-digit dan tambahkan ke dalam array baru
            $cicilanValue = filter_var($cicilan, FILTER_SANITIZE_NUMBER_INT);
            $filteredCicilanInputs[] = $cicilanValue;
        }


        foreach ($filteredCicilanInputs as $cicilan) {
            if (is_numeric($cicilan)) {
                $totalCicilan += (int)$cicilan;
            }
        }

        // Tambahkan 3 juta ke total cicilan
        $totalCicilan += 3000000;


        // Validasi bahwa persentase tidak boleh kurang dari 0 atau lebih dari 100
        foreach ($productPersen as $barangId => $persen) {
            if ($persen < 0 || $persen > 100) {
                return redirect()->back()->with('error', 'Persentase harus berada antara 0 dan 100')->withInput();
            }
        }
    
        $totalPersen = 0;
        foreach ($productPersen as $productId => $persen) {
            if (is_numeric($persen)) {
                $totalPersen += (int)$persen;
            }
        }
    
        if ($totalPersen != 100) {
            return redirect()->back()->with('error', 'Total persen produk harus sama dengan 100%')->withInput();
        }


        $biayaOperasional = BiayaOperasional::where('role_id', $user->role_id)->where('tanggal_mulai', '<=', $tanggalBerjalan)
        ->where('tanggal_selesai', '>=', $tanggalBerjalan)->value('biaya_operasional');
    

        $insentif = $totalCicilan - ($biayaOperasional * 4);



// foreach ($product as $produk) { 
//     $productId = $produk->id;

//     // Perhitungan jumlah produk untuk kategori ntb
//     $jumlahProdukntb[$productId] = intval(ceil((($ntbPersenInputs[$productId] * $insentif) / 100) / 50000));

//     // Perhitungan jumlah produk untuk kategori sosmed
//     $jumlahProduksosmed[$productId] = intval(ceil((($sosmedPersenInputs[$productId] *  $insentif ) / 100) / 20000));

//     $jumlahProdukpersonal[$productId] = intval(ceil((($personalPersenInputs[$productId] *  $insentif ) / 100 )/10000));

// }

$jumlahProduk = [];
foreach ($product as $produk) {
    $productId = $produk->id;
    $detailInsentif = DetailInsentif::where('produk_id', $produk->id)->where('tanggal_mulai', '<=', $tanggalBerjalan)
    ->where('tanggal_selesai', '>=', $tanggalBerjalan)->first();
    
    $incentif = $detailInsentif ? $detailInsentif->insentif : 0;

    $jumlahProduk[$productId] = intval(ceil(($productPersen[$productId] * $insentif / 100)/$incentif));
}


return view('user.hasilhitungprodukMS', [
    'totalCicilan' => $totalCicilan,
  'jumlahProduk' => $jumlahProduk,
    'product' => $product,

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
