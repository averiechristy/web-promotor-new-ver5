@extends('layouts.user.app2')

@section('content2')


<main id="main">
    <!-- ======= Contact Us Section ======= -->
    <section id="contact" style ="background-color : #FEF8F5;" class="contact">
      <div class="container" >
        <div class="section-title">
          <h3>Contact Us</h3>
          <p>Informasi lebih lanjut hubungi kami</p>
        </div>

        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch" >
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Lokasi :</h4>
                <p>PT. Exa Mitra Solusi, Jl. ABCD no 23</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>info@example.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>+123456</p>
              </div>

              <iframe src="https://maps.google.com/maps?q=PT.%20exa%20mitra%20solusi&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed" frameborder="0" scrolling="no" style="width: 470px; height: 400px;"></iframe>            
            
              </div>

          </div>

        

        </div>

      </div>
    </section><!-- End Contact Us Section -->

    </main><!-- End #main -->

    

@endsection
