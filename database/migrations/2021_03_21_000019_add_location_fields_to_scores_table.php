<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocationFieldsToScoresTable extends Migration
{
    public function up()
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->unsignedInteger('location_club_id')->nullable();
            $table->foreign('location_club_id', 'location_club_id_fk_2340610')->references('id')->on('clubs');

            $table->string('other_location')->nullable();
        });
    }
}
