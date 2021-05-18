<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentsTable extends Migration
{
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('startdate')->nullable();
            $table->date('enddate')->nullable();
            $table->boolean('mens')->default(0)->nullable();
            $table->boolean('womens')->default(0)->nullable();
            $table->boolean('mix')->default(0)->nullable();
            $table->string('city')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
