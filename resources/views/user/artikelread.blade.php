@extends('layouts.user.app')

@section('content')


  <!-- ======= Hero Section ======= -->
  <section id="hero4" class="">
  <img src="{{ asset('img/'.$data->gambar_artikel) }}" style="width: 100%; height:70vh; align-item:center;" alt="">
  </section><!-- End Hero -->


   <!-- ======= Artikel Text Section ======= -->
        <section id="article">
          
            <h3>{!!$data->judul_artikel!!} </h3>

            <p> {!!$data->isi_artikel!!} </p>
        </section>

   <!-- End Hero -->
@endsection