@extends('layouts/main')

@section('title', 'Data Pelanggan')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item"><a href="#">Pelanggan</a></li>
<li class="breadcrumb-item"><a href="#">Edit Pelanggan</a></li>
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
            <h3 class="card-title">Pelanggan</h3>
          </div>
          <form method="POST" action="{{ url('/customers/'.$user->id) }}">
            <div class="card-body">
              @method('patch')
              @csrf
              <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                </div>
              </div>
              <div class="form-group row">
                <label for="username" class="col-sm-3 col-form-label">Username</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="username" id="username" value="{{ $user->username }}">
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}">
                </div>
              </div>
              <div class="form-group row">
                <label for="phone" class="col-sm-3 col-form-label">Nomor Telepon</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="phone" id="phone" value="{{ $user->phone }}">
                </div>
              </div>
              <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" value="">
                </div>
              </div>
              <div class="form-group row">
                <label for="password-confirm" class="col-sm-3 col-form-label">Konfirmasi Password</label>
                <div class="col-sm-9">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" value="">
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-md btn-primary float-right">Simpan</button>
              <a href="{{ url('/customers') }}" class="btn btn-md btn-secondary">Kembali</a>
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
    $(document).on('change', 'select#item_id', function(){
      var awal = $(this).find(':selected').data('stok');
      // let idx = $(this).index('select.item');
      // window.harga = $(this).find(':selected').data('harga');
      // $('.jumlah').eq(idx).removeAttr('disabled');
      $('#stok_awal').val(awal);
    });
  </script>
@endsection