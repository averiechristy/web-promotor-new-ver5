@extends('layouts.user.app')

@section('content')

<!-- Package Income-->
 
<section id="package">

<h3>Dapatkan pendapatan 3 juta dengan menjual</h3>
<h1>140 Produk</h1>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        
        <div class="col">
          <div class="card">
            <img src="{{asset('img/produk.png')}}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">10 Produk A</h5>
              <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <img src="{{asset('img/produk.png')}}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">20 Produk B</h5>
              <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <img src="{{asset('img/produk.png')}}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">60 Produk C</h5>
              <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <img src="{{asset('img/produk.png')}}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">30 Produk D</h5>
              <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
          </div>
        </div>
      </div>
</section>

<!--End Package Income-->

@endsection