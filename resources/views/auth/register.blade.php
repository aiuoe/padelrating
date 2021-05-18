@extends('layouts.app')
@section('content')
<style>
.invalid-feedback {
    border: 1px solid;
    background: #ffffffa1;
    padding: 5px;
    margin-bottom: 10px;
    display: block;
}
</style>
<div class="container container-form">
    @if(session()->has('message'))
        <p class="alert alert-info">
            {{ session()->get('message') }}
        </p>
    @endif
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group container-form">
            <label class="form-label" for="name">{{ trans('global.register') }}</label>
            <input type="text" class="formInput form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ trans('global.user_name') }}" name="name" required value="{{ old('name', null) }}">
              @if($errors->has('name'))
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
            @endif
            <input type="text" class="formInput form-control {{ $errors->has('surname') ? ' is-invalid' : '' }}" placeholder="{{ trans('global.surname') }}" name="surname" required value="{{ old('surname', null) }}">
            @if($errors->has('surname'))
            <div class="invalid-feedback">
                {{ $errors->first('surname') }}
            </div>
            @endif
            <input type="email" class="formInput form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" placeholder="{{ trans('global.email') }}" name="email" required value="{{ old('email', null) }}">
            @if($errors->has('email'))
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
            @endif
            <div class="row col-7 rowEnmedioDeForm" style="float: left;">
                <select name="genre" class="selectpicker mySelect" required>
                    <option value="">{{ trans('global.genre') }}</option>
                    <option value="male" {{ old('genre') == 'male' ? 'selected' : '' }}>Hombre</option>
                    <option value="female" {{ old('genre') == 'female' ? 'selected' : '' }}>Mujer</option>
                </select>
                @if($errors->has('genre'))
                <div class="invalid-feedback">
                    {{ $errors->first('genre') }}
                </div>
                @endif
            </div>
            <div class="row col-7 rowEnmedioDeForm"style="float: right;">
                <input type="text" class="formInput form-control" placeholder="Teléfono" name="phone" value="{{ old('phone', null) }}">
            </div>
            <input type="password" class="formInput form-control" placeholder="{{ trans('global.login_password') }}" name="password" required>
            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            <input type="password" class="formInput form-control" placeholder="{{ trans('global.login_password_confirmation') }}" name="password_confirmation" required>
            @if ($errors->has('password_confirmation'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
            <label class="form-check-label terminosCondiciones">
            <input class="form-check-input" type="checkbox" required style="margin-top: 0;"> Acepto los  <a href="https://mypadelrating.com/terminos-condiciones" target="_blank" style="color: #fff;"><u>términos y condiciones de privacidad</u></a>
          </label>
            <div class="col-12" style="display: flex;">
                <button type="submit" class="btn btnEnlace btnRegister">{{ trans('global.register') }}</button>
            </div>
        </div>
    </form>

    <div class="col-12" style="display: flex;">
        <a href="/" class="btn btnIniciar">Volver</a>
    </div>
</div>
@endsection