@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.questions.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.questions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.questions.fields.title') }}
                        </th>
                        <td>
                            {{ $question->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.questions.fields.answer1') }}
                        </th>
                        <td>
                            {{ $question->answer1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.questions.fields.score1') }}
                        </th>
                        <td>
                            {{ $question->score1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.questions.fields.answer2') }}
                        </th>
                        <td>
                            {{ $question->answer2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.questions.fields.score2') }}
                        </th>
                        <td>
                            {{ $question->score2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.questions.fields.answer3') }}
                        </th>
                        <td>
                            {{ $question->answer3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.questions.fields.score3') }}
                        </th>
                        <td>
                            {{ $question->score3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.questions.fields.answer4') }}
                        </th>
                        <td>
                            {{ $question->answer4 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.questions.fields.score4') }}
                        </th>
                        <td>
                            {{ $question->score4 }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.questions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>


@endsection