@section('navbar')
    <nav class="navbar has-background-info-light">
        <div class="navbar-brand">
            <a class="navbar-item" href="{{ url('') }}">
                <span class="has-text-weight-bold">User Management</span>
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div class="navbar-menu">
            <div class="navbar-end">
                <a class="navbar-item" href="{{ url('logout', []) }}">
                    Logout
                </a>
            </div>
        </div>
    </nav>
@endsection
