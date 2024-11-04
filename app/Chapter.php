<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    public function results()
    {
        return $this->hasMany('App\Result', 'chapter_id', 'id');
    }
    
    public function attempts()
    {
        return $this->hasMany('App\Attempt', 'chapter_id', 'id');
    }

    
}
