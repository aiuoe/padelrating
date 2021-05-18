<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToScoresTable extends Migration
{
    public function up()
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->unsignedInteger('tournament_id')->nullable();
            $table->foreign('tournament_id', 'tournament_fk_2340610')->references('id')->on('tournaments');
            $table->unsignedInteger('team_1_player_1_id');
            $table->foreign('team_1_player_1_id', 'team_1_player_1_fk_2340611')->references('id')->on('players');
            $table->unsignedInteger('team_1_player_2_id');
            $table->foreign('team_1_player_2_id', 'team_1_player_2_fk_2340612')->references('id')->on('players');
            $table->unsignedInteger('team_2_player_1_id');
            $table->foreign('team_2_player_1_id', 'team_2_player_1_fk_2340613')->references('id')->on('players');
            $table->unsignedInteger('team_2_player_2_id');
            $table->foreign('team_2_player_2_id', 'team_2_player_2_fk_2340614')->references('id')->on('players');
        });
    }
}
