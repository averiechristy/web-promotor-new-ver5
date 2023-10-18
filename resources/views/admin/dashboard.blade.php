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

                        <a href="{{route('admin.allrank.index')}}">
  <button id="allrank" class="btn btn-link center-text"> Lihat seluruh peringkat </button>
</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Reward</h6>
            
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div  id="rewardData" class="mt-4 text-center small">
                <ul  id="rewardList">
                  
                </ul>
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
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.getElementById('role');
        const rewardList = document.getElementById('rewardList');
        const rewardsData = @json($activeRewards);
        const usersReached50PercentData = @json($usersReached50Percent);
        

        roleSelect.addEventListener('change', function () {
            const selectedRoleId = roleSelect.value;
            const filteredRewards = filterRewardsByRole(rewardsData, selectedRoleId);

            // Hapus isi daftar reward sebelum menambahkan data baru
            rewardList.innerHTML = '';

            // Tambahkan data reward baru ke daftar reward
            filteredRewards.forEach(reward => {
                const rewardItem = document.createElement('li');
                rewardItem.innerHTML = `
                    <div class="reward-item">
                        <span class="reward-title">Reward: ${reward.judul_reward}</span>
                        <br>
                        
                        <ul class="user-list">
                            ${getUserListHTML(usersReached50PercentData[reward.id])}
                        </ul>
                    </div>

                    
                `;
                rewardList.appendChild(rewardItem);
            });
        });

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
            <a href="#" id="allrank">
            <button class="btn btn-link center-text" style="font-size:10pt;">Lihat detail</button>
        </a>
        
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


        roleSelect.addEventListener('change', function () {
            const selectedRoleId = roleSelect.value;
            const filteredLeaderboard = leaderboardData.filter(leader => leader.role_id == selectedRoleId);
            const sortedLeaderboard = filteredLeaderboard.slice(0, 10); // Ambil 10 besar

            console.log(sortedLeaderboard);

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
                    <td>${leader.total}</td>
                    
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
