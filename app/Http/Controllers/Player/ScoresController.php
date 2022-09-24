<?php

namespace App\Http\Controllers\Player;

use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyScoreRequest;
use App\Http\Requests\StoreScoreRequest;
use App\Http\Requests\UpdateScoreRequest;
use App\Models\Player;
use App\Models\Club;
use App\Models\Score;
use App\Models\Tournament;
use App\Notifications\VerifyScoreNotification;
use App\Notifications\VerifiedScoreNotification;
use Gate;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ScoresController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('score_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Score::with(['tournament', 'team_1_player_1', 'team_1_player_2', 'team_2_player_1', 'team_2_player_2'])->select(sprintf('%s.*', (new Score)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'score_show';
                $editGate      = 'score_edit';
                $deleteGate    = 'score_delete';
                $crudRoutePart = 'scores';

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
            $table->addColumn('tournament_name', function ($row) {
                return $row->tournament ? $row->tournament->name : '';
            });

            $table->editColumn('tournament.mens', function ($row) {
                return $row->tournament ? (is_string($row->tournament) ? $row->tournament : $row->tournament->mens) : '';
            });
            $table->editColumn('tournament.womens', function ($row) {
                return $row->tournament ? (is_string($row->tournament) ? $row->tournament : $row->tournament->womens) : '';
            });
            $table->editColumn('tournament.mix', function ($row) {
                return $row->tournament ? (is_string($row->tournament) ? $row->tournament : $row->tournament->mix) : '';
            });

            $table->addColumn('team_1', function ($row) {
                return ($row->team_1_player_1 && $row->team_1_player_2) ? $row->team_1_player_1->name.' '.$row->team_1_player_1->surname.' y '.$row->team_1_player_2->name.' '.$row->team_1_player_2->surname : '';
            });

            $table->addColumn('team_2', function ($row) {
                return ($row->team_2_player_1 && $row->team_2_player_2) ? $row->team_2_player_1->name.' '.$row->team_2_player_1->surname.' y '.$row->team_2_player_2->name.' '.$row->team_2_player_2->surname : '';
            });
/*
            $table->addColumn('team_1_player_1_name', function ($row) {
                return $row->team_1_player_1 ? $row->team_1_player_1->name : '';
            });

            $table->editColumn('team_1_player_1.surname', function ($row) {
                return $row->team_1_player_1 ? (is_string($row->team_1_player_1) ? $row->team_1_player_1 : $row->team_1_player_1->surname) : '';
            });
            $table->addColumn('team_1_player_2_name', function ($row) {
                return $row->team_1_player_2 ? $row->team_1_player_2->name : '';
            });

            $table->editColumn('team_1_player_2.surname', function ($row) {
                return $row->team_1_player_2 ? (is_string($row->team_1_player_2) ? $row->team_1_player_2 : $row->team_1_player_2->surname) : '';
            });
            $table->addColumn('team_2_player_1_name', function ($row) {
                return $row->team_2_player_1 ? $row->team_2_player_1->name : '';
            });

            $table->editColumn('team_2_player_1.surname', function ($row) {
                return $row->team_2_player_1 ? (is_string($row->team_2_player_1) ? $row->team_2_player_1 : $row->team_2_player_1->surname) : '';
            });
            $table->addColumn('team_2_player_2_name', function ($row) {
                return $row->team_2_player_2 ? $row->team_2_player_2->name : '';
            });

            $table->editColumn('team_2_player_2.surname', function ($row) {
                return $row->team_2_player_2 ? (is_string($row->team_2_player_2) ? $row->team_2_player_2 : $row->team_2_player_2->surname) : '';
            });*/
            
            $table->editColumn('set_1', function ($row) {
                return ($row->set_1_team_1 && $row->set_1_team_2) ? $row->set_1_team_1.'-'.$row->set_1_team_2 : "";
            });
            $table->editColumn('set_2', function ($row) {
                return ($row->set_2_team_1 && $row->set_2_team_2) ? $row->set_2_team_1.'-'.$row->set_2_team_2 : "";
            });
            $table->editColumn('set_3', function ($row) {
                return ($row->set_3_team_1 && $row->set_3_team_2) ? $row->set_3_team_1.'-'.$row->set_3_team_2 : "";
            });
/*
            $table->editColumn('set_1_team_1', function ($row) {
                return $row->set_1_team_1 ? $row->set_1_team_1 : "";
            });
            $table->editColumn('set_1_team_2', function ($row) {
                return $row->set_1_team_2 ? $row->set_1_team_2 : "";
            });
            $table->editColumn('set_2_team_1', function ($row) {
                return $row->set_2_team_1 ? $row->set_2_team_1 : "";
            });
            $table->editColumn('set_2_team_2', function ($row) {
                return $row->set_2_team_2 ? $row->set_2_team_2 : "";
            });
            $table->editColumn('set_3_team_1', function ($row) {
                return $row->set_3_team_1 ? $row->set_3_team_1 : "";
            });
            $table->editColumn('set_3_team_2', function ($row) {
                return $row->set_3_team_2 ? $row->set_3_team_2 : "";
            });
*/
            $table->rawColumns(['actions', 'placeholder', 'tournament', 'team_1', 'team_2']);

            return $table->make(true);
        }

        return view('player.scores.index');
    }

    public function create()
    {
        abort_if(Gate::denies('score_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tournaments = Tournament::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $team_1_player_2s = Player::whereNotNull('user_id')->selectRaw('concat(surname, ", ", name) as name, id')->get()->pluck('name', 'id')->prepend('Jugador', '');

        $team_2_player_1s = Player::whereNotNull('user_id')->selectRaw('concat(surname, ", ", name) as name, id')->get()->pluck('name', 'id')->prepend('Jugador', '');

        $team_2_player_2s = Player::whereNotNull('user_id')->selectRaw('concat(surname, ", ", name) as name, id')->get()->pluck('name', 'id')->prepend('Jugador', '');

        $clubs = Club::select('name', 'id')->get()->pluck('name', 'id');

        return view('player.scores.create', compact('tournaments', 'team_1_player_2s', 'team_2_player_1s', 'team_2_player_2s', 'clubs'));
    }

    public function store(StoreScoreRequest $request)
    {
        $score = Score::create($request->all());

        $team2_player1 = Player::find($score->team_2_player_1_id);
        $team2_player2 = Player::find($score->team_2_player_2_id);
        $team2_player1->user()->first()->notify(new VerifyScoreNotification($score));
        $team2_player2->user()->first()->notify(new VerifyScoreNotification($score));

        return redirect()->route('player.home');
    }

    public function getVerifyScore(Score $score)
    {
        $player_id = \Auth::user()->userPlayers()->first()->id;
        if ( ($player_id == $score->team_2_player_1_id) || ($player_id == $score->team_2_player_2_id) )
        {
            $score = Score::with(['tournament', 'team_1_player_1', 'team_1_player_2', 'team_2_player_1', 'team_2_player_2'])
            ->where('id', $score->id)->first();
            return view('player.verifyscore', compact('score'));
        }
        return redirect()->route('player.home');
    }

    public function getConfirmVerifyScore(Score $score)
    {
        $player_id = \Auth::user()->userPlayers()->first()->id;
        if ( ($player_id == $score->team_2_player_1_id) || ($player_id == $score->team_2_player_2_id) )
        {
            $score->verified_at = Carbon::now();
            $score->verified_by = $player_id;
            $score->save();

            $exitCode = Artisan::call('calculate:pr', [
                'score_id' => $score->id
            ]);

            $team1_player1 = Player::find($score->team_1_player_1_id);
            $team1_player2 = Player::find($score->team_1_player_2_id);
            $team1_player1->user()->first()->notify(new VerifiedScoreNotification());
            $team1_player2->user()->first()->notify(new VerifiedScoreNotification());
            if ($player_id == $score->team_2_player_1_id)
            {
                $team2_player2 = Player::find($score->team_2_player_2_id);
                $team2_player2->user()->first()->notify(new VerifiedScoreNotification());
            }
            else
            {
                $team2_player1 = Player::find($score->team_2_player_1_id);
                $team2_player1->user()->first()->notify(new VerifiedScoreNotification());
            }
        }            

        return redirect()->route('player.home');
    }

    public function getConfirmUnverifyScore(Score $score)
    {
        $player_id = \Auth::user()->userPlayers()->first()->id;
        if ( ( ($player_id == $score->team_2_player_1_id) || ($player_id == $score->team_2_player_2_id) ) && ($score->verified_at == null) )
        {
            $score->delete();
        }            

        return redirect()->route('player.home');
    }

    public function edit(Score $score)
    {
        abort_if(Gate::denies('score_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tournaments = Tournament::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $team_1_player_1s = Player::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $team_1_player_2s = Player::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $team_2_player_1s = Player::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $team_2_player_2s = Player::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $score->load('tournament', 'team_1_player_1', 'team_1_player_2', 'team_2_player_1', 'team_2_player_2');

        return view('player.scores.edit', compact('tournaments', 'team_1_player_1s', 'team_1_player_2s', 'team_2_player_1s', 'team_2_player_2s', 'score'));
    }

    public function update(UpdateScoreRequest $request, Score $score)
    {
        $score->update($request->all());

        return redirect()->route('player.scores.index');
    }

    public function show(Score $score)
    {
        abort_if(Gate::denies('score_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $score->load('tournament', 'team_1_player_1', 'team_1_player_2', 'team_2_player_1', 'team_2_player_2');

        return view('player.scores.show', compact('score'));
    }

    public function destroy(Score $score)
    {
        abort_if(Gate::denies('score_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $score->delete();

        return back();
    }

    public function massDestroy(MassDestroyScoreRequest $request)
    {
        Score::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
