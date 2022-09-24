<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateMessagesTables extends Migration
{
    public function up()
    {
        Schema::drop('qa_messages');
        Schema::drop('qa_topics');
        Schema::create('qa_topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject');
            $table->integer('creator_id')->unsigned();
            $table->foreign('creator_id')->references('id')->on('players')->onDelete('cascade');
            $table->integer('receiver_id')->unsigned();
            $table->foreign('receiver_id')->references('id')->on('players')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('qa_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('topic_id')->unsigned();
            $table->foreign('topic_id')->references('id')->on('qa_topics')->onDelete('cascade');
            $table->integer('sender_id')->unsigned();
            $table->foreign('sender_id')->references('id')->on('players')->onDelete('cascade');
            $table->timestamp('read_at')->nullable();
            $table->text('content');
            $table->timestamps();
        });
    }
}
