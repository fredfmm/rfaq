<nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
    <ul class ="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link{{ url()->current() == route('questions.index') ? " active" : "" }}" href="{{ route('questions.index') }}">Questions</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#">Categories</a>
        </li>
        <li class="nav-item">
            <a class="nav-link{{ url()->current() == route('users.index') ? " active" : "" }}" href="{{ route('users.index') }}">Users</a>
        </li>
    </ul>
</nav>