@extends('layouts.user.app')

@section('content')


   
  <!-- ======= Hero Section ======= -->
  <section id="hero1" class="d-flex flex-column justify-content-center align-items-center">
    <div class="container text-center text-md-left" >
      <h1>Get started today</h1>
      <h2>Like what you learning</h2>
    </div>
  </section><!-- End Hero -->


   <!-- ======= Article Section ======= -->
   <section id="portfolio" class="portfolio">
    <div class="container">

      <div class="section-title">
        <h2>Article</h2>
      </div>

    
      <div class="row portfolio-container">

      @foreach ($artikel as $artikel)

        <div class="col-lg-4 col-md-6 portfolio-item filter-app wow fadeInUp">
          <div class="portfolio-wrap">
            <figure>
              <img src="{{asset('img/'.$artikel->gambar_artikel)}}" class="img-fluid"  style="height: 100%;" alt="">
              <!-- <a href="{{asset('img/Article1.png')}}" data-gallery="portfolioGallery" class="link-preview portfolio-lightbox" title="Preview"><i class="bx bx-plus"></i></a>
              <a href="#" class="link-details" title="More Details"><i class="bx bx-link"></i></a> -->
            </figure>

            <div class="portfolio-info">
              <h4>{{$artikel->judul_artikel}}</h4>
              <p><a href="{{ route('user.artikelread', $artikel->id) }}">Read More</a></p>

            </div>
          </div>
        </div>

        @endforeach

        

      </div>

    </div>
  </section><!-- End Portfolio Section -->
  
 <!-- ======= Footer ======= -->
 <footer id="footer1">
    <div class="container py-4">
      <div class="copyright1">
        &copy; 2023 by <strong><span>PT. Exa Mitra Solusi</span></strong>. 
      </div>
      
    </div>
  </footer><!-- End Footer -->

@endsection