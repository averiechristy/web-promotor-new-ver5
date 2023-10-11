@extends('layouts.admin.app')


@section('content')
<div class="container">

<h1 class="h3 mb-2 text-gray-800">Leaderboard Ranking</h1>
    <div class="form-group mb-4">
        <label for="" class="form-label">Kode Role</label>
        <select id="role" name="role_id" class="form-control {{ $errors->has('role_id') ? 'is-invalid' : '' }}" style="border-color: #01004C;" aria-label=".form-select-lg example" oninvalid="this.setCustomValidity('Pilih salah satu role')" oninput="setCustomValidity('')">
            <option value="" disabled selected>-- Pilih Kode Role--</option>
            @foreach ($role as $item)
                @if ($item->Akses->jenis_akses === 'User')
                <option value="{{ $item->id }}"{{ old('role_id') == $item->id ? 'selected' : '' }}> {{ $item->kode_role }} - {{$item->jenis_role}}</option>
                @endif
            @endforeach
        </select> 
        @if ($errors->has('role_id'))
            <p class="text-danger">{{ $errors->first('role_id') }}</p>
        @endif
    </div>
    
   

    <div class="row">
    <div class="container-fluid">
        
            <div class="card shadow mb-4">

            
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">


                
                    <h6 class="m-0 font-weight-bold text-primary">Leaderboard</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </a>
                    </div>
                </div>
                
                <!-- Card Body -->
                <div class="card-body">

                <div class="dataTables_length mb-3" id="myDataTable_length">
<label for="entries"> Show
<select id="entries" name="myDataTable_length" aria-controls="myDataTable"  onchange="changeEntries()" class>
<option value="10">10</option>
<option value="25">25</option>
<option value="50">50</option>
<option value="100">100</option>
</select>
entries
</label>
</div>


                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Nama</th>
                                    <th>Kode Sales</th>
                                    <th>Pendapatan</th>
                                    <th>Poin</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                              
                            </tbody>

                       
                        </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    

</div>

<style>
    .reward-item {
        border: 1px solid #e0e0e0;
        padding: 10px;
        margin-bottom: 20px;
        background-color: #f9f9f9;
    }

    .reward-title {
        font-weight: bold;
        color: #007bff;
    }

    .target-text {
        font-weight: bold;
    }

    .user-list {
        padding-left: 0;
        margin: 0; /* Menghilangkan margin */
    }

    .user-list li {
        list-style-type: none; /* Menghilangkan bullet points */
        margin-left: 0; /* Menghilangkan margin kiri pada elemen <li> */
    }

    .progress {
        height: 20px;
        margin-top: 10px;
    }

    .progress-bar {
        background-color: #007bff;
        color: #ffffff;
    }

    /* List item tanpa bullet point */
    ul {
        list-style: none;
        padding: 0;
    }

    li {
        margin-bottom: 10px;
    }

    .user-info {
        margin-bottom: 10px;
    }

    .user-name {
        font-weight: bold;
    }

    .progress {
        height: 20px;
        margin-top: 10px;
    }

    .progress-bar {
        background-color: #007bff;
        color: #fff;
    }

    /* CSS untuk pagination */
.pagination {float:right;text-align:right;padding-top:.25em}

.pagination button {
    box-sizing:border-box;display:inline-block;min-width:1.5em;padding:.5em 1em;margin-left:2px;text-align:center;text-decoration:none !important;cursor:pointer;color:inherit !important;border:1px solid transparent;border-radius:2px;background:transparent}



