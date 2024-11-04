@extends('layouts.admin.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">  
            <div class = "col-md-10 text-center">
                <h4>Add Play <a href = "{{ route('plays.index') }}" class = "btn btn-sm btn-info float-right">View Plays</a></h4>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif 
            </div>   
        </div>

        <div class = "row justify-content-center">
            <div class = "col-md-6">
                <form action = "{{ route('plays.store') }}" method = "post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class = "form-group">
                        <label>Play Name</label>
                        <input type = "text" name = "chapter_name" class = "form-control" placeholder = "Play Name" required>
                    </div>
                    <div class = "form-group">
                        <label>Content</label>
                        <textarea name = "content" class = "form-control" placeholder = "Content" required rows = "10"></textarea>
                    </div>
                    <div class="input-group control-group increment" >
                        <input type="file" name="filename" class="form-control">
                    </div>
                    
                    <br>
                    <div class = "form-group">
                        <input type = "submit" name = "submit" class = "btn btn-sm btn-info form-control" value = "Add">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
