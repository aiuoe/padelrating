<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToQuestionsTable extends Migration
{
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->integer('nextanswer1question_id')->unsigned()->nullable();
            $table->foreign('nextanswer1question_id')->references('id')->on('questions')->onDelete('cascade');

            $table->integer('nextanswer2question_id')->unsigned()->nullable();
            $table->foreign('nextanswer2question_id')->references('id')->on('questions')->onDelete('cascade');

            $table->integer('nextanswer3question_id')->unsigned()->nullable();
            $table->foreign('nextanswer3question_id')->references('id')->on('questions')->onDelete('cascade');

            $table->integer('nextanswer4question_id')->unsigned()->nullable();
            $table->foreign('nextanswer4question_id')->references('id')->on('questions')->onDelete('cascade');
        });
    }
}
