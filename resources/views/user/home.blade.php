@extends('layouts.user.app')

@section('content')

 

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1>Catch Your Dream</h1>
          <h2>Hitung Penghasilan sesuai keinginanmu!</h2>
          <div>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img">
          <img src="{{asset('img/banner.png')}}" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about d-flex">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-lg-5 d-flex align-items-center justify-content-center about-img">
        <img src="{{asset('img/income.png')}}" class="img-fluid" alt="">
      </div>
      <div class="col-lg-6 pt-5 pt-lg-0">
        <h3>Income</h3>
        <h5 data-aos-delay="100" align-items-center>
          Pilih cara untuk atur pendapatanmu
        </h5>
        <div class="row">
          <div class="col-md-6 mb-3">
            <div class="card" data-aos-delay="100">
              <a href="{{route ('user.kalkulator')}}">
                <i class="bx bx-calculator"></i>
                <h4>Simulasi Pendapatan</h4>
                <p>Fitur kalkulator untuk hitung sendiri pendapatan</p>
              </a>
            </div>
          </div>

          <div class="col-md-6 mb-3">
            <div class="card" data-aos-delay="200">
            
              <a href="{{ route('paketkalkulator') }}">
              <i class='bx bxs-calculator'></i>
        <h4>Simulasi Impianmu</h4>
        <p>Fitur Kalkulator untuk hitung penjualan produk dari cicilan mu</p>
               
              </a>
            </div>
          </div>
        
  <div>
    <div class="card" data-aos-delay="300">
    <a href="{{route ('user.package')}}">
    <i class='bx bx-package'></i>
                <h4>Paket Pendapatan</h4>
                <p>Tersedia banyak pilihan paket pendapatan</p>
      </a>
    </div>
  </div>

          
        </div>
      </div>
    </div>
  </div>
</section><!-- End About Section -->

  <!-- ======= Portfolio Section ======= -->
  <section id="portfolio" class="portfolio" style="background-color:#F6F8FD;">
      <div class="container" >

        <div class="section-title">
          <h2></h2>
          <p>News</p>
        </div>
<!--  -->

        <div class="row portfolio-container"  data-aos-delay="200">
      @php
      $latestArtikel = $artikel->take(6); // Mengambil 6 artikel terbaru
      @endphp

      @foreach ($artikel as $artikel)
          <div class="col-lg-4 portfolio-item ">
          <a href="{{ route('user.artikelread', $artikel->id) }}">
            <div class="card-news">
              <img src="{{asset('img/'.$artikel->gambar_artikel)}}" class="img-fluid" alt="">
              <hr class="solid">
              <div class="info">
                <h5>{{$artikel->judul_artikel}}</h5>
                <p class="card-text"><small class="text-muted">Created {{ $artikel->created_at->diffForHumans() }}</small></p>

              </div>
            </div>
          </a>
          </div>
        @endforeach

        <style>

          /* Membatasi jumlah karakter judul dan menampilkan titik-titik */
.portfolio-item .info h5 {
  white-space: nowrap;
  overflow: hidden;
  font-family: Nunito;
  text-overflow: ellipsis;
  max-width: 100%; /* Atur lebar maksimum yang Anda inginkan */
  cursor: pointer;
}

/* Menampilkan judul lengkap saat hover */
.portfolio-item .info h5:hover {
  white-space: normal;
  max-width: none;
}

.card-news {
  margin: 10px;
    padding: 20px;
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    background-color: #fff; /* Warna latar belakang card */
    transition: transform 0.3s;        
}

.card-news img {
  width:100%;
        height: 150px;
}

.info h5 {
  color : #01004C;
  font-weight : bold;
  
}

        </style>
          <div class="more-button">
      <button class="btn-lain"><a href="{{route('user.artikel')}}">Lihat berita lebih banyak</a></button>
    </div>

        </div>

      </div>
    </section><!-- End Portfolio Section -->
    
<!-- End About Section -->

<!-- Leaderboard Section -->


<section id="leaderboard" class="leaderboard">
  <div class="container">
    <div class="section-title">
      
    <h2>
LeaderBoard
</h2>

      <p>  3 Besar Peringkat per bulan {{ now()->format('F') }}</p>
    </div>
    @if (count($leaderboardData) > 0)
    <div class="row">
    @foreach ($leaderboardData as $leader)
    <div class="col-lg-4 col-md-6 @if ($loop->first) col-lg-offset-4 @endif">
        <div class="leaderboard-card @if ($loop->first) leaderboard-first @elseif ($loop->iteration == 2) leaderboard-second @elseif ($loop->iteration == 3) leaderboard-third @endif">
                <div class="leaderboard-rank">
                    <span class="rank-number">#{{ $loop->iteration }}</span>
                </div>
                <div class="leaderboard-avatar">
    <!-- Cek apakah ada gambar avatar sesuai dengan nama user -->
    @if ($leader->user)
        @if ($leader->user->avatar)
            <img src="{{ asset('img/' . $leader->user->avatar) }}" alt="{{ $leader->nama }} Avatar" width="100" height="100" style="border-radius:100%;">
        @else
            <!-- Jika tidak ada avatar, Anda bisa menampilkan gambar default di sini -->
            <img src="{{ asset('img/default-profile.jpg') }}" alt="Default Avatar" width="100" height="100"  style="border-radius:100%;">
        @endif
    @else
        <!-- Jika tidak ada data pengguna yang sesuai, Anda bisa menampilkan gambar default di sini -->
        <img src="{{ asset('img/default-profile.jpg') }}" alt="Default Avatar" width="100" height="100"  style="border-radius:100%;">
    @endif
