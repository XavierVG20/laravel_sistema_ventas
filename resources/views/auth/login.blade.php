@extends('layouts.auth')

@section('content')
<body class="hold-transition login-page">
<div class="login-box">
<div class="register-logo">
    <a href="../../index2.html"><b>SI</b>Ventas</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">Iniciar Sesion</p>

  <form method="POST" action="{{ route('login') }}">
     @csrf
      <div class="form-group has-feedback">
      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"  placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

@error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"placeholder="Password" name="password" required autocomplete="current-password">

@error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a class="btn btn-link" href="{{ route('register') }}">
                                        {{ __('Crear nueva cuenta') }}
                                    </a>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


</body>

@endsection
