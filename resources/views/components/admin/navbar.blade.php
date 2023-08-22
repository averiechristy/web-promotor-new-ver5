<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion " style="background-color: white;" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <img src="{{asset('img/logoexa.png')}}" style="height: 40px;">
        
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" style="border-color: #01004C; border-radius: 5px;">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.dashboard.index')}}">
            <i class="fas fa-fw fa-tachometer-alt" style="color: #01004C"></i>
            <span style="color: #01004C">Dashboard</span></a>
    </li>


   <!-- Divider -->
    <hr class="sidebar-divider my-0" style="border-color: #01004C; border-radius: 5px;">
    

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.userrole.index')}}" data-toggle="" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-user" style="color: #01004C"></i>
            <span style="color: #01004C">User Role</span>
        </a>
        
    </li>

    <li class="nav-item">
        <a class="nav-link " href="{{route('admin.useraccount.index')}}" data-toggle="" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-address-card" style="color: #01004C"></i>
            <span style="color: #01004C">User Account</span>
        </a>
        
    </li>

    <li class="nav-item">
        <a class="nav-link " href="{{route('admin.product.index')}}" data-toggle="" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-box" style="color: #01004C"></i>
            <span style="color: #01004C">Product</span>
        </a>
        
    </li>

    <li class="nav-item">
        <a class="nav-link " href="{{route('admin.package.index')}}" data-toggle="" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-money-bill-wave-alt" style="color: #01004C"></i>
            <span style="color: #01004C">Package Income</span>
        </a>
        
    </li>

    <li class="nav-item">
        <a class="nav-link " href="{{route('admin.artikel.index')}}" data-toggle="" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="far fa-newspaper" style="color: #01004C"></i>
            <span style="color: #01004C">Article</span>
        </a>
        
    </li>

    <li class="nav-item">
        <a class="nav-link " href="{{route('admin.akses.index')}}" data-toggle="" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-key" style="color: #01004C"></i>
            <span style="color: #01004C">Akses</span>
        </a>
        
    </li>
    <!-- Nav Item - Utilities Collapse Menu -->
  

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" style="background-color: #01004C" id="sidebarToggle" >
    
    </button>
    </div>

  

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light  topbar mb-4 static-top shadow" style="background-color: #01004C;">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
          

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                        aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                    placeholder="Search for..." aria-label="Search"
                                    aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Nav Item - Alerts -->
               
             

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Welcome, Admin!</span>
                        <img class="img-profile rounded-circle"
                            src="{{asset('img/undraw_profile.svg')}}">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('admin.changepassword') }}">
                            <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                            Change Password
                        </a>
                       
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->