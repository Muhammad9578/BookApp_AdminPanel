<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    protected $table = 'attempts';

    protected $fillable = [
        'user_id', 'chapter_id', 'total_questions', 'attempted', 'unattempted', 'true', 'false', 'quiz_type',
        'percentage', 'con_type'
    ];
    
    public function chapter()
    {
        return $this->belongsTo('App\Chapter', 'chapter_id', 'id');
    }
    public function poem()
    {
        return $this->belongsTo('App\Poem', 'chapter_id', 'id');
    }
    public function play()
    {
        return $this->belongsTo('App\Play', 'chapter_id', 'id');
    }
}
