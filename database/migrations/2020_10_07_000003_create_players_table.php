<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('surname');
            $table->string('genre');
            $table->date('birthdate')->nullable();
            $table->integer('license_number')->nullable();
            $table->string('city');
            $table->float('pr')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
