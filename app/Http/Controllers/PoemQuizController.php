<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PoemQuiz;
use App\Poem;
class PoemQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $poem_quizzes = PoemQuiz::where('con_type', 'poem')->paginate(10);
        return view('poem_quiz.index', compact('poem_quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $poems = Poem::all();
        return view('poem_quiz.create', compact('poems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $poem_quiz = new PoemQuiz;
        $poem_quiz->chapter_id = $request->chapter_id;
        $poem_quiz->question = $request->question;
        $poem_quiz->option1 = $request->option1;
        $poem_quiz->option2 = $request->option2;
        $poem_quiz->option3 = $request->option3;
        $poem_quiz->option4 = $request->option4;
        $poem_quiz->correct = $request->correct;
        $poem_quiz->type = $request->type;
        $poem_quiz->con_type = $request->con_type;
        $poem_quiz->save();
        return back()->with('message', 'Poem Quiz Added Successfully!');
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
    public function edit(PoemQuiz $poem_quiz)
    {
        $poems = Poem::all();
        //dd($poems);
        return view('poem_quiz.edit', compact('poem_quiz', 'poems'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PoemQuiz $poem_quiz)
    {
        $poem_quiz->chapter_id = $request->chapter_id;
        $poem_quiz->question = $request->question;
        $poem_quiz->option1 = $request->option1;
        $poem_quiz->option2 = $request->option2;
        $poem_quiz->option3 = $request->option3;
        $poem_quiz->option4 = $request->option4;
        $poem_quiz->correct = $request->correct;
        $poem_quiz->type = $request->type;
        $poem_quiz->con_type = $request->con_type;
        $poem_quiz->save();
        return back()->with('message', 'Poem Quiz Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PoemQuiz $poem_quiz)
    {
        if($poem_quiz->destroy())
        {
            return back()->with('message', 'Poem Quiz Deleted Successfully1');
        }else{
            return back()->with('message', 'Something is Wrong');
        }
    }
}
