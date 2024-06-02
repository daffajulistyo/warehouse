@extends('layouts/main')

@section('title', 'Data Stok Material')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item"><a href="#">Data Stok</a></li>
<li class="breadcrumb-item"><a href="#">Tambah Barang</a></li>
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
            <h3 class="card-title">Tambah Barang</h3>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ url('/items') }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="nama">Nama Barang</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                  </div>
                <input type="text" class="form-control form-control-sm @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukkan Nama Barang" value="{{ old('nama') }}">
                  @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="category_id">Kategori</label>
                    <select name="category_id" id="category_id" class="select2 form-control form-control-sm @error('category_id') is-invalid @enderror">
                      <option value="">Pilih Kategori Barang</option>
                      @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->nama }}</option>
                      @endforeach
                    </select>
                    @error('category_id')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="unit_id">Satuan</label>
                    <select name="unit_id" id="unit_id" class="select2 form-control form-control-sm @error('unit_id') is-invalid @enderror">
                      <option value="">Pilih Satuan Barang</option>
                      @foreach ($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                      @endforeach
                    </select>
                    @error('unit_id')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
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
          <!-- /.card-body -->
          <div class="card-footer">
            <button class="btn btn-md btn-primary float-right">Tambah Barang</button>
            <a href="{{ url('/items') }}" class="btn btn-md btn-secondary">Kembali</a>
          </div>
            </form>
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
  function readUrl(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#gambar-preview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $('#gambar').change(function () {
    readUrl(this);
  })
</script>
@endsection
