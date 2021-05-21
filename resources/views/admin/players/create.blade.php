@extends('layouts.admin')


@section('styles')

    @include('partials.styles_script')
    
@endsection

@section('content')

<div class="card-body">
    @if (session('notification'))
    <div class="alert alert-success" role="alert">
      {{ session('notification') }}
    </div>
    @endif
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.player.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.players.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.player.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="surname">{{ trans('cruds.player.fields.surname') }}</label>
                <input class="form-control {{ $errors->has('surname') ? 'is-invalid' : '' }}" type="text" name="surname" id="surname" value="{{ old('surname', '') }}" required>
                @if($errors->has('surname'))
                    <span class="text-danger">{{ $errors->first('surname') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.surname_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.player.fields.genre') }}</label>
                <select class="form-control {{ $errors->has('genre') ? 'is-invalid' : '' }}" name="genre" id="genre" required>
                    <option value disabled {{ old('genre', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Player::GENRE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('genre', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('genre'))
                    <span class="text-danger">{{ $errors->first('genre') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.genre_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="birthdate">{{ trans('cruds.player.fields.birthdate') }}</label>
                <input class="form-control date {{ $errors->has('birthdate') ? 'is-invalid' : '' }}" type="text" name="birthdate" id="birthdate" value="{{ old('birthdate') }}">
                @if($errors->has('birthdate'))
                    <span class="text-danger">{{ $errors->first('birthdate') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.birthdate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="license_number">{{ trans('cruds.player.fields.license_number') }}</label>
                <input class="form-control {{ $errors->has('license_number') ? 'is-invalid' : '' }}" type="number" name="license_number" id="license_number" value="{{ old('license_number', '') }}" step="1">
                @if($errors->has('license_number'))
                    <span class="text-danger">{{ $errors->first('license_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.license_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="city">{{ trans('cruds.player.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}" required>
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.player.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.user_helper') }}</span>
            </div>

            <div class="card-header">
                {{ trans('cruds.player.calendar') }}
            </div>

            <div class="form-group">
                    <div id='calendar'></div>
            </div>

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>


@include('partials.modal')


@endsection


@section('scripts')

    {{-- @include('partials.styles_script') --}}

    
@endsection