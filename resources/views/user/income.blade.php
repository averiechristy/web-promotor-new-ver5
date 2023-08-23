@extends('layouts.user.app')

@section('content')

<!-- Package Income-->
 
<section id="package">

<h3>{{$data->deskripsi_paket}}</h3>
<div class="row row-cols-1 row-cols-md-2 g-4">

@foreach (json_decode($data->produk, true) as $produk)
  <div class="col">
    <div class="card">
    <img src="{{asset('img/produk.png')}}" class="card-img-top"   style="width: 100%;" alt="...">     
     <div class="card-body">
        <h5 class="card-title">{{ $produk['nama_produk'] }}</h5>
        <p class="card-text">Qty Produk: {{ $produk['qty_produk'] }}</p>
      </div>
    </div>
  </div>

@endforeach

 


</div>
</section>

<!--End Package Income-->

@endsection