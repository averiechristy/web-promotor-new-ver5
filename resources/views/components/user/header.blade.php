  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1 class="text-light"><a href="index.html"><span>

          <img src="{{asset('img/logoexa.png')}}" alt=""  class="logo">
        </span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="home">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">Income</a></li>
          <li><a class="" href="artikel">Article</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact Us</a></li>
          
          <li class="dropdown"><a href="#"><span><img src="{{asset('img/profil.png')}}" class="user"></span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="editprofil">Edit Profile</a></li>
              <li><a href="changepassword">Change Password</a></li>
              <li><a href="login.html">Logout</a></li>
             
            </ul>
          </li>
          
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->