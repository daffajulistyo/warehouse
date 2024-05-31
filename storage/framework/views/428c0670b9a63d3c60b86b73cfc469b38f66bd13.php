<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(url('/css/fa.all.min.css')); ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo e(url('/css/OverlayScrollbars.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(url('/css/adminlte.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('/css/sim.css')); ?>">
    <!-- datatables -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('/css/datatables.min.css')); ?>">
    <!-- select2 BS4 -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('/css/select2.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('/css/select2-bootstrap4.min.css')); ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="<?php echo e(url('/css/googlefont.css')); ?>" rel="stylesheet">
    <!-- Tempus dominus datepicker -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('/css/tempusdominus-bootstrap-4.css')); ?>">
    <!-- Chart js -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('/css/chart.css')); ?>">
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
              <?php if(count(App\Models\Item::where('stok', '<', '10')->get())<1): ?>
              <?php else: ?>
                <span class="badge badge-danger navbar-badge" style="font-size: 1em;"><?php echo e(count(App\Models\Item::where('stok', '<', '10')->get())); ?></span>
              <?php endif; ?>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <span class="dropdown-header">Notifikasi</span>
              <?php $__currentLoopData = App\Models\Item::where('stok', '<', '10')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item text-danger">
                <i class="fas fa-exclamation mr-2"></i> Stok <?php echo e($item->nama); ?>

                <span class="float-right font-weight-bold text-sm">tersisa <?php echo e($item->stok); ?></span>
              </a>
              <div class="dropdown-divider"></div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        <a href="<?php echo e(url('/')); ?>" class="brand-link">
          <span class="brand-text font-weight-light">Warehaouse PT.X</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="<?php echo e(url('img/sites_img/user_pic.jpg')); ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block"><?php echo e(Auth::user()->name); ?></a>
            </div>
            <div class="info">
              <a class="btn btn-warning btn-sm" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <?php echo e(__('Logout')); ?>

              </a>
              <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                <?php echo csrf_field(); ?>
              </form>
            </div>
          </div>

          <!-- Sidebar Menu -->

          <?php switch(Auth::user()->role):
              case ('super_admin'): ?>
              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                  <li class="nav-item">
                    <a href="<?php echo e(url('/')); ?>" class="nav-link <?php echo e((request()->is('*dashboard')) ? 'active' : ''); ?>">
                      <i class="nav-icon fas fa-home"></i>
                      <p>
                        Dashboard
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo e(url('/items')); ?>" class="nav-link <?php echo e(request()->is('*items') ? 'active' : ''); ?>">
                      <i class="nav-icon fas fa-box"></i>
                      <p>Material Data</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo e(url('/items/create')); ?>" class="nav-link <?php echo e(request()->is('*items/create') ? 'active' : ''); ?>">
                      <i class="nav-icon fas fa-box"></i>
                      <p>Input Material</p>
                    </a>
                  </li>

                  <li class="nav-item has-treeview <?php echo e((request()->is('*items*') && request()->segment(2) != 'purchases' && request()->segment(2) != 'mutations') ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e((request()->is('*items*') && request()->segment(2) != 'purchases' && request()->segment(2) != 'mutations') ? 'active' : ''); ?>">
                      <i class="nav-icon fas fa-box"></i>
                      <p>
                        Material
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">


                      <li class="nav-item">
                        <a href="<?php echo e(url('/items/categories')); ?>" class="nav-link <?php echo e(request()->is('*items/categories') ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Kategori</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo e(url('/items/units')); ?>" class="nav-link <?php echo e(request()->is('*items/units') ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Satuan</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview <?php echo e((request()->is('*purchases*')) ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e((request()->is('*purchases*')) ? 'active' : ''); ?>">
                      <i class="nav-icon fas fa-gifts"></i>
                      <p>
                        Pembelian Material
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="<?php echo e(url('/items/purchases/create')); ?>" class="nav-link <?php echo e(request()->is('*items/purchases/create') ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Pembelian</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo e(url('/items/purchases')); ?>" class="nav-link <?php echo e(request()->is('*items/purchases') ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Pembelian</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview <?php echo e((request()->is('*mutations*')) ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e((request()->is('*mutations*')) ? 'active' : ''); ?>">
                      <i class="nav-icon fas fa-history"></i>
                      <p>
                        Mutasi Stok
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="<?php echo e(url('/items/mutations/create')); ?>" class="nav-link <?php echo e(request()->is('*items/mutations/create') ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Mutasi Stok</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo e(url('/items/mutations')); ?>" class="nav-link <?php echo e(request()->is('*items/mutations') ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Mutasi</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview <?php echo e((request()->is('*supplier*')) ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e((request()->is('*supplier*')) ? 'active' : ''); ?>">
                      <i class="nav-icon fas fa-people-carry"></i>
                      <p>
                        Supplier
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="<?php echo e(url('/suppliers/create')); ?>" class="nav-link <?php echo e((request()->is('*suppliers/create')) ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Supplier</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo e(url('/suppliers')); ?>" class="nav-link <?php echo e((request()->is('*suppliers')) ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Supplier</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview <?php echo e((request()->is('*sales*')) ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e((request()->is('*sales*')) ? 'active' : ''); ?>">
                      <i class="nav-icon fas fa-shopping-cart"></i>
                      <p>
                        Transaksi Penjualan
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                      <a href="<?php echo e(url('/sales/create')); ?>" class="nav-link <?php echo e(request()->is('*sales/create') ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Penjualan</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo e(url('/sales')); ?>" class="nav-link <?php echo e(request()->is('*sales') ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Penjualan</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview <?php echo e((request()->is('*customers*')) ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e((request()->is('*customers*')) ? 'active' : ''); ?>">
                      <i class="nav-icon fas fa-users"></i>
                      <p>
                        Pelanggan
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="<?php echo e(url('/customers/create')); ?>" class="nav-link <?php echo e((request()->is('*customers/create')) ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Pelanggan</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo e(url('/customers')); ?>" class="nav-link <?php echo e((request()->is('*customers')) ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Pelanggan</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview <?php echo e((request()->is('*employees*')) ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e((request()->is('*employees*')) ? 'active' : ''); ?>">
                      <i class="nav-icon fas fa-user-tie"></i>
                      <p>
                        User
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="<?php echo e(url('/employees/create')); ?>" class="nav-link <?php echo e((request()->is('*employees/create')) ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah User</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo e(url('/employees')); ?>" class="nav-link <?php echo e((request()->is('*employees')) ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola User</p>
                        </a>
                      </li>
                    </ul>
                  </li>

                </ul>
              </nav>
                  <?php break; ?>
              <?php case ('admin'): ?>
              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                  <li class="nav-item">
                    <a href="<?php echo e(url('/')); ?>" class="nav-link <?php echo e((request()->is('*dashboard')) ? 'active' : ''); ?>">
                      <i class="nav-icon fas fa-home"></i>
                      <p>
                        Dashboard
                      </p>
                    </a>
                  </li>
                  <li class="nav-header text-center nav-header-top"><h6 class="bg-secondary nav-header-title">Penjualan</h6></li>
                  <li class="nav-item has-treeview <?php echo e((request()->is('*sales*')) ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e((request()->is('*sales*')) ? 'active' : ''); ?>">
                      <i class="nav-icon fas fa-shopping-cart"></i>
                      <p>
                        Transaksi Penjualan
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                      <a href="<?php echo e(url('/sales/create')); ?>" class="nav-link <?php echo e(request()->is('*sales/create') ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Penjualan</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo e(url('/sales')); ?>" class="nav-link <?php echo e(request()->is('*sales') ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Penjualan</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview <?php echo e((request()->is('*customers*')) ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e((request()->is('*customers*')) ? 'active' : ''); ?>">
                      <i class="nav-icon fas fa-users"></i>
                      <p>
                        Pelanggan
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="<?php echo e(url('/customers/create')); ?>" class="nav-link <?php echo e((request()->is('*customers/create')) ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Pelanggan</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo e(url('/customers')); ?>" class="nav-link <?php echo e((request()->is('*customers')) ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Pelanggan</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-header text-center nav-header-top"><h6 class="bg-secondary nav-header-title">Manajemen Toko</h6></li>
                  <li class="nav-item has-treeview <?php echo e((request()->is('*reports*')) ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e((request()->is('*reports*')) ? 'active' : ''); ?>">
                      <i class="nav-icon fas fa-clipboard-list"></i>
                      <p>
                        Laporan
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="<?php echo e(url('/reports/purchase')); ?>" class="nav-link <?php echo e((request()->is('*reports/purchase')) ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Laporan Pembelian</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo e(url('/reports/sale')); ?>" class="nav-link <?php echo e((request()->is('*reports/sale')) ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Laporan Penjualan</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo e(url('/reports/stock')); ?>" class="nav-link <?php echo e((request()->is('*reports/stock')) ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Laporan Stok</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </nav>
                  <?php break; ?>
              <?php case ('warehouse'): ?>
              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                  <li class="nav-item">
                    <a href="<?php echo e(url('/')); ?>" class="nav-link <?php echo e((request()->is('*dashboard')) ? 'active' : ''); ?>">
                      <i class="nav-icon fas fa-home"></i>
                      <p>
                        Dashboard
                      </p>
                    </a>
                  </li>

                  <li class="nav-header text-center nav-header-top"><h6 class="bg-secondary nav-header-title">Manajemen Stok</h6></li>
                  <li class="nav-item has-treeview <?php echo e((request()->is('*items*') && request()->segment(2) != 'purchases' && request()->segment(2) != 'mutations') ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e((request()->is('*items*') && request()->segment(2) != 'purchases' && request()->segment(2) != 'mutations') ? 'active' : ''); ?>">
                      <i class="nav-icon fas fa-box"></i>
                      <p>
                        Material
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="<?php echo e(url('/items/create')); ?>" class="nav-link <?php echo e(request()->is('*items/create') ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Material</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo e(url('/items')); ?>" class="nav-link <?php echo e(request()->is('*items') ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Material</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo e(url('/items/categories')); ?>" class="nav-link <?php echo e(request()->is('*items/categories') ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Kategori</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo e(url('/items/units')); ?>" class="nav-link <?php echo e(request()->is('*items/units') ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Satuan</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview <?php echo e((request()->is('*purchases*')) ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e((request()->is('*purchases*')) ? 'active' : ''); ?>">
                      <i class="nav-icon fas fa-gifts"></i>
                      <p>
                        Pembelian Material
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="<?php echo e(url('/items/purchases/create')); ?>" class="nav-link <?php echo e(request()->is('*items/purchases/create') ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Pembelian</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo e(url('/items/purchases')); ?>" class="nav-link <?php echo e(request()->is('*items/purchases') ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Pembelian</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview <?php echo e((request()->is('*mutations*')) ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e((request()->is('*mutations*')) ? 'active' : ''); ?>">
                      <i class="nav-icon fas fa-history"></i>
                      <p>
                        Mutasi Stok
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="<?php echo e(url('/items/mutations/create')); ?>" class="nav-link <?php echo e(request()->is('*items/mutations/create') ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Mutasi Stok</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo e(url('/items/mutations')); ?>" class="nav-link <?php echo e(request()->is('*items/mutations') ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Mutasi</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview <?php echo e((request()->is('*supplier*')) ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e((request()->is('*supplier*')) ? 'active' : ''); ?>">
                      <i class="nav-icon fas fa-people-carry"></i>
                      <p>
                        Supplier
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="<?php echo e(url('/suppliers/create')); ?>" class="nav-link <?php echo e((request()->is('*suppliers/create')) ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah Supplier</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo e(url('/suppliers')); ?>" class="nav-link <?php echo e((request()->is('*suppliers')) ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola Supplier</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-header text-center nav-header-top"><h6 class="bg-secondary nav-header-title">Manajemen Toko</h6></li>
                  <li class="nav-item has-treeview <?php echo e((request()->is('*reports*')) ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e((request()->is('*reports*')) ? 'active' : ''); ?>">
                      <i class="nav-icon fas fa-clipboard-list"></i>
                      <p>
                        Laporan
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="<?php echo e(url('/reports/purchase')); ?>" class="nav-link <?php echo e((request()->is('*reports/purchase')) ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Laporan Pembelian</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo e(url('/reports/sale')); ?>" class="nav-link <?php echo e((request()->is('*reports/sale')) ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Laporan Penjualan</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo e(url('/reports/stock')); ?>" class="nav-link <?php echo e((request()->is('*reports/stock')) ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Laporan Stok</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </nav>
                  <?php break; ?>
              <?php case ('owner'): ?>
              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                  <li class="nav-item">
                    <a href="<?php echo e(url('/')); ?>" class="nav-link <?php echo e((request()->is('*dashboard')) ? 'active' : ''); ?>">
                      <i class="nav-icon fas fa-home"></i>
                      <p>
                        Dashboard
                      </p>
                    </a>
                  </li>
                  <li class="nav-header text-center nav-header-top"><h6 class="bg-secondary nav-header-title">Manajemen Toko</h6></li>
                  <li class="nav-item has-treeview <?php echo e((request()->is('*employees*')) ? 'menu-open' : ''); ?>">
                    <a href="#" class="nav-link <?php echo e((request()->is('*employees*')) ? 'active' : ''); ?>">
                      <i class="nav-icon fas fa-user-tie"></i>
                      <p>
                        User
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="<?php echo e(url('/employees/create')); ?>" class="nav-link <?php echo e((request()->is('*employees/create')) ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tambah User</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="<?php echo e(url('/employees')); ?>" class="nav-link <?php echo e((request()->is('*employees')) ? 'active' : ''); ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Kelola User</p>
                        </a>
                      </li>
                    </ul>
                  </li>

                </ul>
              </nav>
                  <?php break; ?>
              <?php default: ?>

          <?php endswitch; ?>
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
                <h1><?php echo $__env->yieldContent('title'); ?></h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <?php echo $__env->yieldContent('breadcrumb'); ?>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <?php echo $__env->yieldContent('content'); ?>
        <!-- /.content -->
      </div>

      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?php echo e(url('/js/jquery.min.js')); ?>"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo e(url('/js/bootstrap.bundle.min.js')); ?>"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo e(url('/js/jquery.overlayScrollbars.min.js')); ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo e(url('/js/adminlte.min.js')); ?>"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo e(url('/js/demo.js')); ?>"></script>
  <!-- Select2 BS4 -->
  <script src="<?php echo e(url('/js/select2.full.min.js')); ?>"></script>
  <!-- datatables -->
  <script type="text/javascript" src="<?php echo e(url('/js/datatables.min.js')); ?>"></script>
  <!-- tempusdominus -->
  <script type="text/javascript" src="<?php echo e(url('/js/moment.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(url('/js/tempusdominus-bootstrap-4.js')); ?>"></script>
  <!-- Chart js -->
  <script type="text/javascript" src="<?php echo e(url('/js/chart.js')); ?>"></script>
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
  <?php echo $__env->yieldContent('js'); ?>
  </body>
</html>
<?php /**PATH D:\Development\wms\SIM Penjualan & Gudang\resources\views/layouts/main.blade.php ENDPATH**/ ?>