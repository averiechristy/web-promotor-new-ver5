@extends('layouts.admin.app')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Leaderboard</h1>
    <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data">
    @csrf 
    <div class="form-group">
        <label for="role">Kode Role</label>
        <select name="role_id" id="role" class="form-control {{$errors->has('role_id') ? 'is-invalid' : ''}}"
            style="border-color: #01004C;" oninvalid="this.setCustomValidity('Pilih salah satu kode role')"
            oninput="setCustomValidity('')">
            <option value="" disabled selected>Pilih Kode Role</option>
            <!-- Hidden option -->
            @php
            $selectedRoleIds = []; // Array untuk menyimpan role_id yang telah ditambahkan
            @endphp

            @foreach ($produk as $item)
            @if (!in_array($item->role_id, $selectedRoleIds))
            @php
            $selectedRoleIds[] = $item->role_id;
            @endphp

            <option value="{{ $item->role_id }}" {{ old('role_id') == $item->role_id ? 'selected' : '' }}>
                {{ $item->Role->kode_role }} - {{ $item->Role->jenis_role }}
            </option>
            
            @endif
            @endforeach

        </select>
    </div>

    <!-- Pesan "Pilih salah satu kode role" -->
    <div id="selectRoleMessage" class="text-danger" style="display: block;">Pilih kode role terlebih dahulu</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
<!-- Tombol Download Template -->
<a href="{{ route('export.excel') }}" class="btn btn-warning btn-sm" id="downloadTemplateBtn" style="display: none;">Download Template</a>
<!-- Ini adalah token CSRF untuk melindungi formulir dari serangan Cross-Site Request Forgery -->

<div class="mb-3 mt-3">
@include('components.alert')

<input class="form" id="formFileSm" type="file" name="file" style="display: none;" required accept=".xls, .xlsx">

</div>

<button type="submit" class="btn btn-primary btn-sm" style="display: none;">Import Data</button>
</form>

    </div>

    <div class="card-body">

    <!-- Tabel -->
    <div class="table-responsive" id="tableContainer" style="display: none;">
        <table id="myDataTable" class="table table-bordered" width="100%" cellspacing="0" style="border-radius: 10px;">
        <thead>
            
        <div style="display: flex; align-items: center;">
        <div class="form-group" style="margin-right: 10px;">
            <label for="start_date">Tanggal Mulai</label>
            <input type="date" id="start_date" name="start_date" class="form-control" >
        </div>

        <div class="form-group" style="margin-right: 10px;">
            <label for="end_date">Tanggal Akhir</label>
            <input type="date" id="end_date" name="end_date" class="form-control" >
        </div>

        <button type="button" class="btn btn-success btn-sm mt-3" onclick="filterData()">Filter Data</button>
    </div>

            
            <tr>
                <th>Role</th>
                <th>Nama</th>
                <th>Kode Sales</th>
                <th>Pencapaian Penjualan Produk</th>
                <th>Total Poin</th>
                <th>Income</th>
                <th>Tanggal</th>
                <th>Action</th>
                <!-- Kolom lainnya -->
            </tr>
        </thead>

      <!-- Di dalam file Blade Anda -->
    <tbody id="tableBody">
    @php
    $roleCounter = []; // Array untuk menyimpan nomor urut berdasarkan peran
    @endphp
    @foreach ($leaderboardData as $item)
    @php
    $role_id = $item->role_id;

    // Inisialisasi nomor urut untuk peran jika belum ada
    if (!isset($roleCounter[$role_id])) {
        $roleCounter[$role_id] = 1;
    }

    // Ambil nomor urut untuk peran dan kemudian tambahkan satu
    $roleNumber = $roleCounter[$role_id]++;
    @endphp
    <tr data-role="{{ $item->role_id }}">
        <!-- <td>{{ $roleNumber  }}</td> Nomor urutan -->
        <td>{{ $item->Role->jenis_role }}</td> <!-- Kolom Role -->
        <td>{{ $item->nama }}</td> <!-- Kolom Nama -->
        <td>{{ $item->User->username }}</td> <!-- Kolom Role -->
        <td><ul>
    @foreach ($item->pencapaian as $key => $value)
        <li>{{ $key }} : {{ $value }}</li>
    @endforeach
