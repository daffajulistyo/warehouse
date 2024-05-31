

<?php $__env->startSection('title', 'Data Satuan Barang'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item"><a href="#">Barang</a></li>
<li class="breadcrumb-item"><a href="#">Satuan</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content">

  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-9">
        <?php if(session('message')): ?>
          <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong><?php echo e(session('message')); ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Daftar Satuan</h3>
            <a href="<?php echo e(url('/items/units/create')); ?>" class="btn btn-primary float-right text-white">Tambah Satuan</a>
          </div>
          <div class="card-body">
            <ul class="list-group">
              <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li class="list-group-item list-group-item-action list-group-item-light"><?php echo e($unit->nama); ?>

                <form style="all: unset;" action="<?php echo e(url('/items/units/'.$unit->id)); ?>" method="POST">
                  <?php echo method_field('delete'); ?>
                  <?php echo csrf_field(); ?>
                  <button class="btn btn-danger float-right btn-sm"><i class="nav-icon fas fa-trash"></i></button>
                </form>
                <a href="<?php echo e(url('/items/units/'.$unit->id.'/edit')); ?>" class="btn btn-warning float-right btn-sm"><i class="nav-icon fas fa-pen"></i></a>
              </li>    
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Development\wms\SIM Penjualan & Gudang\resources\views/stok/barang/satuan/satuan_index.blade.php ENDPATH**/ ?>