@extends('layout')

@section('main')
    <div class="col-sm-12">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}  
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-3">Users</h1> 
            <div>
                <a href="{{ route('users.create')}}" class="btn btn-primary ml-3">New user</a>
            </div>   
            <table class="table table-striped mt-5">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Avatar</td>
                        <td>Email</td>
                        <td>Gender</td>
                        <td>Address</td>
                        <td>Phone</td>
                        <td>Birthday</td>
                        <td class="text-center" colspan = 2>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            <img src="{{ ($user->ava == null) ? asset('/storage/images/94603142_259349975245733_684610330919174144_o.jpg') : asset('/storage/images/' . $user->ava) }}"  alt="" class="w-25">
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->gender_value }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->birthday }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id)}}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('users.destroy', $user->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>  
@endsection
