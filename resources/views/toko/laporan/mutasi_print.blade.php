<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Laporan Mutasi Stok</title>
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
          Laporan {{ $request->jenis }} Mutasi Stok
          <small class="float-right">Tanggal: {{ date('d-m-Y H:i:s') }}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-6 invoice-col">
        <address>
          <strong>Toko Mentari Alat Tulis Grosir.</strong><br>
          Pasar Paing Stand No.16-17<br>
          Jl. Zamhuri No.31, Rungkut Kidul<br>
          Telepon: (+62) 318-432-447<br>
          Email: mentarigrosir@gmail.com
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-6 invoice-col">
        <b>Periode {{ $request->jenis }} {{ $request->tanggal }}</b><br>
        <br>
        <b>Barang :</b> @if ($request->item_id==NULL) Semua Barang @else {{ $items->find($request->item_id)->nama }} @endif<br>
        <b>Barang Masuk :</b> {{ $mutations->where('jenis_mutasi', 'penambahan')->sum('stok_mutasi') }}<br>
        <b>Barang Keluar :</b> {{ $mutations->where('jenis_mutasi', 'pengurangan')->count() }}
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
              <th>Barang</th>
              <th>Stok Awal</th>
              <th>Masuk (Beli)</th>
              <th>Out (Jual)</th>
              <th>Stok Akhir</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($mutations as $mutation)
              <tr>
                <td>{{ $mutation->created_at->format('j F Y') }}</td>
                <td>{{ $mutation->item->nama }}</td>
                <td>{{ $mutation->stok_awal }}</td>
                @if ($mutation->jenis_mutasi=='penambahan')
                  <td>{{ $mutation->stok_mutasi }}</td>
                  <td>0</td>
                @else
                  <td>0</td>
                  <td>{{ $mutation->stok_mutasi }}</td>
                @endif
                <td>{{ $mutation->stok_akhir }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
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
