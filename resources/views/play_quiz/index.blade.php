@extends('layouts.admin.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h4>Play Quizzes <a href="{{ route('play_quiz.create') }}" class = "btn btn-sm btn-info float-right">Add New</a></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if(count($play_quizzes) > 0)
                    <table class = "table">
                        <thead>
                            <th>Play</th>
                            <th>Question</th>
                            <th>Option1</th>
                            <th>Option2</th>
                            <th>Option3</th>
                            <th>Option4</th>
                            <th>Correct</th>
                            <th>Type</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            @foreach($play_quizzes as $play_quiz)
                                <tr>
                                    <td>{{ $play_quiz->chapter_id }}</td>
                                    <td>{{ $play_quiz->question }}</td>
                                    <td>{{ $play_quiz->option1 }}</td>
                                    <td>{{ $play_quiz->option2 }}</td>
                                    <td>{{ $play_quiz->option3 }}</td>
                                    <td>{{ $play_quiz->option4 }}</td>
                                    <td>{{ $play_quiz->correct }}</td>
                                    <td>{{ $play_quiz->type }}</td>
                                    <td><a href="{{ route('play_quiz.edit', ['play_quiz' => $play_quiz]) }}" class = "btn btn-sm btn-warning">Edit</a></td>
                                    <td>
                                        <form action="{{ route('play_quiz.destroy', ['play_quiz' => $play_quiz]) }}" method = "post">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input type="submit" name = "submit" class = "btn btn-sm btn-danger" value = "Delete">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h4 style = "margin-left: 420px; margin-top: 40px;">No Play Quiz Found!</h4>
                @endif
            </div>
        </div>
        {{ $play_quizzes->links() }}
    </div>

@endsection