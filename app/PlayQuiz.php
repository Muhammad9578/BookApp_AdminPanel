<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayQuiz extends Model
{
    protected $table = 'quizzes';
    protected $fillable = ['chapter_id', 'question', 'option1', 'option2', 'option3', 'option4', 'correct', 'type', 'con_type'];

}
