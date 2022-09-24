@extends('layouts.app')
@section('content')
<div class="container container-form">
    @if(session()->has('message'))
        <p class="alert alert-info">
            {{ session()->get('message') }}
        </p>
    @endif
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group container-form">
          <label class="form-label" for="email">Identifícate:</label>
          <input id="email" type="email" class="formInput form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" name="email" value="{{ old('email', null) }}">
            @if($errors->has('email'))
                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>
            @endif
          <input id="password" type="password" class="formInput form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="{{ trans('global.login_password') }}">
          <label class="form-check-label terminosCondiciones">
            <input class="form-check-input" type="checkbox" name="remember" style="margin-top: 0;"> Mantener la sesión iniciada</a>
          </label>
          <button type="submit" class="btn btnIniciar">{{ trans('global.login') }}</button>
          
        </div>
    </form>
    <div class="col-12">
        <a href="{{ route('password.request') }}" class="terminosCondiciones" style="color: #fff;"><u>¿Has olvidado tu contraseña?</u></a>
    </div>
    <div class="col-12" style="display: flex;">
        <a href="{{ route('register') }}" class="btnEnlace" style="color: #fff;">¿Aún no estás registrdado/a?</a>
    </div>
</div>
@endsection