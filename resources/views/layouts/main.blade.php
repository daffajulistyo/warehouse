<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <!-- Tempus dominus datepicker -->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/tempusdominus-bootstrap-4.css') }}">
    <!-- Chart js -->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/chart.css') }}">
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
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
        <ul class="nav navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell fa-lg"></i>
              @if (count(App\Models\Item::where('stok', '<', '10')->get())<1)
              @else
                <span class="badge badge-danger navbar-badge" style="font-size: 1em;">{{ count(App\Models\Item::where('stok', '<', '10')->get()) }}</span>
              @endif
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <span class="dropdown-header">Notifikasi</span>
              @foreach (App\Models\Item::where('stok', '<', '10')->get() as $item)
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item text-danger">
                <i class="fas fa-exclamation mr-2"></i> Stok {{ $item->nama }}
                <span class="float-right font-weight-bold text-sm">tersisa {{ $item->stok }}</span>
              </a>
              <div class="dropdown-divider"></div>
              @endforeach
            </div>
          </li>
        </ul>

        <!-- SEARCH FORM -->

        <!-- Right navbar links -->
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-light-info   elevation-4">
        <!-- Brand Logo -->
        <a href="{{ url('/') }}" class="brand-link">
          <span class="brand-text font-weight-light">Warehaouse PT.X</span>
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
              <a class="btn btn-warning btn-sm" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
          </div>

          <!-- Sidebar Menu -->

          @switch(Auth::user()->role)
              @case('admin')
              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                  <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link {{ (request()->is('*dashboard')) ? 'active' : ''}}">
                      <i class="nav-icon fas fa-home"></i>
                      <p>
                        Dashboard
                      </p>
                    </a>
                  </li>
                  {{-- <li class="nav-header text-center nav-header-top"><h6 class="bg-secondary nav-header-title">Manajemen Stok</h6></li> --}}
                  <li class="nav-item has-treeview {{ (request()->is('*items*') && request()->segment(2) != 'purchases' && request()->segment(2) != 'mutations') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{ (request()->is('*items*') && request()->segment(2) != 'purchases' && request()->segment(2) != 'mutations') ? 'active' : ''}}">
                      <i class="nav-icon fas fa-box"></i>
                      <p>
                        Material
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ url('/items/create') }}" class="nav-link {{ request()->is('*items/create') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Material</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/items') }}" class="nav-link {{ request()->is('*items') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Material</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/items/categories') }}" class="nav-link {{ request()->is('*items/categories') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Kategori</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/items/units') }}" class="nav-link {{ request()->is('*items/units') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Satuan</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview {{ (request()->is('*purchases*')) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{ (request()->is('*purchases*')) ? 'active' : ''}}">
                      <i class="nav-icon fas fa-gifts"></i>
                      <p>
                         Purchase Requisition
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ url('/items/purchases/create') }}" class="nav-link {{ request()->is('*items/purchases/create') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Pembelian</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/items/purchases') }}" class="nav-link {{ request()->is('*items/purchases') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Pembelian</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview {{ (request()->is('*mutations*')) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{ (request()->is('*mutations*')) ? 'active' : ''}}">
                      <i class="nav-icon fas fa-history"></i>
                      <p>
                        Mutasi Stok
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ url('/items/mutations/create') }}" class="nav-link {{ request()->is('*items/mutations/create') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Mutasi Stok</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/items/mutations') }}" class="nav-link {{ request()->is('*items/mutations') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Mutasi</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview {{ (request()->is('*supplier*')) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{ (request()->is('*supplier*')) ? 'active' : ''}}">
                      <i class="nav-icon fas fa-people-carry"></i>
                      <p>
                        Supplier
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ url('/suppliers/create') }}" class="nav-link {{ (request()->is('*suppliers/create')) ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Supplier</p>
                        </a>
                        
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/suppliers') }}" class="nav-link {{ (request()->is('*suppliers')) ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Supplier</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview {{ (request()->is('*sales*')) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{ (request()->is('*sales*')) ? 'active' : ''}}">
                      <i class="nav-icon fas fa-shopping-cart"></i>
                      <p>
                        Transaksi Penjualan
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                      <a href="{{ url('/sales/create') }}" class="nav-link {{ request()->is('*sales/create') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Penjualan</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/sales') }}" class="nav-link {{ request()->is('*sales') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Penjualan</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview {{ (request()->is('*customers*')) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{ (request()->is('*customers*')) ? 'active' : ''}}">
                      <i class="nav-icon fas fa-users"></i>
                      <p>
                        Pelanggan
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ url('/customers/create') }}" class="nav-link {{ (request()->is('*customers/create')) ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Pelanggan</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/customers') }}" class="nav-link {{ (request()->is('*customers')) ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Pelanggan</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview {{ (request()->is('*employees*')) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{ (request()->is('*employees*')) ? 'active' : ''}}">
                      <i class="nav-icon fas fa-user-tie"></i>
                      <p>
                        User
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ url('/employees/create') }}" class="nav-link {{ (request()->is('*employees/create')) ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah User</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/employees') }}" class="nav-link {{ (request()->is('*employees')) ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola User</p>
                        </a>
                      </li>
                    </ul>
                  </li>

                </ul>
              </nav>
                  @break
              @case('admin')
              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                  <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link {{ (request()->is('*dashboard')) ? 'active' : ''}}">
                      <i class="nav-icon fas fa-home"></i>
                      <p>
                        Dashboard
                      </p>
                    </a>
                  </li>
                  <li class="nav-header text-center nav-header-top"><h6 class="bg-secondary nav-header-title">Penjualan</h6></li>
                  <li class="nav-item has-treeview {{ (request()->is('*sales*')) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{ (request()->is('*sales*')) ? 'active' : ''}}">
                      <i class="nav-icon fas fa-shopping-cart"></i>
                      <p>
                        Transaksi Penjualan
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                      <a href="{{ url('/sales/create') }}" class="nav-link {{ request()->is('*sales/create') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Penjualan</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/sales') }}" class="nav-link {{ request()->is('*sales') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Penjualan</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview {{ (request()->is('*customers*')) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{ (request()->is('*customers*')) ? 'active' : ''}}">
                      <i class="nav-icon fas fa-users"></i>
                      <p>
                        Pelanggan
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ url('/customers/create') }}" class="nav-link {{ (request()->is('*customers/create')) ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Pelanggan</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/customers') }}" class="nav-link {{ (request()->is('*customers')) ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Pelanggan</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-header text-center nav-header-top"><h6 class="bg-secondary nav-header-title">Manajemen Toko</h6></li>
                  <li class="nav-item has-treeview {{ (request()->is('*reports*')) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{ (request()->is('*reports*')) ? 'active' : ''}}">
                      <i class="nav-icon fas fa-clipboard-list"></i>
                      <p>
                        Laporan
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ url('/reports/purchase') }}" class="nav-link {{ (request()->is('*reports/purchase')) ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Laporan Pembelian</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/reports/sale') }}" class="nav-link {{ (request()->is('*reports/sale')) ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Laporan Penjualan</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/reports/stock') }}" class="nav-link {{ (request()->is('*reports/stock')) ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Laporan Stok</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </nav>
                  @break
              @case('warehouse_manager')
              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                  <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link {{ (request()->is('*dashboard')) ? 'active' : ''}}">
                      <i class="nav-icon fas fa-home"></i>
                      <p>
                        Dashboard
                      </p>
                    </a>
                  </li>

                  <li class="nav-header text-center nav-header-top"><h6 class="bg-secondary nav-header-title">Manajemen Stok</h6></li>
                  <li class="nav-item has-treeview {{ (request()->is('*items*') && request()->segment(2) != 'purchases' && request()->segment(2) != 'mutations') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{ (request()->is('*items*') && request()->segment(2) != 'purchases' && request()->segment(2) != 'mutations') ? 'active' : ''}}">
                      <i class="nav-icon fas fa-box"></i>
                      <p>
                        Material
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ url('/items/create') }}" class="nav-link {{ request()->is('*items/create') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Material</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/items') }}" class="nav-link {{ request()->is('*items') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Material</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/items/categories') }}" class="nav-link {{ request()->is('*items/categories') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Kategori</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/items/units') }}" class="nav-link {{ request()->is('*items/units') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Satuan</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview {{ (request()->is('*purchases*')) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{ (request()->is('*purchases*')) ? 'active' : ''}}">
                      <i class="nav-icon fas fa-gifts"></i>
                      <p>
                         Purchase Requisition
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ url('/items/purchases/create') }}" class="nav-link {{ request()->is('*items/purchases/create') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Pembelian</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/items/purchases') }}" class="nav-link {{ request()->is('*items/purchases') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Pembelian</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview {{ (request()->is('*mutations*')) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{ (request()->is('*mutations*')) ? 'active' : ''}}">
                      <i class="nav-icon fas fa-history"></i>
                      <p>
                        Mutasi Stok
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ url('/items/mutations/create') }}" class="nav-link {{ request()->is('*items/mutations/create') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Mutasi Stok</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/items/mutations') }}" class="nav-link {{ request()->is('*items/mutations') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Mutasi</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview {{ (request()->is('*supplier*')) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{ (request()->is('*supplier*')) ? 'active' : ''}}">
                      <i class="nav-icon fas fa-people-carry"></i>
                      <p>
                        Supplier
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ url('/suppliers/create') }}" class="nav-link {{ (request()->is('*suppliers/create')) ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Supplier</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/suppliers') }}" class="nav-link {{ (request()->is('*suppliers')) ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Supplier</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-header text-center nav-header-top"><h6 class="bg-secondary nav-header-title">Manajemen Toko</h6></li>
                  <li class="nav-item has-treeview {{ (request()->is('*reports*')) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{ (request()->is('*reports*')) ? 'active' : ''}}">
                      <i class="nav-icon fas fa-clipboard-list"></i>
                      <p>
                        Laporan
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ url('/reports/purchase') }}" class="nav-link {{ (request()->is('*reports/purchase')) ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Laporan Pembelian</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/reports/sale') }}" class="nav-link {{ (request()->is('*reports/sale')) ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Laporan Penjualan</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/reports/stock') }}" class="nav-link {{ (request()->is('*reports/stock')) ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Laporan Stok</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </nav>
                  @break
              @case('warehouse_staff')
              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                  <li class="nav-header text-center nav-header-top"><h6 class="bg-secondary nav-header-title">Manajemen Stok</h6></li>
                  <li class="nav-item has-treeview {{ (request()->is('*items*') && request()->segment(2) != 'purchases' && request()->segment(2) != 'mutations') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{ (request()->is('*items*') && request()->segment(2) != 'purchases' && request()->segment(2) != 'mutations') ? 'active' : ''}}">
                      <i class="nav-icon fas fa-box"></i>
                      <p>
                        Material
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ url('/items/create') }}" class="nav-link {{ request()->is('*items/create') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Material</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/items') }}" class="nav-link {{ request()->is('*items') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Material</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/items/categories') }}" class="nav-link {{ request()->is('*items/categories') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Kategori</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/items/units') }}" class="nav-link {{ request()->is('*items/units') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Satuan</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview {{ (request()->is('*mutations*')) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{ (request()->is('*mutations*')) ? 'active' : ''}}">
                      <i class="nav-icon fas fa-history"></i>
                      <p>
                        Mutasi Stok
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ url('/items/mutations/create') }}" class="nav-link {{ request()->is('*items/mutations/create') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Mutasi Stok</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/items/mutations') }}" class="nav-link {{ request()->is('*items/mutations') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Mutasi</p>
                        </a>
                      </li>
                    </ul>
                  </li>

                </ul>
              </nav>
                  @break
                  @case('warehouse_supervisor')
              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                  <li class="nav-header text-center nav-header-top"><h6 class="bg-secondary nav-header-title">Manajemen Stok</h6></li>
                  <li class="nav-item has-treeview {{ (request()->is('*items*') && request()->segment(2) != 'purchases' && request()->segment(2) != 'mutations') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{ (request()->is('*items*') && request()->segment(2) != 'purchases' && request()->segment(2) != 'mutations') ? 'active' : ''}}">
                      <i class="nav-icon fas fa-box"></i>
                      <p>
                        Material
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ url('/items/create') }}" class="nav-link {{ request()->is('*items/create') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Material</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/items') }}" class="nav-link {{ request()->is('*items') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Material</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/items/categories') }}" class="nav-link {{ request()->is('*items/categories') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Kategori</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/items/units') }}" class="nav-link {{ request()->is('*items/units') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Satuan</p>
                        </a>
                      </li>
                    </ul>
                  </li>

                </ul>
              </nav>
                  @break
              @case('staff_procurement')
              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                  <li class="nav-item">
                    <a href="{{ url('/items') }}" class="nav-link {{ request()->is('*items') ? 'active' : ''}}">
                      <i class="nav-icon fas fa-box"></i>
                      <p>Material Data</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('/items/create') }}" class="nav-link {{ request()->is('*items/create') ? 'active' : ''}}">
                      <i class="nav-icon fas fa-box"></i>
                      <p>Input Material</p>
                    </a>
                  </li>

                </ul>
              </nav>
                  @break
                  @case('procurement_manager')
              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                  <li class="nav-item">
                    <a href="{{ url('/items') }}" class="nav-link {{ request()->is('*items') ? 'active' : ''}}">
                      <i class="nav-icon fas fa-box"></i>
                      <p>Material Data</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('/items/create') }}" class="nav-link {{ request()->is('*items/create') ? 'active' : ''}}">
                      <i class="nav-icon fas fa-box"></i>
                      <p>Input Material</p>
                    </a>
                  </li>
                  <li class="nav-item has-treeview {{ (request()->is('*purchases*')) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{ (request()->is('*purchases*')) ? 'active' : ''}}">
                      <i class="nav-icon fas fa-gifts"></i>
                      <p>
                         Purchase Requisition
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ url('/items/purchases/create') }}" class="nav-link {{ request()->is('*items/purchases/create') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Pembelian</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/items/purchases') }}" class="nav-link {{ request()->is('*items/purchases') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Pembelian</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview {{ (request()->is('*mutations*')) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{ (request()->is('*mutations*')) ? 'active' : ''}}">
                      <i class="nav-icon fas fa-history"></i>
                      <p>
                        Mutasi Stok
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ url('/items/mutations/create') }}" class="nav-link {{ request()->is('*items/mutations/create') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Mutasi Stok</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/items/mutations') }}" class="nav-link {{ request()->is('*items/mutations') ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Mutasi</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview {{ (request()->is('*supplier*')) ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{ (request()->is('*supplier*')) ? 'active' : ''}}">
                      <i class="nav-icon fas fa-people-carry"></i>
                      <p>
                        Supplier
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ url('/suppliers/create') }}" class="nav-link {{ (request()->is('*suppliers/create')) ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Supplier</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('/suppliers') }}" class="nav-link {{ (request()->is('*suppliers')) ? 'active' : ''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Supplier</p>
                        </a>
                      </li>
                    </ul>
                  </li>

                </ul>
              </nav>
                  @break
              @default

          @endswitch
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
  <!-- tempusdominus -->
  <script type="text/javascript" src="{{ url('/js/moment.js') }}"></script>
  <script type="text/javascript" src="{{ url('/js/tempusdominus-bootstrap-4.js') }}"></script>
  <!-- Chart js -->
  <script type="text/javascript" src="{{ url('/js/chart.js') }}"></script>
  <!-- my custom script -->
  <script>

    $('.alert').delay(1000).fadeOut(1000);
    $('.card').hide();
    $('.card').fadeIn(1000);
    // $(document).ready(function() {
    //   var table = $('#datatable').DataTable();
    // });
    // var table = $('#datatable').DataTable();
    $('.select2').select2({
      theme: 'bootstrap4'
    });
  </script>
  @yield('js')
  </body>
</html>
