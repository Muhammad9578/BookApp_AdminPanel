<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Quiz;
class QuizController extends Controller
{
    public function get_quiz(Request $request)
    {
        
        $chapter_id = $request->chapter_id;
        $quiz_type = $request->type;
        $con_type = $request->con_type;

        $quiz = Quiz::where('chapter_id', $chapter_id)
        ->where('type', $quiz_type)
        ->where('con_type', $con_type)
        ->get();

        if($request->expectsJson())
        {
            return response()->json([
                'status' => $quiz->count() > 0 ? 200 : 400,
                'message' => $quiz->count() > 0 ? 'Quizzes Found!' : 'Quizzes Not Found!',
                'data' => $quiz->count() > 0 ? $quiz->makeHidden(['correct', 'created_at', 'updated_at']) : [],
            ], 200);
        }
    }
}
