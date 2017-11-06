@extends('layouts.app')

@section('content')
    <h1 class="display-3 text-center">rFAQ</h1>
    <form method="GET">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for question..." aria-label="Search for question..." name="search" value="{{ app('request')->input('search') }}">
            <select id="category_id" class="form-control custom-select" name="category_id">
                <option value="">Select an Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ app('request')->input('category_id') == $category->id ? "selected" : ""}}>{{ $category->category_name }}</option>
                @endforeach
            </select>
            <span class="input-group-btn">
                <button class="btn btn-secondary" type="submit">Go!</button>
            </span>
        </div>
    </form>
    <hr />
    <h2 class="text-center">Top tags</h2>
    <div class="row">
        @foreach ($tags as $tag)
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $tag->tag_name }}</h4>
                        <h6 class="card-subtitle mb-2 text-muted">Count: {{ $tag->questions_count }}</h6>
                        <a href="#" class="btn btn-primary">Questions</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <br />
    <hr />
    <br />

    <h2 class="text-center">Questions and Answers</h2>
    @foreach ($questions as $question)
        <div class="card">
            <div class="card-header">
                {{ $question->category->category_name}}
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                <p>Q: {{ $question->question_text }}</p>
                <footer class="blockquote-footer">A: {{ $question->answer->answer_text }}</footer>
                </blockquote>
                @if ($question->tags->count() > 0)
                    <br />
                    Tags:
                @endif
                @foreach ($question->tags as $tag)
                    <a href="#" class="card-link">{{$tag->tag_name}}</a> {{$loop->last ? "" : ", "}}
                @endforeach
            </div>
        </div>
        <hr />
    @endforeach

    <div class="d-flex justify-content-center">
        {{ $questions->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection

