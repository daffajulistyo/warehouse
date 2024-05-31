

<?php $__env->startSection('title', 'Transaksi Penjualan Barang'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item">Transaksi Penjualan</a></li>
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
        <div class="row">
          <div class="col-6">
            <div class="card">
              <div class="card-body">
                <canvas id="monthly-sales"></canvas>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="card">
              <div class="card-body">
                <canvas id="monthly-sales-nominal"></canvas>
              </div>
            </div>
          </div>
        </div>
        <!-- Default box -->
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Penjualan Per Barang</h3>
          </div>
          <div class="card-body">
            <form action="<?php echo e(url('/reports/sale/item_print')); ?>" method="POST">
              <?php echo csrf_field(); ?>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="jenis2">Jenis Laporan</label>
                  <select name="jenis2" class="form-control" id="jenis2">
                    <option value="">Pilih Jenis Laporan</option>
                    <option value="Harian" <?php if($request->jenis2=="Harian"): ?> selected <?php endif; ?>>Harian</option>
                    <option value="Bulanan" <?php if($request->jenis2=="Bulanan"): ?> selected <?php endif; ?>>Bulanan</option>
                    <option value="Tahunan" <?php if($request->jenis2=="Tahunan"): ?> selected <?php endif; ?>>Tahunan</option>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label for="tanggal2">Pilih Tanggal/Bulan/Tahun</label>
                  <input value="<?php echo e($request->tanggal2); ?>" type="text" name="tanggal2" class="form-control datetimepicker-input" id="tanggal2" data-toggle="datetimepicker" data-target="#tanggal2" autocomplete="off" disabled>
                </div>
                <div class="form-group col-md-4" style="margin-top: 32px;">
                  <div class="btn-group" role="group">
                    <button type="submit" class="btn btn-success btn-md">Print</button>
                  </div>
                </div>
              </div>
            </form>
            <div class="col table-responsive">
              <table id="barang" class="table table-sm bg-light table-bordered table-striped text-center table-hover">
                <thead>
                  <tr>
                    <th class="align-middle" scope="col">Barang</th>
                    <th class="align-middle" scope="col">Harga (Rp.)</th>
                    <th class="align-middle" scope="col">Jumlah Terjual</th>
                    <th class="align-middle" scope="col">Satuan</th>
                    <th class="align-middle" scope="col">Total Penjualan (Rp.)</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td class="align-middle" scope="row"><?php echo e($item->nama); ?></td>
                      <td class="align-middle" scope="row"><?php echo e(number_format($item->harga_jual, 2)); ?></td>
                      <td class="align-middle"><?php echo e($item->sale->sum('pivot.jumlah')); ?></td>
                      <td class="align-middle"><?php echo e($item->unit->nama); ?></td>
                      <td class="align-middle"><?php echo e(number_format($item->sale->sum('pivot.jumlah')*$item->harga_jual, 2)); ?></td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer">

          </div>
        </div>
        <!-- Default box -->
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Riwayat Transaksi Penjualan</h3>
          </div>
          <div class="card-body">
            <form action="<?php echo e(url('/reports/sale')); ?>" method="POST">
              <?php echo csrf_field(); ?>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="user_id">Pelanggan</label>
                  <select name="user_id" class="form-control select2" name="user_id" id="user_id">
                    <option value="">Semua Pelanggan</option>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($user->id); ?>" <?php if($request->user_id == $user->id): ?> selected <?php endif; ?>><?php echo e($user->name); ?></option> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label for="jenis">Jenis Laporan</label>
                  <select name="jenis" class="form-control" id="jenis">
                    <option value="">Pilih Jenis Laporan</option>
                    <option value="Harian" <?php if($request->jenis=="Harian"): ?> selected <?php endif; ?>>Harian</option>
                    <option value="Bulanan" <?php if($request->jenis=="Bulanan"): ?> selected <?php endif; ?>>Bulanan</option>
                    <option value="Tahunan" <?php if($request->jenis=="Tahunan"): ?> selected <?php endif; ?>>Tahunan</option>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label for="tanggal">Pilih Tanggal/Bulan/Tahun</label>
                  <input value="<?php echo e($request->tanggal); ?>" type="text" name="tanggal" class="form-control datetimepicker-input" id="tanggal" data-toggle="datetimepicker" data-target="#tanggal" autocomplete="off" disabled>
                </div>
                <div class="form-group col-md-2" style="margin-top: 32px;">
                  <div class="btn-group" role="group">
                    <button type="submit" class="btn btn-primary btn-md">Filter</button>
            </form>
                    <form id="print" action="<?php echo e(url('/reports/sale/print')); ?>" method="POST">
                      <?php echo csrf_field(); ?>
                      <input type="hidden" id="user_print" name="user_id" value="">
                      <input type="hidden" id="jenis_print" name="jenis" value="">
                      <input type="hidden" id="tanggal_print" name="tanggal" value="">
                      <button type="submit" class="btn btn-success btn-md">Print</button>
                    </form>
                  </div>
                </div>
              </div>
            <div class="table-responsive-md">
              <table id="datatable" class="table table-sm bg-light table-bordered table-striped text-center table-hover">
                <thead>
                  <tr>
                    <th class="align-middle" scope="col">Tanggal Penjualan</th>
                    <th class="align-middle" scope="col">Kode Transaksi</th>
                    <th class="align-middle" scope="col">Pelanggan</th>
                    <th class="align-middle" scope="col">Transaksi</th>
                    <th class="align-middle" scope="col">Total Penjualan</th>
                    <th class="align-middle" scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td class="align-middle" scope="row"><?php echo e($sale->created_at->format('j F Y')); ?></td>
                      <td class="align-middle"><?php echo e($sale->kode_transaksi); ?></td>
                      <td class="align-middle text-left"><?php echo e($sale->user->name); ?></td>
                      <td class="align-middle text-left">
                        <ul class="product-list">
                          <?php $__currentLoopData = $sale->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($item->nama.' @Rp.'.$item->harga_jual.' x '.$item->pivot->jumlah.' '.$item->unit->nama); ?></li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                      </td>
                      <td class="align-middle text-nowrap"><?php echo e('Rp. '.number_format($sale->total_bayar, 2).' ,-'); ?></td>
                      <td class="align-middle text-left"><?php echo e($sale->keterangan); ?></td>
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

    var table = $('#barang').DataTable({
      order: [[ 4, "desc" ]]
    });

    var ctx = $('#monthly-sales');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($chart->labels, 15, 512) ?>,
        datasets: [
          {
            label: 'Jumlah Penjualan Perbulan',
            data: <?php echo json_encode($chart->datasets, 15, 512) ?>,
            backgroundColor: 'rgba(39, 10, 228, 0.9)',
            borderWidth: 1
          }
        ]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true,
              stepSize: 1,
              suggestedMax: 10
            }
          }]
        }
      }
    });

    var ctx2 = $('#monthly-sales-nominal');
    var myChart2 = new Chart(ctx2, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($chart->labels2, 15, 512) ?>,
        datasets: [
          {
            label: 'Jumlah Nominal Penjualan Perbulan (Rp.)',
            data: <?php echo json_encode($chart->datasets2, 15, 512) ?>,
            backgroundColor: 'rgba(103, 230, 30, 0.9)',
            borderWidth: 1
          }
        ]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true,
              stepSize: 100000,
              suggestedMax: 1500000
            }
          }]
        }
      }
    });

    $('select#jenis2').change(function () {
      var selected = $('#jenis2 option:selected').val();
      $('#tanggal2').datetimepicker('destroy');
      $('#tanggal2').val('');
      // alert(selected);
      switch (selected) {
        case 'Harian':
          $('#tanggal2').prop('disabled', false);
          $('#tanggal2').datetimepicker({
            format: "YYYY-MM-DD",
            useCurrent: false
          });
          break;

        case 'Bulanan':
          $('#tanggal2').prop('disabled', false);
          $('#tanggal2').datetimepicker({
            format: "M",
            viewMode: "months",
            useCurrent: false
          });
          break

        case 'Tahunan':
          $('#tanggal2').prop('disabled', false);
          $('#tanggal2').datetimepicker({
            format: "YYYY",
            viewMode: "years",
            useCurrent: false
          });
          break
      
        default:
          break;
      }
    });

    $('form#print').submit(function () {
      var user_id = $('select#user_id option:selected').val();
      var jenis = $('#jenis option:selected').val();
      var tanggal = $('input#tanggal').val();
      $('input#user_print').val(user_id);
      $('input#jenis_print').val(jenis);
      $('input#tanggal_print').val(tanggal);
    });

    $('select#jenis').change(function () {
      var selected = $('#jenis option:selected').val();
      $('#tanggal').datetimepicker('destroy');
      $('#tanggal').val('');
      // alert(selected);
      switch (selected) {
        case 'Harian':
          $('#tanggal').prop('disabled', false);
          $('#tanggal').datetimepicker({
            format: "YYYY-MM-DD",
            useCurrent: false
          });
          break;

        case 'Bulanan':
          $('#tanggal').prop('disabled', false);
          $('#tanggal').datetimepicker({
            format: "M",
            viewMode: "months",
            useCurrent: false
          });
          break

        case 'Tahunan':
          $('#tanggal').prop('disabled', false);
          $('#tanggal').datetimepicker({
            format: "YYYY",
            viewMode: "years",
            useCurrent: false
          });
          break
      
        default:
          break;
      }
    });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Development\wms\SIM Penjualan & Gudang\resources\views/toko/laporan/penjualan_index.blade.php ENDPATH**/ ?>