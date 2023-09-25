<?php

use App\Http\Controllers\AksesController;
use App\Http\Controllers\ArtikelController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutocompleteController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\LeaderBoardController;
use App\Http\Controllers\UserController\HomeController;
use App\Http\Controllers\UserController\KalkulatorController;
use App\Http\Controllers\UserController\UserArtikelController;
use App\Http\Controllers\UserController\UserArtikelReadController;
use App\Http\Controllers\UserController\UserIncomeController;
use App\Http\Controllers\UserController\UserLeaderboardController;
use App\Http\Controllers\UserController\UserPaketController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
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
    return view('admin.changepassword');
})->name('admin.changepassword');

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
// Route::get('admin/akses/index', [AksesController::class, 'index'])->name('admin.akses.index');
// Route::get('admin/akses/create', [AksesController::class, 'create'])->name('admin.akses.create');
// Route::post('admin/akses/simpan', [AksesController::class, 'store'])->name('admin.akses.simpan');

// Route::get('/tampilakses/{id}',[AksesController::class,'tampilakses'])->name('tampilakses');
// Route::post('/updateakses/{id}',[AksesController::class,'updateakses'])->name('updateakses');


// Route::delete('/deleteakses/{id}', [AksesController::class, 'destroy'])->name('deleteakses');

Route::middleware('auth')->middleware('ensureUserRole:ADMIN')->group(function () {

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

Route::post('/restore-file-input', [ProductController::class,'restoreFileInput'])->name('restore-file-input');

Route::get('admin/leaderboard/index', [LeaderBoardController::class, 'index'])->name('admin.leaderboard.index');

Route::get('/export-excel', [LeaderBoardController::class,'exportExcel'])->name('export.excel');
Route::post('/import-excel', [LeaderBoardController::class,'importDataFromExcel'])->name('import.excel');
Route::post('/get-leaderboard-data',[ LeaderBoardController::class,'getLeaderboardData'])->name('get.leaderboard.data');



// Package Route

Route::get('admin/package/index', [PackageController::class, 'index'])->name('admin.package.index');
Route::get('admin/package/create', [PackageController::class, 'create'])->name('admin.package.create');
Route::post('admin/package/simpan', [PackageController::class, 'store'])->name('admin.package.simpan');

Route::get('/tampilpackage/{id}',[PackageController::class,'show'])->name('tampilpackage');
Route::post('/updatepackage/{id}',[PackageController::class,'updatepackage'])->name('updatepackage');
Route::get('/tampildetail/{id}',[PackageController::class,'tampildetail'])->name('tampildetail');


// routes/web.php
Route::get('/get-package-details/{packageId}', 'PackageController@getPackageDetails');


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

Route::get('/detailartikel/{id}',[ArtikelController::class,'detailartikel'])->name('detailartikel');



//Dashboard Route
Route::get('admin/dashboard/index', [DashboardController::class, 'index'])->name('admin.dashboard.index');

Route::get('/detailproduct/{id}',[ProductController::class,'detailproduct'])->name('detailproduct');


});

Route::get('getProduct/{id}', function ($id) {
    $produk = App\Models\Product::where('role_id',$id)->get();
    return response()->json($produk);
});

// routes/web.php
Route::get('/get-products/{role}', [PackageController::class, 'getProductsByRole']);
Route::resource('products', 'ProductController');


// // home route
Route::get('user/home', [HomeController::class, 'index'])->name('user.home')->middleware('ensureUserRole:USER');


//login route



// User Package

Route::middleware('auth')->middleware('ensureUserRole:USER')->group(function () {
    Route::get('user/package', [UserPaketController::class, 'index'])->name('user.package');
    Route::get('user/income/{id}', [UserPaketController::class, 'show'])->name('tampilincome');
});

// Kalkulator
Route::middleware('auth')->middleware('ensureUserRole:USER')->group(function () {
Route::get('user/kalkulator', [KalkulatorController::class,'index'])->name('user.kalkulator');
Route::post('/calculate', [KalkulatorController::class,'calculate'])->name('calculate');

Route::get('user/leaderboard', [UserLeaderboardController::class,'index'])->name('user.leaderboard');



});

Route::middleware('auth')->middleware('ensureUserRole:USER')->group(function () {


Route::get('user/income', [UserIncomeController::class, 'index'])->name('user.income')->middleware('ensureUserRole:USER');


// User Artikel
Route::get('user/artikel', [UserArtikelController::class, 'index'])->name('user.artikel');
Route::get('user/artikelread/{id}', [UserArtikelReadController::class, 'index'])->name('user.artikelread');

});

// Login
// routes/web.php
Route::get('/login', [AuthController::class,'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class,'login']);
Route::post('/logout', [AuthController::class,'logout'])->name('logout');


// routes/web.php
Route::middleware('auth')->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('ensureUserRole:ADMIN');
    Route::get('user/home', [HomeController::class, 'index'])->name('user.home')->middleware('ensureUserRole:USER');
});

// Change Password

Route::middleware('auth')->middleware('ensureUserRole:ADMIN')->group(function () {
    Route::get('admin/changepassword', [UserController::class,'showChangePasswordForm'])->name('password');
    Route::post('admin/changepassword', [UserController::class,'adminchangePassword'])->name('admin-change-password');
});

Route::middleware('auth')->middleware('ensureUserRole:USER')->group(function () {
    Route::get('user/changepassword', [UserController::class,'UserChangePasswordForm'])->name('password-change-user');
    Route::post('user/changepassword', [UserController::class,'changePassword'])->name('change-password');
});

Route::middleware('auth')->middleware('ensureUserRole:USER')->group(function () {
    Route::get('/profile/edit', [UserController::class,'editProfileForm'])->name('edit-profile');
    Route::post('/profile/update', [UserController::class,'updateProfile'])->name('update-profile');
    Route::post('/avatar/update',[ProfileController::class,'updateAvatar'])->name('update-avatar');
    Route::get('/profile/delete-photo', [ProfileController::class,'deletePhoto'])->name('profile.delete-photo');

});

Route::middleware('auth')->group(function (){
    Route::get('user/contact-us', [ContactController::class,'user'])->name('user.contact');

    Route::post('/contact-us', [ContactController::class,'store'])->name('contact.store');

// routes/web.php


Route::get('/contact-us', [ContactController::class,'index'])->name('admin.contact-us.index');
Route::get('/contact-us/{id}', [ContactController::class,'show'])->name('contact-us.show');
Route::post('/contact-us/mark-as-read/{id}', [ContactController::class,'markAsRead'])->name('contact-us.mark-as-read');
Route::delete('/contact-us/delete/{id}', [ContactController::class,'delete'])->name('contact-us.delete');


Route::post('user/contact-us', [KontakController::class,'store'])->name('contact.simpan');

 });

 Route::post('/user/{user}/reset-password', [UserController::class,'resetPassword'])->name('admin.reset-password')->middleware('ensureUserRole:ADMIN');







