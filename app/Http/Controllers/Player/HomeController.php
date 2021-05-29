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
        $data = Request()->all();
        // dd($data);
        $mindistance = $request->input('mindistance', null);
        $maxdistance = $request->input('maxdistance', null);
        $minpr = $request->input('minpr', null);
        $maxpr = $request->input('maxpr', null);
        $genre = $request->input('genre', null);
        $playernamesearched = $request->input('playername');

        $user = \Auth::user();
        $player = $user->userPlayers()->first();
        //$player = Player::select('name')->distance(41, 0)->having('distance','<>', 'null')->limit(2)->get();
        //dd($player);
        $order = $request->input('order', null);

        $players = Player::whereRaw("1=1");

        if ($playernamesearched)
        {
            $playernameparts = explode(' ', $playernamesearched);

            foreach ($playernameparts as $playernamepart) {
                if ($playernamepart!="")
                {
                    $players->where(DB::raw('LOWER(CONCAT(name, " ", surname))'), 'LIKE', '%'.strtolower($playernamepart).'%'); 
                }                                   
            }
        }
        if ( $minpr!=null && $maxpr!=null)
        {
            $players->where('pr', '>', $minpr)->where('pr', '<', $maxpr);
        }
        if ($player->latitude)
        {
            $players->distance($player->latitude, $player->longitude);
            if ( $mindistance!=null && $maxdistance!=null)
            {
                $players->having('distance','>', $mindistance)->having('distance','<', $maxdistance);
            }
        }
        if ($order)
        {
            $players->orderBy('distance', 'ASC');
        }
        $players = $players->get();
        return view('player.searchplayers', compact('players', 'playernamesearched', 'mindistance', 'maxdistance', 'minpr', 'maxpr','genre', 'order'));
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
