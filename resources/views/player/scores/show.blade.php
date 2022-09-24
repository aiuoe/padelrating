@extends('layouts.player')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.score.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.scores.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.score.fields.id') }}
                        </th>
                        <td>
                            {{ $score->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.score.fields.tournament') }}
                        </th>
                        <td>
                            {{ $score->tournament->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.score.fields.team_1_player_1') }}
                        </th>
                        <td>
                            {{ $score->team_1_player_1->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.score.fields.team_1_player_2') }}
                        </th>
                        <td>
                            {{ $score->team_1_player_2->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.score.fields.team_2_player_1') }}
                        </th>
                        <td>
                            {{ $score->team_2_player_1->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.score.fields.team_2_player_2') }}
                        </th>
                        <td>
                            {{ $score->team_2_player_2->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.score.fields.set_1_team_1') }}
                        </th>
                        <td>
                            {{ $score->set_1_team_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.score.fields.set_1_team_2') }}
                        </th>
                        <td>
                            {{ $score->set_1_team_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.score.fields.set_2_team_1') }}
                        </th>
                        <td>
                            {{ $score->set_2_team_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.score.fields.set_2_team_2') }}
                        </th>
                        <td>
                            {{ $score->set_2_team_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.score.fields.set_3_team_1') }}
                        </th>
                        <td>
                            {{ $score->set_3_team_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.score.fields.set_3_team_2') }}
                        </th>
                        <td>
                            {{ $score->set_3_team_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.score.fields.observations') }}
                        </th>
                        <td>
                            {{ $score->observations }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.scores.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection