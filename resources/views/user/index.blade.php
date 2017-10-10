@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('user.new') }}" class="btn btn-primary" role="button">New User</a>
        <hr />
        <form method="GET">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for user..." aria-label="Search for user..." name="search" value="{{ app('request')->input('search') }}">
                <span class="input-group-btn">
                    <button class="btn btn-secondary" type="submit">Go!</button>
                </span>
            </div>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Active
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            <a href="{{ route('user.edit', $user) }}">Edit</a>
                        </td>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                            {{ $user->active }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $users->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection