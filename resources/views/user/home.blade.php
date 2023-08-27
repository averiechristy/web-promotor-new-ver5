@extends('layouts.user.app')

@section('content')

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
          
          <img src="{{asset('img/banner.png')}}" class="img-fluid animated" alt="">
          
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img">
          <h2>Penghasilan, Atur Sendiri!</h2>
          <h1>Catch Your Dream</h1>
          
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row justify-content-between">
          <div class="col-lg-5 d-flex align-items-center justify-content-center about-img">
            <div class="button-income">
              <h2>Pilih cara untuk atur penghasilanmu!</h2>
             <a href="{{route ('user.kalkulator')}}"><button class="button-hitung" type="button">Hitung Sendiri</button><br></a>
              <a href="{{route ('user.package')}}"><button class="button-package" type="button">Lihat Paket yang tersedia</button></a>
          </div>
          </div>
          <div class="col-lg-6 pt-5 pt-lg-0">
            <img src="{{asset('img/income.png')}}" class="img-fluid" alt="" >
          </div>

          
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
      <div class="container">
        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="contact-text">
              <h2>Contact Us</h2>
              <i class="fa fa-phone circle-icon" style="font-size:32px ; color: #FF9029;" > <p> +12345678 </p></i> <br>
              <i class="fa fa-envelope circle-icon1" style="font-size:28px ; color: #FF9029;" > <p> loremipsum@gmail.com </p></i>
                 </div>

          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch" >
        
            <form action="{{ route('contact.store') }}" method="post" role="form" class="php-email-form">
              @csrf
              @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
              <h4> Any Questions?</h4>
                <p>Get in touch with us</p>
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="name">Your Name</label>
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="form-group col-md-6 mt-3 mt-md-0">
                  <label for="name">Your Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <label for="name">Subject</label>
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <label for="name">Message</label>
                <textarea class="form-control" name="message" rows="10" required></textarea>
              </div>
              
              <div class="text-center"><button type="submit">Send</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Us Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container py-4">
      <div class="copyright">
        &copy; 2023 by <strong><span>PT. Exa Mitra Solusi</span></strong>. 
      </div>
      
    </div>
  </footer><!-- End Footer -->

  @endsection