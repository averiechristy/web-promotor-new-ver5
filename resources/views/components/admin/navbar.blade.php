<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion " style="background-color: white;" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.dashboard.index')}}">
        <img src="{{asset('img/logoexa.png')}}" style="height: 40px;">
        
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" style="border-color: #01004C; border-radius: 5px;">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('admin/dashboard/index') ? 'active' : '' }} ">
        <a class="nav-link" href="{{route('admin.dashboard.index')}}">
            <i class="fas fa-fw fa-tachometer-alt" style="color: #01004C"></i>
            <span style="color: #01004C">Dashboard</span></a>
    </li>


   <!-- Divider -->
    <hr class="sidebar-divider my-0" style="border-color: #01004C; border-radius: 5px;">
    

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('admin/userrole/index') || Request::is('admin/userrole/create') || Request::is('/tampildata/{id}') ? 'active' : '' }} ">
        <a class="nav-link" href="{{route('admin.userrole.index')}}" data-toggle="" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-user" style="color: #01004C"></i>
            <span style="color: #01004C">User Role</span>
        </a>
        
    </li>

    <li class="nav-item {{ Request::is('admin/useraccount/index') || Request::is('admin/useraccount/create') ? 'active' : '' }}">
        <a class="nav-link " href="{{route('admin.useraccount.index')}}" data-toggle="" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-address-card" style="color: #01004C"></i>
            <span style="color: #01004C">User Account</span>
        </a>
        
    </li>

    <li class="nav-item {{ Request::is('admin/product/index') || Request::is('admin/product/create') ? 'active' : '' }}">
        <a class="nav-link " href="{{route('admin.product.index')}}" data-toggle="" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-box" style="color: #01004C"></i>
            <span style="color: #01004C">Product</span>
        </a>
        
    </li>

    <li class="nav-item {{ Request::is('admin/package/index') || Request::is('admin/package/create')  ? 'active' : '' }}">
        <a class="nav-link " href="{{route('admin.package.index')}}" data-toggle="" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-money-bill-wave-alt" style="color: #01004C"></i>
            <span style="color: #01004C">Package Income</span>
        </a>
        
    </li>

    <li class="nav-item {{ Request::is('admin/artikel/index') || Request::is('admin/artikel/create')  ? 'active' : '' }}">
        <a class="nav-link " href="{{route('admin.artikel.index')}}" data-toggle="" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="far fa-newspaper" style="color: #01004C"></i>
            <span style="color: #01004C">News</span>
        </a>
        
    </li>

    <li class="nav-item {{ Request::is('admin/reward/index')  || Request::is('admin/reward/create')  ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.reward.index') }}" data-toggle="" data-target="#collapseContact"
                aria-expanded="true" aria-controls="collapseContact">
                <i class="fa fa-star" style="color: #01004C"></i>
                <span style="color: #01004C">Reward</span>
               
            </a>
        </li>

    <li class="nav-item {{ Request::is('admin/leaderboard/index')  ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.leaderboard.index') }}" data-toggle="" data-target="#collapseContact"
                aria-expanded="true" aria-controls="collapseContact">
                <i class="fa fa-trophy" style="color: #01004C"></i>
                <span style="color: #01004C">Data Pencapaian</span>
               
            </a>
        </li>
    <!-- Nav Item - Utilities Collapse Menu -->

    <li class="nav-item">
    <a class="nav-link collapsed" href="#collapseTwo" data-toggle="collapse" aria-expanded="false">
        <i class="fa fa-file" style="color: #01004C"></i>
        <span style="color: #01004C">Report</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ Request::is('admin/reportleaderboardtahun') ? 'active' : '' }}" href="{{route('admin.reportleaderboardtahun')}}">Leaderboard Tahun Lalu</a>
            <a class="collapse-item {{ Request::is('admin/reportleaderboardakumulasi') ? 'active' : '' }}" href="{{route('admin.reportleaderboardakumulasi')}}">Leaderboard Akumulasi</a>
            <a class="collapse-item {{ Request::is('admin/reporthistoryreward') ? 'active' : '' }}" href="{{route('admin.reporthistoryreward')}}">History Reward</a>
        </div>
    </div>
</li>

<script>
$(document).ready(function () {
    // Mengambil URL saat ini
    var currentUrl = window.location.href;

    // Mengecek apakah URL saat ini sesuai dengan URL menu Report
    if (currentUrl.includes('/admin/report')) {
        // Jika sesuai, tambahkan class 'show' ke elemen collapse
        $('#collapseTwo').addClass('show');
    }
});
</script>


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
                        <span class="mr-2 d-none d-lg-inline text-white-100 ">Welcome,  {{ Auth::user()->nama }}!</span>
                        <img class="img-profile rounded-circle"
                            src="{{asset('img/undraw_profile.svg')}}">
                            
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('password') }}">
                            <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                            Ubah Password
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
        