<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClubUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('club_user', function (Blueprint $table) {
            $table->unsignedInteger('club_id');
            $table->foreign('club_id', 'club_id_fk_2340445')->references('id')->on('clubs')->onDelete('cascade');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_2340445')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
