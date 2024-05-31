

<?php $__env->startSection('title', 'Transaksi Pembelian Barang'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item">Transaksi Pembelian</a></li>
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
            <h3 class="card-title">Daftar Transaksi Pembelian</h3>
            <a href="<?php echo e(url('/items/purchases/create')); ?>" class="btn btn-primary float-right text-white">Tambah Transaksi Pembelian</a>
          </div>
          <div class="card-body">
            <div class="table-responsive-md">
              <table id="datatable" class="table table-sm bg-light table-bordered table-striped text-center table-hover">
                <thead>
                  <tr>
                    <th class="align-middle" scope="col">Tanggal Pembelian</th>
                    <th class="align-middle" scope="col">Kode Transaksi</th>
                    <th class="align-middle" scope="col">Supplier</th>
                    <th class="align-middle" scope="col">Barang</th>
                    <th class="align-middle" scope="col">Total Pembelian</th>
                    <th class="align-middle" scope="col">Keterangan</th>
                    <th class="align-middle" scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td class="align-middle"><?php echo e($purchase->created_at->format('Y-m-d')); ?></td>
                      <td class="align-middle"><?php echo e($purchase->kode_pembelian); ?></td>
                      <td class="align-middle text-left"><?php echo e($purchase->supplier->nama); ?></td>
                      <td class="align-middle text-left">
                        <ul class="product-list">
                          <?php $__currentLoopData = $purchase->purchaseDetail->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($item->nama.' @Rp.'.$item->harga_beli.' x '.$item->pivot->jumlah.' '.$item->unit->nama); ?></li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                      </td>
                      <td class="align-middle text-nowrap"><?php echo e('Rp. '.number_format($purchase->total_bayar).' ,-'); ?></td>
                      <td class="align-middle text-left"><?php echo e($purchase->keterangan); ?></td>
                      <td class="align-middle">
                        
                        <form style="all: unset;" action="<?php echo e(url('/items/categories/'.$purchase->id)); ?>" method="POST">
                          <?php echo method_field('delete'); ?>
                          <?php echo csrf_field(); ?>
                          <button class="btn btn-danger btn-sm"><i class="nav-icon fas fa-trash"></i></button>
                        </form>
                      </td>
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
<?php echo $__env->make('layouts/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Development\wms\SIM Penjualan & Gudang\resources\views/stok/pembelian/pembelian_index.blade.php ENDPATH**/ ?>