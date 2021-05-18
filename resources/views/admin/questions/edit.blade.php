@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.questions.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.questions.update", [$question->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.questions.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $question->title) }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.questions.fields.title_helper') }}</span>
            </div>            
            <div class="form-group">
                <div class="form-check {{ $errors->has('openfield') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="openfield" value="0">
                    <input class="form-check-input" type="checkbox" name="openfield" id="openfield" value="1" {{ $question->openfield || old('openfield', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="openfield">{{ trans('cruds.questions.fields.openfield') }}</label>
                </div>
                @if($errors->has('openfield'))
                    <span class="text-danger">{{ $errors->first('openfield') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.questions.fields.openfield_helper') }}</span>
            </div>
            <div class="row answerrow">
               <div class="col-4">
                    <div class="form-group">
                        <label class="required" for="answer1">{{ trans('cruds.questions.fields.answer1') }}</label>
                        <input class="form-control {{ $errors->has('answer1') ? 'is-invalid' : '' }}" type="text" name="answer1" id="answer1" value="{{ old('answer1', $question->answer1) }}" required>
                        @if($errors->has('answer1'))
                            <span class="text-danger">{{ $errors->first('answer1') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.questions.fields.answer_helper') }}</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="score1">{{ trans('cruds.questions.fields.score1') }}</label>
                        <input class="form-control {{ $errors->has('score1') ? 'is-invalid' : '' }}" type="number" name="score1" id="score1" value="{{ old('score1', $question->score1) }}" step="0.1">
                        @if($errors->has('score1'))
                            <span class="text-danger">{{ $errors->first('score1') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.questions.fields.score_helper') }}</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="nextanswer1question_id">{{ trans('cruds.questions.fields.nextanswerquestion') }}</label>
                        <select class="form-control select2 {{ $errors->has('nextanswer1question_id') ? 'is-invalid' : '' }}" name="nextanswer1question_id" id="nextanswer1question_id">
                            @foreach($questions as $id => $title)
                                <option value="{{ $id }}" {{ (old('nextanswer1question_id') ? old('nextanswer1question_id') : $question->nextanswer1question_id ?? '') == $id ? 'selected' : '' }}>{{ $title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('nextanswer1question_id'))
                            <span class="text-danger">{{ $errors->first('nextanswer1question_id') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row answerrow">
                <div class="col-4">
                    <div class="form-group">
                        <label class="required" for="answer2">{{ trans('cruds.questions.fields.answer2') }}</label>
                        <input class="form-control {{ $errors->has('answer2') ? 'is-invalid' : '' }}" type="text" name="answer2" id="answer2" value="{{ old('answer2', $question->answer2) }}" required>
                        @if($errors->has('answer2'))
                            <span class="text-danger">{{ $errors->first('answer2') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.questions.fields.answer_helper') }}</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="score2">{{ trans('cruds.questions.fields.score2') }}</label>
                        <input class="form-control {{ $errors->has('score2') ? 'is-invalid' : '' }}" type="number" name="score2" id="score2" value="{{ old('score2', $question->score2) }}" step="0.1">
                        @if($errors->has('score2'))
                            <span class="text-danger">{{ $errors->first('score2') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.questions.fields.score_helper') }}</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="nextanswer2question_id">{{ trans('cruds.questions.fields.nextanswerquestion') }}</label>
                        <select class="form-control select2 {{ $errors->has('nextanswer2question_id') ? 'is-invalid' : '' }}" name="nextanswer2question_id" id="nextanswer2question_id">
                            @foreach($questions as $id => $title)
                                <option value="{{ $id }}" {{ (old('nextanswer2question_id') ? old('nextanswer2question_id') : $question->nextanswer2question_id ?? '') == $id ? 'selected' : '' }}>{{ $title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('nextanswer2question_id'))
                            <span class="text-danger">{{ $errors->first('nextanswer2question_id') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row answerrow">
                <div class="col-4">
                    <div class="form-group">
                        <label class="" for="answer3">{{ trans('cruds.questions.fields.answer3') }}</label>
                        <input class="form-control {{ $errors->has('answer3') ? 'is-invalid' : '' }}" type="text" name="answer3" id="answer3" value="{{ old('answer3', $question->answer3) }}">
                        @if($errors->has('answer3'))
                            <span class="text-danger">{{ $errors->first('answer3') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.questions.fields.answer_helper') }}</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="score3">{{ trans('cruds.questions.fields.score3') }}</label>
                        <input class="form-control {{ $errors->has('score3') ? 'is-invalid' : '' }}" type="number" name="score3" id="score3" value="{{ old('score3', $question->score3) }}" step="0.1">
                        @if($errors->has('score3'))
                            <span class="text-danger">{{ $errors->first('score3') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.questions.fields.score_helper') }}</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="nextanswer3question_id">{{ trans('cruds.questions.fields.nextanswerquestion') }}</label>
                        <select class="form-control select2 {{ $errors->has('nextanswer3question_id') ? 'is-invalid' : '' }}" name="nextanswer3question_id" id="nextanswer3question_id">
                            @foreach($questions as $id => $title)
                                <option value="{{ $id }}" {{ (old('nextanswer3question_id') ? old('nextanswer3question_id') : $question->nextanswer3question_id ?? '') == $id ? 'selected' : '' }}>{{ $title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('nextanswer3question_id'))
                            <span class="text-danger">{{ $errors->first('nextanswer3question_id') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row answerrow">
                <div class="col-4">
                    <div class="form-group">
                        <label class="" for="answer4">{{ trans('cruds.questions.fields.answer4') }}</label>
                        <input class="form-control {{ $errors->has('answer4') ? 'is-invalid' : '' }}" type="text" name="answer4" id="answer4" value="{{ old('answer4', $question->answer4) }}">
                        @if($errors->has('answer4'))
                            <span class="text-danger">{{ $errors->first('answer4') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.questions.fields.answer_helper') }}</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="score4">{{ trans('cruds.questions.fields.score4') }}</label>
                        <input class="form-control {{ $errors->has('score4') ? 'is-invalid' : '' }}" type="number" name="score4" id="score4" value="{{ old('score4', $question->score4) }}" step="0.1">
                        @if($errors->has('score4'))
                            <span class="text-danger">{{ $errors->first('score4') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.questions.fields.score_helper') }}</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="nextanswer4question_id">{{ trans('cruds.questions.fields.nextanswerquestion') }}</label>
                        <select class="form-control select2 {{ $errors->has('nextanswer4question_id') ? 'is-invalid' : '' }}" name="nextanswer4question_id" id="nextanswer4question_id">
                            @foreach($questions as $id => $title)
                                <option value="{{ $id }}" {{ (old('nextanswer4question_id') ? old('nextanswer4question_id') : $question->nextanswer4question_id ?? '') == $id ? 'selected' : '' }}>{{ $title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('nextanswer4question_id'))
                            <span class="text-danger">{{ $errors->first('nextanswer4question_id') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    window.onload = function(){
        jQuery("input#openfield").click(function(){
            if (jQuery("input#openfield").is(":checked")){
                jQuery(".answerrow").hide();
                jQuery(".answerrow input").val("0");
            }
            else
            {
                jQuery(".answerrow").fadeIn();
            }
        });
        if (jQuery("input#openfield").is(":checked")){
            jQuery(".answerrow").hide();
            jQuery(".answerrow input").val("0");
        }
        else
        {
            jQuery(".answerrow").fadeIn();
        }
    };        
</script>



@endsection