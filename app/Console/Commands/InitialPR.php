<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Score;
use App\Models\Player;

class InitialPR extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:pr {score_id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate PR of all matches';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        if ($this->argument('score_id'))
        {
            $scores = Score::where('id', $this->argument('score_id'))->get();
        }
        else
        {
            $scores = Score::all();
        }
        
        //$scores = Score::limit(10)->get();

        foreach ($scores as $score) {
            $this->info("-----------------------------");
            
            list($team1win, $matchrating) = $this->matchscore($score);
            $prmedioteam1 = $this->prmedio($score->team_1_player_1_id, $score->team_1_player_2_id);
            $this->info("PR Medio Team 1: ".$prmedioteam1);
            $prmedioteam2 = $this->prmedio($score->team_2_player_1_id, $score->team_2_player_2_id);
            $this->info("PR Medio Team 2: ".$prmedioteam2);

            $diffprmedio = abs($prmedioteam1-$prmedioteam2);
            $diffprmedio = ($diffprmedio>15)? 15:$diffprmedio;
            if ($team1win)
            {
                if ($prmedioteam1>=$prmedioteam2)
                {
                    //Sumamos menos que si el que hubiera ganado fuera el que menos pr medio tuviera
                    if ($diffprmedio > 2)
                    {
                        $prsum = 0;
                    }
                    else
                    {
                        $prsum = ((15-$diffprmedio)/15) * $matchrating;
                    }
                }
                else
                {
                    $prsum = ($diffprmedio/15) * $matchrating;
                }

                $this->sumPR($score->team_1_player_1_id, $prsum);
                $this->sumPR($score->team_1_player_2_id, $prsum);
                $this->subPR($score->team_2_player_1_id, $prsum);
                $this->subPR($score->team_2_player_2_id, $prsum);
            }
            else
            {
                if ($prmedioteam2>=$prmedioteam1)
                {
                    //Sumamos menos que si el que hubiera ganado fuera el que menos pr medio tuviera
                    if ($diffprmedio > 2)
                    {
                        $prsum = 0;
                    }
                    else
                    {
                        $prsum = ((15-$diffprmedio)/15) * $matchrating;
                    }
                }
                else
                {
                    $prsum = ($diffprmedio/15) * $matchrating;
                }

                $this->sumPR($score->team_2_player_1_id, $prsum);
                $this->sumPR($score->team_2_player_2_id, $prsum);
                $this->subPR($score->team_1_player_1_id, $prsum);
                $this->subPR($score->team_1_player_2_id, $prsum);
            }

            $this->info("PR a sumar: ".$prsum);

        }

        return 0;
    }

    public function matchscore($score)
    {
        $team1 = 0;
        $team2 = 0;
        $matchrating = 0;

        if ($score->set_1_team_1 > $score->set_1_team_2) 
        {
            $team1++;
        }
        else
        {
            $team2++;
        }

        if ($score->set_2_team_1 > $score->set_2_team_2) 
        {
            $team1++;
        }
        else
        {
            $team2++;
        }

        if ( $score->set_3_team_1 != null && ($score->set_3_team_1 > $score->set_3_team_2) )
        {
            $team1++;
        }
        else
        {
            $team2++;
        }

        $matchrating += $score->set_1_team_1 - $score->set_1_team_2;
        $matchrating += $score->set_2_team_1 - $score->set_2_team_2;
        $matchrating += $score->set_3_team_1 - $score->set_3_team_2;

        $matchrating = ($matchrating>12)?12:$matchrating;
        
        $this->info("Gana Team ".( ($team1>$team2)?"1":"2") );
        $this->info("Score diff: ".abs($matchrating)/12);

        return array(($team1>$team2), abs($matchrating)/15);
    }

    public function prmedio($player_1_id, $player_2_id)
    {
        $pr_player1 = Player::find($player_1_id)->pr? Player::find($player_1_id)->pr : 5;
        $pr_player2 = Player::find($player_2_id)->pr? Player::find($player_2_id)->pr : 5;

        return ($pr_player1 + $pr_player2)/2;
    }

    public function sumPR($player_id, $prsum)
    {
        $player = Player::find($player_id);
        $player_pr = $player->pr?$player->pr:5;
        $multiplicador = abs(15-$player_pr)/10;
        $prsum *= $multiplicador;
        $player->pr = $player_pr + $prsum;
        $this->info("nuevo pr: ".$player->pr);
        $player->save();
    }
    public function subPR($player_id, $prsub)
    {
        $player = Player::find($player_id);
        $player_pr = $player->pr?$player->pr:5;
        $prsub = ($player_pr * $prsub)/15;
        $player->pr = (($player_pr - $prsub) > 0)? ($player_pr - $prsub) : 0;
        $this->info("nuevo pr: ".$player->pr);
        $player->save();
    }
}
