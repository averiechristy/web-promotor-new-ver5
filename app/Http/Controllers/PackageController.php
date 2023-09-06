<?php

namespace App\Http\Controllers;

use App\Models\PackageDetail;
use App\Models\PackageIncome;
use App\Models\Product;
use App\Models\UserRole;
use App\Rules\UniqueSelectedProducts;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dtPackage = PackageIncome::all();
        $role = UserRole::with('Role');
        $produk = Product::with('Role');
        $detail = PackageDetail::with('Detail');
        
       
        
        return view('admin.package.index', [
            'dtPackage' => $dtPackage,
             'produk' => $produk,
            'role' => $role,
            'detail' => $detail,
            
        ]);
    }
  
    
  
    public function tampildetail($id) {
        // Ambil data dari tabel PackageIncome berdasarkan id
        $data = PackageIncome::find($id);
    
        // Ambil semua data dari tabel PackageDetail
        // $detail = PackageDetail::all();
    
        // Ambil data produk yang terhubung dengan tabel PackageDetail
        $produk = PackageDetail::with('produk')->where('package_id', $id)->get();
        
    
        return view('admin.package.detail', [
            'data' => $data,
            'produk' => $produk,
            // 'detail' => $detail,
        ]);
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produk = Product::all();
        $role = UserRole::all();
        
        return view ('admin.package.create',[
            'produk' => $produk,
            'role' => $role,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'role_id' => 'required',
            'judul_paket' => 'required',
            'deskripsi_paket' => 'required',
            'produk' => ['required', 'array', new UniqueSelectedProducts],
            'qty_produk' => 'required|min:0',
        ], [
            'role_id.required' => 'Pilih role terlebih dahulu.',
            'judul_paket.required' => 'Input judul terlebih dahulu',
            'deskripsi_paket.required' => 'Input deskripsi paket terlebih dahulu',
            'produk.required' => 'Pilih minimal satu produk.',
            'qty_produk.required' => 'Isi qty produk.',
            'qty_produk.min' => 'Quantity Produk tidak boleh bernilai negatif',
            'produk.unique_selected_products' => 'Produk yang dipilih tidak boleh sama.',
        ]);
        
        
        
      
        $dtPackage = new PackageIncome;
        $dtPackage->judul_paket = $request->judul_paket;
        $dtPackage->role_id = $request->role_id;
        $dtPackage->deskripsi_paket = $request->deskripsi_paket;
        $dtPackage->save();
    
        $packageDetails = [];

        
    
        if ($request->has('produk') && $request->has('qty_produk')) {
            foreach ($request->produk as $index => $productId) {
                $packageDetails[] = [
                    'package_id' => $dtPackage->id,
                    'produk_id' => $productId,
                    'qty_produk' => intval($request->qty_produk[$index]),
                ];
            }
    
            PackageDetail::insert($packageDetails); // Simpan array packageDetails secara massal
        }
        
    $request->session()->flash('success', 'Paket Pendapatan berhasil ditambahkan.');
    return redirect(route('admin.package.index'));
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $package = PackageIncome::find($id); // Menggunakan find() untuk menghindari error jika tidak ditemukan
      

        $kode = Product::where('role_id', $package->role_id)->get(); // Assuming your model name is Product
        $produk = Product::all();

        $role = UserRole::all();
        $selectedRoleId = $package->role_id;

        // $detail = PackageDetail::all();

        $nama = PackageDetail::with('produk')->where('package_id', $id)->get();

return view('admin.package.edit')->with([
    'package' => $package,
    'produk' => $produk,
    'role' => $role,
    'kode'=>$kode,
    'selectedRoleId' => $selectedRoleId,
    // 'detail' => $detail,
    'nama'=>$nama,

]);

    }

    public function updatepackage(Request $request, $id)
    {

        $this->validate($request, [
            'role_id' => 'required',
            'judul_paket' => 'required',
            'deskripsi_paket' => 'required',
            'produk' => ['required', 'array', new UniqueSelectedProducts],
            'qty_produk' => 'required|min:0',
        ], [
            'role_id.required' => 'Pilih role terlebih dahulu.',
            'judul_paket.required' => 'Input judul terlebih dahulu',
            'deskripsi_paket.required' => 'Input deskripsi paket terlebih dahulu',
            'produk.required' => 'Pilih minimal satu produk.',
            'qty_produk.required' => 'Isi qty produk.',
            'qty_produk.min' => 'Quantity Produk tidak boleh bernilai negatif',
            'produk.unique_selected_products' => 'Produk yang dipilih tidak boleh sama.',
        ]);
       // Ambil data paket berdasarkan ID
    $dtPackage = PackageIncome::find($id);

    // Update data paket dengan nilai baru dari form
    $dtPackage->judul_paket = $request->judul_paket;
    $dtPackage->role_id = $request->role_id;
    $dtPackage->deskripsi_paket = $request->deskripsi_paket;
    $dtPackage->save();

    // Hapus detail paket yang ada sebelumnya
    PackageDetail::where('package_id', $id)->delete();

    // Simpan detail paket yang baru
    $packageDetails = [];

    if ($request->has('produk') && $request->has('qty_produk')) {
        foreach ($request->produk as $index => $productId) {
            $packageDetails[] = [
                'package_id' => $dtPackage->id,
                'produk_id' => $productId, // Gunakan $productId langsung sebagai produk_id
                'qty_produk' => intval($request->qty_produk[$index]),
            ];
        }

        // dd($packageDetails);
    
        PackageDetail::insert($packageDetails); // Simpan array packageDetails secara massal
    }
    

        $request->session()->flash('success', 'Paket Pendapatan berhasil diupdate.');
        return redirect(route('admin.package.index'));
    
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
    public function destroy(Request $request, $id)
    {
        $package = PackageIncome::find($id);
        $package->delete();

        $request->session()->flash('error', "Paket Pendapatan berhasil dihapus.");

        return redirect(route('admin.package.index'));
    }

   
   public function deleteproduk(Request $request, $id){
    $product = PackageIncome::find('produk');

    if (!$product) {
        return response()->json(['message' => 'Produk tidak ditemukan.'], 404);
    }

    $product->delete();

    return response()->json(['message' => 'Produk berhasil di hapus.']);
   }


    public function getProductsByRole($roleId)
    {
        $products = Product::findOrFail($roleId)->products;
        return response()->json($products);
    }

    

}
