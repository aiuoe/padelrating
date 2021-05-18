@extends('layouts.player')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.score.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("player.scores.update", [$score->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="tournament_id">{{ trans('cruds.score.fields.tournament') }}</label>
                <select class="form-control select2 {{ $errors->has('tournament') ? 'is-invalid' : '' }}" name="tournament_id" id="tournament_id">
                    @foreach($tournaments as $id => $tournament)
                        <option value="{{ $id }}" {{ (old('tournament_id') ? old('tournament_id') : $score->tournament->id ?? '') == $id ? 'selected' : '' }}>{{ $tournament }}</option>
                    @endforeach
                </select>
                @if($errors->has('tournament'))
                    <span class="text-danger">{{ $errors->first('tournament') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.score.fields.tournament_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="team_1_player_1_id">{{ trans('cruds.score.fields.team_1_player_1') }}</label>
                <select class="form-control select2 {{ $errors->has('team_1_player_1') ? 'is-invalid' : '' }}" name="team_1_player_1_id" id="team_1_player_1_id" required>
                    @foreach($team_1_player_1s as $id => $team_1_player_1)
                        <option value="{{ $id }}" {{ (old('team_1_player_1_id') ? old('team_1_player_1_id') : $score->team_1_player_1->id ?? '') == $id ? 'selected' : '' }}>{{ $team_1_player_1 }}</option>
                    @endforeach
                </select>
                @if($errors->has('team_1_player_1'))
                    <span class="text-danger">{{ $errors->first('team_1_player_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.score.fields.team_1_player_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="team_1_player_2_id">{{ trans('cruds.score.fields.team_1_player_2') }}</label>
                <select class="form-control select2 {{ $errors->has('team_1_player_2') ? 'is-invalid' : '' }}" name="team_1_player_2_id" id="team_1_player_2_id" required>
                    @foreach($team_1_player_2s as $id => $team_1_player_2)
                        <option value="{{ $id }}" {{ (old('team_1_player_2_id') ? old('team_1_player_2_id') : $score->team_1_player_2->id ?? '') == $id ? 'selected' : '' }}>{{ $team_1_player_2 }}</option>
                    @endforeach
                </select>
                @if($errors->has('team_1_player_2'))
                    <span class="text-danger">{{ $errors->first('team_1_player_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.score.fields.team_1_player_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="team_2_player_1_id">{{ trans('cruds.score.fields.team_2_player_1') }}</label>
                <select class="form-control select2 {{ $errors->has('team_2_player_1') ? 'is-invalid' : '' }}" name="team_2_player_1_id" id="team_2_player_1_id" required>
                    @foreach($team_2_player_1s as $id => $team_2_player_1)
                        <option value="{{ $id }}" {{ (old('team_2_player_1_id') ? old('team_2_player_1_id') : $score->team_2_player_1->id ?? '') == $id ? 'selected' : '' }}>{{ $team_2_player_1 }}</option>
                    @endforeach
                </select>
                @if($errors->has('team_2_player_1'))
                    <span class="text-danger">{{ $errors->first('team_2_player_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.score.fields.team_2_player_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="team_2_player_2_id">{{ trans('cruds.score.fields.team_2_player_2') }}</label>
                <select class="form-control select2 {{ $errors->has('team_2_player_2') ? 'is-invalid' : '' }}" name="team_2_player_2_id" id="team_2_player_2_id" required>
                    @foreach($team_2_player_2s as $id => $team_2_player_2)
                        <option value="{{ $id }}" {{ (old('team_2_player_2_id') ? old('team_2_player_2_id') : $score->team_2_player_2->id ?? '') == $id ? 'selected' : '' }}>{{ $team_2_player_2 }}</option>
                    @endforeach
                </select>
                @if($errors->has('team_2_player_2'))
                    <span class="text-danger">{{ $errors->first('team_2_player_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.score.fields.team_2_player_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="set_1_team_1">{{ trans('cruds.score.fields.set_1_team_1') }}</label>
                <input class="form-control {{ $errors->has('set_1_team_1') ? 'is-invalid' : '' }}" type="number" name="set_1_team_1" id="set_1_team_1" value="{{ old('set_1_team_1', $score->set_1_team_1) }}" step="1" required>
                @if($errors->has('set_1_team_1'))
                    <span class="text-danger">{{ $errors->first('set_1_team_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.score.fields.set_1_team_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="set_1_team_2">{{ trans('cruds.score.fields.set_1_team_2') }}</label>
                <input class="form-control {{ $errors->has('set_1_team_2') ? 'is-invalid' : '' }}" type="number" name="set_1_team_2" id="set_1_team_2" value="{{ old('set_1_team_2', $score->set_1_team_2) }}" step="1" required>
                @if($errors->has('set_1_team_2'))
                    <span class="text-danger">{{ $errors->first('set_1_team_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.score.fields.set_1_team_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="set_2_team_1">{{ trans('cruds.score.fields.set_2_team_1') }}</label>
                <input class="form-control {{ $errors->has('set_2_team_1') ? 'is-invalid' : '' }}" type="number" name="set_2_team_1" id="set_2_team_1" value="{{ old('set_2_team_1', $score->set_2_team_1) }}" step="1">
                @if($errors->has('set_2_team_1'))
                    <span class="text-danger">{{ $errors->first('set_2_team_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.score.fields.set_2_team_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="set_2_team_2">{{ trans('cruds.score.fields.set_2_team_2') }}</label>
                <input class="form-control {{ $errors->has('set_2_team_2') ? 'is-invalid' : '' }}" type="number" name="set_2_team_2" id="set_2_team_2" value="{{ old('set_2_team_2', $score->set_2_team_2) }}" step="1">
                @if($errors->has('set_2_team_2'))
                    <span class="text-danger">{{ $errors->first('set_2_team_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.score.fields.set_2_team_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="set_3_team_1">{{ trans('cruds.score.fields.set_3_team_1') }}</label>
                <input class="form-control {{ $errors->has('set_3_team_1') ? 'is-invalid' : '' }}" type="number" name="set_3_team_1" id="set_3_team_1" value="{{ old('set_3_team_1', $score->set_3_team_1) }}" step="1">
                @if($errors->has('set_3_team_1'))
                    <span class="text-danger">{{ $errors->first('set_3_team_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.score.fields.set_3_team_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="set_3_team_2">{{ trans('cruds.score.fields.set_3_team_2') }}</label>
                <input class="form-control {{ $errors->has('set_3_team_2') ? 'is-invalid' : '' }}" type="number" name="set_3_team_2" id="set_3_team_2" value="{{ old('set_3_team_2', $score->set_3_team_2) }}" step="1">
                @if($errors->has('set_3_team_2'))
                    <span class="text-danger">{{ $errors->first('set_3_team_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.score.fields.set_3_team_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="observations">{{ trans('cruds.score.fields.observations') }}</label>
                <input class="form-control {{ $errors->has('observations') ? 'is-invalid' : '' }}" type="text" name="observations" id="observations" value="{{ old('observations', $score->observations) }}">
                @if($errors->has('observations'))
                    <span class="text-danger">{{ $errors->first('observations') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.score.fields.observations_helper') }}</span>
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