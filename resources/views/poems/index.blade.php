@extends('layouts.admin.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h4>Poems <a href="{{ route('poems.create') }}" class = "btn btn-sm btn-info float-right">Add New</a></h4>
        </div>
    </div>
    @if(count($poems) > 0)
    <div class="row">
        <div class="col-md-12">
            <table class = "table table-sm table-default">
                <thead>                    
                    <th>Poem Name</th>
                    <th>Content</th>
                    <th>File Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    @foreach($poems as $poem)
                        <tr>                            
                            <td>{{ $poem->chapter_name }}</td>
                            <td>{{ $poem->content }}</td>
                            <td>{{ $poem->filename }}</td>
                            <td><a href="{{ route('poems.edit', ['poem' => $poem]) }}" class = "btn btn-sm btn-warning">Edit</a></td>
                            <td>
                                <form action="{{ route('poems.destroy', ['poem' => $poem]) }}" method = "post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <input type = "submit" class = "btn btn-sm btn-danger" value = "Delete">
                                </form>                                
                            </td>
                        </tr>
                    @endforeach                  
                </tbody>
            </table>
        </div>
    </div>
    @else
    <h4 style = "margin-left: 440px; margin-top: 50px;">No Poem Found!</h4>
    @endif
</div>
    
@endsection
