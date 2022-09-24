@extends('layouts.player')
@section('content')
<div class="row p-2">
    <div class="col-lg-12">
        <h2 class="text-info font-weight-bold text-center">{{ $user->name }}, queremos conocerte mejor...</h2>
    </div>
    <div class="col-lg-12">
        <h4 class="text-center"></h4>
        <ul class="list-group">
            <li class="list-group-item text-center">
				{{ $next_question->title }}<br><br>
				<button class="btn btn-info btn-lg btn-block answer" data-answer="1">{{ $next_question->answer1 }}</button>
				<button class="btn btn-info btn-lg btn-block answer" data-answer="2">{{ $next_question->answer2 }}</button>
				@if ($next_question->answer3)
				<button class="btn btn-info btn-lg btn-block answer" data-answer="3">{{ $next_question->answer3 }}</button>
				@endif
				@if ($next_question->answer4)
				<button class="btn btn-info btn-lg btn-block answer" data-answer="4">{{ $next_question->answer4 }}</button>
				@endif
			</li>
        </ul>
    </div>

    <form method="POST" id="savefirstquestionary" action="{{ route("player.savefirstquestionary") }}">
    @csrf
    	<input type="hidden" name="question_id" value="{{ $next_question->id }}">
    	<input type="hidden" name="answer" value="">
    </form>

</div>

<script>
	document.addEventListener("DOMContentLoaded", function(event) {
		$("button.answer").click(function(){
			var answer = $(this).data("answer");
			$("input[name='answer']").val(answer);
			$("form#savefirstquestionary").submit();
		});
	});
</script>
@endsection
@section('scripts')
@parent
@endsection