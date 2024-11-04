@extends('layouts.admin.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h4>All Play Results</h4>
            </div>
        </div>
        <div class = "row justify-content-center">
            <div class = "col-md-12">
                <table class = "table table-sm table-default">
                    <thead>
                        <th>UserID</th>
                        <th>ChapterID</th>
                        <th>Total Questions</th>
                        <th>Attempted</th>
                        <th>Unattempted</th>
                        <th>Percentage</th>
                        <th>Comment</th>                        
                        <th>Delete</th>            
                    </thead>
                    <tbody>
                    @foreach($results as $result)
                        <tr>
                            <td>{{$result->user_id}}</td>
                            <td>{{$result->chapter_id}}</td>
                            <td>{{$result->total_questions}}</td>
                            <td>{{$result->attempted}}</td>
                            <td>{{$result->unattempted}}</td>
                            <td>{{$result->percentage}}</td>
                            <td>@if(is_null($result->comment))
                                N/A
                                @else
                                {{$result->comment}}
                                @endif
                            </td>
                            
                            <td>
                            <form action = "{{ route('play_results.destroy', ['result' => $result]) }}" method = "post">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <input type = "submit" name = "submit" value = "Delete" class = "btn btn-sm btn-danger">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $results->links() }}
            </div>
        </div>
    </div>

@endsection
