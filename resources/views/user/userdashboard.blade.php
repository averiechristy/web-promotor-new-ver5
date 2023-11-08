<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Exa Promoter</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logoexa.png" rel="icon">
  <link href="assets/img/logoexa.png" rel="">
  <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />

  <!-- Vendor CSS Files -->
  <link href="{{asset('vendor2/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('vendor2/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendor2/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('vendor2/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendor2/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendor2/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/lineicons.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/materialdesignicons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

    

  <!-- Template Main CSS File -->
  <link href="{{asset('css/style.css')}}" rel="stylesheet">

</head>

<body id="body2">

@include('components.user.header2') 
   

<main id="main">

<section id="userdashboard" class="userdashboard">
    <div class="container">
    
<div class="row portfolio-container" data-aos-delay="200">

        <div class="col-lg-4 col-md-6 portfolio-item">
            <div class="card-deck">
            <div class="icon-card">
                
        <div class="card-body">
                        <h5 class="card-title">Potensi Pendapatan</h5>
                        <div class="icon success mt-3">
            <img class="img-icon" src="{{asset('img/indonesian-rupiah.png')}}" alt="">
        </div>    
                        <h4 class="txt text-bold mb-10 mt-3">Rp. {{ number_format($totalIncomeThisMonth, 0, ',', '.') }},-</h4>

            <div class="container">
  <div class="row">
    <div class="col text-center">
        <small>Asumsi dengan absensi 22 hari kerja</small>
      <a href="{{ route('user.myincome') }}">
        <button class="btn btn-sm btn-link">Lihat riwayat pendapatan</button>
      </a>
    </div>
  </div>
</div>
    </div>

                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6 portfolio-item">
            <div class="card-deck">
            <div class="icon-card">
                            <div class="card-body ">
                        <h5 class="card-title">Potensi Poin</h5>
                        <div class="icon primary mt-3">
            <img class="img-icon" src="{{asset('img/bonus.png')}}" alt="">
        </div>    
                        <h4 class="txt text-bold mb-10 mt-3">{{ $totalPointsThisMonth }} poin</h4>
      

            <div class="container">
  <div class="row">
    <div class="col text-center">
    <small> </small>
      <a href="{{ route('user.myincome') }}">
        <button class="btn btn-sm btn-link">Lihat riwayat poin</button>
      </a>
    </div>
  </div>
</div>    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item">
    <div class="card-deck">
        <div class="icon-card">
           
            <div class="card-body ">
                <h5 class="card-title">Potensi Peringkat</h5>
                <div class="icon orange mt-3">
            <img class="img-icon" src="{{asset('img/top-three.png')}}" alt="">
            </div>
            
                    @if($leaderboardData->isEmpty())
                    <p class="text-sm mt-2">
               
                    <small class="tes text-muted ">
                        Belum ada peringkat
                        </small>
            </p>  
                    @else 
                    <h4 class="text-bold mb-10 mt-3 leaderboard-text">
                        <span class="txt user-rank">{{$userRank}}</span>   <span class="total-user">/ {{$totalUsersWithSameRole}} </span> 
                        </h4>

                        <!-- <p class="text-sm">
                <small class="text-muted">
                Anda menduduki posisi ke {{$userRank}} dari {{$totalUsersWithSameRole}}
            </small>

            </p>   -->
                        @endif
<div class="container">
  <div class="row">
    <div class="col text-center">
      <a href="{{ route('user.leaderboard') }}">
        <button class="btn btn-sm btn-link">Lihat rangking 10 besar</button>
      </a>
    </div>
  </div>
</div>

            </div>
        </div>
    </div>
</div>
</div>


<div class="card-reward">
  
<div class="row portfolio-container" data-aos-delay="200">
     <div class="row">
    <div class="col">
    <h4 >Reward</h4>

    </div>
    <div class="col " >
        <a href="{{route('user.historyreward')}}">
      <button class=" btn btn-warning btn-sm btn-reward " style=" float: right; color:white;">Lihat riwayat reward </button>
      </a>
    </div>
  </div>

    @foreach ($activeRewards as $activeReward)
        <div class="col-lg-4 col-md-6 portfolio-item">
            <div class="card-deck">
                <div class="card-style">
                <img class="card-img-dashboard mt-3" src="{{asset('img/'.$activeReward->gambar_reward)}}" alt="{{ $activeReward->title }}">

                    <div class="card-body mt-3">
                        <h5 class="card-title-reward mb-3 mt-3">{{ $activeReward->judul_reward }}</h5>
                        <div class="progress">
                            
            <div class="progress-bar" role="progressbar" style="width: {{ $progressWidthPerReward[$activeReward->id] }}" aria-valuenow="{{ $progressWidthPerReward[$activeReward->id] }}" aria-valuemin="0" aria-valuemax="100">
            <span class="progress-text">   {{ $progressWidthPerReward[$activeReward->id] }} </span>
        </div>

        
        </div>

        <p class="card-text">
       <span class="text-poin"> {{ $totalPointsRewardPeriod[$activeReward->id] }} </span>   <span class="text-poinreward">  / {{$activeReward->poin_reward}} </span>
        </p>        
        
        <p class="kuota-posisi">
         Posisi <span class="posisi"> {{ $userRankRewardPeriod[$activeReward->id] }} </span> dari
          {{ $totalUsersRewardPeriod[$activeReward->id] }} ||
         Kuota Pemenang : <span class="kuota-pemenang">{{ $activeReward->kuota }}</span>        
         </p>


                        <p class="card-text">
                        <small class="text-muted">
                Berakhir dalam {{ $remainingTime[$activeReward->id] }}
            </small>
        </p>              
    
    
    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
