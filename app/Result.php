<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function chapter()
    {
        return $this->belongsTo('App\Chapter', 'chapter_id', 'id');
    }
}
