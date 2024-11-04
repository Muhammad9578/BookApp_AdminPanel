@extends('layouts.admin.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">  
            <div class = "col-md-10 text-center">
                <h4>Add Play Quiz <a href = "{{ route('play_quiz.index') }}" class = "btn btn-sm btn-info float-right">View Play Quizzes</a></h4>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif 
            </div>   
        </div>

        <div class = "row justify-content-center">
            <div class = "col-md-6">
                <form action = "{{ route('play_quiz.store') }}" method = "post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Poem</label>
                        <select name="chapter_id" class="form-control" required>
                            <option value="">Select Play</option>
                            @foreach($plays as $play)
                            <option value="{{ $play->id }}">{{ $play->play_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class = "form-group">
                        <label>Question</label>
                        <input type = "text" name = "question" class = "form-control" placeholder = "Question" required>
                    </div>

                    <div class = "form-group">
                        <label>Option1</label>
                        <input type = "text" name = "option1" class = "form-control" placeholder = "Option1" required>
                    </div>

                    <div class = "form-group">
                        <label>Option2</label>
                        <input type = "text" name = "option2" class = "form-control" placeholder = "Option2" required>
                    </div>

                    <div class = "form-group">
                        <label>Option3</label>
                        <input type = "text" name = "option3" class = "form-control" placeholder = "Option3" required>
                    </div>
                    <div class = "form-group">
                        <label>Option4</label>
                        <input type = "text" name = "option4" class = "form-control" placeholder = "Option4" required>
                    </div>
                    <div class = "form-group">
                        <label>Correct Option</label>
                        <input type = "text" name = "correct" class = "form-control" placeholder = "Correct Option" required>
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <select name="type" class="form-control">
                            <option value="">Select Category</option>                            
                            <option value="easy">Easy</option>
                            <option value="medium">Medium</option>
                            <option value="hard">Hard</option>
                            <option value="random">Random</option>
                        </select>
                    </div>
                    <input type = "hidden" name = "con_type" value = "play">
                    <div class = "form-group">
                        <input type = "submit" name = "submit" class = "btn btn-sm btn-info form-control" value = "Add">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
