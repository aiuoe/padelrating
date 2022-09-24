<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreScoreRequest;
use App\Http\Requests\UpdateScoreRequest;
use App\Http\Resources\Admin\ScoreResource;
use App\Models\Score;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ScoresApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('score_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ScoreResource(Score::with(['tournament', 'team_1_player_1', 'team_1_player_2', 'team_2_player_1', 'team_2_player_2'])->get());
    }

    public function store(StoreScoreRequest $request)
    {
        $score = Score::create($request->all());

        return (new ScoreResource($score))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Score $score)
    {
        abort_if(Gate::denies('score_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ScoreResource($score->load(['tournament', 'team_1_player_1', 'team_1_player_2', 'team_2_player_1', 'team_2_player_2']));
    }

    public function update(UpdateScoreRequest $request, Score $score)
    {
        $score->update($request->all());

        return (new ScoreResource($score))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Score $score)
    {
        abort_if(Gate::denies('score_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $score->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
