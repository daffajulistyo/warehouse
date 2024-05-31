

<?php $__env->startSection('title', 'Data Stok Gudang'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item"><a href="#">Data Stok</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content">

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- Default box -->
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
            <h3 class="card-title">Daftar Stok Gudang</h3>

            <a href="<?php echo e(url('/items/create')); ?>" class="btn btn-primary float-right text-white">Tambah Barang</a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="datatable" class="table table-sm bg-light table-bordered table-striped text-center table-hover">
                <thead class="thead-dark">
                  <tr>
                    <th class="align-middle" scope="col">#</th>
                    <th class="align-middle" scope="col">Nama Barang</th>
                    <th class="align-middle" scope="col">Kategori</th>
                    <th class="align-middle" scope="col">Harga Beli</th>
                    <th class="align-middle" scope="col">Harga Jual</th>
                    <th class="align-middle" scope="col">Stok</th>
                    <th class="align-middle" scope="col">Satuan</th>
                    <th class="align-middle" scope="col" style="width: 15%;">Gambar</th>
                    <th class="align-middle" scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td scope="row" class="align-middle"><?php echo e($loop->iteration); ?></td>
                    <td class="align-middle"><?php echo e($item->nama); ?></td>
                    <?php if($item->category_id==NULL): ?>
                      <td class="align-middle">-</td>
                    <?php else: ?>
                      <td class="align-middle"><?php echo e($item->category->nama); ?></td>
                    <?php endif; ?>
                    <td class="align-middle text-nowrap">Rp. <?php echo e(number_format($item->harga_beli, 2)); ?></td>
                    <td class="align-middle text-nowrap">Rp. <?php echo e(number_format($item->harga_jual, 2)); ?></td>
                    <td class="align-middle"><?php echo e($item->stok); ?></td>
                    <?php if($item->unit_id==NULL): ?>
                      <td class="align-middle">-</td>
                    <?php else: ?>
                      <td class="align-middle"><?php echo e($item->unit->nama); ?></td>
                    <?php endif; ?>
                    <td class="align-middle"><img src="<?php echo e(url('/img/items_img/'.$item->gambar)); ?>" class="img-thumbnail" alt="<?php echo e($item->nama); ?>"></td>
                    <td class="align-middle">
                      <a class="btn btn-primary btn-xs" href="<?php echo e(url('/items/'.$item->id.'/edit')); ?>"><i class="fas fa-md fa-edit"></i></a>
                      <form action="<?php echo e(url('/items/'.$item->id)); ?>" method="POST">
                        <?php echo method_field('delete'); ?>
                        <?php echo csrf_field(); ?>
                        <button class="btn btn-danger btn-xs"><i class="fas fa-md fa-trash-alt"></i></button>
                      </form>
                    </td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card-body -->
          
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
    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Development\wms\SIM Penjualan & Gudang\resources\views/stok/barang/barang_index.blade.php ENDPATH**/ ?>