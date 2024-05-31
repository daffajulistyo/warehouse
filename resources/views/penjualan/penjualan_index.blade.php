@extends('layouts/main')

@section('title', 'Data Penjualan')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item"><a href="#">Penjualan</a></li>
@endsection

@section('content')
<!-- Main content -->
<section class="content">

  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md">
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
            <h3 class="card-title">Daftar Penjualan</h3>
            <a href="{{ url('/sales/create') }}" class="btn btn-primary float-right text-white">Tambah Penjualan</a>
          </div>
          <div class="card-body">
            <div class="table-responsive-md">
              <table id="datatable" class="table table-sm bg-light table-striped text-center table-hover">
                <thead class="thead-light">
                  <tr>
                    <th class="align-middle" scope="col">Tanggal Penjualan</th>
                    <th class="align-middle" scope="col">Kode Transaksi</th>
                    <th class="align-middle" scope="col">Customer</th>
                    <th class="align-middle" scope="col">Transaksi</th>
                    <th class="align-middle" scope="col">Total Bayar</th>
                    <th class="align-middle" scope="col">Status</th>
                    <th class="align-middle" scope="col">Keterangan</th>
                    <th class="align-middle" scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($sales as $sale)
                    <tr>
                      <td class="align-middle" scope="row">{{ $sale->created_at->format('j F Y') }}</td>
                      <td class="align-middle">{{ $sale->kode_transaksi }}</td>
                      <td class="align-middle">{{ $sale->user->name }}</td>
                      <td class="align-middle text-left">
                        <ul>
                          @foreach ($sale->items as $item)
                            <li>{{ $item->nama.' @Rp.'.$item->harga_jual.' x '.$item->pivot->jumlah.' '.$item->unit->nama }}</li>
                          @endforeach
                        </ul>
                      </td>
                      <td class="align-middle text-nowrap">{{ 'Rp. '.$sale->total_bayar.',-' }}</td>
                      <td class="align-middle">{{ $sale->status }}</td>
                      <td class="align-middle">{{ $sale->keterangan }}</td>
                      <td class="align-middle">
                        @if ($sale->status == 'Lunas')
                          
                        @else
                          <a href="{{ url('/sales/'.$sale->id.'/edit') }}" class="btn btn-warning btn-sm"><i class="nav-icon fas fa-pen"></i></a>
                          <form style="all: unset;" action="{{ url('/sales/'.$sale->id) }}" method="POST">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger btn-sm"><i class="nav-icon fas fa-trash"></i></button>
                          </form>
                        @endif
                      </td>
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
      "order": []
    });
  </script>
@endsection