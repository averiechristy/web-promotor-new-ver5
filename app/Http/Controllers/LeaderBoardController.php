<?php

namespace App\Http\Controllers;

use App\Models\LeaderBoard;
use App\Models\Product;
use DateTime;
use App\Models\User;
use App\Models\UserRole;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Protection;
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
        $header = ['No', 'Tanggal', 'Nama', 'Kode Sales']; // Menambahkan "Tanggal" di antara "No" dan "Nama"
    
        // Isi header produk dari $produk (jika perlu)
        foreach ($produk as $item) {
            $header[] = $item->nama_produk;
        }
    
        // Tambahkan header ke sheet
        $sheet->fromArray([$header]);
    
        // Mendapatkan kolom yang perlu dikunci (header)
        $headerColumnCount = count($header);
        $headerRange = 'A1:' . $sheet->getCellByColumnAndRow($headerColumnCount, 1)->getColumn() . '1';
    
      
        // Mengunci sel-sel header


        $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet->getDefaultStyle()->getProtection()->setLocked(false);
        $sheet->getStyle($headerRange)->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);

    
        // Buat response untuk file Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'data_leaderboard_template.xlsx';
    
        // Set Content-Security-Policy header untuk melarang modifikasi header oleh JavaScript
        header('Content-Security-Policy: default-src \'none\'; script-src \'self\'');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
    
        // Menambahkan validasi format "dd/mm/yyyy" untuk kolom "Tanggal"
    
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
            
            $validData = [];

            // Mulai dari baris kedua (indeks 1) karena baris pertama adalah header
            $errorDetails = array();

            for ($i = 1; $i < count($data); $i++) {
                $rowData = $data[$i];
                $rowNumber = $i + 1;
            
                $kodeSales = trim($rowData[3]); // Kolom 'Kode Sales'
                $importedName = trim($rowData[2]); 
            
                // Periksa apakah data dengan nama dan kode sales yang sama sudah ada pada hari yang sama
                $tanggalString = $rowData[1];
                
                $tanggalObj = DateTime::createFromFormat('d/m/Y', $tanggalString);
            
                if (!$tanggalObj) {
                    $errorDetails[] = "Kesalahan pada baris $rowNumber : Format tanggal tidak valid. Gunakan format 'dd/mm/yyyy'.";
                    continue;
                }
            
                list($day, $month, $year) = explode('/', $tanggalString);
                if (!checkdate($month, $day, $year)) {
                    $errorDetails[] = "Kesalahan pada baris $rowNumber : Tanggal tidak valid.";
                    continue;
                }
            
                $tanggal = $tanggalObj->format('Y-m-d');
                $rowData[1] = $tanggal;
            
                $tanggalSekarang = new DateTime();
                if ($tanggalObj > $tanggalSekarang) {
                    $errorDetails[] = "Kesalahan pada baris $rowNumber : Tanggal yang diinput belum berjalan.";
                    continue;
                }


                $existingData = LeaderBoard::where('nama', $importedName)
                ->where('kode_sales', $kodeSales)
                ->whereDate('tanggal', $tanggal)
                ->first();
        
            if ($existingData) {
                $errorDetails[] = "Kesalahan pada baris $rowNumber : Data dengan nama dan kode sales yang sama sudah ada pada tanggal yang sama.";
                continue;
            }
            
                $existingNames = User::pluck('nama')->toArray();
            
                $role_id = $request->input('role_id');
            
                $role = UserRole::find($role_id);
            
                if (!$role) {
                    $errorDetails[] = "Kesalahan pada baris $rowNumber: Role tidak ditemukan.";
                    continue;
                }
            
                $kodeRole = strtolower($role->kode_role);
            
                if (!in_array($importedName, $existingNames)) {
                    $errorDetails[] = "Kesalahan pada baris $rowNumber : Terdapat nama yang tidak sesuai dengan yang ada di database user.";
                    continue;
                }
            
                $user = User::where('username', $kodeSales)->first();
            
                if (!$user) {
                    $errorDetails[] = "Kesalahan pada baris $rowNumber: Kode Sales tidak sesuai dengan pengguna yang ada di database.";
                    continue;
                }
            
                $userRole = strtolower($user->role->kode_role);
            
                if ($kodeRole != $userRole) {
                    $errorDetails[] = "Peran yang Anda pilih tidak sesuai dengan peran yang dimiliki oleh pengguna ini.";
                    continue;
                }
            
                
            
                $pencapaian = [];
                $total = 0;
    
                for ($j = 4; $j < count($headerRow); $j++) {
                    $pencapaian[$headerRow[$j]] = $rowData[$j];
    
                    $namaProduk = $headerRow[$j]; // Nama produk dari header
                    $jumlah = $rowData[$j];
    
                    // Memeriksa apakah $jumlah adalah angka
                    if (!is_numeric($jumlah)) {
                        // Tangani kesalahan jika $jumlah bukan angka
                        $request->session()->flash('error', 'Jumlah produk harus berupa angka.');
                        return redirect(route('admin.leaderboard.index'))->withInput();
                    }
    
                    $jumlah = intval($jumlah); // Mengonversi ke integer setelah memastikan itu adalah angka
    
                    // Cek apakah nilai negatif
                    if ($jumlah < 0) {
                        // Tangani nilai negatif sesuai dengan kebutuhan Anda.
                        $request->session()->flash('error', 'Jumlah produk tidak boleh negatif.');
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
                }

                $rowData[0] = $maxNo + 1;
                $rowData['user_id'] = $user->id;
            
                $validData[] = $rowData;
            }
            
            if (!empty($errorDetails)) {
                $errorMessages = implode('<br>', $errorDetails);
                $request->session()->flash('error', $errorMessages);
                return redirect(route('admin.leaderboard.index'))->withInput();
            }

            foreach ($validData as $rowData) {

                $maxNo = LeaderBoard::max('no');
                // Lakukan semua perubahan yang diperlukan sebelum menyimpan data ke dalam database

                $rowData[0] = $maxNo + 1;
                // Simpan data ke dalam database
                $pencapaian = [];
                $total = 0;

                for ($j = 4; $j < count($headerRow); $j++) {
                    $pencapaian[$headerRow[$j]] = $rowData[$j];
    
                    $namaProduk = $headerRow[$j]; // Nama produk dari header
                    $jumlah = $rowData[$j];
    
                  
                    // Dapatkan poin produk dari tabel master produk
                    $product = Product::where('nama_produk', $namaProduk)->first();
    
                    
                    // Hitung total poin berdasarkan poin produk dan jumlah yang diisi
                    $total += $product->poin_produk * $jumlah;
                }

                if ($kodeRole == 'mr') {
                    if ($total < 72) {
                        $hasil = 3600000;
                    } else if ($total > 72 && $total < 120) {
                        $insentif = ($total - 72) * 40000;
                        $hasil = $insentif + 3600000;
                    } else if ($total == 72) {
                        $hasil = 3600000;
                    } elseif ($total == 120) {
                        $hasil = 6000000;
                    } elseif ($total > 120) {
                        $insentif = ($total - 120) * 40000;
                        $hasil = $insentif + 6000000;
                    }

                } elseif ($kodeRole == 'tm') {
                    $hasil = 0;
                } elseif ($kodeRole == 'ms') {
                    $hasil = 0;
                }
    
                // Tambahkan nilai total ke dalam array $rowData
                $rowData[] = $total;
                

                LeaderBoard::create([
                    'no' => $rowData[0], // Kolom 'No'
                    'role_id' => $request->input('role_id'), // Role ID yang dipilih sebelumnya
                    'user_id' => $rowData['user_id'], // Kolom 'user_id' (ID Pengguna)
                    'nama' => $rowData[2], // Kolom 'Nama'
                    'kode_sales' => $rowData[3],
                    'tanggal' => $tanggal, // Kolom 'Tanggal'
                    'income' => $hasil,
                    'pencapaian' => $pencapaian, // Kolom-kolom pencapaian dari header
                    'total' => $total, // Kolom 'Total' (ambil dari indeks terakhir)
                ]);
    
                // Increment nomor terbesar
                $maxNo++;
            }
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
    public function destroy(Request $request, $id)
    {
        $leaderboard = LeaderBoard::find($id);
        $leaderboard->delete();
 
        $request->session()->flash('error', 'Leaderboard berhasil dihapus.');
        return redirect(route('admin.leaderboard.index'))->withInput();
        }
}
