@extends('layouts.admin.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h4>All Plays <a href="{{ route('plays.create') }}" class = "btn btn-sm btn-info float-right">Add New</a></h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                @if(count($plays) > 0)
                    <table class="table table-sm table-default">
                        <thead>
                            <th>Play Name</th>
                            <th>Content</th>
                            <th>File Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            @foreach($plays as $play)
                            <tr>
                                <td>{{ $play->chapter_name }}</td>
                                <td>{{ $play->content }}</td>
                                <td>{{ $play->filename }}</td>
                                <td><a href="{{ route('plays.edit', ['play' => $play]) }}" class = "btn btn-sm btn-warning">Edit</a></td>
                                <td>
                                    <form action="{{ route('plays.destroy', ['play' => $play]) }}" method = "post">
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
                    <h4 style = "margin-left: 440px; margin-top: 50px;">No Play Found!</h4>
                @endif
            </div>
        </div>

    </div>
@endsection 