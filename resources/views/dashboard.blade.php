@extends('layouts/main')

@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item">Dashboard</li>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">

                <!-- ./col -->
                <div class="col-lg-6 col-6">
                    <!-- small card -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $purchases }}</h3>

                            <p>Purchase Requisition</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-gifts"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Lebih lanjut <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6 col-6">
                    <!-- small card -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $items }}</h3>

                            <p>Barang</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Lebih lanjut <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->

                <!-- ./col -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-transparent">
                            @if (Auth::user()->role == 'admin')
                                <h3 class="card-title">Welcome, {{ Auth::user()->name }}</h3>
                            @endif
                        </div>


                    </div>
                </div>


            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
