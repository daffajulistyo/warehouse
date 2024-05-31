@extends('shop.layouts.main')

{{-- @section('title', 'Dashboard') --}}

{{-- @section('breadcrumb')
<li class="breadcrumb-item">Dashboard</li>
@endsection --}}

@section('test')
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
      <li class="nav-header text-center nav-header-top"><h6 class="bg-secondary nav-header-title">Filter</h6></li>
      <form action="{{ url('/shop/filter') }}" method="POST">
        @csrf
        <div class="form-group">            
          <label class="text-white" for="">Kategori</label>
          <select name="kategori" class="form-control form-control-sm select2" id="">
            <option value="">Pilih Kategori</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->nama }}</option>
            @endforeach
          </select>
        </div>
        <label class="text-white" for="">Batas Harga(Rp)</label>
        <div class="form-row">
          <div class="col">
            <input name="min" class="form-control form-control-sm" type="number" placeholder="Min">
          </div>
          <div class="col">
            <input name="max" class="form-control form-control-sm" type="number" placeholder="Max">
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-sm" style="margin-top: 20px;">Apply</button>
      </form>
    </ul>
  </nav>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row text-sm">
              @foreach ($items as $item)
                <div class="col-6 d-flex align-items-stretch">
                  <div class="card w-100">
    
                    <!-- Card image -->
                    <img class="card-img-top" src="{{ url('/img/items_img/'.$item->gambar) }}" alt="Produk">
                    {{-- <img class="card-img-top" src="https://via.placeholder.com/150?text={{ $item->nama }}" alt="Produk"> --}}
                  
                    <!-- Card content -->
                    <div class="card-body">
                  
                      <!-- Title -->
                      <h6 class="card-title">{{ $item->nama }}</h6><br>
                      <!-- Text -->
                      <span class="info-box-text">Rp. {{ number_format($item->harga_jual, 2) }} / {{ $item->unit->nama }}</span>
                      <!-- Button -->
                    </div>
                    <a href="{{ url('/shop/'.$item->id) }}" class="btn btn-primary btn-block rounded-0">Lihat barang</a>
                  
                  </div>
                </div>
              @endforeach
              @isset ($request->search)
                <div class="col-md-12">
                  <a href="{{ url('/shop') }}" type="submit" class="btn btn-primary btn-block">Kembali</a>
                </div> 
              @endif
            </div>
        </div>
    </section>
@endsection