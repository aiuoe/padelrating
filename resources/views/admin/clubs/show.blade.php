@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.club.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clubs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.club.fields.id') }}
                        </th>
                        <td>
                            {{ $club->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.club.fields.name') }}
                        </th>
                        <td>
                            {{ $club->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.club.fields.city') }}
                        </th>
                        <td>
                            {{ $club->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.club.fields.indoor_courts') }}
                        </th>
                        <td>
                            {{ $club->indoor_courts }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.club.fields.outdor_courts') }}
                        </th>
                        <td>
                            {{ $club->outdor_courts }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.club.fields.user') }}
                        </th>
                        <td>
                            @foreach($club->users as $key => $user)
                                <span class="label label-info">{{ $user->email }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clubs.index') }}">
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
            <a class="nav-link" href="#club_tournaments" role="tab" data-toggle="tab">
                {{ trans('cruds.tournament.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="club_tournaments">
            @includeIf('admin.clubs.relationships.clubTournaments', ['tournaments' => $club->clubTournaments])
        </div>
    </div>
</div>

@endsection