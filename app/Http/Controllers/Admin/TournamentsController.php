<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTournamentRequest;
use App\Http\Requests\StoreTournamentRequest;
use App\Http\Requests\UpdateTournamentRequest;
use App\Models\Club;
use App\Models\Tournament;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TournamentsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('tournament_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Tournament::with(['club'])->select(sprintf('%s.*', (new Tournament)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'tournament_show';
                $editGate      = 'tournament_edit';
                $deleteGate    = 'tournament_delete';
                $crudRoutePart = 'tournaments';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });

            $table->editColumn('mens', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->mens ? 'checked' : null) . '>';
            });
            $table->editColumn('womens', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->womens ? 'checked' : null) . '>';
            });
            $table->editColumn('mix', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->mix ? 'checked' : null) . '>';
            });
            $table->editColumn('city', function ($row) {
                return $row->city ? $row->city : "";
            });
            $table->addColumn('club_name', function ($row) {
                return $row->club ? $row->club->name : '';
            });

            $table->editColumn('club.indoor_courts', function ($row) {
                return $row->club ? (is_string($row->club) ? $row->club : $row->club->indoor_courts) : '';
            });
            $table->editColumn('club.outdor_courts', function ($row) {
                return $row->club ? (is_string($row->club) ? $row->club : $row->club->outdor_courts) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'mens', 'womens', 'mix', 'club']);

            return $table->make(true);
        }

        return view('admin.tournaments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('tournament_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clubs = Club::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.tournaments.create', compact('clubs'));
    }

    public function store(StoreTournamentRequest $request)
    {
        $tournament = Tournament::create($request->all());

        return redirect()->route('admin.tournaments.index');
    }

    public function edit(Tournament $tournament)
    {
        abort_if(Gate::denies('tournament_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clubs = Club::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tournament->load('club');

        return view('admin.tournaments.edit', compact('clubs', 'tournament'));
    }

    public function update(UpdateTournamentRequest $request, Tournament $tournament)
    {
        $tournament->update($request->all());

        return redirect()->route('admin.tournaments.index');
    }

    public function show(Tournament $tournament)
    {
        abort_if(Gate::denies('tournament_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tournament->load('club', 'tournamentScores');

        return view('admin.tournaments.show', compact('tournament'));
    }

    public function destroy(Tournament $tournament)
    {
        abort_if(Gate::denies('tournament_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tournament->delete();

        return back();
    }

    public function massDestroy(MassDestroyTournamentRequest $request)
    {
        Tournament::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
