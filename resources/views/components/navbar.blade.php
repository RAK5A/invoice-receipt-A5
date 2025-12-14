<!-- Mobile Sidebar Menu Button -->
<button class="sidebar-menu-button">
    <span class="material-symbols-rounded">menu</span>
</button>

<aside class="sidebar">
    <!-- Sidebar Header -->
    <header class="sidebar-header">
        {{-- <a href="{{ route('profile') }}" class="header-logo"> --}}
            <a href="#" class="header-logo">
                <img src="{{ asset('images/logo.png') }}" alt="" />
            </a>
            <button class="sidebar-toggler">
                <span class="material-symbols-rounded">chevron_left</span>
            </button>
    </header>

    <nav class="sidebar-nav">
        <!-- Primary Top Nav -->
        <ul class="nav-list primary-nav">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <span class="material-symbols-rounded">dashboard</span>
                    <span class="nav-label">Dashboard</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-item"><a class="nav-link dropdown-title">Dashboard</a></li>
                </ul>
            </li>

            <!-- Dropdown -->
            <li class="nav-item dropdown-container">
                <a href="#" class="nav-link dropdown-toggle">
                    <span class="material-symbols-rounded">receipt</span>
                    <span class="nav-label">Invoices</span>
                    <span class="dropdown-icon material-symbols-rounded">keyboard_arrow_down</span>
                </a>

                <!-- Dropdown Menu -->
                <ul class="dropdown-menu">
                    <li class="nav-item"><a class="nav-link dropdown-title">Invoices</a></li>
                    <li class="nav-item"><a href="#" class="nav-link dropdown-link"><span
                                class="material-symbols-rounded">add_notes</span>Create Invoices</a></li>
                    <li class="nav-item"><a href="#" class="nav-link dropdown-link"><span
                                class="material-symbols-rounded">settings</span>Manage Invoice</a></li>
                    <li class="nav-item"><a href="#" class="nav-link dropdown-link"><span
                                class="material-symbols-rounded">file_save</span>Download CSV</a></li>
                </ul>
            </li>

            <!-- Dropdown -->
            <li class="nav-item dropdown-container">
                <a href="#" class="nav-link dropdown-toggle">
                    <span class="material-symbols-rounded">box</span>
                    <span class="nav-label">Products</span>
                    <span class="dropdown-icon material-symbols-rounded">keyboard_arrow_down</span>
                </a>
                
                <!-- Dropdown Menu -->
                <ul class="dropdown-menu">
                    <li class="nav-item"><a class="nav-link dropdown-title">Products</a></li>
                    <li class="nav-item"><a href="{{ route('products.create') }}" class="nav-link dropdown-link"><span class="material-symbols-rounded">add_box</span>Add Products</a></li>
                    <li class="nav-item"><a href="{{ route('products.index') }}" class="nav-link dropdown-link"><span class="material-symbols-rounded">settings</span>Manage Products</a></li>
                </ul>
            </li>
            
            <!-- Dropdown -->
            <li class="nav-item dropdown-container">
                <a href="#" class="nav-link dropdown-toggle">
                    <span class="material-symbols-rounded">people</span>
                    <span class="nav-label">Customers</span>
                    <span class="dropdown-icon material-symbols-rounded">keyboard_arrow_down</span>
                </a>

                <!-- Dropdown Menu -->
                <ul class="dropdown-menu">
                    <li class="nav-item"><a class="nav-link dropdown-title">Customers</a></li>
                    <li class="nav-item"><a href="#" class="nav-link dropdown-link"><span class="material-symbols-rounded">person_add</span>Add Customers</a></li>
                    <li class="nav-item"><a href="#" class="nav-link dropdown-link"><span class="material-symbols-rounded">person_edit</span>Manage Customers</a></li>
                </ul>
            </li>
        </ul>
        <x-login-status></x-login-status>
    </nav>
</aside>



{{-- <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">Invoice System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Customers
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Create Customer</a></li>
                            <li><a class="dropdown-item" href="#">View Customers</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Invoices
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Create Invoices</a></li>
                            <li><a class="dropdown-item" href="#">View Invoices</a></li>
                        </ul>
                    </li>
                </ul>
                <x-login-status></x-login-status>
            </div>
        </div>
    </nav>
</header> --}}



{{-- <aside class="w-64 bg-slate-800 text-white min-h-screen p-4 flex flex-col">
    <h2 class="text-2xl font-bold mb-8 border-b border-slate-700 pb-2">InvoiceSys</h2>
    <nav class="flex-1 space-y-2">
        <a href="{{ route('dashboard') }}" class="block p-2 hover:bg-slate-700 rounded">Dashboard</a>
        <a href="{{ route('customers.index') }}" class="block p-2 hover:bg-slate-700 rounded">Customers</a>
        <a href="{{ route('invoices.index') }}" class="block p-2 hover:bg-slate-700 rounded">Invoices</a>
    </nav>
    <form method="POST" action="{{ route('logout') }}" class="mt-auto">
        @csrf
        <button class="w-full text-left p-2 text-red-400 hover:bg-slate-700 rounded">Logout</button>
    </form>
</aside> --}}

{{-- <aside class="w-64 bg-slate-900 text-white min-h-screen flex flex-col shadow-xl">
    <div class="p-6">
        <h2 class="text-xl font-bold tracking-widest uppercase">Invoice Manager</h2>
    </div>

    <nav class="flex-1 px-4 space-y-2">
        <a href="{{ route('dashboard') }}"
            class="flex items-center p-3 rounded hover:bg-slate-800 {{ request()->routeIs('dashboard') ? 'bg-slate-800' : '' }}">
            <span>Dashboard</span>
        </a>
        <a href="{{ route('customers.index') }}"
            class="flex items-center p-3 rounded hover:bg-slate-800 {{ request()->routeIs('customers.*') ? 'bg-slate-800' : '' }}">
            <span>Customers</span>
        </a>
        <a href="{{ route('invoices.index') }}"
            class="flex items-center p-3 rounded hover:bg-slate-800 {{ request()->routeIs('invoices.*') ? 'bg-slate-800' : '' }}">
            <span>Invoices</span>
        </a>
    </nav>

    @auth
    <div class="p-4 border-t border-slate-800">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left p-2 text-sm text-red-400 hover:text-red-300">
                Log Out ({{ auth()->user()->name }})
            </button>
        </form>
    </div>
    @endauth
</aside> --}}