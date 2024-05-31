<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Laporan Stok</title>
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
          Laporan {{ $request->jenis2 }} Stok
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
        @switch($request->jenis2)
        
          @case('Harian')
            <b>Periode {{ $request->jenis2 }} {{ $request->tanggal2 }}</b><br>
          @break

          @case('Bulanan')
            <b>Periode {{ $request->jenis2 }} {{ Carbon\Carbon::createFromFormat('n', $request->tanggal2)->isoFormat('MMMM') }}</b><br>
          @break

          @case('Tahunan')
            <b>Periode {{ $request->jenis2 }} {{ $request->tanggal2 }}</b><br>
          @break

          @default
            <b>Semua Periode</b><br>
        @endswitch
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
              <th>Barang</th>
              <th>Stok Awal</th>
              <th>Masuk (Pembelian)</th>
              <th>Keluar (Penjualan)</th>
              <th>Stok Akhir</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($items as $item)
              <tr>
                <td class="align-middle" scope="row">{{ $item->nama }}</td>
                <td class="align-middle">{{ $item->mutation[0]->stok_awal }}</td>
                <td class="align-middle masuk">{{ $item->mutation->where('jenis_mutasi', 'penambahan')->sum('stok_mutasi') }}</td>
                <td class="align-middle keluar">{{ $item->mutation->where('jenis_mutasi', 'pengurangan')->sum('stok_mutasi') }}</td>
                <td class="align-middle stok">{{ $item->stok }}</td>
              </tr>
            @endforeach
            <tr>
              <td class="align-middle text-center display-4" colspan="2">Total</td>
              <td class="align-middle" id="total-masuk"></td>
              <td class="align-middle" id="total-keluar"></td>
              <td class="align-middle" id="total"></td>
            </tr>
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
  var total_masuk = 0;
  var total_keluar = 0;

  $('td.masuk').each(function () {
    var masuk = parseInt($(this).text());
    $('td#total-masuk').text(total_masuk+=masuk);
  });
  
  $('td.keluar').each(function () {
    var keluar = parseInt($(this).text());
    $('td#total-keluar').text(total_keluar+=keluar);
  });
  
  $('td.stok').each(function () {
    var stok = parseInt($(this).text());
    $('td#total').text(total+=stok);
  });
  window.addEventListener("load", window.print());
</script>
</body>
</html>
