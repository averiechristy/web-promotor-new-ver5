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
                    <form action="#" method="post" role="form" class="php-email-form1">
                      
                      <p> Silahkan masukan jumlah produk yang ingin kamu jual</p>
                      
                      <div class="row">
                      
                        
                        <div class="form-group col-md-6">
                     
                      <div class="form-group mt-3">
                        <label for="name">Produk A</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Masukan Jumlah Produk" required>
                      </div>
                      <div class="form-group mt-3">
                        <label for="name">Produk B</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Masukan Jumlah Produk" required>
                      </div>

                      <div class="form-group mt-3">
                        <label for="name">Produk C</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Masukan Jumlah Produk" required>
                      </div>

                      <div class="form-group mt-3">
                        <label for="name">Produk D</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Masukan Jumlah Produk" required>
                      </div>

                      <div class="text-center"><button type="submit" class="button-hitung">Hitung</button></div>
                    </div>

                    <div class="form-group col-md-6 mt-3 mt-md-0">
                        <div class="form-group mt-3">
                            <label for="name">Hasil yang kamu dapat</label>
                            <input class="form-control" type="text" value="Rp. 0,-" aria-label="Rp. 0,-" disabled readonly>
                          </div>

                          <div class="form-group mt-3">
                            <label for="name">Jumlah Poin</label>
                            <input class="form-control" type="text" value="0 poin" aria-label="0 poin" disabled readonly>
                          </div>

                    </div>
                    </div>
                   
                    </form>
                  </div>
         
           
          </div>
  
        </div>
      </section><!-- End Kalkulator Section -->
@endsection