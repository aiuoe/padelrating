@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.player.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.players.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.player.fields.id') }}
                        </th>
                        <td>
                            {{ $player->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.player.fields.name') }}
                        </th>
                        <td>
                            {{ $player->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.player.fields.surname') }}
                        </th>
                        <td>
                            {{ $player->surname }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.player.fields.genre') }}
                        </th>
                        <td>
                            {{ App\Models\Player::GENRE_SELECT[$player->genre] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.player.fields.birthdate') }}
                        </th>
                        <td>
                            {{ $player->birthdate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.player.fields.license_number') }}
                        </th>
                        <td>
                            {{ $player->license_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.player.fields.user') }}
                        </th>
                        <td>
                            {{ $player->user->email ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.players.index') }}">
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
            <a class="nav-link" href="#team1_player1_scores" role="tab" data-toggle="tab">
                {{ trans('cruds.score.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#team1_player2_scores" role="tab" data-toggle="tab">
                {{ trans('cruds.score.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#team2_player1_scores" role="tab" data-toggle="tab">
                {{ trans('cruds.score.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#team2_player2_scores" role="tab" data-toggle="tab">
                {{ trans('cruds.score.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="team1_player1_scores">
            @includeIf('admin.players.relationships.team1Player1Scores', ['scores' => $player->team1Player1Scores])
        </div>
        <div class="tab-pane" role="tabpanel" id="team1_player2_scores">
            @includeIf('admin.players.relationships.team1Player2Scores', ['scores' => $player->team1Player2Scores])
        </div>
        <div class="tab-pane" role="tabpanel" id="team2_player1_scores">
            @includeIf('admin.players.relationships.team2Player1Scores', ['scores' => $player->team2Player1Scores])
        </div>
        <div class="tab-pane" role="tabpanel" id="team2_player2_scores">
            @includeIf('admin.players.relationships.team2Player2Scores', ['scores' => $player->team2Player2Scores])
        </div>
    </div>
</div>

@endsection