@extends('layouts/main')

@section('title', 'Laporan Stok Barang')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item">Laporan Stok</a></li>
@endsection

@section('content')
<!-- Main content -->
<section class="content">

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        @if (session('message'))
          <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        <!-- Default box -->
        <div class="row">
          <div class="col-6">
            <div class="card">
              <div class="card-body">
                <canvas id="monthly-chart-in"></canvas>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="card">
              <div class="card-body">
                <canvas id="monthly-chart-out"></canvas>
              </div>
            </div>
          </div>
        </div>
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Daftar Stok per Barang</h3>
          </div>
          <div class="card-body">
            <form action="{{ url('/reports/stock/item_print') }}" method="POST">
              @csrf
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="jenis2">Jenis Laporan</label>
                  <select name="jenis2" class="form-control" id="jenis2">
                    <option value="">Pilih Jenis Laporan</option>
                    <option value="Harian" @if ($request->jenis2=="Harian") selected @endif>Harian</option>
                    <option value="Bulanan" @if ($request->jenis2=="Bulanan") selected @endif>Bulanan</option>
                    <option value="Tahunan" @if ($request->jenis2=="Tahunan") selected @endif>Tahunan</option>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label for="tanggal2">Pilih Tanggal/Bulan/Tahun</label>
                  <input value="{{ $request->tanggal2 }}" type="text" name="tanggal2" class="form-control datetimepicker-input" id="tanggal2" data-toggle="datetimepicker" data-target="#tanggal2" autocomplete="off" disabled>
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
                    <th class="align-middle" scope="col">Stock Awal</th>
                    <th class="align-middle" scope="col">Masuk</th>
                    <th class="align-middle" scope="col">Keluar</th>
                    <th class="align-middle" scope="col">Stok Akhir</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($items as $item)
                    <tr>
                      <td class="align-middle" scope="row">{{ $item->nama }}</td>
                      <td class="align-middle">{{ $item->mutation[0]->stok_awal }}</td>
                      <td class="align-middle">{{ $item->mutation->where('jenis_mutasi', 'penambahan')->sum('stok_mutasi') }}</td>
                      <td class="align-middle">{{ $item->mutation->where('jenis_mutasi', 'pengurangan')->sum('stok_mutasi') }}</td>
                      <td class="align-middle">{{ $item->stok }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer">

          </div>
        </div>
        <!-- Default box -->
        <div class="card">
          <div class="card-body">
            <div class="form-row align-items-center">
              <div class="form-group col-md-4">
                <label for="item_id">Barang</label>
                <form style="all: unset;" action="{{ url('/reports/stock') }}" method="POST">
                  @csrf
                  <select name="item_id" class="form-control select2" name="item_id" id="item_id">
                    <option value="">Semua Barang</option>
                    @foreach ($items as $item)
                      <option value="{{ $item->id }}" @if ($request->item_id == $item->id) selected @endif>{{ $item->nama }}</option>
                    @endforeach
                  </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="jenis">Jenis Laporan</label>
                    <select name="jenis" class="form-control" id="jenis">
                      <option value="">Pilih Jenis Laporan</option>
                      <option value="Harian" @if ($request->jenis=="Harian") selected @endif>Harian</option>
                      <option value="Bulanan" @if ($request->jenis=="Bulanan") selected @endif>Bulanan</option>
                      <option value="Tahunan" @if ($request->jenis=="Tahunan") selected @endif>Tahunan</option>
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="tanggal">Pilih Tanggal/Bulan/Tahun</label>
                    <input value="{{ $request->tanggal }}" type="text" name="tanggal" class="form-control datetimepicker-input" id="tanggal" data-toggle="datetimepicker" data-target="#tanggal" autocomplete="off" disabled>
                  </div>
                  <div class="col-md-2" style="margin-top: 15px;">
                    <div class="btn-group" role="group">
                      <button type="submit" class="btn btn-primary btn-md">Filter</button>
                </form>
                      <form id="print" action="{{ url('/reports/stock/print') }}" method="POST">
                        @csrf
                        <input type="hidden" id="user_print" name="item_id" value="">
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
            <h3 class="card-title">Daftar Mutasi Stok</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive-md">
              <table id="datatable" class="table table-sm bg-light table-bordered table-striped text-center table-hover">
                <thead>
                  <tr>
                    <th class="align-middle" scope="col">Tanggal Mutasi</th>
                    <th class="align-middle" scope="col">Barang</th>
                    <th class="align-middle" scope="col">Jenis Mutasi</th>
                    <th class="align-middle" scope="col">Spesifikasi</th>
                    <th class="align-middle" scope="col">Mutasi</th>
                    <th class="align-middle" scope="col">Stok Akhir</th>
                    <th class="align-middle" scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($mutations as $mutation)
                    <tr>
                      <td class="align-middle" scope="row">{{ $mutation->created_at->format('j F Y') }}</td>
                      <td class="align-middle text-left">{{ $mutation->item->nama }}</td>
                      <td class="align-middle text-left">{{ $mutation->jenis_mutasi }}</td>
                      <td class="align-middle text-left">{{ $mutation->stok_awal }}</td>
                      @if ($mutation->jenis_mutasi == 'penambahan')
                        <td>{{ '+'.$mutation->stok_mutasi }}</td>
                      @else
                        <td>{{ '-'.$mutation->stok_mutasi }}</td>
                      @endif
                      <td class="align-middle text-left">{{ $mutation->stok_akhir }}</td>
                      <td class="align-middle text-left">{{ $mutation->keterangan }}</td>
                    </tr>
                  @endforeach
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
@endsection

@section('js')
  <script>
    var table = $('#barang').DataTable({
      order: [[ 4, "asc" ]]
    });

    var table2 = $('#datatable').DataTable( {
      "order": []
    });

    var ctx = $('#monthly-chart-in');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: @json($chart->masuk_labels),
        datasets: [
          {
            label: 'Barang Masuk',
            backgroundColor: 'rgba(60, 141, 188, 0.9)',
            data: @json($chart->masuk_datasets),
            borderWidth: 1
          },

        ]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true,
              stepSize: 5,
              suggestedMax: 100
            }
          }]
        }
      }
    });
    var ctx2 = $('#monthly-chart-out');
    var myChart2 = new Chart(ctx2, {
      type: 'bar',
      data: {
        labels: @json($chart->keluar_labels),
        datasets: [
          {
            label: 'Barang Keluar',
            backgroundColor: 'rgba(210, 214, 222, 1)',
            data: @json($chart->keluar_datasets),
            borderWidth: 1
          },
        ]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true,
              stepSize: 5,
              suggestedMax: 100
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
      var item_id = $('select#item_id option:selected').val();
      var jenis = $('#jenis option:selected').val();
      var tanggal = $('input#tanggal').val();
      $('input#user_print').val(item_id);
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
@endsection
