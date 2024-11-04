@extends('layouts.admin.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">  
            <div class = "col-md-10 text-center">
                <h4>Update Play <a href = "{{ route('plays.index') }}" class = "btn btn-sm btn-info float-right">View Plays</a></h4>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif 
            </div>   
        </div>

        <div class = "row justify-content-center">
            <div class = "col-md-6">
                <form action = "{{ route('plays.update', ['play' => $play->id]) }}" method = "post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class = "form-group">
                        <label>Play Name</label>
                        <input type = "text" name = "chapter_name" value = "{{ $play->chapter_name }}" class = "form-control" required>
                    </div>
                    <div class = "form-group">
                        <label>Content</label>
                        <textarea name = "content" class = "form-control"  placeholder = "Content" required rows = "10">{{ $play->content }}</textarea>
                    </div>
                    <div class="input-group control-group increment" >
                        <input type="file" name="filename" class="form-control" >
                    </div>
                    
                    <br>
                    <div class = "form-group">
                        <input type = "submit" name = "submit" class = "btn btn-sm btn-info form-control" value = "Update">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