.pagination button:hover {
    color:white !important;border:1px solid #111;background-color:#111;background:-webkit-gradient(linear, left top, left bottom, color-stop(0%, #585858), color-stop(100%, #111));background:-webkit-linear-gradient(top, #585858 0%, #111 100%);background:-moz-linear-gradient(top, #585858 0%, #111 100%);background:-ms-linear-gradient(top, #585858 0%, #111 100%);background:-o-linear-gradient(top, #585858 0%, #111 100%);background:linear-gradient(to bottom, #585858 0%, #111 100%)}

.pagination button:disabled {
    background-color: #ccc;
    cursor: not-allowed;
}

</style>



<script>
document.addEventListener('DOMContentLoaded', function () {
    const roleSelect = document.getElementById('role');
    const tableBody = document.getElementById('tableBody');
    const entriesSelect = document.getElementById('entries');
    let leaderboardData = @json($leaderboardData);
    let itemsPerPage = parseInt(entriesSelect.value);
    let currentPage = 1;
    let totalItems = 0;
    let totalPages = 0;
    let filteredLeaderboard = [];

    roleSelect.addEventListener('change', function () {
        const selectedRoleId = roleSelect.value;
        filteredLeaderboard = leaderboardData.filter(leader => leader.role_id == selectedRoleId);
        totalItems = filteredLeaderboard.length;
        totalPages = Math.ceil(totalItems / itemsPerPage);
        currentPage = 1;
        
        // Hapus pagination yang ada sebelumnya
        removeExistingPagination();

        // Tampilkan paginasi
        displayPagination(totalPages);

        // Update tampilan tabel
        updateTable(currentPage);
    });

    entriesSelect.addEventListener('change', function () {
        itemsPerPage = parseInt(entriesSelect.value);
        totalPages = Math.ceil(totalItems / itemsPerPage);
        currentPage = 1;
        
        // Hapus pagination yang ada sebelumnya
        removeExistingPagination();

        // Tampilkan paginasi
        displayPagination(totalPages);

        // Update tampilan tabel
        updateTable(currentPage);
    });

    // Fungsi untuk menampilkan halaman tabel
    function updateTable(page) {
        tableBody.innerHTML = '';

        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = Math.min(startIndex + itemsPerPage, totalItems);

        for (let i = startIndex; i < endIndex; i++) {
            const leader = filteredLeaderboard[i];
            const row = document.createElement('tr');
            if (i === 0) {
                row.classList.add('leaderboard-first');
            } else if (i === 1) {
                row.classList.add('leaderboard-second');
            } else if (i === 2) {
                row.classList.add('leaderboard-third');
            }
            row.innerHTML = `
                <td>${i + 1}</td>
                <td>${leader.nama}</td>
                <td>${leader.kode_sales}</td>
                <td>Rp. ${numberWithCommas(leader.income)},-</td>
                <td>${leader.total}</td>
            `;
            tableBody.appendChild(row);
        }
    }

    // Fungsi untuk menampilkan paginasi
    function displayPagination(totalPages) {
        const paginationContainer = document.createElement('div');
        paginationContainer.classList.add('pagination');
        const prevButton = document.createElement('button');
        prevButton.innerHTML = '<i class="fas fa-arrow-left"></i>';
        prevButton.classList.add('pagination-button');
        prevButton.disabled = true;

        prevButton.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                updateTable(currentPage);
                updatePaginationButtons();
            }
        });

        paginationContainer.appendChild(prevButton);

        for (let i = 1; i <= totalPages; i++) {
            const pageButton = document.createElement('button');
            pageButton.textContent = i;
            pageButton.addEventListener('click', () => {
                currentPage = i;
                updateTable(currentPage);
                updatePaginationButtons();
            });
            paginationContainer.appendChild(pageButton);
        }

        const nextButton = document.createElement('button');
        nextButton.innerHTML = '<i class="fas fa-arrow-right"></i>';
        nextButton.classList.add('pagination-button');

        nextButton.addEventListener('click', () => {
            if (currentPage < totalPages) {
                currentPage++;
                updateTable(currentPage);
                updatePaginationButtons();
            }
        });

        paginationContainer.appendChild(nextButton);

        document.querySelector('.card-body').appendChild(paginationContainer);

        // Fungsi untuk mengatur status tombol Previous dan Next
        function updatePaginationButtons() {
            prevButton.disabled = currentPage === 1;
            nextButton.disabled = currentPage === totalPages;
        }

        // Inisialisasi tampilan awal
        updatePaginationButtons();
    }

    // Fungsi untuk menghapus pagination yang sudah ada
    function removeExistingPagination() {
        const existingPagination = document.querySelector('.pagination');
        if (existingPagination) {
            existingPagination.remove();
        }
    }

    // Format angka dengan pemisah ribuan
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
});
</script>






@endsection
