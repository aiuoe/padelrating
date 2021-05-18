<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Resources\Admin\QuestionResource;
use App\Models\Question;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuestionsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('Question_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QuestionResource(Question::with(['users'])->get());
    }

    public function store(StoreQuestionRequest $request)
    {
        $Question = Question::create($request->all());
        $Question->users()->sync($request->input('users', []));

        return (new QuestionResource($Question))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Question $Question)
    {
        abort_if(Gate::denies('Question_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QuestionResource($Question->load(['users']));
    }

    public function update(UpdateQuestionRequest $request, Question $Question)
    {
        $Question->update($request->all());
        $Question->users()->sync($request->input('users', []));

        return (new QuestionResource($Question))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Question $Question)
    {
        abort_if(Gate::denies('Question_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Question->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
