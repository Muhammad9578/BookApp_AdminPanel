<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poem extends Model
{
    protected $table = 'poems';
    protected $fillable = ['id','poem_name', 'content', 'filename'];
    
    
    public function attempts()
    {
        return $this->hasMany('App\Attempt', 'chapter_id', 'id');
    }
    
}
