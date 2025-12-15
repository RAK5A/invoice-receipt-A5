<ul class="nav-list secondary-nav">
    @auth
        <li class="nav-item dropdown-container">
            <a href="#" class="nav-link dropdown-toggle">
                <span class="material-symbols-rounded">account_circle</span>
                {{-- <span class="nav-label">{{ Auth::user()->username }}</span> --}}
                <span class="nav-label">{{ auth()->user()->username}}</span>
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
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link dropdown-link" style="width: 100%; text-align: left; border: none; background: none; cursor: pointer;">
                            <span class="material-symbols-rounded">logout</span>Logout
                        </button>
                    </form>
                </li>
            </ul>
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