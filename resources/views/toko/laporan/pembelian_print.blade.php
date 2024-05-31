<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Laporan Pembelian</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/css/fa.all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ url('/css/sim.css') }}">

  <!-- Google Font: Source Sans Pro -->
  <link href="{{ url('/css/googlefont.css') }}" rel="stylesheet">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          Laporan {{ $request->jenis }} Pembelian Barang
          <small class="float-right">Tanggal: {{ date('d-m-Y H:i:s') }}</small>
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
        <b>Periode {{ $request->jenis }} {{ $request->tanggal }}</b><br>
        <br>
        <b>Supplier :</b> @if ($request->supplier_id==NULL) Semua @else {{ $suppliers->find($request->supplier_id)->nama }} @endif<br>
        <b>Jumlah Barang :</b> <span id="total_item"></span><br>
        <b>Jumlah Transaksi :</b> {{ $purchases->count() }}
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
              <th>Kode Pembelian</th>
              <th>Supplier</th>
              <th>Barang</th>
              <th>Jumlah</th>
              <th>Unit</th>
              <th>Harga Satuan</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($purchases as $purchase)
              @foreach ($purchase->purchaseDetail->items as $item)
                <tr class="item">
                  @if ($loop->first)
                    <td class="align-middle" rowspan="{{ $purchase->purchaseDetail->items->count() }}">{{ $purchase->created_at }}</td>
                    <td class="align-middle" rowspan="{{ $purchase->purchaseDetail->items->count() }}">{{ $purchase->kode_pembelian }}</td>
                    <td class="align-middle text-left" rowspan="{{ $purchase->purchaseDetail->items->count() }}">{{ $purchase->supplier->nama }}</td>
                  @endif
                  <td class="align-middle text-left">
                    {{ $item->nama }}
                  </td>
                  <td class="align-middle text-center">{{ $item->pivot->jumlah }}</td>
                  <td class="align-middle">{{ $item->unit->nama }}</td>
                  <td class="align-middle text-nowrap">{{ 'Rp. '.number_format($item->harga_beli) }}</td>
                  <td class="align-middle text-nowrap">{{ 'Rp. '.number_format($item->pivot->jumlah*$item->harga_beli) }}</td>
                </tr>
              @endforeach
            @endforeach
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
        <p class="lead">Total Pembelian {{ $request->jenis }}</p>

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
<script src="{{ url('/js/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('/js/adminlte.min.js') }}"></script>

<script type="text/javascript">
  var total = 0;
  var total_item = $('#table tr').length;
  $('span#total_item').text(total_item-1);

  $('.item').each(function () {
    var subtotal = parseInt($(this).children().last().text().replace(/[^0-9]/g, ''));
    total += subtotal;
    $('#total_pembelian').text('Rp. '+total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
  });

  window.addEventListener("load", window.print());
</script>
</body>
</html>
