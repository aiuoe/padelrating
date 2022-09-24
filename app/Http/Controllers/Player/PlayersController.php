<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPlayerRequest;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Models\Player;
use App\Models\Score;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PlayersController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('player_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Player::with(['user'])->select(sprintf('%s.*', (new Player)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'player_show';
                $editGate      = 'player_edit';
                $deleteGate    = 'player_delete';
                $crudRoutePart = 'players';

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
            $table->editColumn('surname', function ($row) {
                return $row->surname ? $row->surname : "";
            });
            $table->editColumn('genre', function ($row) {
                return $row->genre ? Player::GENRE_SELECT[$row->genre] : '';
            });

            $table->editColumn('license_number', function ($row) {
                return $row->license_number ? $row->license_number : "";
            });
            $table->addColumn('user_email', function ($row) {
                return $row->user ? $row->user->email : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('player.players.index');
    }

    public function create()
    {
        abort_if(Gate::denies('player_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('player.players.create', compact('users'));
    }

    public function store(StorePlayerRequest $request)
    {
        $player = Player::create($request->all());

        return redirect()->route('player.players.index');
    }

    public function edit(Player $player)
    {
        abort_if(Gate::denies('player_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = \Auth::user();
        if ($player->user_id == $user->id)
        {
            $users = User::all()->pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

            $player->load('user');

            return view('player.players.edit', compact('users', 'player'));
        }
        $userplayer = $user->userPlayers()->first();
        if ($userplayer)
        {
            return redirect(route('player.players.edit', $userplayer->id));
        }
        else
        {
            return redirect(route('player.home'));
        }
            
    }

    public function update(UpdatePlayerRequest $request, Player $player)
    {
        $player->update($request->all());

        if ($request->avatar)
        {
            $imageName = time().'.'.$request->avatar->extension();
            $request->avatar->move(public_path('avatars'), $imageName);
            $player->avatar = $imageName;
            $player->save();
        }        

        return redirect()->route('player.myplayer');
    }

    public function show(Player $player)
    {
        abort_if(Gate::denies('player_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $player->load('user', 'team1Player1Scores', 'team1Player2Scores', 'team2Player1Scores', 'team2Player2Scores');

        return view('player.players.show', compact('player'));
    }

    public function destroy(Player $player)
    {
        abort_if(Gate::denies('player_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $player->delete();

        return back();
    }

    public function massDestroy(MassDestroyPlayerRequest $request)
    {
        Player::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function getPlayer(Request $request, $id)
    {
        $user = \Auth::user();
        $userplayer = $user->userPlayers()->first();

        $player = Player::where('id', $id)->distance($userplayer->latitude, $userplayer->longitude)->first();

        if ($player)
        {
            $lastscores = Score::with(['tournament', 'team_1_player_1', 'team_1_player_2', 'team_2_player_1', 'team_2_player_2'])
            ->where(function($query) use ($id){
                $query->where('team_1_player_1_id', $id)
                    ->orWhere('team_1_player_2_id', $id)
                    ->orWhere('team_2_player_1_id', $id)
                    ->orWhere('team_2_player_2_id', $id);
            })
            ->whereNotNull('verified_by')
            ->orderBy('id', 'DESC')->get();
            
            $player->bestshots = explode(',', $player->bestshots);
            $edit = false;
            return view('player.player', compact('player', 'lastscores', 'edit'));
        }
        
        return redirect(action('Player\HomeController@index'));
    }

    public function getMyPlayer(Request $request)
    {
        $user = \Auth::user();
        $player = $user->userPlayers()->first();

        if ($player)
        {
            $lastscores = Score::with(['tournament', 'team_1_player_1', 'team_1_player_2', 'team_2_player_1', 'team_2_player_2'])
            ->where(function($query) use ($player){
                $query->where('team_1_player_1_id', $player->id)
                    ->orWhere('team_1_player_2_id', $player->id)
                    ->orWhere('team_2_player_1_id', $player->id)
                    ->orWhere('team_2_player_2_id', $player->id);
            })
            ->whereNotNull('verified_by')
            ->orderBy('id', 'DESC')->get();
            
            $player->bestshots = explode(',', $player->bestshots);
            $edit = true;
            return view('player.player', compact('player', 'lastscores', 'edit'));
        }
        
        return redirect(action('Player\HomeController@index'));
    }

    public function getPlayerinfo(Player $player)
    {

        $player->bestshots = explode(',', $player->bestshots);

        return view('player.profile', compact('player'));
    }
    
    public function postMyProfile(Request $request)
    {
        $user = \Auth::user();
        $player = $user->userPlayers()->first();

        $player->description = $request->input('desc');
        $player->bestshots = $request->input('bestshots');
        $player->side = $request->input('side');
        $player->save();

        return view('player.profile', compact('player'));
    }
}
