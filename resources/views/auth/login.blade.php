<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>  Grosir</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/css/fa.all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ url('/css/sim.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="{{ url('/css/googlefont.css') }}" rel="stylesheet">
</head>
<body id="background" class="hold-transition login-page" style='background-image: url({{ url("/img/sites_img/login.jpg") }})'>
<div class="login-box">
  <div class="login-logo">
    <a href="#" class="text-white display-5">
      @if ($agent->isMobile())
        <b>Aplikasi Katalog</b> <br>
      @endif
      <b> </b> <br>
      Warehouse Management System
    </a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silahkan masuk untuk memulai</p>

      <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
          <input placeholder="Masukkan Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input placeholder="Masukkan Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="row">
          <div class="col-8">
            <div class="form-check" style="margin-left: 11%;">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label for="remember">
                Ingat Saya
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <br>
      <p class="mb-0">
        @if ($agent->isMobile())
          <a href="{{ route('register') }}" class="text-center">Belum Punya Akun? Daftar Disini</a>
        @endif
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ url('/js/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('/js/adminlte.min.js') }}"></script>

</body>
</html>
