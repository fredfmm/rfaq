@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('questions.create') }}" class="btn btn-primary" role="button">New Question</a>
        <hr />
        <form method="GET">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for question..." aria-label="Search for question..." name="search" value="{{ app('request')->input('search') }}">
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
                        ID
                    </th>
                    <th>
                        Category
                    </th>
                    <th>
                        Question
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($questions as $question)
                    <tr>
                        <td>
                            <a href="{{ route('questions.edit', $question) }}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            {{ $question->id }}
                        </td>
                        <td>
                            {{ $question->category->category_name }}
                        </td>
                        <td>
                            {{ $question->question_text }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $questions->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection