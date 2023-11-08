@extends('layouts.admin.app')
@section('content')

<div class="container">
    <h4 class="mb-4">History Reward</h4>
    <div class="form-group mb-4">
        <label for="" class="form-label">Kode Role</label>
        <select id="role" name="role_id" class="form-control {{ $errors->has('role_id') ? 'is-invalid' : '' }}" style="border-color: #01004C;" aria-label=".form-select-lg example" oninvalid="this.setCustomValidity('Pilih salah satu role')" oninput="setCustomValidity('')">
            <option value="" disabled selected>-- Pilih Kode Role--</option>
            @foreach ($role as $item)
                @if ($item->Akses->jenis_akses === 'User')
                <option value="{{ $item->id }}" {{ old('role_id') == $item->id ? 'selected' : '' }}> {{ $item->kode_role }} - {{$item->jenis_role}}</option>
                @endif
            @endforeach
        </select>
        @if ($errors->has('role_id'))
            <p class="text-danger">{{ $errors->first('role_id') }}</p>
        @endif
    </div>
    <div class="row" id="reward-container">
        @foreach ($rewards as $reward)
        <div class="col-md-4 reward-card role-{{ $reward->role_id }} d-none">
                <div class="card mb-4">
                    <div class="card-body">
                        <!-- Tampilkan detail reward -->
                        <h5 class="card-title">{{ $reward->judul_reward }}</h5>
                        <hr>
                        <!-- Display the total number of users who reached 100% for this reward -->
                        <!-- <p class="card-text">
                            <strong>Total Pemenang</strong> {{ count($usersReached100Percent[$reward->id]) }}
                        </p> -->

                        <p>Kuota reward : {{ $reward->kuota }}</p>

                        <button data-toggle="modal" data-target="#detailModal{{ $reward->id }}" class="btn btn-primary btn-sm">Lihat detail pemenang</button>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="detailModal{{ $reward->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">{{ $reward->judul_reward }}</h5>
                    

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <p>Kuota reward : {{ $reward->kuota }}</p>
    <!-- Tampilkan daftar nama pemenang di sini -->
    @if (count($usersReached100Percent[$reward->id]) > 0)
    <ol type="1">
        @php
            $rewardQuota = $reward->kuota;
            $userRank = 1; // Inisialisasi peringkat pengguna
        @endphp
        @foreach ($usersReached100Percent[$reward->id] as $userId)
            @php
                $user = \App\Models\User::find($userId); // Ganti \App\User dengan model User Anda
            @endphp

            @if ($user)
                @if ($userRank <= $rewardQuota)
                    <li class="tercapai mt-2">
                        {{ $user->nama }} ({{ $user->username }}) <span class="badge badge-primary">Tercapai dan masuk kuota pemenang</span>
                    </li>
                @else
                    <li class="tidak-tercapai mt-2">
                        {{ $user->nama }} ({{ $user->username }}) <span class="badge badge-danger">Tercapai dan tidak masuk kuota pemenang</span>
                    </li>
                @endif

                @php
                    $userRank++;
                @endphp
            @endif
        @endforeach
    </ol>
    @else
    <p>Tidak ada pemenang yang mencapai reward ini.</p>
    @endif
</div>



                    <div class="modal-footer">
<button id="exportDataButton" class="btn btn-sm btn-success" >Download Data Pemenang</button>

</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .card-title {
        font-weight: bold;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 100%;
        cursor: pointer;
    }

    .card-title:hover {
        white-space: normal;
        max-width: none;
    }
</style>
<script>
    // Fungsi untuk mengonversi data pemenang ke format CSV
    function exportDataToCSV(rewardId, rewardTitle) {
        // Mendapatkan daftar nama pemenang dari modal yang sesuai dengan rewardId
        var winners = [];
        var modalId = 'detailModal' + rewardId;
        var modal = $('#' + modalId);
        modal.find('ol li').each(function() {
            winners.push($(this).text());
        });

        // Menambahkan header "Nama Pengguna"
        winners.unshift("Nama (Kode Sales)");

        // Mengonversi data pemenang ke format CSV
        var csvData = winners.join('\n');
        var csvContent = 'data:text/csv;charset=utf-8,' + csvData;
        var encodedUri = encodeURI(csvContent);

        // Membuat nama file dengan judul reward
        var fileName = 'data_pemenang_reward_' + rewardTitle + '.csv';

        // Membuat link untuk mengunduh CSV
        var link = document.createElement('a');
        link.setAttribute('href', encodedUri);
        link.setAttribute('download', fileName);
        link.style.display = 'none';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    // Menambahkan event listener untuk tombol "Download Data Pemenang" pada semua modal
    $('.modal').each(function () {
        var modal = $(this);
        var modalId = modal.attr('id');
        var rewardId = modalId.replace('detailModal', '');
        var rewardTitle = modal.find('.modal-title').text(); // Mengambil judul reward dari modal

        modal.find('#exportDataButton').on('click', function() {
            exportDataToCSV(rewardId, rewardTitle);
        });
    });
</script>


<script>
    // Function to show/hide rewards based on selected role
    $('#role').on('change', function () {
        var selectedRoleId = $(this).val();
        $('.reward-card').addClass('d-none'); // Menyembunyikan semua card terlebih dahulu
        $('.role-' + selectedRoleId).removeClass('d-none'); // Menampilkan card hanya untuk role yang dipilih
    });
</script>

@endsection
