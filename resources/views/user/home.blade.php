@extends('layouts.user.app')

@section('content')

 

  <section id="hero" class="d-flex align-items-center">

<div class="container">
  <div class="row gy-4">
    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
      <h1>Penghasilan, Atur Sendiri!</h1>
      <h2>Catch Your Dream</h2>
      
    </div>
    <div class="col-lg-6 order-1 order-lg-2 hero-img">
    <img src="{{asset('img/banner.png')}}" class="img-fluid animated" alt="">
    </div>
  </div>
</div>

</section><!-- End Hero -->


<main id="main">

<!-- ======= About Section ======= -->
<section id="about" class="about ">
  <div class="container">

    <div class="row justify-content-between">
      <div class="col-lg-5 d-flex align-items-center justify-content-center about-img">
      <img src="{{asset('img/income.png')}}" class="img-fluid" alt="" >
          </div>
      <div class="col-lg-6 pt-5 pt-lg-0">
        <h3>Pilih cara untuk atur penghasilanmu!</h3>
      
     
        <div class="col-md-6" >
        <a href="{{route ('user.kalkulator')}}"><button class="button-hitung" type="button">Hitung Sendiri</button><br></a>

          </div>
          <div class="col-md-6" >
           
            <a href="{{route ('user.package')}}"><button class="button-package" type="button">Lihat Paket yang tersedia</button></a>
          </div>
         
        </div>
      </div>
    </div>

  </div>
</section>
<!-- End About Section -->
<section id="artikel" class="portfolio">
  <div class="container">
    <div class="section-title">
      <p>Artikel</p>
    </div>
    <div class="article-container row">
      @php
        $latestArtikel = $artikel->take(6); // Mengambil 6 artikel terbaru
      @endphp
      @foreach ($artikel as $artikel)
        <!-- Repeat this block for each article -->
        <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item filter-card">
          <div class="portfolio-wrap">
            <figure>
              <a href="{{ route('user.artikelread', $artikel->id) }}">
                <img src="{{asset('img/'.$artikel->gambar_artikel)}}" class="img-fluid" alt="">
              </a>
            </figure>
            <div class="portfolio-info">
              <h4>{{$artikel->judul_artikel}}</h4>
              <p><a href="{{ route('user.artikelread', $artikel->id) }}">Read More</a></p>
            </div>
          </div>
        </div>
      @endforeach
      <!-- Repeat for other articles -->
    </div>
    <div class="more-button">
      <button class="btn btn-warning btn-lain"><a href="{{route('user.artikel')}}">Lihat artikel lebih banyak</a></button>
    </div>
  </div>
</section>


    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact d-flex align-items-center">
      <div class="container">
        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="contact-text">
              <h2>Contact Us</h2>
              <i class="fa fa-phone circle-icon" style="font-size:32px ; color: #FF9029;" > <p> +12345678 </p></i> <br>
              <i class="fa fa-envelope circle-icon1" style="font-size:28px ; color: #FF9029;" > <p> loremipsum@gmail.com </p></i>
                 </div>

          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch" >
       

            <form action="{{ route('contact.store') }}" method="post" role="form" class="php-email-form rounded">
              @csrf
              @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
              <h4> Any Questions?</h4>
                <p>Get in touch with us</p>
              <div class="row">
                <div class="form-group col-md-6">
                <label for="name">Nama</label>
                  <input type="text" name="name" class="form-control" id="name" value=" {{ Auth::user()->nama }}" disabled >
                  <!-- @if ($errors->has('name'))
                                                    <p class="text-danger">{{$errors->first('name')}}</p>
                                                @endif -->
                </div>
                <div class="form-group col-md-6 mt-3 mt-md-0">
                  <label for="name">Email</label>
                  <input type="email" class="form-control" name="email" id="email" value=" {{ Auth::user()->email}}" disabled>
                  <!-- @if ($errors->has('email'))
                                                    <p class="text-danger">{{$errors->first('email')}}</p>
                                                @endif -->
                </div>
              </div>
              <div class="form-group mt-3">
                <label for="name">Subject</label>
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                @if ($errors->has('subject'))
                                                    <p class="text-danger">{{$errors->first('subject')}}</p>
                                                @endif
              </div>
              <div class="form-group mt-3">
                <label for="name">Message</label>
                <textarea class="form-control" name="message" rows="10" ></textarea>
                @if ($errors->has('message'))
                                                    <p class="text-danger">{{$errors->first('message')}}</p>
                                                @endif
              </div>
              
              <div class="text-center">
                <button type="submit" >Send</button></div>
            </form>
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

  @endsection