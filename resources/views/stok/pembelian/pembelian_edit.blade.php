@extends('layouts/main')

@section('title', 'Transaksi Pembelian Barang')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item">Transaksi Pembelian</a></li>
@endsection

@section('content')
<!-- Main content -->
<section class="content">

  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-10">
        <!-- Default box -->
        <form action="{{ url('/items/purchases/'.$purchase->id) }}" method="POST">
          @method('patch')
          @csrf
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tambah Transaksi Pembelian</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fas fa-times"></i></button>
              </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                  <label for="supplier_id">Nama Supplier</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                    </div>
                    <select class="custom-select custom-select-md" name="supplier_id" id="supplier_id">
                      @foreach ($suppliers as $supplier)
                      <option value="{{ $supplier->id }}" @if ($purchase->supplier_id == $supplier->id) selected @endif>{{ $supplier->nama }}</option>
                      @endforeach
                    </select>
                    @error('supplier_id')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="card">
                  <div class="card-header">
                    <label for="">Detail Pembelian</label>
                    <button id="add_row" class="btn btn-primary float-right btn-sm"><i class="fa fa-plus"></i></button>
                    <button id='delete_row' class="float-right btn btn-danger btn-sm"><i class="fa fa-minus"></i></button>
                  </div>
                  <div class="card-body table-responsive">
                    <table class="table table-bordered table-md tb bg-light table-striped text-center table-hover" id="table">
                      <thead>
                        <tr>
                          <th scope="col">Barang</th>
                          <th scope="col">Jumlah</th>
                          <th scope="col">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr id="item0">
                          <td class="align-middle">
                            <select class="form-control form-control-sm item" name="item_id[]">
                              <option value="">--- Pilih Barang ---</option>
                              @foreach ($items as $item)
                              <option data-harga="{{ $item->harga_beli }}" value="{{ $item->id }}">{{ $item->nama.' @'.$item->harga_beli.' /'.$item->unit->nama }}</option>
                              @endforeach
                            </select>
                          </td>
                          <td class="align-middle">
                            <input type="number" oninput="validity.valid||(value='');" min="0" class="form-control form-control-sm jumlah @error('jumlah') is-invalid @enderror" name="jumlah[]" placeholder="1" disabled>
                          </td>
                          <td class="align-middle">
                            <div class="input-group input-group-sm">
                              <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                              </div>
                              <input type="number" class="form-control form-control-sm total" placeholder="0" value="0" disabled>
                            </div>
                          </td>
                        </tr>
                        @foreach ($detail->items as $purchased)
                          <tr id="item{{ $loop->iteration }}">
                            <td class="align-middle">
                              <select class="select2 form-control form-control-sm item" name="item_id[]">
                                @foreach ($items as $item)
                                <option data-harga="{{ $item->harga_beli }}" value="{{ $item->id }}" @if ($item->id == $purchased->id) selected @endif>{{ $item->nama.' @'.$item->harga_beli.' /'.$item->unit->nama }}</option>
                                @endforeach
                              </select>
                            </td>
                            <td class="align-middle">
                              <input type="number" value="{{ $purchased->pivot->jumlah }}" oninput="validity.valid||(value='');" min="0" class="form-control form-control-sm jumlah @error('jumlah') is-invalid @enderror" name="jumlah[]">
                            </td>
                            <td class="align-middle">
                              <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="number" class="form-control form-control-sm total" value="{{ $purchased->harga_beli*$purchased->pivot->jumlah }}" disabled>
                              </div>
                            </td>
                          </tr>
                        @endforeach
                        {{-- <tr id="item1"><td colspan="3">Belum ada data, Silahkan tambah baris....</td></tr> --}}
                      </tbody>
                    </table>
                  </div>
                  <div class="card-footer">
                    <button id="simpan" type="button" class="btn btn-success btn-sm">Simpan</button>
                    <div id="grand-total" class="float-right">
                      <div class="input-group input-group-sm mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Total Pembelian</span><span class="input-group-text">Rp. </span>
                        </div>
                        <input id="total_bayar" name="total_bayar" min="0" type="number" class="form-control" value="{{ $purchase->total_bayar }}" readonly>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="keterangan">Keterangan Pembelian</label>
                  <textarea class="form-control" name="keterangan" id="keterangan" rows="3" placeholder="Silahkan isi keterangan pembelian jika perlu....">{{ $purchase->keterangan }}</textarea>
                  @error('keterangan')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <a class="btn btn-secondary btn-md" href="{{ url('/items/purchases/') }}">Kembali</a>
              <button id="submit" type="submit" class="btn btn-primary btn-md float-right" disabled>Submit</button>
            </div>
            <!-- /.card-footer-->
          </div>
        </form>
        <!-- /.card -->
      </div>
    </div>
  </div>
</section>
<!-- /.content -->
@endsection

@section('js')
<script> 
  var jumlah = '';
  var harga = '';
  // let row_number = 1;

  $('#item0').hide();
  
  $("#add_row").click(function(e){
    e.preventDefault();
    $('td.empty').parent().remove();
    let row_number = $('table tr').last().index();
    row_number++;
    var clone = $('#item0').children().clone(true,true);
    $('#table').append('<tr id="item' + (row_number) + '"></tr>');
    $('#item' + row_number).html('').append(clone);
    $('input.jumlah').eq(row_number).attr('disabled', true);
    $('select.item').eq(row_number).select2();
  });

  $("#delete_row").click(function(e){
    e.preventDefault();
    let row_number = $('table tr').last().index();
    if (row_number == 1) {
      $("#item"+row_number).html('<td class="empty" colspan="3">Belum ada data, Silahkan tambah baris....</td>');
    } else {
      $('table tr').last().remove();
    }
  });

  $(document).on('change', 'select.item', function(){
    let idx = $(this).index('select.item');
    window.harga = $(this).find(':selected').data('harga');
    $('.jumlah').eq(idx).removeAttr('disabled');
    $('.total').eq(idx).val(jumlah*harga);
  });

  $(document).on('change', 'input.jumlah', function(){
    let idx = $(this).index('input.jumlah');
    window.jumlah = $(this).val();
    $('.total').eq(idx).val(jumlah*harga);
  });
  
  $('#simpan').click(function () {
    var sum = 0;
    $('.total').each(function() {
        var total = parseInt($(this).val());
        parseInt(sum += total);
        $('#total_bayar').val(sum);
    });
    $('#submit').removeAttr('disabled');
  });

  $('form').submit(function () {
    $("#item0").remove();
    return true;
  });
</script>
@endsection