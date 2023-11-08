@extends('layouts.user.app2')

@section('content2')
<main id="main">
<section id="myincome" class="myincome d-flex align-items-center">
        <div class="container">
  
          <div class="row justify-content-between">
        <h5>History Reward</h5>
        <div class="row mt3">
            @foreach($rewards as $reward)
                <div class="col-md-4 mt-3">
                    <div class="card card-tes">
                        <div class="card-atas">
                        @if ($userRank !== false && $userRank + 1 <= $reward->kuota)
                    <span class="badge badge-primary">{!! $reward->status !!}</span>
                @else
                    <span class="badge badge-danger">{!! $reward->status !!}</span>
                @endif
</div>
                        
                    <img class="card-img-dashboard" src="{{asset('img/'.$reward->gambar_reward)}}" alt="{{ $reward->title }}">
                        <div class="card-body">

                            <p class="card-title">{{ $reward->judul_reward }}</hp>
                            <p class="card-text"> {{ $totalpoinuser[$reward->id] }} / {{ $reward->poin_reward }}</p>
                        </div>
                        <div class="card-footer">
                        <p class="kuota-posisi">
         Posisi <span class="posisi"> {{ $userRankRewardPeriod[$reward->id] }} </span> dari
          {{ $totalUsersRewardPeriod[$reward->id] }} ||
         Kuota Pemenang : <span class="kuota-pemenang">{{ $reward->kuota }}</span>        
         </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        </div>
        </div>
    </main>
</section>
 

<style>

.card-atas {
    background-color: white;
    margin-bottom:10px;
}
.badge-primary {
    background-color: #007BFF;
    float:right;
}
.badge-danger {
    background-color: red;
    float:right;
}
.kuota-posisi {
        align-items: center; /* Untuk mengalign vertikal */
    }

    .kuota-pemenang {
        font-weight: bold;
        color: #FF5733; /* Ganti warna sesuai keinginan Anda */
        margin-right: 5px; 
    }

    .posisi {
        font-weight: bold;
        color: #007BFF; /* Ganti warna sesuai keinginan Anda */
        font-size : 16pt;
    }

h5{
    font-family: Nunito;
    font-weight:bold;
}

.card-title {
  white-space: nowrap;
  font-size: 10px;
   
  overflow: hidden;
  font-family: Nunito;
  text-overflow: ellipsis;
  max-width: 100%; /* Atur lebar maksimum yang Anda inginkan */
  cursor: pointer;
}

/* Menampilkan judul lengkap saat hover */
.card-title:hover {
  white-space: normal;
  max-width: none;
}
    .card-img-dashboard{
        width:100%;
        height: 150px;
    }

    .card-title {
        font-size : 16pt;
    }

    .card-text{
        font-size : 10pt;
        color:#FF9029;
    }
    .card-tes{
        margin: 10px;
    padding: 20px;
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    background-color: #fff; /* Warna latar belakang card */
    transition: transform 0.3s;        
    }

    .card-footer {
        background-color: #fff; /* Warna latar belakang card */

    }
</style>

@endsection
