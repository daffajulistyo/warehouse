@extends('shop.layouts.main')

{{-- @section('title', 'Dashboard')

@section('breadcrumb')
<li class="breadcrumb-item">Dashboard</li>
@endsection --}}

@section('content')
<!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-sm-6">
            <div class="col-12">
              <img src="{{ url('/img/items_img/'.$item->gambar) }}" class="product-image" alt="Product Image">
            </div>
          </div>
          <div class="col-12 col-sm-6">
            <h3 class="my-3">{{ $item->nama }}</h3>

            <hr>
            <h4>Informasi Barang</h4>
            <table>
              <tr>
                <td>Stok</td>
                <td>:</td>
                <td id="stok">{{ $item->stok }}</td>
              </tr>
              <tr>
                <td>Satuan</td>
                <td>:</td>
                <td>{{ $item->unit->nama }}</td>
              </tr>
              <tr>
                <td>Harga</td>
                <td>:</td>
                <td id="harga">Rp. {{ $item->harga_jual }}</td>
              </tr>
            </table>

            <form action="{{ url('/shop') }}" method="POST">
              @csrf
              <div class="bg-gray py-2 px-3 mt-4">
                <div class="input-group mb-3">
                  <input type="hidden" name="item_id" value="{{ $item->id }}">
                  <input type="number" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah Barang" class="form-control">
                  <div class="input-group-append">
                    <span class="input-group-text">{{ $item->unit->nama }}</span>
                  </div>
                </div>
                <br>
                <h2 class="mb-0">
                  Total
                </h2>
                <h4 class="mt-0">
                  <small>Rp. 0</small>
                </h4>
              </div>

              <div class="mt-4 text-center">
                <button type="submit" class="btn btn-primary btn-lg btn-flat text-light">
                  <i class="fas fa-cart-plus fa-lg mr-2"></i> 
                  Masukkan Keranjang
                </button>
                
              </div>
            </form>

          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <a id="back-to-top" href="{{ url('/shop') }}" class="btn btn-success back-to-top" role="button" aria-label="Scroll to top">
    <i class="fas fa-home"></i>
  </a>
<!-- /.content -->
@endsection

@section('js')
  <script>
    $('input#jumlah').keyup(function () {
      if ($(this).val() > parseInt($('td#stok').text())) {
        $(this).val(0);
        $(this).tooltip({title: "Tidak Boleh Melebihi Stok", placement: "top"}).tooltip('show');
      }
      var total = parseInt(($('td#harga').text().replace(/[^0-9]/g, ''))*($(this).val()));
      $('h4.mt-0').text('Rp. '+total);
    });
  </script>
@endsection