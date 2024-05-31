

<?php $__env->startSection('title', 'Mutasi Stok Barang'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item">Mutasi Stok</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content">

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
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
            <h3 class="card-title">Daftar Mutasi Stok</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive-md">
              <table id="datatable" class="table table-sm bg-light table-bordered table-striped text-center table-hover">
                <thead>
                  <tr>
                    <th class="align-middle" scope="col">Tanggal Mutasi</th>
                    <th class="align-middle" scope="col">Barang</th>
                    <th class="align-middle" scope="col">Jenis Mutasi</th>
                    <th class="align-middle" scope="col">Stok Awal</th>
                    <th class="align-middle" scope="col">Mutasi</th>
                    <th class="align-middle" scope="col">Stok Akhir</th>
                    <th class="align-middle" scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $mutations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mutation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($mutation->created_at); ?></td>
                      <td><?php echo e($mutation->item->nama); ?></td>
                      <td><?php echo e($mutation->jenis_mutasi); ?></td>
                      <td><?php echo e($mutation->stok_awal); ?></td>
                      <?php if($mutation->jenis_mutasi == 'penambahan'): ?>
                        <td><?php echo e('+'.$mutation->stok_mutasi); ?></td>
                      <?php else: ?>
                        <td><?php echo e('-'.$mutation->stok_mutasi); ?></td>
                      <?php endif; ?>
                      <td><?php echo e($mutation->stok_akhir); ?></td>
                      <td><?php echo e($mutation->keterangan); ?></td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
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

<?php $__env->startSection('js'); ?>
  <script>
    var table = $('#datatable').DataTable({
      "order": [[ 0, "desc" ]]
    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Development\wms\SIM Penjualan & Gudang\resources\views/stok/mutasi/mutasi_index.blade.php ENDPATH**/ ?>