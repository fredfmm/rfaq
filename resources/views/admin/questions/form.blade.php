@extends('layouts.app')

@section('content')
    @if (url()->current() == route('questions.create'))
        <h1 class="text-center">Creating a question</h1>
    @elseif (url()->current() == route('questions.edit', $question))
        <h1 class="text-center">Editing question <strong>{{ $question->id }}</strong></h1>
    @endif
    
    <form method="POST" action="{{ url()->current() === route('questions.create') ? route('questions.store') : route('questions.update', $question) }}">
        {{ csrf_field() }}
        @if (url()->current() !== route('questions.create'))
            {{ method_field('PUT') }}
        @endif
        <div class="form-group">
            <label for="category_id">Categories</label>
            <select id="category_id" class="form-control custom-select" name="category_id">
                <option value="">Select an Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ isset($question) && ($question->category_id === $category->id) ? "selected" : ""}}>{{ $category->category_name }}</option>
                @endforeach
            </select>
            <hr />
            <label for="tags">Tags</label>
            <input type="text" name="tags" class="form-control" id="tags" placeholder="Enter tags" value="{{ isset($question) ? implode(', ', $question->tags->pluck('tag_name')->all()) : old('tags') }}">
            <hr />
            <label for="question_text">Question</label>
            <textarea name="question_text" id="question_text" class="form-control" rows="5">{{ isset($question) ? $question->question_text : old('question_text') }}</textarea>
            <hr />
            <label for="answer_text">Answer</label>
            <textarea name="answer_text" id="answer_text" class="form-control" rows="5">{{ isset($question) ? $question->answer->answer_text : old('answer_text') }}</textarea>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Save</button>
            @if (isset($question))
                <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-question').submit();">Delete</button>
            @endif
            <a class="btn btn-light" href="{{ route('questions.index') }}" role="button">Cancel</a>
        </div>
    </form>

    @if (isset($question))
        <form id="delete-question" method="POST" action="{{ route('questions.destroy', $question) }}" style="display: none;">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
        </form>
    @endif
@endsection