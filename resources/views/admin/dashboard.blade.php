@extends('layouts.admin.app')


@section('content')
<div class="container">
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
    
    <div id="selectRoleMessage" class="alert alert-warning mt-3">
    Silakan memilih peran terlebih dahulu untuk melihat data.
</div>

    <div class="row">
        <div class="col-xl-8 col-lg-7">
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
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Peringkat</th>
                                    <th>Nama</th>
                                    <th>Kode Sales</th>
                                    <th>Poin</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                              
                            </tbody>
                        </table>

                        <div id="lihatSeluruhRanking" class="more-leaderboard">

                        
  <button id="lihatSeluruhRangking" class="btn btn-link center-text"> Lihat seluruh peringkat </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
        
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Reward Sedang Berjalan</h6>
        </div>
       
        <div class="card-body">
    <div id="rewardList" class="text-center small">
        <ul id="rewardItems"></ul>
        <div id="paginationButtons">

        </div>
    </div>
    
    <div class="text-center">
      
            <div id="historyButton">
        <button class="btn btn-sm btn-link" id="historyButton">Lihat History Reward</button>
        </div>
        
    </div>

</div>

      
    </div>
</div>


</div>

<style>

.text-center {
    text-align: center;
    margin-top: 20px; /* Untuk memberi jarak dari elemen di atasnya */
}

.pagination-button {box-sizing:border-box;
    display:inline-block;
    min-width:1.5em;
    padding:.5em 1em;
    margin-left:2px;
    text-align:center;
    text-decoration:none !important;
    cursor:pointer;color:inherit !important;
    border:1px solid transparent;
    border-radius:2px;
    background:transparent;

    display: inline-block;
    margin: 5px;
    text-align: center;
    border: 1px solid #000;
    padding: 5px 10px;}

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
    
    .reward-item {
        
    font-weight: bold;
  white-space: nowrap;
  overflow: hidden;
  font-family: Nunito;
  text-overflow: ellipsis;
  max-width: 100%; /* Atur lebar maksimum yang Anda inginkan */
  cursor: pointer;   
    }

    .reward-item:hover {
        white-space: normal;
  max-width: none;
    }

</style>

