
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Exa Promoter</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logoexa.png" rel="icon">
  <link href="assets/img/logoexa.png" rel="">
  <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />

  <!-- Vendor CSS Files -->
  <link href="{{asset('vendor2/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('vendor2/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendor2/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('vendor2/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendor2/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendor2/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('css/style.css')}}" rel="stylesheet">

</head>

<body>

@include('components.user.header') 
   
@yield('content')


<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{asset('vendor/aos/aos.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/glightbox/js/glightbox.min.js')}}"></script>
<script src="{{asset('vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('vendor/swiper/swiper-bundle.min.js')}}"></script>
<script src="{{asset('vendor/php-email-form/validate.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Template Main JS File -->
<script src="{{asset('js/main.js')}}"></script>

<!-- Modal -->
<div class="modal fade" id="changeProfilePhotoModal" tabindex="-1" aria-labelledby="changeProfilePhotoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form action="{{route('update-avatar')}}" method="post" enctype="multipart/form-data">
    @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="changeProfilePhotoModalLabel">Change Profile Photo</h5>
                </div>
                <div class="modal-body">
                <input type="file" name="avatar">
                </div>
                <div class="modal-footer">   
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload Photo</button>
                </div>
            </form>
        </div>
    </div>
</div>


  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1 class="text-light"><a href="index.html"><span>

        <a class="nav-link scrollto" href="{{route('user.home')}}">  <img src="{{asset('img/logoexa.png')}}" alt=""  class="logo"> </a>
        </span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <!-- <li ><a class="nav-link scrollto" href="{{route('user.home')}}">Home</a></li> -->
          <!-- <li><a class="nav-link scrollto" href="#about">Income</a></li>
          <li><a class="nav-link scrollto" href="#article">Article</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact Us</a></li> -->
          
          <li> <span class="ml-8 d-none d-lg-inline text-gray-600 small">Welcome,  {{ Auth::user()->nama }}!</span></li>


        <li class="dropdown">
    <a href="#">
    @if(auth()->check() && auth()->user()->avatar)
    <span> <img src="{{ asset('img/' . auth()->user()->avatar) }}"  class="user"></span>
@else
<span> <img src="{{ asset('img/default.jpg') }}"  class="user"> </span>
@endif


        <i class="bi bi-chevron-down"></i>
    </a>
    <ul>
        <li><a href="#" data-toggle="modal" data-target="#changeProfilePhotoModal">Change Profile Photo</a></li>
        <li><a href="{{ route('edit-profile') }}">Edit Profile</a></li>
        <li><a href="{{ route('password-change-user') }}">Change Password</a></li>
        <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
        </li>
    </ul>
</li>

          
        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Edit Profil Section ======= -->
  <section id="edit-profil" class="edit-profil">
        <div class="container">
  
          <div class="row justify-content-between">
            <div class="col-lg-5 d-flex align-items-center justify-content-center about-img">
               
                <img src="{{asset('img/editprofil.png')}}" class="img-fluid" alt="" >
                
            </div>

            
            <div class="col-lg-6 pt-5 pt-lg-0">
            @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="button-income2">
            <form method="POST" action="{{ route('update-profile') }}" enctype="multipart/form-data">
        @csrf

          <div class="mb-3">
            <label for="name">Name</label>
            <input id="nama" type="text" name="nama" value="{{ $user->nama }}"style="width: 80%;" class="form-control">
            @if ($errors->has('nama'))
                                                    <p class="text-danger">{{$errors->first('nama')}}</p>
                                                @endif
        </div>

          <div class="mb-3">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ $user->email }}"style="width: 80%;" class="form-control" >
            @if ($errors->has('email'))
                                                    <p class="text-danger">{{$errors->first('email')}}</p>
                                                @endif
        </div>

          <div class="mb-3">
            <label for="phone_number">Phone Number</label>
            <input id="phone_number" type="number" name="phone_number" value="{{ $user->phone_number }}"style="width: 80%;" class="form-control">
            @if ($errors->has('phone_number'))
                                                    <p class="text-danger">{{$errors->first('phone_number')}}</p>
                                                @endif
          </div>

         

          <div class="mb-3">
            <button type="submit" class="btn-save me-md-2">Update Profile</button>
        </div>
    </form>
            </div>
  
            
          </div>
  
        </div>
      </section><!-- End Edit Profil Section -->
  


      </body>
</html>
