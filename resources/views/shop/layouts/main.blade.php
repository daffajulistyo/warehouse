<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- csrf token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('/css/fa.all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ url('/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/sim.css') }}">
    <!-- datatables -->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/datatables.min.css') }}">
    <!-- select2 BS4 -->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/select2-bootstrap4.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="{{ url('/css/googlefont.css') }}" rel="stylesheet">
  </head>
  <body class="hold-transition sidebar-mini layout-navbar-fixed">
  <!-- Site wrapper -->
    <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline" action="{{ url('/shop/search') }}" method="POST">
          @csrf
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" name="search" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Messages Dropdown Menu -->
          <a class="nav-link" href="{{ url('/orders') }}">
            <i class="fas fa-clipboard-list"></i>
          </a>
          <!-- Notifications Dropdown Menu -->
          <a class="nav-link" href="{{ url('/cart') }}">
            <i class="fas fa-shopping-cart"></i>
            <span class="badge badge-warning navbar-badge">{{ $cart_count }}</span>
          </a>
        </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ url('/') }}" class="brand-link">
          <img src="{{ url('img/sites_img/site_logo.png') }}" alt="Mentari Logo" class="brand-image">
          <span class="brand-text font-weight-light">Mentari Katalog</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="{{ url('img/sites_img/user_pic.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
            <div class="info">
              <a class="btn btn-danger btn-sm" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
          </div>

          <!-- Sidebar Menu -->
          @yield('sidebar')
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>@yield('title')</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  @yield('breadcrumb')
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        @yield('content')
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
          <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2020 Archie Cakra.</strong> All rights
        reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{ url('/js/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ url('/js/bootstrap.bundle.min.js') }}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ url('/js/jquery.overlayScrollbars.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ url('/js/adminlte.min.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ url('/js/demo.js') }}"></script>
  <!-- Select2 BS4 -->
  <script src="{{ url('/js/select2.full.min.js') }}"></script>
  <!-- datatables -->
  <script type="text/javascript" src="{{ url('/js/datatables.min.js') }}"></script>
  <!-- my custom script -->
  <script>
    
    $('.alert').delay(1000).fadeOut(1000);
    $('.card').hide();
    $('.card').fadeIn(1000);
    // $(document).ready(function() {
    //   var table = $('#datatable').DataTable();
    // });
    var table = $('#datatable').DataTable();
    $('.select2').select2({
      theme: 'bootstrap4'
    });
  </script>
  @yield('js')
  </body>
</html>
