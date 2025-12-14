{{-- <div class="row ms-2 g-2">
    @auth
        <a href="{{ route('profile') }}" role="button" class="btn btn-success col">Profile</a>
        <form action="/logout" method="post" class="col">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    @endauth

    @guest
        <button type="button" class="btn btn-primary">Login</button>
        <a href="/register" role="button" class="btn btn-success">Sign up</button>
    @endguest
</div> --}}

<ul class="nav-list secondary-nav">
    @auth
    {{-- <li class="nav-item">
        <a href="{{ route('profile') }}" class="nav-link">
            <span class="material-symbols-rounded">person</span>
            <span class="nav-label">Profile</span>
        </a>
        <ul class="dropdown-menu">
            <li class="nav-item"><a class="nav-link dropdown-title">Profile</a></li>
        </ul>
    </li> --}}
    <li class="nav-item">
        <form id="logout-form" action="/logout" method="post" style="display: none;">
            @csrf
        </form>
        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span class="material-symbols-rounded">logout</span>
            <span class="nav-label">Sign Out</span>
        </a>
        <ul class="dropdown-menu">
            <li class="nav-item">
                <a class="nav-link dropdown-title" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a>
            </li>
        </ul>
    </li>
    @endauth
</ul>