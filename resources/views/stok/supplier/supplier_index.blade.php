@extends('layouts/main')

@section('title', 'Data Supplier')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<li class="breadcrumb-item"><a href="#">Data Supplier</a></li>
@endsection

@section('content')
<!-- Main content -->
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
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Daftar Supplier</h3>
            <a href="{{ url('/suppliers/create') }}" class="btn btn-primary float-right text-white">Tambah Supplier</a>
          </div>
          <div class="card-body">
            <div class="col-7">
              <div class="list-group">
                @foreach ($suppliers as $supplier)    
                <a href="{{ url('/suppliers/'.$supplier->id.'/edit') }}" class="list-group-item list-group-item-action list-group-item-light font-weight-light">{{ $supplier->nama }}</a>
                @endforeach
              </div>
            </div>
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