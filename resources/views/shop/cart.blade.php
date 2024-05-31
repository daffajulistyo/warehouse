@extends('shop.layouts.main')

@section('title', 'Keranjang Anda')

{{-- @section('breadcrumb')
<li class="breadcrumb-cart->item">Dashboard</li>
@endsection --}}

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          @if (session('message'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
              <strong>{{ session('message') }}</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
        </div>
        {{-- <form id="cart" action=""> --}}
          @foreach ($carts as $cart)
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-info"><img src="{{ url('/img/items_img/'.$cart->item->gambar) }}" alt="..." class="img-thumbnail"></span>
    
                <div class="info-box-content">
                  <input type="hidden" name="item_id[]" value="{{ $cart->item->id }}">
                  <span class="info-box-text font-weight-bold">{{ $cart->item->nama }}</span>
                  <div class="row">
                    <div class="col-6 align-middle">
                      <span class="info-box-text harga ">Rp. {{ $cart->item->harga_jual }} / {{ $cart->item->unit->nama }}</span>
                    </div>
                    <div class="col-6 text-center">
                      @if ($cart->item->stok<=10)
                        <span class="text-danger">Stok Tinggal {{ $cart->item->stok }}!</span>
                      @endif
                      <input type="hidden" class="stok" value="{{ $cart->item->stok }}">
                    </div>
                  </div>
                  <span class="info-box-text"><span>Subtotal : Rp. </span><span class="subtotal">0</span></span>
                  {{-- <span class="info-box-number">Jumlah Barang :</span> --}}
                  <div class="row">
                    <div class="col-6">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <button class="btn btn-outline-secondary btn-sm minus" data-id="{{ $cart->id }}" type="button"><i class="fa fa-minus"></i></button>
                        </div>
                        <input type="number" name="jumlah[]" class="form-control form-control-sm text-center" value="{{ $cart->jumlah }}" readonly>
                        <div class="input-group-append">
                          <button class="btn btn-outline-secondary btn-sm plus" data-id="{{ $cart->id }}" type="button"><i class="fa fa-plus"></i></button>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 text-center">
                      <form action="{{ url('/cart/'.$cart->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-sm">Hapus Barang</button>
                      </form>
                      {{-- <a href="{{ url('/cart/'.$cart->id) }}" class="btn btn-danger btn-sm">Hapus barang</a> --}}
                    </div>
                  </div>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>    
          @endforeach
          <div class="col-md-12">
            <p class="float-right font-weight-bold">Total Bayar : Rp. <span id="total_bayar">0</span></p>
            <button type="submit" id="checkout" class="btn btn-primary btn-block">Checkout</button>
          </div> 
        {{-- </form> --}}
      </div>
    </div>
  </section>
  <a id="back-to-top" href="{{ url('/shop') }}" class="btn btn-success back-to-top" role="button" aria-label="Scroll to top">
    <i class="fas fa-home"></i>
  </a>
@endsection

@section('js')
<script>

  function hitung() {
    var total = 0;
    $("input[name='jumlah[]']").each(function(){
      var index = $(this).index("input[name='jumlah[]']");
      var harga = $('span.harga').eq(index).text().replace(/[^0-9]/g, '');
      var sub_total = parseInt(this.value*harga);
      $('span.subtotal').eq(index).text(sub_total);
      total = total+=sub_total;
      // alert(sub_total);
      $('#total_bayar').text(total);
    });
  }

  $(hitung());

  $("button.plus").click(function () {
    var index = $(this).index("button.plus");
    var jumlah_item = parseInt($("input[name='jumlah[]']").eq(index).val());
    jumlah_item += 1;
    var cart_id = $(this).data('id');
    var stok = parseInt($('.stok').eq(index).val());
    // alert(stok);
    if (jumlah_item>stok) {
      $("input[name='jumlah[]']").eq(index).val(stok);
    } else {
      $("input[name='jumlah[]']").eq(index).val(jumlah_item);
      $.ajax({
        type      : 'PATCH',
        url       : '{{ url("/cart/") }}/'+cart_id,
        dataType  : 'json',
        data      : {"_token": "{{ csrf_token() }}", jumlah:jumlah_item},
        success   : function () {
          console.log('success');
          hitung();
        },
        error     : function () {
          console.log('error');
        }
      });
    }
  });

  $("button.minus").click(function () {
    var index = $(this).index("button.minus");
    var jumlah_item = parseInt($("input[name='jumlah[]']").eq(index).val());
    var input = jumlah_item - 1;
    var cart_id = $(this).data('id');
    if(input<1){
      $("input[name='jumlah[]']").eq(index).val(jumlah_item);
      $.ajax({
        type      : 'PATCH',
        url       : '{{ url("/cart/") }}/'+cart_id,
        dataType  : 'json',
        data      : {"_token": "{{ csrf_token() }}", jumlah:jumlah_item},
        success   : function () {
          console.log('success');
          hitung();
        },
        error     : function () {
          console.log('error');
        }
      });
    } else {
      $("input[name='jumlah[]']").eq(index).val(input);
      $.ajax({
        type      : 'PATCH',
        url       : '{{ url("/cart/") }}/'+cart_id,
        dataType  : 'json',
        data      : {"_token": "{{ csrf_token() }}", jumlah:input},
        success   : function () {
          console.log('success');
          hitung();
        },
        error     : function () {
          console.log('error');
        }
      });
    }
    
  });

  $("button#checkout").click( function () {
    var item_id = [];
    var jumlah = [];

    $("input[name='item_id[]']").each(function(){
      item_id.push(this.value);
    });
    $("input[name='jumlah[]']").each(function(){
      jumlah.push(this.value);
    });

    var total_bayar = parseInt($('#total_bayar').text());
    // alert('');
    $.ajax({
      type      : 'POST',
      url       : '{{ url("/cart") }}',
      dataType  : 'json',
      data      : {"_token": "{{ csrf_token() }}", item_id:item_id, jumlah:jumlah, total_bayar:total_bayar},
      success   : function () {
        window.location.href = '{{ url("/orders") }}';
      },
      error     : function () {
        console.log('error');
      }
    });
  });
</script>
@endsection