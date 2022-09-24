<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClubsTable extends Migration
{
    public function up()
    {
        Schema::create('clubs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('city');
            $table->integer('indoor_courts')->nullable();
            $table->integer('outdor_courts')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