<script>
    let filteredRewards = []; 
 document.addEventListener('DOMContentLoaded', function () {
    const roleSelect = document.getElementById('role');
    const rewardList = document.getElementById('rewardItems');
    const rewardsData = @json($activeRewards);
//     const historyButton = document.getElementById('historyButton');
//   historyButton.style.display = 'none';



//   function navigateToHistoryReward(roleId) {
//             // Ganti 'route_name' dengan nama rute yang sesuai
//             window.location.href = `/admin/adminhistoryreward/${roleId}`;
//         }

//         historyButton.addEventListener('click', function () {
//             const selectedRoleId = roleSelect.value;
//             if (selectedRoleId !== 'role_id') { // Ganti 'role_id' dengan ID peran yang sesuai
//                 navigateToHistoryReward(selectedRoleId);
//             }
//         });
    
    
    const usersReached50PercentData = @json($usersReached50Percent);
    const itemsPerPage = 3;
    let currentPage = 1;

    roleSelect.addEventListener('change', function () {
        const selectedRoleId = roleSelect.value;
    filteredRewards = filterRewardsByRole(rewardsData, selectedRoleId); // Perbarui filteredRewards
    currentPage = 1; // Kembali ke halaman pertama saat peran berubah
    rewardList.innerHTML = ''; // Hapus isi daftar reward
    renderRewardsWithPagination(filteredRewards, currentPage, itemsPerPage);


    historyButton.style.display = 'block';

    });

    function renderRewardsWithPagination(rewards, page, itemsPerPage) {
        const startIndex = (page - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const paginatedRewards = rewards.slice(startIndex, endIndex);

    // Hapus isi daftar reward sebelum menambahkan data baru
    rewardList.innerHTML = '';

        paginatedRewards.forEach(reward => {
            const rewardItem = document.createElement('li');
            rewardItem.innerHTML = `
                <div class="reward-item">
                    <span class="reward-title">${reward.judul_reward}</span>
                    <br>
                    
                    <ul class="user-list">
                        ${getUserListHTML(usersReached50PercentData[reward.id])}
                    </ul>
                    <a href="#" class="view-detail" data-reward-id="${reward.id}">
                        <button class="btn btn-link center-text" style="font-size:10pt;">Lihat Detail</button>
                    </a>
                </div>
            `;
            rewardList.appendChild(rewardItem);
            
            const viewDetailButton = rewardItem.querySelector('.view-detail');
            viewDetailButton.addEventListener('click', function (event) {
                event.preventDefault();
                const rewardId = viewDetailButton.getAttribute('data-reward-id');
                // Panggil fungsi untuk menampilkan detail reward
                showRewardDetail(rewardId);
            });
        });

        // Buat tombol-tombol paginasi
        const totalPages = Math.ceil(rewards.length / itemsPerPage);
    renderPaginationButtons(totalPages);
    }

    function renderPaginationButtons(totalPages) {
        
    const paginationButtons = document.getElementById('paginationButtons');
    paginationButtons.innerHTML = '';


    const totalPagesToShow = 3; // Jumlah halaman yang ingin ditampilkan (1-3)
    const startPage = Math.max(1, currentPage - 1); // Mulai dari halaman saat ini atau minimal 1
    const endPage = Math.min(startPage + totalPagesToShow - 1, totalPages); // Akhiran halaman yang ditampilkan

    // Tombol Double Previous
const doublePrevButton = document.createElement('button');
doublePrevButton.innerHTML = '<i class="fas fa-angle-double-left"></i>';
doublePrevButton.classList.add( 'mr-2', 'pagination-button');
doublePrevButton.addEventListener('click', function () {
    if (currentPage > 1) {
        currentPage = 1;
        renderRewardsWithPagination(filteredRewards, currentPage, itemsPerPage);
    }
});

// Tombol Previous
const prevButton = document.createElement('button');
prevButton.innerHTML = '<i class="fas fa-angle-left"></i>';
prevButton.classList.add( 'mr-2', 'pagination-button');
prevButton.addEventListener('click', function () {
    if (currentPage > 1) {
        currentPage--;
        renderRewardsWithPagination(filteredRewards, currentPage, itemsPerPage);
    }
});

// Tombol Next
   const nextButton = document.createElement('button');
    nextButton.innerHTML = '<i class="fas fa-angle-right"></i>';
    nextButton.classList.add('mr-2', 'pagination-button');
    nextButton.addEventListener('click', function () {
        if (currentPage < totalPages) {
            currentPage++;
            renderRewardsWithPagination(filteredRewards, currentPage, itemsPerPage);
        }
        // Cek apakah tombol "Next" telah mencapai batas halaman 3, jika ya, tampilkan angka 1-3 lagi
        if (currentPage >= totalPages - 2) {
            renderPaginationButtons(totalPages);
        }
    });


// Tombol Double Next
const doubleNextButton = document.createElement('button');
doubleNextButton.innerHTML = '<i class="fas fa-angle-double-right"></i>';
doubleNextButton.classList.add( 'mr-2', 'pagination-button');
doubleNextButton.addEventListener('click', function () {
    if (currentPage < totalPages) {
        currentPage = totalPages;
        renderRewardsWithPagination(filteredRewards, currentPage, itemsPerPage);
    }
});


    paginationButtons.appendChild(doublePrevButton);
    paginationButtons.appendChild(prevButton);

    for (let i = startPage; i <= endPage; i++) {
        const button = document.createElement('button');
        button.textContent = i;
        button.classList.add('btn', 'btn-primary', 'mr-1', 'ml-1', 'btn-sm');
        button.style.fontSize = '10pt';
        if (i === currentPage) {
            button.classList.add('active');
        }

        button.addEventListener('click', function () {
            currentPage = i;
            renderRewardsWithPagination(filteredRewards, currentPage, itemsPerPage);
        });

        paginationButtons.appendChild(button);
    }


    paginationButtons.appendChild(nextButton);
    paginationButtons.appendChild(doubleNextButton);

}

    function showRewardDetail(rewardId) {
        // Ganti 'route_name' dengan nama rute yang sesuai untuk menampilkan detail reward
        window.location.href = `/admin/allreward/${rewardId}`;
    }

    // Fungsi untuk mengambil reward berdasarkan peran yang dipilih
    function filterRewardsByRole(rewards, roleId) {
        return rewards.filter(reward => reward.role_id == roleId);
    }

    // Fungsi untuk menghasilkan HTML daftar pengguna yang mencapai target
    function getUserListHTML(users) {
        let userListHTML = '';
        const totalUsers = Object.keys(users).length;

        userListHTML += `
            <div class="user-info">
                <span class="user-name">Total Pengguna yang Mencapai 50% </span> <br>
                <span style="color:#01004C; font-size:20pt; font-weight: bold;">${totalUsers} </span>
            </div>
        `;
        return userListHTML;
        
    }
});

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.getElementById('role');
        const tableBody = document.getElementById('tableBody');
        const leaderboardData = @json($leaderboardData);
        const lihatSeluruhRankingButton = document.getElementById('lihatSeluruhRanking');
        lihatSeluruhRankingButton.style.display = 'none';

        const rolepesan = document.getElementById('selectRoleMessage');

        function navigateToAllRankPage(roleId) {
            // Ganti 'route_name' dengan nama rute yang sesuai
            window.location.href = `/admin/allrank/${roleId}`;
        }

        lihatSeluruhRankingButton.addEventListener('click', function () {
            const selectedRoleId = roleSelect.value;
            if (selectedRoleId !== 'role_id') { // Ganti 'role_id' dengan ID peran yang sesuai
                navigateToAllRankPage(selectedRoleId);
            }
        });


        roleSelect.addEventListener('change', function () {
            const selectedRoleId = roleSelect.value;
            const filteredLeaderboard = leaderboardData.filter(leader => leader.role_id == selectedRoleId);

            
            const sortedLeaderboard = filteredLeaderboard.slice(0, 10); // Ambil 10 besar

            console.log(filteredLeaderboard);

            // Hapus isi tabel sebelum menambahkan data baru
            tableBody.innerHTML = '';

            // Tambahkan data baru ke tabel
            sortedLeaderboard.forEach((leader, index) => {
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