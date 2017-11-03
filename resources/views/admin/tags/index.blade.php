@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="GET">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for tag..." aria-label="Search for tag..." name="search" value="{{ app('request')->input('search') }}">
                <span class="input-group-btn">
                    <button class="btn btn-secondary" type="submit">Go!</button>
                </span>
            </div>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>
                        Tag Name
                    </th>
                    <th>
                        Count
                    </th>
                    <th>
                        Remove
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td>
                            {{ $tag->tag_name }}
                        </td>
                        <td>
                            {{ $tag->questions_count }}
                        </td>
                        <td>
                            <form method="POST" action="{{ route('tags.destroy', $tag) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input class="btn btn-danger" type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $tags->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection