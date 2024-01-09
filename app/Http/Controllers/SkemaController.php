<?php

namespace App\Http\Controllers;

use App\Models\DetailInsentif;
use App\Models\Product;
use App\Models\Skema;
use App\Models\UserRole;
use Illuminate\Http\Request;

class SkemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skema = Skema::orderBy('created_at', 'desc')->get();
        return view ('admin.skema.index',[
           'skema' => $skema
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = UserRole::all();
        $produk = Product::all();


        return view('admin.skema.create',[
            'role' => $role,
            'produk' => $produk
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $existingEntry = Skema::where('role_id', $request->role_id)
    ->where('produk_id', $request->produk_id) // Tambahkan kondisi produk_id
    ->where(function ($query) use ($request) {
        $query->where(function ($q) use ($request) {
            $q->where('tanggal_mulai', '<=', $request->tanggal_mulai)
                ->where('tanggal_selesai', '>=', $request->tanggal_mulai);
        })
        ->orWhere(function ($q) use ($request) {
            $q->where('tanggal_mulai', '<=', $request->tanggal_selesai)
                ->where('tanggal_selesai', '>=', $request->tanggal_selesai);
        });
    })
    ->first();

if ($existingEntry) {
    $request->session()->flash('error', 'Gagal Menyimpan Data, Skema dengan role, produk, dan rentang tanggal yang sama sudah ada');
    return redirect(route('admin.skema.index'))->withInput();
}

        
        $loggedInUser = auth()->user();
        $loggedInUsername = $loggedInUser->nama; 
        $skema = new Skema();
        $skema->role_id = $request->role_id;
        $skema->produk_id = $request->produk_id;
        // $skema->biaya_operasional = $request->biaya_operasional;
        $skema->tanggal_mulai = $request->tanggal_mulai;
        $skema->tanggal_selesai = $request->tanggal_selesai;
        $skema->poin_produk = $request->poin_produk;
        $skema->keterangan = $request->keterangan;
        $skema->created_by = $loggedInUsername;

     

        $skema->save();


        $insentifData = [];

        foreach ($request->insentif as $key => $insentif) {
           
                $insentifData[] = [
                    'skema_id' => $skema->id,
                    'produk_id' => $request->produk_id, 
                    'insentif' => $insentif,
                    'min_qty' => $request->min_qty[$key],
                    'max_qty' => $request->max_qty[$key],
                    'tanggal_mulai' => $request->tanggal_mulai,
                    'tanggal_selesai' => $request->tanggal_selesai,
                    'role_id' => $request->role_id,
                ];
            
        }
        

        // Mass insert data insentif
        if (!empty($insentifData)) {
           DetailInsentif::insert($insentifData);
        }

        $request->session()->flash('success', 'Skema berhasil ditambahkan.');
        return redirect(route('admin.skema.index'));
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $skema = Skema::find($id);
        $selectedRoleId = $skema->role_id;
        $nama = DetailInsentif::with('skema')->where('skema_id', $id)->get();
        $role = UserRole::all();
        $produk = Product::all();
        $selectedProductId = $skema->produk_id;
        $skemaHasPoinProduk = $skema->hasPoinProduk(); 
        
       
        return view ('admin.skema.edit', [
            'skema' => $skema,
            'selectedRoleId' => $selectedRoleId,
            'nama' => $nama,
            'role' => $role,
            'produk' => $produk,
            'selectedProductId' => $selectedProductId,
            'skemaHasPoinProduk' => $skemaHasPoinProduk,
        ]);
    }

    public function tampildetailinsentif( $id)
    {
        $data = Skema::find($id);
    
        // Ambil semua data dari tabel PackageDetail
        // $detail = PackageDetail::all();
    
        // Ambil data produk yang terhubung dengan tabel PackageDetail
        $insentif = DetailInsentif::with('skema')->where('skema_id', $id)->get();

        return view('admin.skema.detail', [
            'data' => $data,
            'insentif' => $insentif,

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
    public function update(Request $request, string $id)
    {
        $existingEntry = Skema::where('role_id', $request->role_id)
        ->where('produk_id', $request->produk_id)
        ->where('id', '!=', $id) // Exclude the current entry being updated
        ->where(function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('tanggal_mulai', '<=', $request->tanggal_mulai)
                    ->where('tanggal_selesai', '>=', $request->tanggal_mulai);
            })
            ->orWhere(function ($q) use ($request) {
                $q->where('tanggal_mulai', '<=', $request->tanggal_selesai)
                    ->where('tanggal_selesai', '>=', $request->tanggal_selesai);
            });
        })
        ->first();

    if ($existingEntry) {
        $request->session()->flash('error', 'Gagal Menyimpan Data, Skema dengan role dan rentang tanggal yang sama sudah ada');
        return redirect(route('admin.skema.index'))->withInput();
    }
        
        $selectedInsentifArray = $request->input('skema');
        $loggedInUser = auth()->user();
        $loggedInUsername = $loggedInUser->nama; 

        // Simpan data produk yang dipilih ke dalam session
        $request->session()->put('selected_products', $selectedInsentifArray);
           // Ambil data paket berdasarkan ID
        $skema = Skema::find($id);

        $skema-> role_id = $request -> role_id;
        $skema -> produk_id = $request -> produk_id;
        $skema -> tanggal_mulai = $request -> tanggal_mulai;
        $skema -> tanggal_selesai = $request -> tanggal_selesai;
        $skema -> keterangan = $request -> keterangan;
        $skema -> updated_by = $loggedInUsername;

        $skema -> save();

        DetailInsentif::where('skema_id', $id)->delete();


        $insentifData = [];
        $insentifData = [];

if ($request->has('insentif') && $request->has('min_qty') && $request->has('max_qty')) {
    foreach ($request->insentif as $key => $insentif) {
        $insentifData[] = [
            'skema_id' => $skema->id,
            'produk_id' => $request->produk_id,
            'insentif' => $insentif,
            'min_qty' => $request->min_qty[$key],
            'max_qty' => $request->max_qty[$key],
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'role_id' => $request->role_id,
        ];
    }
    // Simpan data insentif ke dalam tabel DetailInsentif
    DetailInsentif::insert($insentifData);
}

        $request->session()->flash('success', 'Skema berhasil diupdate.');
        return redirect(route('admin.skema.index'));    
    
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        // Temukan skema berdasarkan ID
        $skema = Skema::find($id);
    
        // Hapus semua detailinsentifs terkait dengan skema_id yang dipilih
        $detailinsentifs = DetailInsentif::where('skema_id', $id)->get();
        foreach ($detailinsentifs as $detailinsentif) {
            $detailinsentif->delete();
        }
    
        // Hapus skema
        $skema->delete();
    
        // Flash message
        $request->session()->flash('error', "Skema berhasil dihapus.");
    
        // Redirect ke index skema
        return redirect(route('admin.skema.index'));
    }
    

}
