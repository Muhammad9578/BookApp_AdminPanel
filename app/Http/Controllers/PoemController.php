<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poem;
class PoemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $poems = Poem::paginate(10);
        return view('poems.index', compact('poems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('poems.create');
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

        $poem = new Poem;
        $poem->poem_name = $request->poem_name;
        $poem->content = $request->content;
        $poem->filename=$new_path;        
        $poem->save();
        return back()->with('message', 'Poem Added Successfully!');        
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
    public function edit($id)
    {
        $poem = Poem::find($id);
        // dd($poem->content);
        return view('poems.edit', compact('poem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poem $poem)
    {
        
        $this->validate($request, [
            'filename' => 'required',
            'filename.*' => 'file|mimes:pdf|max:4048'
        ]);

        $file = $request->file('filename');
        $path = $file->storeAs('files', md5(mt_rand()) . '.' . $file->getClientOriginalExtension(), 'public'); 
        $new_path = 'http://travces.com/bookapp/storage/app/public/'.$path;

        $poem->chapter_name = $request->chapter_name;
        $poem->content = $request->content;
        $poem->filename = $new_path;        
        $poem->save();
        return back()->with('message', 'Poem Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $poem = Poem::find($id);
        $poem->destroy();
        return back()->with('message', 'Poem Deleted Successfully!');
    }
}
