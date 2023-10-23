@extends('layouts.user.app2')

@section('content2')


<main id="main">
    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact d-flex align-items-center">
      <div class="container">
        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="contact-text">
              <h2>Contact Us</h2>
              <i class="fa fa-envelope circle-icon1" style="font-size:28px ; color: #FF9029;" > <p> loremipsum@gmail.com </p></i>
                 </div>

          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch" >
       

            <form action="{{route('contact.simpan')}}" method="post" role="form" class="php-email-form rounded">
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
                  <label for="name">Nama</label>
                  <input type="text" name="name" class="form-control" id="name" value=" {{ Auth::user()->nama }}" disabled >
                  <!-- @if ($errors->has('name'))
                                                    <p class="text-danger">{{$errors->first('name')}}</p>
                                                @endif -->
                </div>
                <div class="form-group col-md-6 mt-3 mt-md-0">
                  <label for="name">Email</label>
                  <input type="email" class="form-control" name="email" id="email" value=" {{ Auth::user()->email}}" disabled>
                  <!-- @if ($errors->has('email'))
                                                    <p class="text-danger">{{$errors->first('email')}}</p>
                                                @endif -->
                </div>
              </div>
              <div class="form-group mt-3">
                <label for="name">Subject</label>
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                @if ($errors->has('subject'))
                                                    <p class="text-danger">{{$errors->first('subject')}}</p>
                                                @endif
              </div>
            <div class="form-group mt-3">
    <label for="name">Message</label>
    <textarea class="form-control" name="message" rows="10"></textarea>
    @if ($errors->has('message'))
        <p class="text-danger">{{$errors->first('message')}}</p>
    @endif
</div>

              
              <div class="text-center">
                <button type="submit" >Send</button></div>
            </form>
          </div>
        </div>

      </div>
    </section><!-- End Contact Us Section -->

    </main><!-- End #main -->

    

@endsection
