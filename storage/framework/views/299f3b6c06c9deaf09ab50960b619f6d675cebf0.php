<?php $__env->startSection('title', 'Mutasi Stok Barang'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item"><a href="#">Mutasi Stok</a></li>
<li class="breadcrumb-item">Tambah Mutasi Stok</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content">

  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-9">
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Koreksi Stok Kategori</h3>
          </div>
          <form method="POST" action="<?php echo e(url('/items/mutations')); ?>">
            <div class="card-body">
              <?php echo csrf_field(); ?>
              <div class="form-group row">
                <label for="item_id" class="col-sm-3 col-form-label">Kategori</label>
                <div class="col-sm-9">
                  <select class="form-control select2" name="item_id" id="item_id">
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option data-stok="<?php echo e($item->stok); ?>" value="<?php echo e($item->id); ?>"><?php echo e($item->nama); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="stok_awal" class="col-sm-3 col-form-label">Spesifikasi</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" name="stok_awal" id="stok_awal" placeholder="Pilih Barang ...." value="">
                </div>
              </div>
              <div class="form-group row">
                <label for="jenis_mutasi" class="col-sm-3 col-form-label">Jenis Mutasi</label>
                <div class="col-sm-9">
                  <select name="jenis_mutasi" id="jenis_mutasi" class="form-control">
                    <option value="penambahan">Penambahan</option>
                    <option value="pengurangan">Pengurangan</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="stok_mutasi" class="col-sm-3 col-form-label">Stok Mutasi</label>
                <div class="col-sm-9">
                  <input type="number" name="stok_mutasi" class="form-control" id="stok_mutasi" value="0">
                </div>
              </div>
              <div class="form-group">
                <label for="keterangan">Keterangan Mutasi Stok</label>
                <textarea class="form-control" name="keterangan" id="keterangan" rows="3" placeholder="Silahkan isi keterangan mutasi stok jika perlu...."></textarea>
                <?php $__errorArgs = ['keterangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-md btn-primary float-right">Mutasi Stok</button>
              <a href="<?php echo e(url('/items/mutations')); ?>" class="btn btn-md btn-secondary">Kembali</a>
            </div>
          </form>
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
    $(document).on('change', 'select#item_id', function(){
      var awal = $(this).find(':selected').data('stok');
      // let idx = $(this).index('select.item');
      // window.harga = $(this).find(':selected').data('harga');
      // $('.jumlah').eq(idx).removeAttr('disabled');
      $('#stok_awal').val(awal);
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Development\wms\SIM Penjualan & Gudang\resources\views/stok/mutasi/mutasi_create.blade.php ENDPATH**/ ?>