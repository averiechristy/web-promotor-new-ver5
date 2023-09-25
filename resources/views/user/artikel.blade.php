@extends('layouts.user.app2')

@section('content2')


   
  <!-- ======= Hero Section ======= -->
  <main id="main">

   <!-- ======= Article Section ======= -->
   <!-- ======= Portfolio Section ======= -->
   <section id="portfolio" class="portfolio">
      <div class="container" >

       
<!--  -->

        <div class="row portfolio-container"  data-aos-delay="200">
        
      @foreach ($artikel as $artikel)
          <div class="col-lg-4 portfolio-item ">
          <a href="{{ route('user.artikelread', $artikel->id) }}">
            <div class="card">
              <img src="{{asset('img/'.$artikel->gambar_artikel)}}" class="img-fluid" alt="">
              <hr class="solid">
              <div class="info">
                <h4>{{$artikel->judul_artikel}}</h4>
                <p>baca lebih lengkap</p>
              </div>
            </div>
</a>
          </div>
          @endforeach
        </div>
      </div>
    </section><!-- End Portfolio Section -->

  


</main>
@endsection