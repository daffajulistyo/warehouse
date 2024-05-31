@extends('layouts/main')

@section('title', 'Data Stok Material')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item"><a href="#">Data Stok</a></li>
@endsection

@section('content')
<!-- Main content -->
<section class="content">

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- Default box -->
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
            <h3 class="card-title">Daftar Stok Material</h3>

            <a href="{{ url('/items/create') }}" class="btn btn-primary float-right text-white">Tambah Barang</a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="datatable" class="table table-sm bg-light table-bordered table-striped text-center table-hover">
                <thead class="thead-dark">
                  <tr>
                    <th class="align-middle" scope="col">#</th>
                    <th class="align-middle" scope="col">Nama Barang</th>
                    <th class="align-middle" scope="col">Kategori</th>
                    <th class="align-middle" scope="col">Harga Beli</th>
                    <th class="align-middle" scope="col">Harga Jual</th>
                    <th class="align-middle" scope="col">Stok</th>
                    <th class="align-middle" scope="col">Satuan</th>
                    <th class="align-middle" scope="col" style="width: 15%;">Gambar</th>
                    <th class="align-middle" scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($items as $item)
                  <tr>
                    <td scope="row" class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $item->nama }}</td>
                    @if ($item->category_id==NULL)
                      <td class="align-middle">-</td>
                    @else
                      <td class="align-middle">{{ $item->category->nama }}</td>
                    @endif
                    <td class="align-middle text-nowrap">Rp. {{ number_format($item->harga_beli, 2) }}</td>
                    <td class="align-middle text-nowrap">Rp. {{ number_format($item->harga_jual, 2) }}</td>
                    <td class="align-middle">{{ $item->stok }}</td>
                    @if ($item->unit_id==NULL)
                      <td class="align-middle">-</td>
                    @else
                      <td class="align-middle">{{ $item->unit->nama }}</td>
                    @endif
                    <td class="align-middle"><img src="{{ url('/img/items_img/'.$item->gambar) }}" class="img-thumbnail" alt="{{ $item->nama }}"></td>
                    <td class="align-middle">
                      <a class="btn btn-primary btn-xs" href="{{ url('/items/'.$item->id.'/edit') }}"><i class="fas fa-md fa-edit"></i></a>
                      <form action="{{ url('/items/'.$item->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger btn-xs"><i class="fas fa-md fa-trash-alt"></i></button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card-body -->
          {{-- <div class="card-footer">
            Footer
          </div> --}}
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
    });
  </script>
@endsection
