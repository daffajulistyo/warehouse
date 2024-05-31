@extends('layouts/main')

@section('title', 'Transaksi Pembelian Barang')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item">Transaksi Pembelian</a></li>
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
            <h3 class="card-title">Daftar Transaksi Pembelian</h3>
            <a href="{{ url('/items/purchases/create') }}" class="btn btn-primary float-right text-white">Tambah Transaksi Pembelian</a>
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
                    <th class="align-middle" scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($purchases as $purchase)
                    <tr>
                      <td class="align-middle">{{ $purchase->created_at->format('Y-m-d') }}</td>
                      <td class="align-middle">{{ $purchase->kode_pembelian }}</td>
                      <td class="align-middle text-left">{{ $purchase->supplier->nama }}</td>
                      <td class="align-middle text-left">
                        <ul class="product-list">
                          @foreach ($purchase->purchaseDetail->items as $item)
                            <li>{{ $item->nama.' @Rp.'.$item->harga_beli.' x '.$item->pivot->jumlah.' '.$item->unit->nama }}</li>
                          @endforeach
                        </ul>
                      </td>
                      <td class="align-middle text-nowrap">{{ 'Rp. '.number_format($purchase->total_bayar).' ,-' }}</td>
                      <td class="align-middle text-left">{{ $purchase->keterangan }}</td>
                      <td class="align-middle">
                        {{-- <a href="{{ url('/items/purchases/'.$purchase->id.'/edit') }}" class="btn btn-warning btn-sm"><i class="nav-icon fas fa-pen"></i></a> --}}
                        <form style="all: unset;" action="{{ url('/items/categories/'.$purchase->id) }}" method="POST">
                          @method('delete')
                          @csrf
                          <button class="btn btn-danger btn-sm"><i class="nav-icon fas fa-trash"></i></button>
                        </form>
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
      "order": [[ 0, "desc" ]]
    });
  </script>
@endsection