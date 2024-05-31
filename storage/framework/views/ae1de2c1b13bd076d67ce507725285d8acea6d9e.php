<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Laporan Penjualan</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(url('/css/fa.all.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(url('/css/adminlte.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(url('/css/sim.css')); ?>">

  <!-- Google Font: Source Sans Pro -->
  <link href="<?php echo e(url('/css/googlefont.css')); ?>" rel="stylesheet">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          Laporan <?php echo e($request->jenis); ?> Penjualan Barang
          <small class="float-right">Tanggal: <?php echo e(date('d-m-Y H:i:s')); ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-6 invoice-col">
        <address>
          <strong>Toko   Warehouse Management System.</strong><br>
          Pasar Paing Stand No.16-17<br>
          Jl. Zamhuri No.31, Rungkut Kidul<br>
          Telepon: (+62) 318-432-447<br>
          Email:  grosir@gmail.com
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-6 invoice-col">
        <b>Periode <?php echo e($request->jenis); ?> <?php echo e($request->tanggal); ?></b><br>
        <br>
        <b>Pelanggan :</b> <?php if($request->user_id==NULL): ?> Semua <?php else: ?> <?php echo e($users->find($request->user_id)->nama); ?> <?php endif; ?><br>
        <b>Barang Terjual :</b> <span id="total_item"></span><br>
        <b>Jumlah Transaksi :</b> <?php echo e($sales->count()); ?>

      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table id="table" class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Tanggal</th>
              <th>Kode Penjualan</th>
              <th>Supplier</th>
              <th>Barang</th>
              <th>Jumlah</th>
              <th>Unit</th>
              <th>Harga Satuan</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php $__currentLoopData = $sale->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="item">
                  <?php if($loop->first): ?>
                    <td class="align-middle" rowspan="<?php echo e($sale->items->count()); ?>"><?php echo e($sale->created_at); ?></td>
                    <td class="align-middle" rowspan="<?php echo e($sale->items->count()); ?>"><?php echo e($sale->kode_transaksi); ?></td>
                    <td class="align-middle text-left" rowspan="<?php echo e($sale->items->count()); ?>"><?php echo e($sale->user->name); ?></td>
                  <?php endif; ?>
                  <td class="align-middle text-left"><?php echo e($item->nama); ?></td>
                  <td class="align-middle text-center qty"><?php echo e($item->pivot->jumlah); ?></td>
                  <td class="align-middle"><?php echo e($item->unit->nama); ?></td>
                  <td class="align-middle text-nowrap"><?php echo e('Rp. '.number_format($item->harga_jual)); ?></td>
                  <td class="align-middle text-nowrap"><?php echo e('Rp. '.number_format($item->pivot->jumlah*$item->harga_jual)); ?></td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">

      </div>
      <!-- /.col -->
      <div class="col-6">
        <p class="lead">Total Penjualan <?php echo e($request->jenis); ?></p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th>Total:</th>
              <td id="total_pembelian"></td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="<?php echo e(url('/js/jquery.min.js')); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(url('/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(url('/js/adminlte.min.js')); ?>"></script>

<script type="text/javascript">
  var total = 0;
  var total_item = 0;
  $('td.qty').each(function () {
    var qty = parseInt($(this).text());
    $('span#total_item').text(total_item+=qty);
  });

  $('.item').each(function () {
    var subtotal = parseInt($(this).children().last().text().replace(/[^0-9]/g, ''));
    total += subtotal;
    $('#total_pembelian').text('Rp. '+total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
  });

  window.addEventListener("load", window.print());
</script>
</body>
</html>
<?php /**PATH D:\Development\wms\SIM Penjualan & Gudang\resources\views/toko/laporan/penjualan_print.blade.php ENDPATH**/ ?>
