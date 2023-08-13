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
               <a href="package-income.html"><button class="button-hitung" type="button">Pendapatan 3 Juta</button><br></a>
               <a href="#"><button class="button-hitung" type="button">Pendapatan 4 Juta</button><br></a>
               <a href="#"><button class="button-hitung" type="button">Pendapatan 5 Juta</button><br></a>
               <a href="#"><button class="button-hitung" type="button">Pendapatan 7 Juta</button><br></a>

            </div>
            </div>
          </div>
  
        </div>
      </section><!-- End Income Section -->
@endsection