@extends('layouts.user.app2')

@section('content2')
  <!-- ======= Hero Section ======= -->
  <section id="hero4" class="text-center">
    <img src="{{ asset('img/'.$data->gambar_artikel) }}" class="centered-image img-fluid" alt="">
  </section><!-- End Hero -->

  <!-- ======= Artikel Text Section ======= -->
  <section id="articleread">
    <h3>{!! $data->judul_artikel !!} </h3>
    <p>{!! $data->isi_artikel !!} </p>
  </section>
  <!-- End Hero -->
@endsection
