@extends('layouts.user.app')

@section('content')

       <!-- ======= Income Section ======= -->
       <section id="income" class="income">
        <div class="container">
  
          <div class="row justify-content-between">
            <div class="col-lg-5 d-flex align-items-center justify-content-center income-img">
                <img src="{{asset('img/income-illus.png')}}" class="img-fluid" alt="" >
            </div>
            <div class="col-lg-6 pt-5 pt-lg-0">
              
              <div class="button-income">
                <h2>Pilih pendapatan yang ingin kamu capai</h2>
                @foreach ($paket as $data)
               <a href="{{ route('tampilincome', $data->id) }}"><button class="button-hitung" type="button">{{ $data->judul_paket}}</button><br></a>
            @endforeach
            </div>
            </div>
          </div>
  
        </div>
      </section><!-- End Income Section -->
@endsection