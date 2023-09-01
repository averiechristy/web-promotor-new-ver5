@extends('layouts.user.app2')

@section('content2')


   
  <!-- ======= Hero Section ======= -->


   <!-- ======= Article Section ======= -->
   
<section id="artikel" class="portfolio">
  <div class="container">
    <div class="section-title">
     
    </div>
    <div class="article-container row">
    
    @foreach ($artikel as $artikel)
      <!-- Repeat this block for each article -->
      <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item filter-card">
      <div class="portfolio-wrap">
      <figure>
      <a href="{{ route('user.artikelread', $artikel->id) }}">
        <img src="{{asset('img/'.$artikel->gambar_artikel)}}" class="img-fluid"  style="height: 100%; width:100%;" alt="">
        <!-- <a href="{{asset('img/Article1.png')}}" data-gallery="portfolioGallery" class="link-preview portfolio-lightbox" title="Preview"><i class="bx bx-plus"></i></a>
        <a href="#" class="link-details" title="More Details"><i class="bx bx-link"></i></a> -->
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
 
  </div>
</section>

  
  
<footer id="footer" style="height:5px;" class ="d-flex align-items-center">
    <div class="container py-4">
      <div class="copyright mt-5">
        &copy; 2023 by <strong><span>PT. Exa Mitra Solusi</span></strong>. 
      </div>
      
    </div>
  </footer><!-- End Footer -->


@endsection