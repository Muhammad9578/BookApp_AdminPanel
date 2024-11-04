@extends('layouts.admin.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-10 text-center">
			<h4>Lesson Quizzes <a href = "{{ route('quizzes.create') }}" class = "btn btn-sm btn-info float-right">Add New</a></h4>
		</div>
	</div>
    <div class = "row justify-content-center">
        <div class = "col-md-12">
            <table class = "table table-sm table-default">
                <thead>
                    <th>Chapter ID</th>
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
                    @foreach($quizzes as $quiz)
                        <tr>
                            <td>{{$quiz->chapter_id}}</td>
                            <td>{{$quiz->question}}</td>
                            <td>{{$quiz->option1}}</td>
                            <td>{{$quiz->option2}}</td>
                            <td>{{$quiz->option3}}</td>
                            <td>{{$quiz->option4}}</td>
                            <td>{{$quiz->correct}}</td>
                            <td>{{$quiz->type}}</td>
                            <td>
                                <a href = "{{ route('quizzes.edit', ['quiz' => $quiz]) }}" class = "btn btn-sm btn-warning">Edit</a>
                            </td>
                            <td>
                                <form action = "{{ route('quizzes.destroy', ['quiz' => $quiz]) }}" method = "post">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <input type = "submit" name = "submit" value = "Delete" class = "btn btn-sm btn-danger">
                                </form>                           
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $quizzes->links() }}
        </div>
    </div>
</div>

@endsection
