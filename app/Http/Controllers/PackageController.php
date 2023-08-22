<?php

namespace App\Http\Controllers;

use App\Models\PackageIncome;
use App\Models\Product;
use App\Models\UserRole;
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
        
        return view('admin.package.index', [
            'dtPackage' => $dtPackage,
             'produk' => $produk,
            'role' => $role,
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
    $dataProduk = $request->input('data_produk');
    $produkArray = []; // Initialize an empty array
    

    // dd($dataProduk);
    foreach ($dataProduk as $data) {
       
        
        $produkArray[] = [
        
            'nama_produk' => $data['nama_produk'],
            'qty_produk' => $data['qty_produk'],
            
        ];
    }

    // dd($produkArray);
    $jsonData = json_encode($produkArray);

    $package = new PackageIncome();
    $package->judul_paket = $request->judul_paket;
    $package->deskripsi_paket = $request->deskripsi_paket;
    $package->role_id = $request->role_id;
    $package->produk = $jsonData;

    $package->save();
    
    $request->session()->flash('success', 'A new Package has been created');
    return redirect(route('admin.package.index'))->with('success', 'Package has been created successfully!');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $package = PackageIncome::find($id); // Menggunakan find() untuk menghindari error jika tidak ditemukan
        
      

        $produk = Product::where('role_id', $package->role_id)->get(); // Assuming your model name is Product
        $produk = Product::all();
        $package->produk = json_decode($package->produk, true); // Decode the JSON data into an array
        $role = UserRole::all();
        $selectedRoleId = $package->role_id;

return view('admin.package.edit')->with([
    'package' => $package,
    'produk' => $produk,
    'role' => $role,
    'selectedRoleId' => $selectedRoleId,
]);

    }

    public function updatepackage(Request $request, $id){
        $dataProduk = $request->input('data_produk');
        $produkArray = []; // Initialize an empty array
        
        
       
        foreach ($dataProduk as $data) {
        
            
            $produkArray[] = [
                'nama_produk' => $data['nama_produk'],
                'qty_produk' => $data['qty_produk'],
            ];
        }
    
       
        $jsonData = json_encode($produkArray);
    
       
        $package = PackageIncome::findOrFail($id); // Find the package by ID
        $package->judul_paket = $request->judul_paket;
        $package->deskripsi_paket = $request->deskripsi_paket;
        $package->role_id = $request->role_id;
        $package->produk = $jsonData;
        // dd($package);
        $package->save();
        
        $request->session()->flash('success', 'Package has been updated');
        return redirect(route('admin.package.index'))->with('success', 'Package has been updated successfully!');
    
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

        $request->session()->flash('error', "{$package->judul_paket} has been deleted");

        return redirect(route('admin.package.index'))->with('sucess','user has been deleted!');
    }

   
   public function deleteproduk(Request $request, $id){
    $product = PackageIncome::find('produk');

    if (!$product) {
        return response()->json(['message' => 'Product not found.'], 404);
    }

    $product->delete();

    return response()->json(['message' => 'Product deleted successfully.']);
   }


    public function getProductsByRole($roleId)
    {
        $products = Product::findOrFail($roleId)->products;
        return response()->json($products);
    }

    

}
