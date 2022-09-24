<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('answer1');
            $table->float('score1');
            $table->string('answer2');
            $table->float('score2');
            $table->string('answer3')->nullable();
            $table->float('score3')->nullable();
            $table->string('answer4')->nullable();
            $table->float('score4')->nullable();
            $table->integer('order')->nullable()->unsigned();
            $table->timestamps();
        });
    }
}
