@extends('layouts.app')

@section('content')
    @if (url()->current() == route('user.new'))
        <h1 class="text-center">Creating a new user</h1>
    @elseif (url()->current() == route('user.edit', $user))
        <h1 class="text-center">Editing user <strong>{{ $user->name }}</strong></h1>
    @endif
    
    <form method="POST" action="{{ url()->current() == route('user.new') ? route('user.save') : route('user.update', $user) }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="userName">Name</label>
            <input type="name" name="name" class="form-control" id="userName" placeholder="Enter user's name" value="{{ $user->exists ? $user->name : old('name') }}">
        </div>
        <div class="form-group">
            <label for="inputEmail">Email address</label>
            <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Enter user's email" value="{{ $user->exists ? $user->email : old('email') }}">
        </div>
        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="inputPasswordConfirmation">Password Confirmation</label>
            <input type="password" name="password_confirmation" class="form-control" id="inputPasswordConfirmation" placeholder="Password Confirmation">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Save</button>
            <a class="btn btn-light" href="{{ (url()->previous() == url()->current()) ? route('users') : url()->previous() }}" role="button">Cancel</a>
        </div>
    </form>
@endsection