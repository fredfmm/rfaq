@extends('layouts.app')

@section('content')
    @if (url()->current() == route('users.create'))
        <h1 class="text-center">Creating a new user</h1>
    @elseif (url()->current() == route('users.edit', $user))
        <h1 class="text-center">Editing user <strong>{{ $user->name }}</strong></h1>
    @endif
    
    <form method="POST" action="{{ url()->current() === route('users.create') ? route('users.store') : route('users.update', $user) }}">
        {{ csrf_field() }}
        @if(url()->current() !== route('users.create'))
            {{ method_field('PUT') }}
        @endif
        <div class="form-group">
            <label for="userName">Name</label>
            <input type="text" name="name" class="form-control" id="userName" placeholder="Enter user's name" value="{{ isset($user) ? $user->name : old('name') }}">
        </div>
        <div class="form-group">
            <label for="inputEmail">Email address</label>
            <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Enter user's email" value="{{ isset($user) ? $user->email : old('email') }}">
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
            <a class="btn btn-light" href="{{ route('users.index') }}" role="button">Cancel</a>
        </div>
    </form>
@endsection