</div>
            </div>


</section>

</main>

<style> 
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
.leaderboard-text{
    text-align:center;
}
.btn-reward {
    
    margin-top : 20px;
}

.card-reward {
background-color : white;
border-radius : 8px;
}

.card-reward h4{
    margin-left : 50px;
    margin-top : 20px;
}

.text-sm {
    text-align:center;
}

.txt {
    text-align: center;
}

.card-title-reward {
  white-space: nowrap;
  overflow: hidden;
  font-family: Nunito;
  text-overflow: ellipsis;
  max-width: 100%; /* Atur lebar maksimum yang Anda inginkan */
  cursor: pointer;
  font-size: 18px;
    font-weight: bold;
}

/* Menampilkan judul lengkap saat hover */
.card-title-reward:hover {
  white-space: normal;
  max-width: none;
}
.icon .img-icon {
    width:60px;
    height:60px;
    
}

.card-img-dashboard {
    width:100%;
    border-radius :8px;
    
    height:100px;
}
.text-poin{
    font-size: 20px; /* Ubah ukuran teks sesuai preferensi Anda */
    color: #FF5733; /* Ubah warna teks sesuai preferensi Anda */
    font-weight: bold; /* Membuat teks menjadi tebal */
    margin-right: 5px; /* Memberikan jarak sebelum tanda "/" */
}

.text-poinreward {
    font-size: 15px;
    color: gray; 
}
.user-rank {
    font-size: 24px; /* Ubah ukuran teks sesuai preferensi Anda */
    color: #FF5733; /* Ubah warna teks sesuai preferensi Anda */
    font-weight: bold; /* Membuat teks menjadi tebal */
    margin-right: 5px; /* Memberikan jarak sebelum tanda "/" */
}

.total-user {
    font-size: 20px;
    color: gray; 

}

.portfolio-container h4{
 color:#01004C;
 font-family: Nunito;
}


.card-header h6 {
    color: #06234F;
    font-size: 15px;
font-style: normal;
font-weight: 700;

}

.icon-card {
    margin: 10px;
    padding: 20px;
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    background-color: #fff; /* Warna latar belakang card */
    transition: transform 0.3s;
    height:300px;
}


.card-style {
    margin:20px;

    padding: 20px;
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    background-color: #F6F8FD; /* Warna latar belakang card */
    transition: transform 0.3s;

}
.card-style h5.card-title {
    font-size: 18px;
    font-weight: bold;
    
}

.card-title {
    text-align: center;

}

.card-img-top {
    border-radius: 10px;
    width:100%;
}

.card-style p.card-text {
    font-size: 16px;
}

.card-style small.text-muted {
    font-size: 14px;
    color: #888;
}

.card-style:hover {
    transform: scale(1.02); /* Membesarkan card saat dihover */
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
}
.icon-card:hover {
    transform: scale(1.02); /* Membesarkan card saat dihover */
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
}

.portfolio-item {
    margin-bottom: 20px; /* Menambahkan jarak antara card */
}
.badge-danger {
  background-color : red;
}
.badge-success {
  background-color : green;
}
.badge-info {
  background-color : orange;

}

.card-desc {
 color: black;
}

#gambarmodal {
  width:100%;
  height:50%;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
border-radius :5px;
  
} 


    .progress {
        height:20px;
        border-radius:50px;


    }
    .progress-bar {
        position: relative;
        background: linear-gradient(270deg, #1681FF 0%, rgba(22, 129, 255, 0.42) 100%);


       


        /* Menjadikan posisi relatif untuk progress bar */
    }

    .progress-text {
        position: absolute;
    
        right: 5px;
        font-weight : bold;
    }

    


/* CSS untuk gambar dalam modal */






</style>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{asset('vendor/aos/aos.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/glightbox/js/glightbox.min.js')}}"></script>
<script src="{{asset('vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('vendor/swiper/swiper-bundle.min.js')}}"></script>
<script src="{{asset('vendor/php-email-form/validate.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Template Main JS File -->
<script src="{{asset('js/main.js')}}"></script>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin untuk logout?</h5>
                   
                </div>
                <div class="modal-body">Pilih "logout" jika anda yakin untuk mengakhiri sesi anda.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
                </div>
            </div>
        </div>
    </div>
<!-- Modal -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const avatarInput = document.getElementById('avatar-input');
        const avatarPreview = document.getElementById('avatar-preview');
        const successMessage = document.getElementById('success-message');

        // Tampilkan gambar profil yang lama saat halaman dimuat
        const previousAvatarSrc = avatarPreview.getAttribute('src');
        avatarPreview.src = previousAvatarSrc;

        avatarInput.addEventListener('change', function() {
            const file = avatarInput.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    avatarPreview.src = e.target.result;
                };

                reader.readAsDataURL(file);
            } else {
                // Kembalikan ke gambar profil yang lama jika tidak ada file yang dipilih
                avatarPreview.src = previousAvatarSrc;
            }
        });

        // Tampilkan pesan sukses setelah mengunggah
        const successNotification = "{{ session('success') }}";
        if (successNotification) {
            successMessage.classList.remove('d-none');
        }
    });
</script>



<script>
    @if($errors->has('avatar'))
        $(document).ready(function() {
            $('#changeProfilePhotoModal').modal('show');
        });
    @endif
</script>

</body>
</html>