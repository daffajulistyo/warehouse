@extends('layouts/main')

@section('title', 'Mutasi Stok Barang')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item"><a href="#">Mutasi Stok</a></li>
<li class="breadcrumb-item">Tambah Mutasi Stok</li>
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
            <h3 class="card-title">Koreksi Stok Kategori</h3>
          </div>
          <form method="POST" action="{{ url('/items/mutations') }}">
            <div class="card-body">
              @csrf
              <div class="form-group row">
                <label for="item_id" class="col-sm-3 col-form-label">Kategori</label>
                <div class="col-sm-9">
                  <select class="form-control select2" name="item_id" id="item_id">
                    @foreach ($items as $item)
                      <option data-stok="{{ $item->stok }}" value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="stok_awal" class="col-sm-3 col-form-label">Spesifikasi</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" name="stok_awal" id="stok_awal" placeholder="Pilih Barang ...." value="">
                </div>
              </div>
              <div class="form-group row">
                <label for="jenis_mutasi" class="col-sm-3 col-form-label">Jenis Mutasi</label>
                <div class="col-sm-9">
                  <select name="jenis_mutasi" id="jenis_mutasi" class="form-control">
                    <option value="penambahan">Penambahan</option>
                    <option value="pengurangan">Pengurangan</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="stok_mutasi" class="col-sm-3 col-form-label">Stok Mutasi</label>
                <div class="col-sm-9">
                  <input type="number" name="stok_mutasi" class="form-control" id="stok_mutasi" value="0">
                </div>
              </div>
              <div class="form-group">
                <label for="keterangan">Keterangan Mutasi Stok</label>
                <textarea class="form-control" name="keterangan" id="keterangan" rows="3" placeholder="Silahkan isi keterangan mutasi stok jika perlu...."></textarea>
                @error('keterangan')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-md btn-primary float-right">Mutasi Stok</button>
              <a href="{{ url('/items/mutations') }}" class="btn btn-md btn-secondary">Kembali</a>
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
