

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
        <div class="row">
          <div class="col-6">
            <div class="card">
              <div class="card-body">
                <canvas id="monthly-purchase"></canvas>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="card">
              <div class="card-body">
                <canvas id="monthly-purchase-nominal"></canvas>
              </div>
            </div>
          </div>
        </div>
        <!-- Default box -->
        <!-- Default box -->
        <div class="card">
          <div class="card-body">
            <div class="form-row align-items-center">
              <div class="form-group col-md-4">
                <label for="supplier_id">Supplier</label>
                
                <form style="all: unset;" action="<?php echo e(url('/reports/purchase')); ?>" method="POST">
                  <?php echo csrf_field(); ?>
                  <select name="supplier_id" class="form-control select2" name="supplier_id" id="supplier_id">
                    <option value="">Semua</option>
                    <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($supplier->id); ?>"><?php echo e($supplier->nama); ?></option> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="inputEmail4">Jenis Laporan</label>
                    
                    <select name="jenis" class="form-control" id="jenis">
                      <option value="">Pilih Jenis Laporan</option>
                      <option value="Harian">Harian</option>
                      <option value="Bulanan">Bulanan</option>
                      <option value="Tahunan">Tahunan</option>
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="inputPassword4">Pilih Tanggal/Bulan/Tahun</label>
                    
                    <input type="text" name="tanggal" class="form-control datetimepicker-input" id="tanggal" data-toggle="datetimepicker" data-target="#tanggal" autocomplete="off" disabled>
                  </div>
                  <div class="col-md-2" style="margin-top: 15px;">
                    <div class="btn-group" role="group">
                      <button type="submit" class="btn btn-primary btn-md">Filter</button>
                </form>
                      <form id="print" action="<?php echo e(url('/reports/purchase/print')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" id="supplier_print" name="supplier_id" value="">
                        <input type="hidden" id="jenis_print" name="jenis" value="">
                        <input type="hidden" id="tanggal_print" name="tanggal" value="">
                        <button type="submit" class="btn btn-success btn-md">Print</button>
                      </form>
                    </div>
                  </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
        <!-- Default box -->
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Daftar Transaksi Pembelian</h3>
            
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
                    
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td class="align-middle"><?php echo e($purchase->created_at); ?></td>
                      <td class="align-middle"><?php echo e($purchase->kode_pembelian); ?></td>
                      <td class="align-middle text-left"><?php echo e($purchase->supplier->nama); ?></td>
                      <td class="align-middle text-left">
                        <ul class="product-list">
                          <?php $__currentLoopData = $purchase->purchaseDetail->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($item->nama.' @Rp.'.$item->harga_beli.' x '.$item->pivot->jumlah.' '.$item->unit->nama); ?></li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                      </td>
                      <td class="align-middle text-nowrap"><?php echo e('Rp. '.number_format($purchase->total_bayar, 2).' ,-'); ?></td>
                      <td class="align-middle text-left"><?php echo e($purchase->keterangan); ?></td>
                      
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
    var ctx = $('#monthly-purchase');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($chart->labels, 15, 512) ?>,
        datasets: [
          {
            label: 'Jumlah Pembelian Perbulan',
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

    var ctx2 = $('#monthly-purchase-nominal');
    var myChart2 = new Chart(ctx2, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($chart->labels2, 15, 512) ?>,
        datasets: [
          {
            label: 'Jumlah Nominal Pembelian Perbulan (Rp.)',
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

    $('form#print').submit(function () {
      var supplier_id = $('select#supplier_id option:selected').val();
      var jenis = $('#jenis option:selected').val();
      var tanggal = $('input#tanggal').val();
      $('input#supplier_print').val(supplier_id);
      $('input#jenis_print').val(jenis);
      $('input#tanggal_print').val(tanggal);
      // alert(supplier_id+jenis+tanggal);
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
<?php echo $__env->make('layouts/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Development\wms\SIM Penjualan & Gudang\resources\views/toko/laporan/pembelian_index.blade.php ENDPATH**/ ?>