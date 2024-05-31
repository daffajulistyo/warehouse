@extends('layouts/main')

@section('title', 'Data Kategori')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item"><a href="#">Barang</a></li>
<li class="breadcrumb-item"><a href="#">Kategori</a></li>
<li class="breadcrumb-item">Tambah Kategori</li>
@endsection

@section('content')
<!-- Main content -->
<section class="content">

  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-9">
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Tambah Kategori</h3>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ url('/items/categories') }}">
              @csrf
              <div class="form-group">
                <label for="nama">Nama Kategori</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-th-list"></i></span>
                  </div>
                  <input type="text" class="form-control form-control-sm @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Buku" value="{{ old('nama') }}">
                  @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button class="btn btn-md btn-primary float-right">Tambah Kategori</button>
            <a href="{{ url('/items/categories') }}" class="btn btn-md btn-secondary">Kembali</a>
            </form>
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