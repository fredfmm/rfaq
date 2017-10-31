@extends('layouts.app')

@section('content')
    @if (url()->current() == route('categories.create'))
        <h1 class="text-center">Creating a category</h1>
    @elseif (url()->current() == route('categories.edit', $category))
        <h1 class="text-center">Editing category <strong>{{ $category->category_name }}</strong></h1>
    @endif
    
    <form method="POST" action="{{ url()->current() === route('categories.create') ? route('categories.store') : route('categories.update', $category) }}">
        {{ csrf_field() }}
        @if (url()->current() !== route('categories.create'))
            {{ method_field('PUT') }}
        @endif
        <div class="form-group">
            <label for="category_name">Category</label>
            <input type="text" name="category_name" class="form-control" id="category_name" placeholder="Enter category name" value="{{ isset($category) ? $category->category_name : old('category') }}">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Save</button>
            @if (isset($category))
                <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-category').submit();">Delete</button>
            @endif
            <a class="btn btn-light" href="{{ route('categories.index') }}" role="button">Cancel</a>
        </div>
    </form>

    @if (isset($category))
        <form id="delete-category" method="POST" action="{{ route('categories.destroy', $category) }}" style="display: none;">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
        </form>
    @endif
@endsection