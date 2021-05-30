<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Question;
use App\Models\User;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index()
    {
    	$user = \Auth::user();
    	$player = $user->userPlayers()->first();

    	if ($player)
    	{
            $recommendedplayers = Player::whereNotNull('user_id')->where('pr', '>', $player->pr)->distance($player->latitude, $player->longitude)->orderBy('pr', 'ASC')->limit(6)->get();
            $nearplayers = Player::whereNotNull('latitude')->where('id', '<>', $player->id)->distance($player->latitude, $player->longitude)->orderBy('distance', 'ASC')->limit(10)->get();
            return view('player.home', compact('recommendedplayers', 'nearplayers'));
    	}
    	else
    	{
    		$candidates = Player::whereRaw('LOWER(surname) LIKE (?) ',["%{$user->surname}%"])->get();
    		if ($candidates)
    		{
    			return view('player.linkplayer', compact('candidates'));
    		}
    		else
    		{
    			return redirect(action('Player\HomeController@getFirstQuestionary'));
    		}
    	}
    }

    public function getLinkPlayer(Request $request, $id)
    {
    	$user = \Auth::user();

    	$player = Player::find($id);
    	$player->user_id = $user->id;
    	$player->save();

    	return redirect('home');
    }

    public function getFirstQuestionary(Request $request)
    {
        $user = \Auth::user();
        $player = $user->userPlayers()->first();
        $next_question = Question::whereRaw("1=1")->orderBy('id', 'ASC');
        if ($player)
        {
            $last_question_player = $player->questions()->orderBy('question_id', 'DESC')->first();
            
            if ($last_question_player)
            {
                $question_answered = Question::find($last_question_player->id);
                $next_question_id = $question_answered->{"nextanswer".$last_question_player->pivot->answer."question_id"};
                if ($next_question_id)
                {
                    $next_question = $next_question->where('id', $next_question_id);
                }
                else
                {
                    return redirect('home');
                }                
            }
        }
    	
        $next_question = $next_question->first();
    	return view('player.firstquestionary', compact('next_question', 'user'));
    }

    public function getSearchPlayers(Request $request)
    {
        $mindistance = 0;
        $maxdistance = 50;
        $minpr = 0;
        $maxpr = 14;
        $genre = null;
        $playernamesearched = "";
        
        $order = null;

        $players = Player::whereRaw("2=1")->get();

        return view('player.searchplayers', compact('players', 'playernamesearched', 'mindistance', 'maxdistance', 'minpr', 'maxpr', 'genre', 'order'));
    }

    public function postSearchPlayers(Request $request)
    {
        $me = Player::where('user_id', auth()->user()->id)->first();
        $players = [];

        $dist_min = ($request->input('distanceMin') == 0)? 1 : $request->input('distanceMin');
        $dist_max = $request->input('distanceMax');
        $pr_min = $request->input('prMin');
        $pr_max = $request->input('prMax');
        $hours = null;

        if ($request->hora != null)
            $hours = explode('-', $request->hora);

        $players = Player::distance($me->latitude, $me->longitude)
        ->get()
        ->whereBetween('distance', [$dist_min, $dist_max])
        ->whereBetween('pr', [$pr_min, $pr_max]);

        if ($request->has('filtrohombre'))
            $players = $players->where('genre', 'male');

        if ($request->has('filtromujer'))
            $players = $players->where('genre', 'female');

        if ($request->has('filtrootro'))
            $players = $players->where('genre', 'other');

        if ($request->fechaInicio != null)
        {
            $players = $players->filter(function($item, $key) use ($request)
            { 
                return count($item->schedules()->where('start', '<', $request->fechaInicio)->get()); 
            });
        }

        if ($request->fechaEnd != null)
        {
            $players = $players->filter(function($item, $key) use ($request)
            { 
                return count($item->schedules()->where('end', '<', $request->fechaEnd)->get()); 
            });   
        }

        if ($hours != null)
        {
            $players = $players->filter(function($item, $key) use ($hours)
            { 
                return count($item->schedules()->whereTime('start', '<', $hours[0])->get()); 
            });

            $players = $players->filter(function($item, $key) use ($hours)
            { 
                return count($item->schedules()->whereTime('end', '<', $hours[1])->get()); 
            });
        }


        return $players->where('user_id', '!=', auth()->user()->id)->flatten();
    }

    public function postFirstQuestionary(Request $request)
    {
        $question_id = $request->input('question_id');
        $answer = $request->input('answer');
        $user = \Auth::user();

        $player = $user->userPlayers()->first();

        if (!$player)
        {
            $player = new Player;
            $player->name = $user->name;
            $player->surname = $user->surname;
            $player->genre = ($user->genre == 'male')?'male':'female';
            $player->birthdate = $request->input('birthdate');
            $player->license_number = $request->input('license_number');
            $player->user_id = $user->id;
            $player->pr=0;
            $player->save();
        }

        $player->questions()->attach([ $question_id => [
            'answer' => $answer
        ] ]);

        $score = Question::find($question_id)->{"score".$answer};
        $player->pr+=$score;
        $player->save();

        return redirect(action('Player\HomeController@getFirstQuestionary'));
    }

    public function postSaveUserLocation(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $user = \Auth::user();

        $player = $user->userPlayers()->first();
        if ($player)
        {
            $player->latitude = $latitude;
            $player->longitude = $longitude;
            $player->save();

            return 1;
        }
        
        return -1;
    }
}
