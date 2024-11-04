<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlayQuiz;
use App\Play;
class PlayQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $play_quizzes = PlayQuiz::where('con_type', 'play')->paginate(10);
        return view('play_quiz.index', compact('play_quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plays = Play::all();
        return view('play_quiz.create', compact('plays'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PlayQuiz::create($request->all());
        return back()->with('message', 'Play Quiz Added Successfully!');
        // $play_quiz = new PlayQuiz;
        // $play_quiz->chapter_id = $request->chapter_id;
        // $play_quiz->question = $request->question;
        // $play_quiz->option1 = $request->option1;
        // $play_quiz->option2 = $request->option2;
        // $play_quiz->option3 = $request->option3;
        // $play_quiz->option4 = $request->option4;
        // $play_quiz->correct = $request->correct;
        // $play_quiz->type = $request->type;
        // $play_quiz->con_type = $request->con_type;
        // $play_quiz->save();
        // return back()->with('message', 'Play Quiz Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PlayQuiz $play_quiz)
    {
        $plays = Play::all();
        return view('play_quiz.edit', compact('play_quiz', 'plays'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlayQuiz $play_quiz)
    {
        $play_quiz->chapter_id = $request->chapter_id;
        $play_quiz->question = $request->question;
        $play_quiz->option1 = $request->option1;
        $play_quiz->option2 = $request->option2;
        $play_quiz->option3 = $request->option3;
        $play_quiz->option4 = $request->option4;
        $play_quiz->correct = $request->correct;
        $play_quiz->type = $request->type;
        $play_quiz->con_type = $request->con_type;
        $play_quiz->save();
        return back()->with('message', 'Play Quiz Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlayQuiz $play_quiz)
    {
        $play_quiz->destroy();
        return back()->with('message', 'Play Quiz Deleted Successfully!');
    }
}
