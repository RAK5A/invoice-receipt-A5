<ul class="nav-list secondary-nav">
    @auth
        <li class="nav-item">
            <a href="{{ route('profile.show') }}" class="nav-link">
                <span class="material-symbols-rounded">person</span>
                <span class="nav-label">{{ auth()->user()->username}}</span>
            </a>
            <ul class="dropdown-menu">
                <li class="nav-item"><a class="nav-link dropdown-title">Profile</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="nav-link logout-btn">
                    <span class="material-symbols-rounded">logout</span>
                    <span class="nav-label">Sign Out</span>
                </button>
            </form>
        </li>
    @else
        <li class="nav-item">
            <a href="{{ route('login') }}" class="nav-link">
                <span class="material-symbols-rounded">login</span>
                <span class="nav-label">Login</span>
            </a>
        </li>
    @endauth
</ul>