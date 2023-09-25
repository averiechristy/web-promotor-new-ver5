<?php

namespace App\Http\Controllers;

use App\Models\LeaderBoard;
use App\Models\Product;
use App\Models\User;
use App\Models\UserRole;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Request;

class LeaderBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */    
    public function index(Request $request)
    {
        // Mengambil semua data produk dan role untuk keperluan tampilan dropdown
        $produk = Product::all();
        $role = UserRole::all();
    
        // Mengambil data leaderboard berdasarkan role_id yang dipilih (jika ada)
    
        $leaderboardData = LeaderBoard::all();
    
        return view('admin.leaderboard.index', [
            'produk' => $produk,
            'role' => $role,
            'leaderboardData' => $leaderboardData, // Mengirim data leaderboard yang sesuai ke view
        ]);
    }
    

    public function exportExcel(Request $request)
{
    // Buat objek Spreadsheet
    $selectedRoleId = $request->input('role_id');

 // Ambil produk sesuai dengan role yang dipilih
  // Buat objek Spreadsheet
  $spreadsheet = new Spreadsheet();

  // Ambil sheet aktif
  $sheet = $spreadsheet->getActiveSheet();

  // Ambil produk sesuai dengan role yang dipilih
  $produk = Product::where('role_id', $selectedRoleId)->get();

    // Isi header tabel dari blade.php
    $header = ['No', 'Nama', 'Kode Sales'];

    // Isi header produk dari $produk (jika perlu)
    foreach ($produk as $item) {
        $header[] = $item->nama_produk;
    }

    $sheet->fromArray([$header]);

    // Tidak perlu mengisi data tabel

    // Buat response untuk file Excel
    $writer = new Xlsx($spreadsheet);
    $filename = 'data_leaderboard_template.Xlsx';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
}

public function importDataFromExcel(Request $request)
{
    $file = $request->file('file');

    try {
        $spreadsheet = IOFactory::load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        $data = $worksheet->toArray();
        
        // Mengambil baris header (baris pertama) untuk mendapatkan nama kolom
        $headerRow = $data[0];

        // Ambil nomor terbesar yang sudah ada di database
        $maxNo = LeaderBoard::max('no');

        // Mulai dari baris kedua (indeks 1) karena baris pertama adalah header
       // ...
// ...
// Ambil daftar nama yang ada di database
$existingNames = User::pluck('nama')->toArray();

for ($i = 1; $i < count($data); $i++) {
    $rowData = $data[$i];
    $kodeSales = $rowData[2]; // Kolom 'Kode Sales'

    $user = User::where('username', $kodeSales)->first();

    if (!$user) {
        // Tangani kesalahan jika kode sales tidak sesuai
        $request->session()->flash('error', 'Kode Sales tidak sesuai dengan pengguna yang ada di database.');
        return redirect(route('admin.leaderboard.index'))->withInput();
    }

    // Periksa apakah nama ada dalam daftar nama yang ada di database
    $importedName = $rowData[1]; // Kolom 'Nama' dari data yang diimpor

    if (!in_array($importedName, $existingNames)) {
        // Tangani kesalahan jika nama tidak sesuai
        $request->session()->flash('error', 'Terdapat nama yang tidak sesuai dengan yang ada di database user.');
        return redirect(route('admin.leaderboard.index'))->withInput();
    }

    // Inisialisasi array asosiatif untuk data pencapaian
    $pencapaian = [];

    // Inisialisasi total
    $total = 0;

for ($j = 3; $j < count($headerRow); $j++) {
    $pencapaian[$headerRow[$j]] = $rowData[$j];

    $namaProduk = $headerRow[$j]; // Nama produk dari header
    $jumlah = intval($rowData[$j]);

    // Cek apakah nilai negatif
    if ($jumlah < 0) {
        // Tangani nilai negatif sesuai dengan kebutuhan Anda.
        $request->session()->flash('error', 'Nilai tidak boleh negatif.');
        return redirect(route('admin.leaderboard.index'))->withInput();
    }

    // Dapatkan poin produk dari tabel master produk
    $product = Product::where('nama_produk', $namaProduk)->first();

    if (!$product) {
        // Tangani kesalahan jika produk tidak ditemukan
        $request->session()->flash('error', 'Produk tidak ditemukan dalam database.');
        return redirect(route('admin.leaderboard.index'))->withInput();
    }

    // Hitung total poin berdasarkan poin produk dan jumlah yang diisi
    $total += $product->poin_produk * $jumlah;
}

if ($total < 72) {
    $hasil = 3600000; 

} else if ($total >72 && $total < 120) {
    $insentif = ($total - 72) * 40000;
    $hasil = $insentif + 3600000;

} else if ($total == 72) {
    $hasil = 3600000;
    
}elseif ($total == 120) {
    $hasil = 6000000;

} elseif ($total > 120) {
    $insentif = ($total - 120) * 40000;
    $hasil = $insentif + 6000000;
        
}
    // Tambahkan nilai total ke dalam array $rowData
    $rowData[] = $total;

    // Tambahkan nomor terbesar yang sudah ada di database ke kolom 'no'
    $rowData[0] = $maxNo + 1;

    // Simpan user_id pada baris saat ini
    $rowData['user_id'] = $user->id;


    LeaderBoard::create([
        'no' => $rowData[0], // Kolom 'No'
        'role_id' => $request->input('role_id'), // Role ID yang dipilih sebelumnya
        'user_id' => $rowData['user_id'], // Kolom 'user_id' (ID Pengguna)
        'nama' => $rowData[1], // Kolom 'Nama'
        'income' => $hasil,
        'pencapaian' => $pencapaian, // Kolom-kolom pencapaian dari header
        'total' => $total, // Kolom 'Total' (ambil dari indeks terakhir)
    ]);

    // Increment nomor terbesar
    $maxNo++;
}




// Now you can dd($total) outside of the loop if you want to see the final total for each row
// dd($total);
// ...

// ...

        $request->session()->flash('success', 'Data berhasil diimport.');

        return redirect(route('admin.leaderboard.index'))->withInput();
    } catch (\Exception $e) {

        $request->session()->flash('error', 'Terjadi kesalahan.');

        // Notifikasi kesalahan dalam format JSON
        return redirect(route('admin.leaderboard.index'))->withInput();
    }
}

public function getLeaderboardData(Request $request)
{
    // Mendapatkan role_id dari permintaan POST
    $role_id = $request->input('role_id');

    // Mengambil data leaderboard sesuai dengan role_id menggunakan Eloquent
    $leaderboardData = LeaderBoard::where('role_id', $role_id)->get();
    

    // Mengembalikan data dalam format JSON
    return response()->json($leaderboardData);
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
