<?php

namespace App\Http\Controllers;

use App\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chapters = Chapter::paginate(10);
        return view('chapters.index', compact('chapters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('chapters.create');
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
    
        $chapter = new Chapter;
        $chapter->chapter_name = $request->chapter_name;
        $chapter->content = $request->content;
        $chapter->filename=$new_path;
        $chapter->save();
        return back()->with('message', 'Chapter Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function show(Chapter $chapter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function edit(Chapter $chapter)
    {
               
        return view('chapters.edit', compact('chapter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chapter $chapter)
    {
        $this->validate($request, [
            'filename' => 'required',
            'filename.*' => 'file|mimes:pdf|max:4048'
        ]);

        $file = $request->file('filename');
        // $path = $file->storeAs('files', md5(mt_rand()) . '.' . $file->getClientOriginalExtension(), 'public');
        $path = $file->storeAs('files', $file. '.' . $file->getClientOriginalExtension(), 'public');
        $new_path = 'http://travces.com/bookapp/storage/app/public/'.$path;

        $chapter->chapter_name = $request->chapter_name;
        $chapter->content = $request->content;
        $chapter->filename = $new_path;
        $chapter->save();
        return back()->with('message', 'Chapter Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chapter $chapter)
    {
        //dd($chapter);
        $chapter->delete();
        return back();
    }
}
