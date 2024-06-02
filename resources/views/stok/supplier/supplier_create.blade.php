@extends('layouts/main')

@section('title', 'Data Supplier')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item"><a href="#">Data Supplier</a></li>
<li class="breadcrumb-item"><a href="#">Tambah Supplier</a></li>
@endsection

@section('content')
<!-- Main content -->
<section class="content">

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Tambah Supplier</h3>
          </div>
          <div class="card-body">
            <div class="col-12">
              <form method="POST" action="{{ url('/suppliers') }}">
                @csrf
                <div class="form-group">
                  <label for="nama">Nama Supplier</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                  <input type="text" class="form-control form-control-sm @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="PT. Mencari Cinta Sejati" value="{{ old('nama') }}">
                    @error('nama')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                    <label for="category_id">Kategori</label>
                    <select name="category_id" id="category_id" class="select2 form-control form-control-sm @error('category_id') is-invalid @enderror">
                      <option value="">Pilih Kategori Barang</option>
                     <option value="">Pilihan 1</option>
                     <option value="">Pilihan 2</option>
                     <option value="">Pilihan 3</option>
                    </select>
                    @error('category_id')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                <div class="form-group">
                  <label for="nama">Spesifikasi</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-book"></i></span>
                    </div>
                  <input type="text" class="form-control form-control-sm @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Spesifikasi..." value="{{ old('nama') }}">
                    @error('nama')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="harga_beli">Harga Satuan</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas">Rp.</i></span>
                          </div>
                          <input type="text" class="form-control form-control-sm @error('harga_beli') is-invalid @enderror" id="harga_beli" name="harga_beli" placeholder="Masukkan Harga Satuan Barang" value="{{ old('harga_beli') }}">
                          @error('harga_beli')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button class="btn btn-md btn-primary float-right">Tambah Supplier</button>
            <a href="{{ url('/suppliers') }}" class="btn btn-md btn-secondary">Kembali</a>
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
