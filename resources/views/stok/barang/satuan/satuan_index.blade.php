@extends('layouts/main')

@section('title', 'Data Satuan Barang')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item"><a href="#">Barang</a></li>
<li class="breadcrumb-item"><a href="#">Satuan</a></li>
@endsection

@section('content')
<!-- Main content -->
<section class="content">

  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-9">
        @if (session('message'))
          <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Daftar Satuan</h3>
            <a href="{{ url('/items/units/create') }}" class="btn btn-primary float-right text-white">Tambah Satuan</a>
          </div>
          <div class="card-body">
            <ul class="list-group">
              @foreach ($units as $unit)
              <li class="list-group-item list-group-item-action list-group-item-light">{{ $unit->nama }}
                <form style="all: unset;" action="{{ url('/items/units/'.$unit->id) }}" method="POST">
                  @method('delete')
                  @csrf
                  <button class="btn btn-danger float-right btn-sm"><i class="nav-icon fas fa-trash"></i></button>
                </form>
                <a href="{{ url('/items/units/'.$unit->id.'/edit') }}" class="btn btn-warning float-right btn-sm"><i class="nav-icon fas fa-pen"></i></a>
              </li>    
              @endforeach
            </ul>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
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