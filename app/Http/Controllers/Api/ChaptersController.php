<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Chapter;
use App\Result;
use App\Poem;
use App\Play;

class ChaptersController extends Controller
{
    public function get_chapters(Request $request)
    {        
        $user_id = $request->user_id; 
        $con_type = $request->con_type;
        
        if($con_type == 'lesson')
        {
            $result = Result::where('user_id', $user_id)->where('con_type', 'lesson')->latest()->first(['chapter_id','total_questions', 'easy', 'medium', 'hard', 'random']);
            
            $ch = array();
            if(!empty($result))
            {
                $total_attempt = $result->easy + $result->medium + $result->hard + $result->random;
                
                if($result->total_questions == $total_attempt)
                {
                    $next_chapter = $result->chapter_id + 1;
                    $pre = Chapter::where('id', '<',$next_chapter)->get(['id', 'chapter_name', 'filename']);                
                    $items = collect($pre)->each(function ($item) {
                        // Add new keys to the item
                        $item->status = 'locked';
                        $item->color = 'green';
                        $item->type = 'completed';
                    });

                    $curr = Chapter::where('id',$next_chapter)->get(['id', 'chapter_name', 'filename']);                
                    $items = collect($curr)->each(function ($item) {
                        // Add new keys to the item
                        $item->status = 'unlocked';
                        $item->color = 'yellow'; 
                        $item->type = 'current';
                    });            
                    
                    $next = Chapter::where('id', '>', $next_chapter)->get(['id', 'chapter_name', 'filename']);
                    $items = collect($next)->each(function ($item) {
                        // Add new keys to the item
                        $item->status = 'locked'; 
                        $item->color = 'red';
                        $item->type = 'next';
                    });
                    
                    $pre_curr = $pre->merge($curr);
                    $all_ch = $pre_curr->merge($next);

                    return response()->json([
                        'status' => 200,
                        'messages' => 'Chapters Found!',
                        'data' => $all_ch,
                    ], 200);

                }else{
                    
                    $pre = Chapter::where('id', '<',$result->chapter_id)->get(['id', 'chapter_name', 'filename']);                
                    $items = collect($pre)->each(function ($item) {
                        // Add new keys to the item
                        $item->status = 'locked';
                        $item->color = 'green';
                        $item->type = 'completed';
                    });

                    $curr = Chapter::where('id', $result->chapter_id)->get(['id', 'chapter_name', 'filename']);                
                    $items = collect($curr)->each(function ($item) {
                        // Add new keys to the item
                        $item->status = 'unlocked';
                        $item->color = 'yellow'; 
                        $item->type = 'current';
                    });            
                    
                    $next = Chapter::where('id', '>', $result->chapter_id)->get(['id', 'chapter_name', 'filename']);
                    $items = collect($next)->each(function ($item) {
                        // Add new keys to the item
                        $item->status = 'locked'; 
                        $item->color = 'red';
                        $item->type = 'next';
                    });
                    
                    $pre_curr = $pre->merge($curr);
                    $all_ch = $pre_curr->merge($next);

                    return response()->json([
                        'status' => 200,
                        'messages' => 'Chapters Found!',
                        'data' => $all_ch,
                    ], 200);
                }            
            }else{
                $chapters = Chapter::all(['id', 'chapter_name', 'filename']);
                //dd($chapters);
                if($chapters->count() > 0)
                {
                    $c = $chapters->slice(0,1);                        
                    $items = collect($c)->each(function ($item) {
                        // Add new keys to the item
                        $item->status = 'unlocked'; 
                        $item->color = 'yellow';
                        $item->type = 'current';
                    });
                    $d = $chapters->slice(1);
                    $items = collect($d)->each(function ($item) {
                        // Add new keys to the item
                        $item->status = 'locked'; 
                        $item->color = 'red';
                        $item->type = 'next';
                    });
                    $chapter = $c->merge($d);            
                    return response()->json([
                        'status' => 200,
                        'message' => 'All Chapters are Locked Except Chapter 1',
                        'data' => $chapter,
                    ], 200);
                    }else{
                        return response()->json([
                            'status' => 400,
                            'message' => 'No Chapter Found!',
                            'data' => null,
                    ], 400);
                }                
            }

        }elseif($con_type == 'poem')
        {
            $result = Result::where('user_id', $user_id)->where('con_type', 'poem')->latest()->first(['chapter_id','total_questions', 'easy', 'medium', 'hard', 'random']);
            //dd($result);
            $ch = array();
            if(!empty($result))
            {
                $total_attempt = $result->easy + $result->medium + $result->hard + $result->random;
                
                if($result->total_questions == $total_attempt)
                {
                    $next_chapter = $result->chapter_id + 1;
                    $pre = Poem::where('id', '<',$next_chapter)->get(['id', 'chapter_name', 'filename']);                
                    $items = collect($pre)->each(function ($item) {
                        // Add new keys to the item
                        $item->status = 'locked';
                        $item->color = 'green';
                        $item->type = 'completed';
                    });

                    $curr = Poem::where('id',$next_chapter)->get(['id', 'chapter_name', 'filename']);                
                    $items = collect($curr)->each(function ($item) {
                        // Add new keys to the item
                        $item->status = 'unlocked';
                        $item->color = 'yellow'; 
                        $item->type = 'current';
                    });            
                    
                    $next = Poem::where('id', '>', $next_chapter)->get(['id', 'chapter_name', 'filename']);
                    $items = collect($next)->each(function ($item) {
                        // Add new keys to the item
                        $item->status = 'locked'; 
                        $item->color = 'red';
                        $item->type = 'next';
                    });
                    
                    $pre_curr = $pre->merge($curr);
                    $all_ch = $pre_curr->merge($next);

                    return response()->json([
                        'status' => 200,
                        'messages' => 'Poems Found!',
                        'data' => $all_ch,
                    ], 200);

                }else{
                    //dd($result->chapter_id);
                    $pre = Poem::where('id', '<',$result->chapter_id)->get(['id', 'chapter_name', 'filename']);                
                    $items = collect($pre)->each(function ($item) {
                        // Add new keys to the item
                        $item->status = 'locked';
                        $item->color = 'green';
                        $item->type = 'completed';
                    });
                    //dd($pre);
                    $curr = Poem::where('id', $result->chapter_id)->get(['id', 'chapter_name', 'filename']);                
                    $items = collect($curr)->each(function ($item) {
                        // Add new keys to the item
                        $item->status = 'unlocked';
                        $item->color = 'yellow'; 
                        $item->type = 'current';
                    });            
                    
                    $next = Poem::where('id', '>', $result->chapter_id)->get(['id', 'chapter_name', 'filename']);
                    $items = collect($next)->each(function ($item) {
                        // Add new keys to the item
                        $item->status = 'locked'; 
                        $item->color = 'red';
                        $item->type = 'next';
                    });
                    
                    $pre_curr = $pre->merge($curr);
                    $all_ch = $pre_curr->merge($next);

                    return response()->json([
                        'status' => 200,
                        'messages' => 'Poems Found!',
                        'data' => $all_ch,
                    ], 200);
                }            
            }else{
                $chapters = Poem::all(['id', 'chapter_name', 'filename']);
                
                if($chapters->count() > 0)
                {
                    $c = $chapters->slice(0,1);                        
                    $items = collect($c)->each(function ($item) {
                        // Add new keys to the item
                        $item->status = 'unlocked'; 
                        $item->color = 'yellow';
                        $item->type = 'current';
                    });
                    $d = $chapters->slice(1);
                    $items = collect($d)->each(function ($item) {
                        // Add new keys to the item
                        $item->status = 'locked'; 
                        $item->color = 'red';
                        $item->type = 'next';
                    });
                    $chapter = $c->merge($d);            
                    return response()->json([
                        'status' => 200,
                        'message' => 'All Poems are Locked Except Poem 1',
                        'data' => $chapter,
                    ], 200);
                    }else{
                        return response()->json([
                            'status' => 400,
                            'message' => 'No Poem Found!',
                            'data' => null,
                    ], 400);
                }                
            }
        }else{            

            $result = Result::where('user_id', $user_id)->where('con_type', 'play')->latest()->first(['chapter_id','total_questions', 'easy', 'medium', 'hard', 'random']);
            //dd($result);
            $ch = array();
            if(!empty($result))
            {
                $total_attempt = $result->easy + $result->medium + $result->hard + $result->random;
                
                if($result->total_questions == $total_attempt)
                {
                    $next_chapter = $result->chapter_id + 1;
                    $pre = Play::where('id', '<',$next_chapter)->get(['id', 'chapter_name', 'filename']);                
                    $items = collect($pre)->each(function ($item) {
                        // Add new keys to the item
                        $item->status = 'locked';
                        $item->color = 'green';
                        $item->type = 'completed';
                    });

                    $curr = Play::where('id',$next_chapter)->get(['id', 'chapter_name', 'filename']);                
                    $items = collect($curr)->each(function ($item) {
                        // Add new keys to the item
                        $item->status = 'unlocked';
                        $item->color = 'yellow'; 
                        $item->type = 'current';
                    });            
                    
                    $next = Play::where('id', '>', $next_chapter)->get(['id', 'chapter_name', 'filename']);
                    $items = collect($next)->each(function ($item) {
                        // Add new keys to the item
                        $item->status = 'locked'; 
                        $item->color = 'red';
                        $item->type = 'next';
                    });
                    
                    $pre_curr = $pre->merge($curr);
                    $all_ch = $pre_curr->merge($next);

                    return response()->json([
                        'status' => 200,
                        'messages' => 'Plays Found!',
                        'data' => $all_ch,
                    ], 200);

                }else{
                    
                    $pre = Play::where('id', '<', $result->chapter_id)->get(['id', 'chapter_name', 'filename']);                
                    $items = collect($pre)->each(function ($item) {
                        // Add new keys to the item
                        $item->status = 'locked';
                        $item->color = 'green';
                        $item->type = 'completed';
                    });
                    //dd($pre);
                    $curr = Play::where('id', $result->chapter_id)->get(['id', 'chapter_name', 'filename']);                
                    $items = collect($curr)->each(function ($item) {
                        // Add new keys to the item
                        $item->status = 'unlocked';
                        $item->color = 'yellow'; 
                        $item->type = 'current';
                    });            
                    
                    $next = Play::where('id', '>', $result->chapter_id)->get(['id', 'chapter_name', 'filename']);
                    $items = collect($next)->each(function ($item) {
                        // Add new keys to the item
                        $item->status = 'locked'; 
                        $item->color = 'red';
                        $item->type = 'next';
                    });
                    
                    $pre_curr = $pre->merge($curr);
                    $all_ch = $pre_curr->merge($next);

                    return response()->json([
                        'status' => 200,
                        'messages' => 'Plays Found!',
                        'data' => $all_ch,
                    ], 200);
                }            
            }else{
                $chapters = Play::all(['id', 'chapter_name', 'filename']);
                
                if($chapters->count() > 0)
                {
                    $c = $chapters->slice(0,1);                        
                    $items = collect($c)->each(function ($item) {
                        // Add new keys to the item
                        $item->status = 'unlocked'; 
                        $item->color = 'yellow';
                        $item->type = 'current';
                    });
                    $d = $chapters->slice(1);
                    $items = collect($d)->each(function ($item) {
                        // Add new keys to the item
                        $item->status = 'locked'; 
                        $item->color = 'red';
                        $item->type = 'next';
                    });
                    $chapter = $c->merge($d);            
                    return response()->json([
                        'status' => 200,
                        'message' => 'All Plays are Locked Except Play 1',
                        'data' => $chapter,
                    ], 200);
                    }else{
                        return response()->json([
                            'status' => 400,
                            'message' => 'No Play Found!',
                            'data' => null,
                    ], 400);
                }                
            }
        }  
    }    
}
