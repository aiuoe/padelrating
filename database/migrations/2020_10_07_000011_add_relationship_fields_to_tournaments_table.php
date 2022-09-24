<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTournamentsTable extends Migration
{
    public function up()
    {
        Schema::table('tournaments', function (Blueprint $table) {
            $table->unsignedInteger('club_id')->nullable();
            $table->foreign('club_id', 'club_fk_2340287')->references('id')->on('clubs');
        });
    }
}
