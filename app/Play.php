<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Play extends Model
{
    protected $table = 'plays';
    protected $fillable = ['id', 'play_name', 'content', 'filename'];
    
    public function attempts()
    {
        return $this->hasMany('App\Attempt', 'chapter_id', 'id');
    }
}
