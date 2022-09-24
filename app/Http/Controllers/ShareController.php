<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Score;

class ShareController extends Controller
{

    public function getPlayer(Player $player)
    {
        if ($player)
        {
            $lastscores = Score::with(['tournament', 'team_1_player_1', 'team_1_player_2', 'team_2_player_1', 'team_2_player_2'])
            ->where(function($query) use ($player){
                $query->where('team_1_player_1_id', $player->id)
                    ->orWhere('team_1_player_2_id', $player->id)
                    ->orWhere('team_2_player_1_id', $player->id)
                    ->orWhere('team_2_player_2_id', $player->id);
            })
            ->orderBy('id', 'DESC')->get();

            $player->bestshots = explode(',', $player->bestshots);
            
            return view('sharedplayer', compact('player', 'lastscores'));
        }
        else
        {
            return view('home');
        }
    }
}
