@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tournament.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tournaments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tournament.fields.id') }}
                        </th>
                        <td>
                            {{ $tournament->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tournament.fields.name') }}
                        </th>
                        <td>
                            {{ $tournament->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tournament.fields.startdate') }}
                        </th>
                        <td>
                            {{ $tournament->startdate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tournament.fields.enddate') }}
                        </th>
                        <td>
                            {{ $tournament->enddate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tournament.fields.mens') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $tournament->mens ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tournament.fields.womens') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $tournament->womens ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tournament.fields.mix') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $tournament->mix ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tournament.fields.city') }}
                        </th>
                        <td>
                            {{ $tournament->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tournament.fields.club') }}
                        </th>
                        <td>
                            {{ $tournament->club->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tournaments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#tournament_scores" role="tab" data-toggle="tab">
                {{ trans('cruds.score.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="tournament_scores">
            @includeIf('admin.tournaments.relationships.tournamentScores', ['scores' => $tournament->tournamentScores])
        </div>
    </div>
</div>

@endsection