@extends('layouts.admin.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12 text-center">
			<h4>All Users</h4>
		</div>
	</div>
    <div class = "row justify-content-center">
        <div class = "col-md-12">
            <table class = "table table-sm table-default">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <form action = "{{ route('all_users.destroy', ['user' => $user]) }}" method = "post">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <input type = "submit" name = "submit" value = "Delete" class = "btn btn-sm btn-danger">
                                </form>                            
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
</div>

@endsection
