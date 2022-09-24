@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.club.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.clubs.update", [$club->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.club.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $club->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.club.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="city">{{ trans('cruds.club.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $club->city) }}" required>
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.club.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="indoor_courts">{{ trans('cruds.club.fields.indoor_courts') }}</label>
                <input class="form-control {{ $errors->has('indoor_courts') ? 'is-invalid' : '' }}" type="number" name="indoor_courts" id="indoor_courts" value="{{ old('indoor_courts', $club->indoor_courts) }}" step="1">
                @if($errors->has('indoor_courts'))
                    <span class="text-danger">{{ $errors->first('indoor_courts') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.club.fields.indoor_courts_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="outdor_courts">{{ trans('cruds.club.fields.outdor_courts') }}</label>
                <input class="form-control {{ $errors->has('outdor_courts') ? 'is-invalid' : '' }}" type="number" name="outdor_courts" id="outdor_courts" value="{{ old('outdor_courts', $club->outdor_courts) }}" step="1">
                @if($errors->has('outdor_courts'))
                    <span class="text-danger">{{ $errors->first('outdor_courts') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.club.fields.outdor_courts_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="users">{{ trans('cruds.club.fields.user') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('users') ? 'is-invalid' : '' }}" name="users[]" id="users" multiple>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ (in_array($id, old('users', [])) || $club->users->contains($id)) ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('users'))
                    <span class="text-danger">{{ $errors->first('users') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.club.fields.user_helper') }}</span>
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