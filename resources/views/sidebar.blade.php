<?php 
  use Illuminate\Support\Str;

?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/admin_dash" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin_dash" class="brand-link">
      {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
      <span style="margin-left: 0px font-size: 15px;" class="brand-text font-weight-dark"><strong>Saptak Filling Station</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Str::ucfirst(Session::get('user')['name'])}}</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="/admin_dash" class="nav-link active">
              <h2><i style="font-size: 130%" class="nav-icon ion ion-calculator">  Billing</i></h2>
            </a>
          </li>
        </li>   
        <br>
        <li class="nav-item">
          <a href="/stock" class="nav-link active">
            <h2><i style="font-size: 130%" class="nav-icon ion ion-podium">  Stocks</i></h2>
          </a>
        </li>
        <br>
          <li class="nav-item">
            <a href="/oil_price" class="nav-link active">
              <h2><i style="font-size: 130%" class="nav-icon ion ion-flame">  Oil Price</i></h2>
            </a>
          </li>
          <br>
          <li class="nav-item">
            <a href="/reports" class="nav-link active">
              <h2><i style="font-size: 130%" class="nav-icon ion ion-podium">  Reports</i></h2>
            </a>
        </ul>
            <li class="nav-item">
              <a href="/logout" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt">  Logout</i>
              </a>
            </li>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</div>
