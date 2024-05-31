@extends('layouts/main')

@section('title', 'Data Penjualan')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item"><a href="#">Tambah Penjualan</a></li>
@endsection

@section('content')
<!-- Main content -->
<section class="content">

  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-sm">
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Penjualan</h3>
          </div>
          <form method="POST" action="{{ url('/sales') }}">
            <div class="card-body">
              @csrf
              <div class="form-group row">
                <label for="kode_transaksi" class="col-sm-2 col-form-label">Kode Transaksi</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" value="{{ $transaction_code }}" name="kode_transaksi" id="kode_transaksi" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="Status" class="col-sm-2 col-form-label">Status Transaksi</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" value="Lunas" name="status" id="Status" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" value="{{ date('d-m-Y') }}" id="tanggal" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label for="user_id" class="col-sm-2 col-form-label">Nama Pelanggan</label>
                <div class="col-sm-4">
                  <select class="form-control select2" name="user_id" id="user_id">
                    @foreach ($customers as $customer)
                      <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                  </select>
                  @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="item" class="col-sm-2 col-form-label">Tambah Barang</label>
                <div class="col-sm-7">
                  <select class="select2 form-control" id="item">
                    <option value="">Silahkan Pilih Barang</option>
                    @foreach ($items as $item)
                    <option data-id="{{ $item->id }}" data-harga="{{ $item->harga_jual }}" data-item="{{ $item->nama }}" data-stok="{{ $item->stok }}">{{ $item->nama.' @'.$item->harga_jual }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="input-group col-sm-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Stok</span>
                  </div>
                  <input id="stok-label" value="" type="number" class="form-control" disabled>
                </div>
              </div>
              <div class="row">
                <div class="col-sm">
                  <div class="card">
                    <div class="card-body table-responsive">
                      <table id="datatable" class="table table-sm bg-light table-striped text-center table-hover">
                        <thead>
                          <tr>
                            <th scope="col">Barang</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Total</th>
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                      </table>
                    </div>
                    <div class="card-footer">
                      <div class="float-right">
                        <div class="input-group input-group-sm mb-2">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Total Bayar</span><span class="input-group-text">Rp. </span>
                          </div>
                          <input id="total_bayar" name="total_bayar" min="0" type="number" class="form-control" value="0" readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control" name="keterangan" id="keterangan" rows="3" placeholder="Silahkan isi keterangan jika perlu...."></textarea>
                @error('keterangan')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-md btn-primary float-right">Simpan</button>
              <a href="{{ url('/sales') }}" class="btn btn-md btn-secondary">Kembali</a>
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
    var table = $('#datatable').DataTable({
      "ordering": false
    });
    $('#item').change(function () {
      var harga = $(this).find(':selected').data('harga');
      var stok = $(this).find(':selected').data('stok');
      var item = $(this).find(':selected').data('item');
      var item_id = $(this).find(':selected').data('id');
      var new_row = table.row.add([
        '<input name="item_id[]" type="hidden" value="'+item_id+'">'+item,
        'Rp. '+ harga +' ,-',
        '<input name="jumlah[]" data-stok="'+ stok +'" type="number" class="form-control form-control-sm jumlah" placeholder="0">',
        '<td class="total">0</td>',
        '<td><button type="button" class="btn btn-danger btn-sm del-row"><i class="fa fa-minus"></i></button></td>'
      ]).draw( true ).node();
      $(new_row).addClass('item-row');
      $(new_row).find('td').eq(3).addClass('total');
      // $('td.dataTables_empty').hide();
      $('#stok-label').val(stok);
      // $('#datatable').append(row);
    });

    $(document).on('click', 'button.del-row', function(){
      var row = table.row($(this).parents('tr')).remove().draw();

      var sum = 0;
      $('.total').each(function() {
        var total_row = parseInt($(this).text().replace(/[^0-9]/g, ''));
        parseInt(sum += total_row);
      });
      $('#total_bayar').val(sum);
    });

    $(document).on('keyup', 'input.jumlah', function(){
      var sum = 0;
      let idx = $(this).index('input.jumlah');
      var jumlah = $(this).val();
      if (jumlah > $(this).data('stok')) {
        $(this).val('');
        $(this).tooltip({title: "Tidak Boleh Melebihi Stok", placement: "top"}).tooltip('show');
      }

      var harga = $(this).parent().prev().text();
      harga = harga.replace(/[^0-9]/g, '');
      var row_total = parseInt(jumlah*harga);
      $('tr.item-row').eq(idx).children().eq(3).html('Rp. '+ row_total +' ,-');
      $('.total').each(function() {
        var total_row = parseInt($(this).text().replace(/[^0-9]/g, ''));
        parseInt(sum += total_row);
      });
      $('#total_bayar').val(sum);
    });
  </script>
@endsection