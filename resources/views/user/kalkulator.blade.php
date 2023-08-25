@extends('layouts.user.app')

@section('content')

       <!-- ======= Kalkulator Section ======= -->
       <section id="count" class="count">
        <div class="container">
  
          <div class="row justify-content-between">
            <h3>Hitung pendapatan yang kamu mau!</h3>
            <div class="col-lg-5 d-flex align-items-center justify-content-center income-img">
                
                
                <img src="{{asset ('img/kalkulator-illus.png')}}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 pt-5 pt-lg-0">
              
                <div class="col-lg-8 mt-5 mt-lg-0 d-flex align-items-stretch" >
                    <form action="{{ route('calculate') }}" method="post" role="form" class="php-email-form1">
                    @csrf
                      <p> Silahkan masukan jumlah produk yang ingin kamu jual</p>
                      @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

                      
                      <div class="row">
                      
                        
                        <div class="form-group col-md-6">
                     
                        @foreach ($produk as $produk)
                      <div class="form-group mt-3">
                      <label>{{ $produk->nama_produk }}</label>
        <input type="number" name="product_quantity[{{ $produk->id }}]" min="0" style="width:50vh;" >
        <br>
                      </div>
                      @endforeach
                     
                    </div>
                    <div class="text-center"><button type="submit" class="button-hitung">Hitung</button></div>
                    <div class="row g-3">
                    
   

  <div class="col">
  <label for="name">Hasil yang kamu dapat</label>
                            <input class="form-control" type="text" value="Rp. 0,-" aria-label="Rp. 0,-" disabled readonly>  </div>
  <div class="col">
  <label for="name">Jumlah Poin</label>
                            <input class="form-control" type="text" value="0 poin" aria-label="0 poin" disabled readonly>  </div>
</div>
                    <div class="form-group col-md-6 mt-3 mt-md-0">

                    </div>
                    </div>
                   
                    </form>
                  </div>
         
           
          </div>
  
        </div>
      </section><!-- End Kalkulator Section -->
@endsection