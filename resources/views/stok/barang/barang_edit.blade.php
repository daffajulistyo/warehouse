@extends('layouts/main')

@section('title', 'Data Stok Material')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item"><a href="#">Data Stok</a></li>
<li class="breadcrumb-item"><a href="#">Ubah Data Barang</a></li>
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
            <h3 class="card-title">Ubah Data Barang</h3>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ url('/items/'.$item->id) }}" enctype="multipart/form-data">
              @method('patch')
              @csrf
              <div class="form-group">
                <label for="nama">Nama</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                  </div>
                <input type="text" class="form-control form-control-sm @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Buku Tulis Sidu 58 Lembar" value="{{ $item->nama }}">
                  @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="category_id">Kategori</label>
                    <select name="category_id" id="category_id" class="form-control form-control-sm @error('category_id') is-invalid @enderror">
                      @foreach ($categories as $category)
                      <option value="{{ $category->id }}" @if ($category->id==$item->category_id) selected @endif>{{ $category->nama }}</option>
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
                    <select name="unit_id" id="unit_id" class="form-control form-control-sm @error('unit_id') is-invalid @enderror">
                      @foreach ($units as $unit)
                      <option value="{{ $unit->id }}" @if ($unit->id==$item->unit_id) selected @endif>{{ $unit->nama }}</option>
                      @endforeach
                    </select>
                    @error('unit_id')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="form-row">
                {{-- <div class="col-4">
                  <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="text" class="form-control form-control-sm @error('stok') is-invalid @enderror" id="stok" name="stok" placeholder="23" value="{{ $item->stok }}">
                    @error('stok')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div> --}}
                <div class="col-12">
                  <div class="form-group">
                    <label for="harga_beli">Harga Beli</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas">Rp.</i></span>
                      </div>
                      <input type="text" class="form-control form-control-sm @error('harga_beli') is-invalid @enderror" id="harga_beli" name="harga_beli" placeholder="45000" value="{{ $item->harga_beli }}">
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
            <button class="btn btn-md btn-primary float-right">Update Barang</button>
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
