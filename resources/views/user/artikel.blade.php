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
        </div>
      </div>
    </section><!-- End Portfolio Section -->

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


</main>
@endsection