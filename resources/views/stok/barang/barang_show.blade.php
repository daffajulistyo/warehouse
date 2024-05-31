@extends('layouts/main')

@section('title', 'Data Stok Material')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item"><a href="#">Data Stok</a></li>
<li class="breadcrumb-item">Edit Barang</li>
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
            <h3 class="card-title">Edit Barang</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="">Nama Barang</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                    </div>
                    <input type="text" class="form-control form-control-sm" id="ip_publik" data-inputmask="'alias': 'ip'" data-mask placeholder="112.140.160.112">
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="exampleFormControlFile1">Gambar</label>
                  <input type="file" class="form-control-file border" id="exampleFormControlFile1">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="ip_publik">Jumlah Barang</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                    </div>
                    <input type="text" class="form-control form-control-sm" id="ip_publik" data-inputmask="'alias': 'ip'" data-mask placeholder="112.140.160.112">
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="ip_lokal">Satuan</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                    </div>
                    <input type="text" class="form-control form-control-sm" id="ip_lokal" data-inputmask="'alias': 'ip'" data-mask placeholder="172.18.1.112">
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="ip_lokal">Harga</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                    </div>
                    <input type="text" class="form-control form-control-sm" id="ip_lokal" data-inputmask="'alias': 'ip'" data-mask placeholder="172.18.1.112">
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="ip_lokal">Expired Date</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                    </div>
                    <input type="text" class="form-control form-control-sm" id="ip_lokal" data-inputmask="'alias': 'ip'" data-mask placeholder="172.18.1.112">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button class="btn btn-md btn-primary float-right">Tambah</button>
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
