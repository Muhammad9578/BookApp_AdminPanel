@extends('layouts.admin.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h4>Poem Quizzes <a href="{{ route('poem_quiz.create') }}" class = "btn btn-info btn-sm float-right">Add New</a></h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                @if(count($poem_quizzes) > 0)
                    <table class="table table-sm table-default">
                        <thead>
                            <th>Poem ID</th>
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
                            @foreach($poem_quizzes as $poem_quiz)
                            <tr>
                                <td>{{ $poem_quiz->chapter_id }}</td>
                                <td>{{ $poem_quiz->question }}</td>
                                <td>{{ $poem_quiz->option1 }}</td>
                                <td>{{ $poem_quiz->option2 }}</td>
                                <td>{{ $poem_quiz->option3 }}</td>
                                <td>{{ $poem_quiz->option4 }}</td>
                                <td>{{ $poem_quiz->correct }}</td>
                                <td>{{ $poem_quiz->type }}</td>
                                <td>
                                    <a href="{{ route('poem_quiz.edit', ['poem_quiz' => $poem_quiz]) }}" class = "btn btn-sm btn-warning">Edit</a>
                                </td>
                                <td>
                                    <form action = "{{ route('poem_quiz.destroy', ['poem_quiz' => $poem_quiz]) }}" method = "post">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                            <input type = "submit" name = "submit" value = "Delete" class = "btn btn-sm btn-danger">
                                    </form>                                     
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h4 style = "margin-left: 425px; margin-top: 50px;">No Poem Quiz Found</h4>
                @endif
            </div>
        </div>
        {{ $poem_quizzes->links() }}
    </div>
@endsection