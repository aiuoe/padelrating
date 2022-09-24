<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTournamentRequest;
use App\Http\Requests\UpdateTournamentRequest;
use App\Http\Resources\Admin\TournamentResource;
use App\Models\Tournament;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TournamentsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tournament_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TournamentResource(Tournament::with(['club'])->get());
    }

    public function store(StoreTournamentRequest $request)
    {
        $tournament = Tournament::create($request->all());

        return (new TournamentResource($tournament))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Tournament $tournament)
    {
        abort_if(Gate::denies('tournament_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TournamentResource($tournament->load(['club']));
    }

    public function update(UpdateTournamentRequest $request, Tournament $tournament)
    {
        $tournament->update($request->all());

        return (new TournamentResource($tournament))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Tournament $tournament)
    {
        abort_if(Gate::denies('tournament_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tournament->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
