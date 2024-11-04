@extends('layouts.admin.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">  
            <div class = "col-md-10 text-center">
                <h4>Update Play Quiz <a href = "{{ route('play_quiz.index') }}" class = "btn btn-sm btn-info float-right">View Play Quizzes</a></h4>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif 
            </div>   
        </div>

        <div class = "row justify-content-center">
            <div class = "col-md-6">
                <form action = "{{ route('play_quiz.update', ['play_quiz' => $play_quiz]) }}" method = "post">
                    {{ method_field('PUT') }}
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
                        <input type = "text" name = "question" value = "{{ $play_quiz->question }}" class = "form-control" required>
                    </div>

                    <div class = "form-group">
                        <label>Option1</label>
                        <input type = "text" name = "option1" value = "{{ $play_quiz->option1 }}" class = "form-control" required>
                    </div>

                    <div class = "form-group">
                        <label>Option2</label>
                        <input type = "text" name = "option2" value = "{{ $play_quiz->option2 }}" class = "form-control"  required>
                    </div>

                    <div class = "form-group">
                        <label>Option3</label>
                        <input type = "text" name = "option3" value = "{{ $play_quiz->option3 }}" class = "form-control" required>
                    </div>
                    <div class = "form-group">
                        <label>Option4</label>
                        <input type = "text" name = "option4" value = "{{ $play_quiz->option4 }}" class = "form-control"  required>
                    </div>
                    <div class = "form-group">
                        <label>Correct Option</label>
                        <input type = "text" name = "correct" value = "{{ $play_quiz->correct }}" class = "form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <select name="type" class="form-control" required>
                            <option value="">Select Type</option>                            
                            <option value="easy">Easy</option>
                            <option value="medium">Medium</option>
                            <option value="hard">Hard</option>
                            <option value="random">Random</option>
                        </select>
                    </div>
                    <input type="hidden" name = "con_type" value = "play">
                    <div class = "form-group">
                        <input type = "submit" name = "submit" class = "btn btn-sm btn-info form-control" value = "Update">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
