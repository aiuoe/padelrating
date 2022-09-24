@extends('layouts.player')
@section('content')

<div class="card" style="width: initial;height: initial;">
    <h4 class="card-header">
        Editar mi perfil
    </h4>
    <p>&nbsp;</p>

    <div class="card-body">
        <form method="POST" action="{{ route('player.players.update', [$player->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="avatar">{{ trans('cruds.player.fields.avatar') }}</label>
                <input class="form-control {{ $errors->has('avatar') ? 'is-invalid' : '' }}" type="file" accept="image/x-png,image/gif,image/jpeg" name="avatar" id="avatar" value="{{ old('avatar', $player->avatar) }}">
                @if($errors->has('avatar'))
                    <small class="text-danger">{{ $errors->first('avatar') }}</small>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.player.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $player->name) }}" required>
                @if($errors->has('name'))
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="surname">{{ trans('cruds.player.fields.surname') }}</label>
                <input class="form-control {{ $errors->has('surname') ? 'is-invalid' : '' }}" type="text" name="surname" id="surname" value="{{ old('surname', $player->surname) }}" required>
                @if($errors->has('surname'))
                    <small class="text-danger">{{ $errors->first('surname') }}</small>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.surname_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.player.fields.genre') }}</label>
                <select class="form-control {{ $errors->has('genre') ? 'is-invalid' : '' }}" name="genre" id="genre" required>
                    <option value disabled {{ old('genre', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Player::GENRE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('genre', $player->genre) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('genre'))
                    <small class="text-danger">{{ $errors->first('genre') }}</small>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.genre_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="birthdate">{{ trans('cruds.player.fields.birthdate') }}</label>
                <input class="form-control date {{ $errors->has('birthdate') ? 'is-invalid' : '' }}" type="text" name="birthdate" id="birthdate" value="{{ old('birthdate', $player->birthdate) }}">
                @if($errors->has('birthdate'))
                    <small class="text-danger">{{ $errors->first('birthdate') }}</small>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.birthdate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="license_number">{{ trans('cruds.player.fields.license_number') }}</label>
                <input class="form-control {{ $errors->has('license_number') ? 'is-invalid' : '' }}" type="number" name="license_number" id="license_number" value="{{ old('license_number', $player->license_number) }}" step="1">
                @if($errors->has('license_number'))
                    <small class="text-danger">{{ $errors->first('license_number') }}</small>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.license_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="city">{{ trans('cruds.player.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $player->city) }}" required>
                @if($errors->has('city'))
                    <small class="text-danger">{{ $errors->first('city') }}</small>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="description">{{ trans('cruds.player.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $player->description) }}" required>
                @if($errors->has('description'))
                    <small class="text-danger">{{ $errors->first('description') }}</small>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="side">{{ trans('cruds.player.fields.side') }}</label>
                <input class="form-control {{ $errors->has('side') ? 'is-invalid' : '' }}" type="text" name="side" id="side" value="{{ old('side', $player->side) }}" required>
                @if($errors->has('side'))
                    <small class="text-danger">{{ $errors->first('side') }}</small>
                @endif
                <span class="help-block">{{ trans('cruds.player.fields.side_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="bestshots">{{ trans('cruds.player.fields.bestshots') }}</label>
                <input class="form-control {{ $errors->has('bestshots') ? 'is-invalid' : '' }}" type="text" name="bestshots" id="bestshots" value="{{ old('bestshots', $player->bestshots) }}" required>
                @if($errors->has('bestshots'))
                    <small class="text-danger">{{ $errors->first('bestshots') }}</small>
                @endif
                <small class="help-block">{{ trans('cruds.player.fields.bestshots_helper') }}</small>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection