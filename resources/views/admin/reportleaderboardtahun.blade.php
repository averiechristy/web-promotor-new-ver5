
@extends('layouts.admin.app')

@section('content')


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 id="rankingTitle" class="h3 mb-2 text-gray-800">Peringkat penjualan sales tahun 2023</h1>

                  
<script>
  // Mengambil elemen h2 berdasarkan ID
  var h2Element = document.getElementById("rankingTitle");

  // Mendapatkan tahun saat ini
  var currentYear = new Date().getFullYear();

  // Mengganti teks tahun dalam elemen h2
  h2Element.innerHTML = h2Element.innerHTML.replace("2023", currentYear - 1);
</script>

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
    
    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        
                
                        <div class="card-body">

                        
                        <div class="card-body">
                        <button id="exportData" class="btn btn-success btn-sm mb-3" style="float:right;" onclick="exportTableToCSV('Data Leaderboard Tahun {{ \Carbon\Carbon::now()->subYears(1)->format('Y') }}.csv')">Download Data</button>



</div>

<script>
    // Fungsi untuk mengonversi data tabel ke format CSV
    function exportTableToCSV(filename) {
        var table = document.querySelector("table");
        var rows = table.querySelectorAll("tr");
        var csvData = [];

        for (var i = 0; i < rows.length; i++) {
            var row = [],
                cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++) {
                row.push(cols[j].textContent);
            }

            csvData.push(row.join(","));
        }

        var csvContent = "data:text/csv;charset=utf-8," + csvData.join("\n");
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", filename);
        link.style.display = "none";
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>

<script>
  // Mengambil elemen h2 berdasarkan ID
  var h2Element = document.getElementById("rankingTitle");

  // Mendapatkan tahun saat ini
  var currentYear = new Date().getFullYear();

  // Mengganti teks tahun dalam elemen h2
  h2Element.innerHTML = h2Element.innerHTML.replace("2023", currentYear - 1);
</script>


                        <!-- <div class="dataTables_length mb-3" id="myDataTable_length">
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

<div id="myDataTable_filter" class="dataTables_filter">
    <label for="search">Search
        <input id="search" placeholder>
    </label>
</div> -->

                            
                            <div class="table-responsive">
                            @include('components.alert')
                                <table  class="table table-bordered"  width="100%" cellspacing="0" >
                                    <thead>
                                        <tr>
                                           
                                        <tr>
        <th>Peringkat</th>
        <th>Nama</th>
        <th>Kode Sales</th>
        <th>Total</th>
    </tr>
                                          
                                        </tr>
                                    </thead>
                                    
                                    <tbody id="tableBody">
                                  
                     </tbody>
                      </table>

                      <!-- <div class="dataTables_info" id="dataTableInfo" role="status" aria-live="polite">
    Showing <span id="showingStart">1</span> to <span id="showingEnd">10</span> of <span id="totalEntries">0</span> entries
</div>
        
<div class="dataTables_paginate paging_simple_numbers" id="myDataTable_paginate">
    
    <a href="#" class="paginate_button" id="doublePrevButton" onclick="doublePreviousPage()"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a>
    <a href="#" class="paginate_button" id="prevButton" onclick="previousPage()"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
    <span>
        <a id="pageNumbers" aria-controls="myDataTable" role="link" aria-current="page" data-dt-idx="0" tabindex="0"></a>
    </span>
    <a href="#" class="paginate_button" id="nextButton" onclick="nextPage()"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
    <a href="#" class="paginate_button" id="doubleNextButton" onclick="doubleNextPage()"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
</div> -->
                      <nav aria-label="Page navigation example">
                    </nav>
                               

                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
           
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

   
    <style>

.dataTables_paginate{float:right;text-align:right;padding-top:.25em}
.paginate_button {box-sizing:border-box;
    display:inline-block;
    min-width:1.5em;
    padding:.5em 1em;
    margin-left:2px;
    text-align:center;
    text-decoration:none !important;
    cursor:pointer;color:inherit !important;
    border:1px solid transparent;
    border-radius:2px;
    background:transparent}

.dataTables_length{float:left}
.dataTables_wrapper 
.dataTables_length select{border:1px solid #aaa;border-radius:3px;padding:5px;background-color:transparent;color:inherit;padding:4px}
.dataTables_info{clear:both;float:left;padding-top:.755em}    
.dataTables_filter{float:right;text-align:right}
.dataTables_filter input{border:1px solid #aaa;border-radius:3px;padding:5px;background-color:transparent;color:inherit;margin-left:3px}


.btn-active {
    background-color: #007bff;
    color: #fff;
}

/* Styling for paginasi container */
.dataTables_paginate {
        text-align: center;
    }

    /* Styling for each paginasi button */
 
        /* Styling for paginasi container */
    .dataTables_paginate {
        text-align: center;
    }

    /* Styling for each paginasi button */
    .paginate_button {
        display: inline-block;
        margin: 5px;
        text-align: center;
        border: 1px solid #000; 
        padding: 5px 10px;
    }

    /* Media query for small screens */
    @media (max-width: 768px) {
        .paginate_button {
            padding: 3px 6px;
        }
    }

    /* Media query for extra small screens */
    @media (max-width: 576px) {
        .dataTables_paginate {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .paginate_button {
            padding: 2px 4px;
            margin: 2px;
            
        }
    }
        
    /* Media query for small screens */
    @media (max-width: 768px) {
        .paginate_button {
            padding: 3px 6px;
        }
    }

    /* Media query for extra small screens */
    @media (max-width: 576px) {
        .dataTables_paginate {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .paginate_button {
            padding: 2px 4px;
            margin: 2px;
        }
    }

</style>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.getElementById('role');
        const tableBody = document.getElementById('tableBody');
        const leaderboardData = @json($leaderboardData);
    

        // const rolepesan = document.getElementById('selectRoleMessage');

       

        roleSelect.addEventListener('change', function () {
            const selectedRoleId = roleSelect.value;
            const filteredLeaderboard = leaderboardData.filter(leader => leader.role_id == selectedRoleId);

            

            console.log(filteredLeaderboard);

            // Hapus isi tabel sebelum menambahkan data baru
            tableBody.innerHTML = '';

            // Tambahkan data baru ke tabel
            filteredLeaderboard.forEach((leader, index) => {
                const row = document.createElement('tr');
                if (index === 0) {
                    row.classList.add('leaderboard-first');
                } else if (index === 1) {
                    row.classList.add('leaderboard-second');
                } else if (index === 2) {
                    row.classList.add('leaderboard-third');
                }
                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${leader.nama}</td>
                    <td>${leader.kode_sales}</td>
                    <td>${leader.total_poin}</td>
                    
                `;
                tableBody.appendChild(row);
            });

            if (selectedRoleId === 'role_id') { // Ganti 'some_role_id' dengan ID role yang sesuai
            lihatSeluruhRankingButton.style.display = 'block';
            rolepesan.style.display ='none';
        } else {
            lihatSeluruhRankingButton.style.display = 'block';
            rolepesan.style.display ='none';
        }
        });

        // Format angka dengan pemisah ribuan
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    });
</script>


    @endsection


