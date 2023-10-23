@extends('layouts.user.app2')

@section('content2')
<main id="main">
<section id="myincome" class="myincome d-flex align-items-center">
        <div class="container">
  
          <div class="row justify-content-between">
        <h5>Reward yang Berhasil Dicapai</h5>
        <div class="row mt3">
            @foreach($rewards as $reward)
                <div class="col-md-4 mt-3">
                    <div class="card card-tes">
                    <img class="card-img-dashboard" src="{{asset('img/'.$reward->gambar_reward)}}" alt="{{ $reward->title }}">
                        <div class="card-body">
                            <p class="card-title">{{ $reward->judul_reward }}</hp>
                            <p class="card-text">Poin Reward: {{ $reward->poin_reward }}</p>
                        </div>
                        <div class="card-footer">
                            <i style="color:green;"class="fas fa-check-circle"></i> Reward Tercapai
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
