@extends('layouts/main')

@section('title', 'Data Satuan')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ url('/items/units') }}">Satuan</a></li>
<li class="breadcrumb-item"><a>Tambah Satuan</a></li>
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
            <h3 class="card-title">Tambah Satuan</h3>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ url('/items/units') }}">
              @csrf
              <div class="form-group">
                <label for="nama">Nama Satuan</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
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
            <button class="btn btn-md btn-primary float-right">Tambah Satuan</button>
            <a href="{{ url('/items/units') }}" class="btn btn-md btn-secondary">Kembali</a>
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