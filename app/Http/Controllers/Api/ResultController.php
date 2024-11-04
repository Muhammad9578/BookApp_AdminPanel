<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Result;
use App\User;
use App\Chapter;
use App\Quiz;
use App\Attempt;
use App\Poem;
use App\Play;
class ResultController extends Controller
{
    public function get_result(Request $request)
    {    
        
        $user_id = $request->user_id;
        $chapter_id = $request->chapter_id;
        $type = $request->type;
        $con_type = $request->con_type;
        
        //$mcqs = json_decode(json_encode($request->mcqs));               
        $mcqs = json_decode($request->mcqs); 
        $total_questions = Quiz::where('chapter_id', $chapter_id)->where('type', $type)->where('con_type', $con_type)->count();
        $all_questions = Quiz::where('chapter_id', $chapter_id)->where('con_type', $con_type)->count();
        
        $answers = array();

        for($i = 0; $i < count($mcqs); $i++)
        {            
            array_push($answers, $mcqs[$i]->selected_option);                    
        }
        
        $correct = Quiz::where('chapter_id', $chapter_id)->where('type', $type)->where('con_type', $con_type)->pluck('correct');
        // //dd($correct);        

        $result = 0;
        for($i = 0; $i < count($correct); $i++)
        {
            if($correct[$i] === $answers[$i])
            {
                $result++;
            }
        }   
        
        $unattempted = array();

        for($i = 0; $i < count($mcqs); $i++)
        {
            if($mcqs[$i]->selected_option == 'empty'){
                array_push($unattempted, $mcqs[$i]->selected_option);
            }  
        }
        
        $attempted = $total_questions - count($unattempted);
        
        $percentage = ($result * 100) / $total_questions;

        if($type == 'easy')
        {
            $e = $attempted;
            $m = 0;
            $h = 0;
            $r = 0;
        }
        if($type == 'medium')
        {
            $e = 0;
            $m = $attempted;
            $h = 0;
            $r = '';
        }elseif($type == 'hard')
        {
            $e = 0;
            $m = 0;
            $h = $attempted;
            $r = 0;
        }elseif($type == 'random')
        {
            $e = 0;
            $m = 0;
            $h = 0;
            $r = $attempted;
        }

        $rr = Result::where('user_id', $user_id)->where('chapter_id', $chapter_id)->where('con_type', $con_type)->first();
        //dd($rr);
        if(!empty($rr))
        {
            if($type == 'medium')
            {
                $e = $rr->easy;
                $m = $attempted;
                $h = 0;
                $r = 0;
            }elseif($type == 'hard')
            {
                $e = $rr->easy;
                $m = $rr->medium;
                $h = $attempted;
                $r = 0;
            }
            elseif($type == 'random'){
                $e = $rr->easy;
                $m = $rr->medium;
                $h = $rr->hard;
                $r = $attempted;
            }
            
            $per = ($rr->percentage + $percentage) / 2;            
        
            $trues = $rr->true + $result;
            $falses = $rr->false + ($total_questions - $result);
            $rr->true = $trues;
            $rr->false = $falses;
            $rr->easy = $e;
            $rr->medium = $m;
            $rr->hard = $h;
            $rr->random = $r;
            $rr->percentage = $per;
            $rr->comment = 'None';
            $rr->save();

            $rr1 = Result::where('user_id', $user_id)->where('chapter_id', $chapter_id)->where('con_type', $con_type)->first();

            $tt = $rr1->easy + $rr1->medium + $rr1->hard + $rr1->random;

            $attempt = new Attempt;
            $attempt->user_id = $user_id;
            $attempt->chapter_id = $chapter_id;
            $attempt->total_questions = $all_questions;
            $attempt->attempted = $tt;
            $attempt->unattempted = $all_questions - $tt;
            $attempt->true = $trues;
            $attempt->false = $falses;
            $attempt->quiz_type = $type;
            $attempt->percentage = $percentage;
            $attempt->con_type = $con_type;
            $attempt->save();

            return response()->json([
                'status' => 200,
                'message' => 'Result Compiled',
                'data' => [
                    'user_id' => $user_id,
                    'chapter_id' => $chapter_id,
                    'total_questions' => $all_questions,
                    'type_total_questions' => $total_questions,
                    'attempted' => $tt,
                    'unattempted' => $all_questions - $tt,
                    'true' => $trues,
                    'false' => $falses,
                    'percentage' => $per,
                    'con_type' => $con_type 
                ],
            ], 200);
            

        }else{
            $res = new Result;
            $res->user_id = $user_id;
            $res->chapter_id = $chapter_id;
            $res->total_questions = $all_questions;        
            $res->true = $result;
            $res->false = $total_questions - $result;
            $res->easy = $e;
            $res->medium = $m;
            $res->hard = $h;
            $res->random = $r;        
            $res->percentage = $percentage;
            $res->comment = 'None';
            $res->con_type = $con_type;  

            $res->save();
            
            $attempt = new Attempt;
            $attempt->user_id = $user_id;
            $attempt->chapter_id = $chapter_id;
            $attempt->total_questions = $all_questions;
            $attempt->attempted = $attempted;
            $attempt->unattempted = $total_questions - $attempted;
            $attempt->true = $result;
            $attempt->false = $total_questions - $result;
            $attempt->quiz_type = $type;
            $attempt->percentage = $percentage;
            $attempt->con_type = $con_type;
            $attempt->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Result Complied',
                    'data' => [
                        'user_id' => $user_id,
                        'chapter_id' => $chapter_id,
                        'chapter_total_questions' => $all_questions,
                        'type_total_questions' => $total_questions,
                        'attempted' => $attempted,
                        'unattempted' => $total_questions - $attempted,
                        'true' => $result,
                        'false' => $total_questions - $result,
                        'percentage' => $percentage,
                         
                    ],
                ], 200);
    
        }        
    }
    
    public function attempted_chapters(Request $request)
    {
        $user_id = $request->user_id;
        //$con_type = $request->con_type;
        $attempted_chapters = Attempt::where('user_id', $user_id)->first();
    
        $chapters = array();

        if(!is_null($attempted_chapters))
        {
            
            // if($con_type == 'lesson')
            // {
            //     $attempted_chapters = Attempt::where('user_id', $user_id)->get()->unique(['chapter_id'])->loadMissing('poem')
            //     ->map(function($item){                
            //         //unset($item->chapter->filename);
            //         unset($item->poem->content);
            //         unset($item->poem->created_at);
            //         unset($item->poem->updated_at);
    
            //         return $item;
            //     })->makeHidden([
            //         'id', 'poem_id','play_id','quiz_type','user_id', 'chapter_id', 'created_at', 'updated_at', 'total_questions', 'attempted', 'unattempted',
            //         'true', 'false', 'percentage', 'comment',
            //     ]);    
            // }
            
            
            $attempted_chapters = Result::where('user_id', $user_id)->get(['chapter_id', 'con_type']);
            $ch = array();
            foreach($attempted_chapters as $atc)
            {
                if($atc->con_type == 'lesson')
                {
                    $chapters = Chapter::find($atc->chapter_id);
                    $chapters['con_type'] = 'lesson';
                    array_push($ch, $chapters);
                
                }elseif($atc->con_type == 'poem')
                {
                    $poems = Poem::find($atc->chapter_id);
                    $poems['con_type'] = 'poem';
                    array_push($ch, $poems);
                }else{
                    $plays = Play::find($atc->chapter_id);
                    $plays['con_type'] = 'play';
                    array_push($ch, $plays);
                }
            }
            
            return response()->json([
                'status' => 200,
                'message' => ' Attempted Chapters Found',
                'data' => $ch             
            ], 200);
            
            
            
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'No Attempted Chapters Found!',
                'data' => null,
            ], 400);
        }
    }

    public function result_history(Request $request)
    {
        $user_id = $request->user_id;
        $chapter_id = $request->chapter_id;
        $con_type = $request->con_type;
        $result = Attempt::where('chapter_id', $chapter_id)->where('con_type', $con_type)
        ->where('user_id', $user_id)
        ->get();

        if($result->count() <= 2 && $result->count() > 0){
            if($request->expectsJson())
            {
                return response()->json([
                    'status' => 200,
                    'message' => 'Results Found',
                    'data' => $result->makeHidden(['comment', 'created_at', 'updated_at']),
                ], 200);
            }
        }elseif($result->count() >= 3)
        {
            $res = Attempt::where('chapter_id', $chapter_id)->where('con_type', $con_type)
            ->where('user_id', $user_id)
            ->orderby('created_at', 'asc')->limit(2)->get();

            $res1 = Attempt::where('chapter_id', $chapter_id)->where('con_type', $con_type)
            ->where('user_id', $user_id)
            ->orderby('created_at', 'desc')->limit(1)->get();
            
            $res2 = $res->merge($res1);

            return response()->json([
                'status' => 200,
                'message' => 'Results Found!',
                'data' => $res2->makeHidden(['created_at', 'updated_at']),
            ], 200);
        }else{
            if($request->expectsJson())
            {
                return response()->json([
                    'status' => 400,
                    'message' => 'No Result Found!',
                    'data' => null,
                ], 400);
            }
        }   
    }

    public function answer_sheet(Request $request)
    {
        $chapter_id = $request->chapter_id;
        $con_type = $request->con_type;
        $sheet = Quiz::where('chapter_id', $chapter_id)->where('con_type', $con_type)->get();
        //dd($sheet);
            return response()->json([
                'status' => $sheet->count() > 0 ? 200:400,
                'message' => $sheet->count() > 0 ? 'Answer Sheet Found!':'No Answer Sheet Found!',
                'data' => $sheet->count() > 0 ? $sheet->makeHidden(['id', 'con_type','chapter_id', 'type','option1', 'option2', 'option3', 'option3', 'option4', 'created_at', 'updated_at']): null,
            ], 200);        
    }
    
    public function delete_history(Request $request)
    {
        $user_id = $request->user_id;
        
        $attempts = Attempt::where('user_id', $user_id)->get();
        $results = Result::where('user_id', $user_id)->get();
        
        if($attempts->count() > 0 && $results->count() > 0)
        {
            foreach($attempts as $at)
            {
                $at->delete();
            }
            
            foreach($results as $res)
            {
                $res->delete();
            }
            
            return response()->json([
                'status' => 200,
                'message' => 'Result History Deleted!',
                'data' => null,
            ], 200);
            
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'No Result History Found!',
                'data' => null,
            ], 400);
        }
        
    }
}
