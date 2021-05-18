<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('set_1_team_1');
            $table->integer('set_1_team_2');
            $table->integer('set_2_team_1')->nullable();
            $table->integer('set_2_team_2')->nullable();
            $table->integer('set_3_team_1')->nullable();
            $table->integer('set_3_team_2')->nullable();
            $table->string('observations')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