</div>

                <div class="leaderboard-info">
                    <h4>{{ $leader->user->nama }}</h4>
                    <p>Total Poin: {{ $leader->total_point }}</p>
                    
          <?php
    $formattedHasil = 'Rp. ' . number_format($leader->total_income, 0, ',', '.') . ',-';
    ?>
          <p>Pendapatan : {{ $formattedHasil }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>
@else
<p style="text-align: center;">Tidak ada data leaderboard yang tersedia saat ini.</p>
            @endif

<style>
    .leaderboard-card {
        border: 2px solid #01004C; /* Warna border kartu */
        padding: 20px;
        text-align: center;
        background-color: #f8f9fa; /* Warna latar belakang kartu */
        border-radius: 8px;
    }

    .leaderboard-first {
        /* Gaya kartu untuk peringkat pertama */
        border: 4px solid #FFD700; /* Warna border lebih tebal untuk peringkat pertama */
        padding: 20px; /* Lebih besar padding untuk peringkat pertama */
        background-color: #E6E8FA; /* Warna latar belakang berbeda untuk peringkat pertama */
    }

    .leaderboard-second {
        /* Gaya kartu untuk peringkat pertama */
        border: 4px solid #d6d6d6; /* Warna border lebih tebal untuk peringkat pertama */
        padding: 20px; /* Lebih besar padding untuk peringkat pertama */
        background-color: #E6E8FA; /* Warna latar belakang berbeda untuk peringkat pertama */
    }

    .leaderboard-third {
        /* Gaya kartu untuk peringkat pertama */
        border: 4px solid #CD7F32; /* Warna perunggu (bronze) */
                padding: 20px; /* Lebih besar padding untuk peringkat pertama */
        background-color: #E6E8FA; /* Warna latar belakang berbeda untuk peringkat pertama */
    }

    .leaderboard-rank {
        font-size: 36px; /* Ukuran angka rank yang lebih besar */
        color: #01004C; /* Warna angka rank */
    }

    .rank-number {
        font-weight: bold; /* Membuat angka rank lebih tebal */
    }

    /* Menggunakan Flexbox untuk mengatur kartu secara horizontal */
    .row {
        display: flex;
        justify-content: center; /* Mengatur kartu di tengah secara horizontal */
    }

    /* Mengatur offset kolom untuk peringkat pertama */
    .col-lg-offset-4 {
        margin-left: auto; /* Geser peringkat pertama ke tengah */
    }

   
        /* Styling for small screens */
        @media (max-width: 767px) {
            .col-lg-5 {
                width: 100%;
            }

            iframe {
                width: 100%;
                height: 250px; /* Adjust the height as needed */
            }
        }
  
</style>




      <!-- Akhiri daftar leaderboard -->

      <!-- Tombol untuk melihat lebih banyak -->
      <div class="col-12 text-center mt-4">
        <button class="btn-lain"><a href="{{route ('user.leaderboard')}}">Lihat daftar ranking</a></button>
      </div>
    </div>
  </div>
</section>



<!-- End Leaderboard Section -->

    <!-- ======= Contact Us Section ======= -->
    <!-- <section id="contact" class="contact d-flex align-items-center">
      <div class="container" id = "contact">
        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="contact-text">
              <h2>Contact Us</h2>
              <i class="fa fa-envelope circle-icon1" style="font-size:28px ; color: #FF9029;" > <p> loremipsum@gmail.com </p></i>
                 </div>

          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch" >
       

            
          </div>
        </div>

      </div>
    </section>End Contact Us Section -->

    <!-- ======= Contact Us Section ======= -->
    <section id="contact" style ="background-color : #FEF8F5;" class="contact">
      <div class="container" >
        <div class="section-title">
          <h2>Contact Us</h2>
          <p>Informasi lebih lanjut hubungi kami</p>
        </div>

        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch" >
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Lokasi :</h4>
                <p>PT. Exa Mitra Solusi, Jl. ABCD no 23</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>info@example.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>+123456</p>
            
          </div>

        

        </div>

      </div>
    </section><!-- End Contact Us Section -->
    

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" style="height:5px;" class ="d-flex align-items-center">
    <div class="container py-4">
      <div class="copyright mt-5">
        &copy; 2023 by <strong><span>PT. Exa Mitra Solusi</span></strong>. 
      </div>
      
    </div>
  </footer><!-- End Footer -->


  <script>
  @if($errors->any())
    // Jika terdapat kesalahan validasi, arahkan scroll ke elemen dengan ID "contact"
    window.location.hash = '#contact';
  @endif
</script>

  @endsection