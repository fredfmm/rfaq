@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('categories.create') }}" class="btn btn-primary" role="button">New Category</a>
        <hr />
        <form method="GET">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for category..." aria-label="Search for category..." name="search" value="{{ app('request')->input('search') }}">
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
                        Category
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            {{ $category->category_name }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $categories->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection