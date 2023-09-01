@extends('layouts.user.app2')

@section('content2')



    <!-- ======= Services Section ======= -->
    <main id="main">
    <section id="services" class="services d-flex align-items-center">
      <div class="container" >

        <div class="section-title">
          <p>{{$data->deskripsi_paket}}</p>
        </div>
   
        <div class="row">
        @foreach ($produk as $detail)

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch">
            <div class="icon-box">
              <div class="icon">                    
                <img src="{{ asset('img/' .$detail->produk->gambar_produk) }}" class="card-img-top" style="object-fit: cover; height: 250px;" alt="...">
              </div>
              <h4 class="title"><a href="">{{ $detail->qty_produk }} {{ $detail->produk->nama_produk }}</a></h4>
              <p class="description">{!! nl2br(e($detail->produk->deskripsi_produk)) !!}</p>
            </div>
          </div>

          @endforeach

      

        </div>

      </div>
    </section><!-- End Services Section -->
</main>


@endsection
