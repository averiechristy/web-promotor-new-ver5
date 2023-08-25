@extends('layouts.user.app')

@section('content')

<!-- Package Income-->
 
<section id="package">

<h3>{{$data->deskripsi_paket}}</h3>
<div class="row row-cols-1 row-cols-md-2 g-4">


@foreach ($detail as $detail)
  <div class="col">
    <div class="card">
    <img src="{{ asset('img/' .$detail->produk->gambar_produk) }}" class="card-img-top"   style="width: 100%;" alt="...">     
     <div class="card-body">
        <h5 class="card-title">{{ $detail->produk->nama_produk }}</h5>
        <p class="card-text">Qty Produk: {{ $detail->qty_produk }}</p>
      </div>
    </div>
  </div>

@endforeach

</div>
</section>

<!--End Package Income-->

@endsection