@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.tournament.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tournaments.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.tournament.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tournament.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="startdate">{{ trans('cruds.tournament.fields.startdate') }}</label>
                <input class="form-control date {{ $errors->has('startdate') ? 'is-invalid' : '' }}" type="text" name="startdate" id="startdate" value="{{ old('startdate') }}">
                @if($errors->has('startdate'))
                    <span class="text-danger">{{ $errors->first('startdate') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tournament.fields.startdate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="enddate">{{ trans('cruds.tournament.fields.enddate') }}</label>
                <input class="form-control date {{ $errors->has('enddate') ? 'is-invalid' : '' }}" type="text" name="enddate" id="enddate" value="{{ old('enddate') }}">
                @if($errors->has('enddate'))
                    <span class="text-danger">{{ $errors->first('enddate') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tournament.fields.enddate_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('mens') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="mens" value="0">
                    <input class="form-check-input" type="checkbox" name="mens" id="mens" value="1" {{ old('mens', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="mens">{{ trans('cruds.tournament.fields.mens') }}</label>
                </div>
                @if($errors->has('mens'))
                    <span class="text-danger">{{ $errors->first('mens') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tournament.fields.mens_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('womens') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="womens" value="0">
                    <input class="form-check-input" type="checkbox" name="womens" id="womens" value="1" {{ old('womens', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="womens">{{ trans('cruds.tournament.fields.womens') }}</label>
                </div>
                @if($errors->has('womens'))
                    <span class="text-danger">{{ $errors->first('womens') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tournament.fields.womens_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('mix') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="mix" value="0">
                    <input class="form-check-input" type="checkbox" name="mix" id="mix" value="1" {{ old('mix', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="mix">{{ trans('cruds.tournament.fields.mix') }}</label>
                </div>
                @if($errors->has('mix'))
                    <span class="text-danger">{{ $errors->first('mix') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tournament.fields.mix_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="city">{{ trans('cruds.tournament.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}">
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tournament.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="club_id">{{ trans('cruds.tournament.fields.club') }}</label>
                <select class="form-control select2 {{ $errors->has('club') ? 'is-invalid' : '' }}" name="club_id" id="club_id">
                    @foreach($clubs as $id => $club)
                        <option value="{{ $id }}" {{ old('club_id') == $id ? 'selected' : '' }}>{{ $club }}</option>
                    @endforeach
                </select>
                @if($errors->has('club'))
                    <span class="text-danger">{{ $errors->first('club') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tournament.fields.club_helper') }}</span>
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