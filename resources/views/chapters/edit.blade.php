@extends('layouts.admin.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">  
            <div class = "col-md-10 text-center">
                <h4>Update Chapter <a href = "{{ route('chapters.index') }}" class = "btn btn-sm btn-info float-right">View Chapters</a></h4>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif 
            </div>   
        </div>

        <div class = "row justify-content-center">
            <div class = "col-md-6">
                <form action = "{{ route('chapters.update', ['chapter' => $chapter]) }}" method = "post" enctype="multipart/form-data">
                    {{method_field('PUT')}}
                    {{csrf_field()}}
                    <div class = "form-group">
                        <label>Chapter Name</label>
                        <input type = "text" name = "chapter_name" value = "{{ $chapter->chapter_name }}" class = "form-control" placeholder = "Chapter Name" required>
                    </div>
                    <div class = "form-group">
                        <label>Content</label>
                        <textarea name = "content" class = "form-control" placeholder = "Content" required rows = "10">{{ $chapter->content }}</textarea>
                    </div>
                    <div class="input-group control-group increment" >
                        <input type="file" name="filename" class="form-control">
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