</ul>
</td>      

        <td>{{ $item->total }} poin</td>
    <?php
    $formattedHasil = 'Rp. ' . number_format($item->income, 0, ',', '.') . ',-';
    ?>
        <td>{{ $formattedHasil}} </td>
        <td>{{ date('d-m-Y', strtotime($item->tanggal)) }}</td>
        <td>
            <form method="POST" action="{{ route('deleteleaderboard', $item->id) }}">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn show_confirm" data-toggle="tooltip" title='Hapus'><i class="fas fa-fw fa-trash" style="color:red" ></i></button>
                        </form> </td>
        <!-- Kolom lainnya -->

    </tr>
    @endforeach
</tbody>
        </table>
    </div>
</div>
</div>

<!-- Modal Import -->
<!-- Modal Import -->
<script>
    // Fungsi ini akan dipanggil saat pilihan peran berubah

    function filterData() {
    var startDate = document.getElementById('start_date').value;
    var endDate = document.getElementById('end_date').value;
    var selectedRole = document.getElementById('role').value; // Ambil peran yang dipilih

    // Ambil semua baris data dalam tbody
    var allRows = document.querySelectorAll('#tableBody tr');

    // Loop melalui semua baris data dan tampilkan hanya yang sesuai dengan tanggal dan peran yang dipilih
    allRows.forEach(function (row) {
        var createdAt = row.querySelector('td:last-child').textContent; // Ambil nilai kolom "Created At"
        var role = row.getAttribute('data-role'); // Ambil peran dari atribut data-role

        // Format tanggal dari kolom "Created At" ke format "YYYY-MM-DD"
        var createdDate = new Date(createdAt).toISOString().split('T')[0];

        if ((startDate <= createdDate && createdDate <= endDate) && (selectedRole === '' || selectedRole === role)) {
            row.style.display = 'table-row'; // Tampilkan baris data yang sesuai
        } else {
            row.style.display = 'none'; // Sembunyikan baris data yang tidak sesuai
        }
    });
}


    function onRoleChange() {
    var roleSelect = document.getElementById('role');
    var selectedRole = roleSelect.options[roleSelect.selectedIndex].value;
    var downloadLink = "{{ route('export.excel') }}?role_id=" + selectedRole;

    // Sembunyikan semua baris data dalam tbody
    var allRows = document.querySelectorAll('#tableBody tr');
    allRows.forEach(function (row) {
        row.style.display = 'none';
    });

    if (selectedRole !== "") {
        // Sembunyikan pesan "Pilih Kode Role"
        document.getElementById('selectRoleMessage').style.display = 'none';

        // Tampilkan tabel
        document.getElementById('tableContainer').style.display = 'block';

        // Tampilkan baris data sesuai dengan peran yang dipilih
        var selectedRoleRows = document.querySelectorAll('#tableBody tr[data-role="' + selectedRole + '"]');
        selectedRoleRows.forEach(function (row) {
            row.style.display = 'table-row';
        });

        // Menampilkan tombol "Import Data"
        var importDataBtn = document.querySelector('.btn-primary.btn-sm');
        importDataBtn.style.display = 'inline-block';

        var downloadTemplateBtn = document.querySelector('.btn-warning.btn-sm');
        downloadTemplateBtn.style.display = 'inline-block';
        downloadTemplateBtn.href = downloadLink;

        var importFile = document.querySelector('.form');
        importFile.style.display = 'inline-block';
    } else {
        // Tampilkan pesan "Pilih Kode Role" jika tidak ada peran yang dipilih
        document.getElementById('selectRoleMessage').style.display = 'block';

        // Sembunyikan tabel
        document.getElementById('tableContainer').style.display = 'none';

        // Sembunyikan tombol "Import Data"
        var importDataBtn = document.querySelector('.btn-primary.btn-sm');
        importDataBtn.style.display = 'none';

        var downloadTemplateBtn = document.querySelector('.btn-warning.btn-sm');
        downloadTemplateBtn.style.display = 'none';

        var importFile = document.querySelector('.form');
        importFile.style.display = 'none';
    }
}


    // Panggil onRoleChange saat halaman dimuat ulang
    window.onload = onRoleChange;
    
    // Panggil onRoleChange saat elemen select dengan id 'role' berubah
    document.getElementById('role').addEventListener('change', onRoleChange);
</script>


@endsection
