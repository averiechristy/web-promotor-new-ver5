<?php

use App\Http\Controllers\AksesController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AutocompleteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/login', function () {
//     return view('login');
// });

Route::get('/admin/dashboard', function () {
    return view('admin/dashboard');
});

Route::get('/admin/userrole/index', function () {
    return view('/admin/userrole/index');
});

Route::get('/admin/userrole/create', function () {
    return view('/admin/userrole/create');
});


Route::get('/admin/useraccount/index', function () {
    return view('/admin/useraccount/index');
});

Route::get('/admin/useraccount/create', function () {
    return view('/admin/useraccount/create');
});


Route::get('/admin/product/index', function () {
    return view('/admin/product/index');
});

Route::get('/admin/product/create', function () {
    return view('/admin/product/create');
});

Route::get('/admin/package/index', function () {
    return view('/admin/package/index');
});

Route::get('/admin/package/create', function () {
    return view('/admin/package/create');
});


Route::get('/admin/artikel/index', function () {
    return view('/admin/artikel/index');
});

Route::get('/admin/artikel/create', function () {
    return view('/admin/artikel/');
});

Route::get('/admin/changepassword', function () {
    return view('/admin/changepassword');
});

Route::get('/user/home', function () {
    return view('/user/home');
});

Route::get('/user/artikel', function () {
    return view('/user/artikel');
});

Route::get('/user/artikelread', function () {
    return view('/user/artikelread');
});

Route::get('/user/kalkulator', function () {
    return view('/user/kalkulator');
});

Route::get('/user/package', function () {
    return view('/user/package');
});


Route::get('/user/changepassword', function () {
    return view('/user/changepassword');
});

Route::get('/user/editprofil', function () {
    return view('/user/editprofil');
});

Route::get('/user/income', function () {
    return view('/user/income');
});



//akses route
Route::get('admin/akses/index', [AksesController::class, 'index'])->name('admin.akses.index');
Route::get('admin/akses/create', [AksesController::class, 'create'])->name('admin.akses.create');
Route::post('admin/akses/simpan', [AksesController::class, 'store'])->name('admin.akses.simpan');

Route::get('/tampilakses/{id}',[AksesController::class,'tampilakses'])->name('tampilakses');
Route::post('/updateakses/{id}',[AksesController::class,'updateakses'])->name('updateakses');


Route::delete('/deleteakses/{id}', [AksesController::class, 'destroy'])->name('deleteakses');


// user role route
Route::get('admin/userrole/index', [UserRoleController::class, 'index'])->name('admin.userrole.index');
Route::get('admin/userrole/create', [UserRoleController::class, 'create'])->name('admin.userrole.create');
Route::post('admin/userrole/simpan', [UserRoleController::class, 'store'])->name('admin.userrole.simpan');

Route::get('/tampildata/{id}', [UserRoleController::class, 'tampildata'])->name('tampildata');
Route::post('/updatedata/{id}', [UserRoleController::class, 'updatedata'])->name('updatedata');
Route::delete('/delete/{id}', [UserRoleController::class, 'destroy'])->name('delete');


// user account route
Route::get('admin/useraccount/index', [UserController::class, 'index'])->name('admin.useraccount.index');
Route::get('admin/useraccount/create', [UserController::class, 'create'])->name('admin.useraccount.create');
Route::post('admin/useraccount/simpan', [UserController::class, 'store'])->name('admin.useraccount.simpan');

Route::get('/tampiluser/{id}',[UserController::class,'tampiluser'])->name('tampiluser');
Route::post('/updateuser/{id}',[UserController::class,'updateuser'])->name('updateuser');
Route::delete('/deleteuser/{id}', [UserController::class, 'destroy'])->name('deleteuser');



// Product Route
Route::get('admin/product/index', [ProductController::class, 'index'])->name('admin.product.index');
Route::get('admin/product/create', [ProductController::class, 'create'])->name('admin.product.create');
Route::post('admin/product/simpan', [ProductController::class, 'store'])->name('admin.product.simpan');

Route::get('/tampilproduct/{id}',[ProductController::class,'tampilproduct'])->name('tampilproduct');
Route::post('/updateproduct/{id}',[ProductController::class,'updateproduct'])->name('updateproduct');
Route::delete('/deleteproduct/{id}', [ProductController::class, 'destroy'])->name('deleteproduct');



// Package Route

Route::get('admin/package/index', [PackageController::class, 'index'])->name('admin.package.index');
Route::get('admin/package/create', [PackageController::class, 'create'])->name('admin.package.create');
Route::post('admin/package/simpan', [PackageController::class, 'store'])->name('admin.package.simpan');

Route::get('/tampilpackage/{id}',[PackageController::class,'show'])->name('tampilpackage');
Route::post('/updatepackage/{id}',[PackageController::class,'updatepackage'])->name('updatepackage');


Route::get('admin/package/cobacreate', [PackageController::class, 'create'])->name('admin.package.createcopy');

Route::delete('/deletepackage/{id}', [PackageController::class, 'destroy'])->name('deletepackage');

Route::delete('/admin/package/delete-product', [PackageController::class,'deleteProduct'])->name('admin.package.deleteProduct');

// Artikel Route
Route::get('admin/artikel/index', [ArtikelController::class, 'index'])->name('admin.artikel.index');
Route::get('admin/artikel/create', [ArtikelController::class, 'create'])->name('admin.artikel.create');
Route::post('admin/artikel/simpan', [ArtikelController::class, 'store'])->name('admin.artikel.simpan');

Route::get('/tampilartikel/{id}',[ArtikelController::class,'show'])->name('tampilartikel');
Route::post('/updateartikel/{id}',[ArtikelController::class,'updateartikel'])->name('updateartikel');
Route::delete('/deleteartikel/{id}', [ArtikelController::class, 'destroy'])->name('deleteartikel');




//Dashboard Route
Route::get('admin/dashboard/index', [PackageController::class, 'index'])->name('admin.dashboard.index');


Route::get('getProduct/{id}', function ($id) {
    $produk = App\Models\Product::where('role_id',$id)->get();
    return response()->json($produk);
});

// routes/web.php
Route::get('/get-products/{role}', [PackageController::class, 'getProductsByRole']);
Route::resource('products', 'ProductController');


// // home route
Route::get('user/home', [HomeController::class, 'index'])->name('user.home');


//Login Route

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login']);

// ...





// // login
// Route::get('/login',[LoginController::class, 'index'])->name('login')->middleware('guest');
// Route::post('/login/auth',[LoginController::class, 'authenticate'])->name('login.auth');


// // dashboard admin route
// Route::get('admin/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
