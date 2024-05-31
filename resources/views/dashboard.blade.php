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
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $sales }}</h3>

                            <p>Penjualan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Lebih lanjut <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $purchases }}</h3>

                            <p>Pembelian</p>
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
                <div class="col-lg-3 col-6">
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
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $customers }}</h3>

                            <p>Pelanggan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Lebih lanjut <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-transparent">
                            @if (Auth::user()->role == 'admin')
                                <h3 class="card-title">Welcome {{ Auth::user()->name }}</h3>
                            @endif
                        </div>
                        <hr>
                        <div class="card-header border-transparent">
                            @if (Auth::user()->role == 'admin')
                                <p class="card-title">
                                <p class="card-text">Pertamina Delivery Service: Pengiriman yang Cepat, Aman, dan Terpercaya
                                    untuk Memenuhi Kebutuhan Energi Anda!
                                    Dengan layanan kami, nikmati kenyamanan pengiriman bahan bakar langsung ke pintu Anda,
                                    sehingga Anda dapat fokus pada kegiatan penting tanpa khawatir kehabisan bahan bakar.
                                    Percayakan kebutuhan energi Anda kepada kami, dan rasakan kemudahan serta kehandalan
                                    layanan pengiriman kami!</p>
                                </p>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Material Check</h3>

                        </div>
                        <div class="card-body">
                            <canvas id="materialCheck"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>

                        </div>
                        <!-- /.card-body -->
                        {{-- <div class="card-footer">
                      Footer
                    </div> --}}
                        <!-- /.card-footer-->
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
