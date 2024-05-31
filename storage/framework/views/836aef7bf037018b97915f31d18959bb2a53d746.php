

<?php $__env->startSection('title', 'Data Pegawai'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item"><a href="#">Pegawai</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content">

  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md">
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
            <h3 class="card-title">Daftar Pegawai</h3>
            <a href="<?php echo e(url('/employees/create')); ?>" class="btn btn-primary float-right text-white">Tambah Pegawai</a>
          </div>
          <div class="card-body">
            <div class="table-responsive-md">
              <table id="datatable" class="table table-sm bg-light table-striped text-center table-hover">
                <thead class="thead-light">
                  <tr>
                    <th class="align-middle" scope="col">Nama</th>
                    <th class="align-middle" scope="col">Role</th>
                    <th class="align-middle" scope="col">Email</th>
                    <th class="align-middle" scope="col">Username</th>
                    <th class="align-middle" scope="col">No Telpon</th>
                    <th class="align-middle" scope="col">Tanggal Registrasi</th>
                    <th class="align-middle" scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td class="align-middle" scope="row"><?php echo e($employee->name); ?></td>
                      <td class="align-middle"><?php echo e($employee->role); ?></td>
                      <td class="align-middle"><?php echo e($employee->email); ?></td>
                      <td class="align-middle"><?php echo e($employee->username); ?></td>
                      <td class="align-middle"><?php echo e($employee->phone); ?></td>
                      <td class="align-middle"><?php echo e($employee->created_at); ?></td>
                      <td class="align-middle">
                        <a href="<?php echo e(url('/employees/'.$employee->id.'/edit')); ?>" class="btn btn-warning btn-sm"><i class="nav-icon fas fa-pen"></i></a>
                        <form style="all: unset;" action="<?php echo e(url('/employees/'.$employee->id)); ?>" method="POST">
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
<?php echo $__env->make('layouts/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Development\wms\SIM Penjualan & Gudang\resources\views/toko/pegawai/pegawai_index.blade.php ENDPATH**/ ?>