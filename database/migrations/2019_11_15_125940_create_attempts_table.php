<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attempts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('chapter_id');
            $table->foreign('chapter_id')->references('id')->on('chapters')->onDelete('cascade');
            $table->unsignedBigInteger('poem_id');
            $table->foreign('poem_id')->references('id')->on('poems')->onDelete('cascade');
            $table->unsignedBigInteger('play_id');
            $table->foreign('play_id')->references('id')->on('plays')->onDelete('cascade');
            $table->string('total_questions');
            $table->string('attempted');
            $table->string('unattempted');
            $table->string('true');
            $table->string('false');
            $table->string('quiz_type');
            $table->string('percentage');
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
        Schema::dropIfExists('attempts');
    }
}
