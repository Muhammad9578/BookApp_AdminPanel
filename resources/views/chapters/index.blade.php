@extends('layouts.admin.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 text-center">
                <h4>All Chapters <a href = " {{ route('chapters.create') }} " class = "btn btn-sm btn-info float-right">Add New</a></h4>
            </div>
        </div>
        <div class = "row">
            <div class = "col-md-12">
                <table class = "table table-sm table-default">
                    <thead>
                    <th>ID</th>
                    <th>Chapter Name</th>                
                    <th>Content</th>
                    <th>FileName</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </thead>
                    <tbody>
                    @foreach($chapters as $chapter)
                        <tr>
                            <td>{{$chapter->id}}</td>
                            <td>{{$chapter->chapter_name}}</td>
                            <td>@if(is_null($chapter->content))
                                N/A
                                @else
                                {{$chapter->content}}
                                @endif
                            </td>
                            <td>@if(is_null($chapter->filename))
                                N/A
                                @else
                                {{$chapter->filename}}
                                @endif
                            </td> 
                            <td>
                                <a href = "{{ route('chapters.edit', ['chapter' => $chapter]) }}" class = "btn btn-sm btn-warning">Edit</a>                                    
                            </td>
                            <td>
                                <form action = "{{ route('chapters.destroy', ['chapter' => $chapter]) }}" method = "post">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <input type = "submit" name = "submit" value = "Delete" class = "btn btn-sm btn-danger">
                                </form>                            
                            </td>                           
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $chapters->links() }}
            </div>
        </div>
    </div>

@endsection
