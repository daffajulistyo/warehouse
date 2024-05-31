@extends('layouts/main')

@section('title', 'Mutasi Stok Barang')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item">Mutasi Stok</a></li>
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
                    <th class="align-middle" scope="col">Stok Awal</th>
                    <th class="align-middle" scope="col">Mutasi</th>
                    <th class="align-middle" scope="col">Stok Akhir</th>
                    <th class="align-middle" scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($mutations as $mutation)
                    <tr>
                      <td>{{ $mutation->created_at }}</td>
                      <td>{{ $mutation->item->nama }}</td>
                      <td>{{ $mutation->jenis_mutasi }}</td>
                      <td>{{ $mutation->stok_awal }}</td>
                      @if ($mutation->jenis_mutasi == 'penambahan')
                        <td>{{ '+'.$mutation->stok_mutasi }}</td>
                      @else
                        <td>{{ '-'.$mutation->stok_mutasi }}</td>
                      @endif
                      <td>{{ $mutation->stok_akhir }}</td>
                      <td>{{ $mutation->keterangan }}</td>
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
    var table = $('#datatable').DataTable({
      "order": [[ 0, "desc" ]]
    });
  </script>
@endsection