<?php

namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quiz::where('con_type', 'lesson')->paginate(10);
        return view('quizzes.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quizzes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quiz = new Quiz;
        $quiz->chapter_id = $request->chapter_id;
        $quiz->question = $request->question;
        $quiz->option1 = $request->option1;
        $quiz->option2 = $request->option2;
        $quiz->option3 = $request->option3;
        $quiz->option4 = $request->option4;
        $quiz->correct = $request->correct;
        $quiz->type = $request->type;
        $quiz->save();
        return back()->with('message', 'Quiz Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        return view('quizzes.edit', compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz)
    {
        $quiz->chapter_id = $request->chapter_id;
        $quiz->question = $request->question;
        $quiz->option1 = $request->option1;
        $quiz->option2 = $request->option2;
        $quiz->option3 = $request->option3;
        $quiz->option4 = $request->option4;
        $quiz->correct = $request->correct;
        $quiz->type = $request->type;
        $quiz->save();
        return back()->with('message', 'Quiz Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return back();
    }
}
