<ul class="nav-list secondary-nav">
    @auth
        <li class="nav-item dropdown-container">
            <a href="#" class="nav-link dropdown-toggle">
                <span class="material-symbols-rounded">account_circle</span>
                <span class="nav-label">{{ auth()->user()->username }}</span>
                <span class="dropdown-icon material-symbols-rounded">keyboard_arrow_down</span>
            </a>
            <ul class="dropdown-menu">
                <li class="nav-item"><a class="nav-link dropdown-title">Account</a></li>
                <li class="nav-item">
                    <a href="{{ route('profile.show') }}" class="nav-link dropdown-link">
                        <span class="material-symbols-rounded">person</span>Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link dropdown-link">
                        <span class="material-symbols-rounded">settings</span>Settings
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <a href="#" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">
                    <span class="material-symbols-rounded">logout</span>
                    <span class="nav-label">Sign Out</span>
                </a>
            </form>
            <ul class="dropdown-menu">
                <li class="nav-item"><a class="nav-link dropdown-title">Sign Out</a></li>
            </ul>
        </li>
    @else
        <li class="nav-item">
            <a href="{{ route('login') }}" class="nav-link">
                <span class="material-symbols-rounded">login</span>
                <span class="nav-label">Login</span>
            </a>
            <ul class="dropdown-menu">
                <li class="nav-item"><a class="nav-link dropdown-title">Login</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="{{ route('register') }}" class="nav-link">
                <span class="material-symbols-rounded">person_add</span>
                <span class="nav-label">Register</span>
            </a>
            <ul class="dropdown-menu">
                <li class="nav-item"><a class="nav-link dropdown-title">Register</a></li>
            </ul>
        </li>
    @endauth
</ul>