  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1 class="text-light"><a href="index.html"><span>

        <a class="nav-link scrollto" href="{{route('user.home')}}"><img src="{{asset('img/logoexa.png')}}" alt=""  class="logo"></a>
        </span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <!-- <li ><a class="nav-link scrollto" href="{{route('user.home')}}">Home</a></li> -->
          <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      Income
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
      <li><a class=" {{ Request::is('user/kalkulator') ? 'active' : '' }} " href="{{route ('user.kalkulator')}}">Simulasi Pendapatan</a></li>
      
      <li><a class=" {{ Request::is('user/package') ? 'active' : '' }} " href="{{route ('user.package')}}">Paket Pendapatan</a></li>
     
      <li><a class=" {{ Request::is('user/paketkalkulator') ? 'active' : '' }} " href="{{route ('paketkalkulator')}}">Simulasi Impianmu</a></li>

    </ul>
  </li>      
  
  <li><a class="nav-link scrollto  {{ Request::is('user/artikel') ? 'active' : '' }} " href="{{route('user.artikel')}}">News</a></li>
  <!-- <li><a class="nav-link scrollto  {{ Request::is('user/reward') ? 'active' : '' }} " href="{{route('user.reward')}}">Reward</a></li> -->

  <li><a class="nav-link scrollto  {{ Request::is('user/leaderboard') ? 'active' : '' }} " href="{{route('user.leaderboard')}}">Leaderboard</a></li>
          <!-- <li><a class="nav-link scrollto  {{ Request::is('user/contact-us') ? 'active' : '' }} " href="{{route('user.contact')}}">Contact Us</a></li> -->
          
          <li><p class="nav-link scrollto" style="margin-top:13px; margin-left:13px;" >Welcome,  {{ Auth::user()->nama }}!</p></li>


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
    <li><a class="{{ Request::is('user/userdashboard') ? 'active' : '' }} " href="{{ route('user.userdashboard') }}">Dashboard Saya</a></li>


        <li><a class="{{ Request::is('user/editprofil') ? 'active' : '' }} " href="{{ route('edit-profile') }}">Edit Profile</a></li>
        <li><a  class="{{ Request::is('user/changepassword') ? 'active' : '' }} " href="{{ route('password-change-user') }}">Change Password</a></li>
        <li>
            <a href="#" data-toggle="modal" data-target="#logoutModal">
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