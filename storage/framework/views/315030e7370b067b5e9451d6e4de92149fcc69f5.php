





<?php $__env->startSection('test'); ?>
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
      <li class="nav-header text-center nav-header-top"><h6 class="bg-secondary nav-header-title">Filter</h6></li>
      <form action="<?php echo e(url('/shop/filter')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-group">            
          <label class="text-white" for="">Kategori</label>
          <select name="kategori" class="form-control form-control-sm select2" id="">
            <option value="">Pilih Kategori</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($category->id); ?>"><?php echo e($category->nama); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
        <label class="text-white" for="">Batas Harga(Rp)</label>
        <div class="form-row">
          <div class="col">
            <input name="min" class="form-control form-control-sm" type="number" placeholder="Min">
          </div>
          <div class="col">
            <input name="max" class="form-control form-control-sm" type="number" placeholder="Max">
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-sm" style="margin-top: 20px;">Apply</button>
      </form>
    </ul>
  </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row text-sm">
              <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-6 d-flex align-items-stretch">
                  <div class="card w-100">
    
                    <!-- Card image -->
                    <img class="card-img-top" src="<?php echo e(url('/img/items_img/'.$item->gambar)); ?>" alt="Produk">
                    
                  
                    <!-- Card content -->
                    <div class="card-body">
                  
                      <!-- Title -->
                      <h6 class="card-title"><?php echo e($item->nama); ?></h6><br>
                      <!-- Text -->
                      <span class="info-box-text">Rp. <?php echo e(number_format($item->harga_jual, 2)); ?> / <?php echo e($item->unit->nama); ?></span>
                      <!-- Button -->
                    </div>
                    <a href="<?php echo e(url('/shop/'.$item->id)); ?>" class="btn btn-primary btn-block rounded-0">Lihat barang</a>
                  
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php if(isset($request->search)): ?>
                <div class="col-md-12">
                  <a href="<?php echo e(url('/shop')); ?>" type="submit" class="btn btn-primary btn-block">Kembali</a>
                </div> 
              <?php endif; ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('shop.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Development\wms\SIM Penjualan & Gudang\resources\views/shop/landing.blade.php ENDPATH**/ ?>