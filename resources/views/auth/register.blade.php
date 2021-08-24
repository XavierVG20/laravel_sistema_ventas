@extends('layouts.auth')
@section('content')
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Sistema</b>WISP</a>
  </div>
  

  <div class="register-box-body">
    <p class="login-box-msg">Registarse</p>

    <form method="POST" action="{{ route('register') }}">
    @csrf
      <div class="form-group has-feedback">
      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="nombres" required autocomplete="name" autofocus>

@error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="email" required autocomplete="email">

@error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="password" required autocomplete="new-password">

@error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="confirmar password" required autocomplete="new-password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
       
        <!-- /.col -->
        <div class="col-xs-4">
        <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>        </div>
        <!-- /.col -->
      </div>
    </form>

  

    <a href="{{ route('login') }}" class="text-center">Inciar sesion</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->


</body>

@endsection
