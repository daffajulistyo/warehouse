<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item">Dashboard</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo e($sales); ?></h3>

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
                            <h3><?php echo e($purchases); ?></h3>

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
                            <h3><?php echo e($items); ?></h3>

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
                            <h3><?php echo e($customers); ?></h3>

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
                            <?php if(Auth::user()->role == 'super_admin'): ?>
                                <h3 class="card-title">Welcome <?php echo e(Auth::user()->name); ?></h3>
                            <?php endif; ?>
                        </div>
                        <hr>
                        <div class="card-header border-transparent">
                            <?php if(Auth::user()->role == 'super_admin'): ?>
                                <p class="card-title">
                                <p class="card-text">Pertamina Delivery Service: Pengiriman yang Cepat, Aman, dan Terpercaya
                                    untuk Memenuhi Kebutuhan Energi Anda!
                                    Dengan layanan kami, nikmati kenyamanan pengiriman bahan bakar langsung ke pintu Anda,
                                    sehingga Anda dapat fokus pada kegiatan penting tanpa khawatir kehabisan bahan bakar.
                                    Percayakan kebutuhan energi Anda kepada kami, dan rasakan kemudahan serta kehandalan
                                    layanan pengiriman kami!</p>
                                </p>
                            <?php endif; ?>
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
                        
                        <!-- /.card-footer-->
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Development\wms\SIM Penjualan & Gudang\resources\views/dashboard.blade.php ENDPATH**/ ?>