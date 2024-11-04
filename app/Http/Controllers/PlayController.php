<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Play;
class PlayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plays = Play::paginate(10);
        return view('plays.index', compact('plays'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plays.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'filename' => 'required',
            'filename.*' => 'file|mimes:pdf|max:4048'
        ]);

        $file = $request->file('filename');
        $path = $file->storeAs('files', md5(mt_rand()) . '.' . $file->getClientOriginalExtension(), 'public');        

        $new_path = 'http://travces.com/bookapp/storage/app/public/'.$path;

        $play = new Play;
        $play->play_name = $request->play_name;
        $play->content = $request->content;
        $play->filename=$new_path;        
        $play->save();
        return back()->with('message', 'Play Added Successfully!'); 
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
    public function edit(Play $play)
    {
        return view('plays.edit', compact('play'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Play $play)
    {
        $this->validate($request, [
            'filename' => 'required',
            'filename.*' => 'file|mimes:pdf|max:4048'
        ]);

        $file = $request->file('filename');
        $path = $file->storeAs('files', md5(mt_rand()) . '.' . $file->getClientOriginalExtension(), 'public'); 
       $new_path = 'http://travces.com/bookapp/storage/app/public/'.$path;

        $play->chapter_name = $request->chapter_name;
        $play->content = $request->content;
        $play->filename = $new_path;        
        $play->save();
        return back()->with('message', 'Play Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Play $play)
    {   
        $play->destroy();
        return back()->with('message', 'Play Deleted Successfully!');
    }
}
