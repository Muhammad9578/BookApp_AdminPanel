<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('chapter_id')->nullable();
            $table->foreign('chapter_id')->references('id')->on('chapters')->onDelete('cascade');
            $table->unsignedBigInteger('poem_id')->nullable();
            $table->foreign('poem_id')->references('id')->on('poems')->onDelete('cascade');
            $table->unsignedBigInteger('play_id')->nullable();
            $table->foreign('play_id')->references('id')->on('plays')->onDelete('cascade');
            $table->string('total_questions');            
            $table->string('true');
            $table->string('false');
            $table->string('easy')->default(0);
            $table->string('medium')->default(0);
            $table->string('hard')->default(0);
            $table->string('random')->default(0);            
            $table->string('percentage')->default(0);
            $table->string('comment')->nullable();
            $table->enum('con_type', ['lesson', 'poem', 'play']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
}
