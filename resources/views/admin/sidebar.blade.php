<nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
    <ul class ="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link{{ url()->current() == route('questions.index') ? " active" : "" }}" href="{{ route('questions.index') }}">Questions</a>
        </li>
        <li class="nav-item">
            <a class="nav-link{{ url()->current() == route('categories.index') ? " active" : "" }}" href="{{ route('categories.index') }}">Categories</a>
        </li>
        <li class="nav-item">
            <a class="nav-link{{ url()->current() == route('users.index') ? " active" : "" }}" href="{{ route('users.index') }}">Users</a>
        </li>
        <li class="nav-item">
            <a class="nav-link{{ url()->current() == route('tags.index') ? " active" : "" }}" href="{{ route('tags.index') }}">Tags</a>
        </li>
    </ul>
</nav>