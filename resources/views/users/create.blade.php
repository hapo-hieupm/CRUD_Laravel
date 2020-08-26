@extends('layout')

@section('main')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Add a users</h1>
        <div>
            <form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
            @csrf
                <div class="form-group">    
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"/>
                        @if($errors->has('name'))
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        @endif
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}"/>
                        @if($errors->has('email'))
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                        @endif
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                        @if($errors->has('address'))
                            <small class="text-danger">{{ $errors->first('address') }}</small>
                        @endif
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="tel" class="form-control" name="phone" value="{{ old('phone') }}">
                        @if($errors->has('phone'))
                            <small class="text-danger">{{ $errors->first('phone') }}</small>
                        @endif
                </div>
                <div class="form-group">
                    <label for="birthday">Birthday:</label>
                    <input type="date" class="form-control" name="birthday" value="{{ old('birthday') }}">
                        @if($errors->has('birthday'))
                            <small class="text-danger">{{ $errors->first('birthday') }}</small>
                        @endif
                </div>
                 <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="text" class="form-control" name="password" value="{{ old('password') }}">
                        @if($errors->has('password'))
                            <small class="text-danger">{{ $errors->first('password') }}</small>
                        @endif
                </div>
                <div class="form-group">
                    <th>Gender</th>
                    <td>
                        <input class="form-check-input ml-1" type="radio" name="gender" id="0" 
                            value="0" {{ old('gender')  ==  App\User::getGender('Male') ? 'checked' : '' }}>
                        <label for="0" class="ml-4">Male</label>
                        <input class="form-check-input ml-4" type="radio" name="gender" id="1" 
                            value="1" {{ old('gender')  ==  App\User::getGender('Female') ? 'checked' : '' }}>
                        <label for="1" class="ml-5">Female</label>
                            @if($errors->has('gender'))
                                <br>
                                <small class="text-danger">{{ $errors->first('gender') }}</small>
                            @endif  
                    </td>      
                </div>
                <div class="form-group">
                    <th>Avatar</th>
                    <td>
                        <input type="file" class="form-control-file border" id="ava" name="ava" value="{{ old('ava') }}">
                            @if($errors->has('ava'))
                                <br>
                                <small class="text-danger">{{ $errors->first('ava') }}</small>
                            @endif
                    </td>
                </div>    
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div><br/>
                @endif
                <button type="submit" class="btn btn-primary">Add users</button>
            </form>
        </div>
    </div>
</div>
@endsection
