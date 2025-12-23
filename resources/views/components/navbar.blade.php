<!-- Mobile Sidebar Menu Button -->
<button class="sidebar-menu-button">
    <span class="material-symbols-rounded">menu</span>
</button>

<aside class="sidebar">
    <!-- Sidebar Header -->
    <header class="sidebar-header">
        <a href="{{ route('home') }}" class="header-logo">
            <div class="logo-badge">
                <span class="material-symbols-rounded">receipt_long</span>
            </div>
            <div class="logo-content">
                <div class="logo-text">
                    <span class="logo-primary">Invoice</span>
                    <span class="logo-secondary">System</span>
                </div>
                <p>Dashboard</p>
            </div>
        </a>
        <button class="sidebar-toggler">
            <span class="material-symbols-rounded">chevron_left</span>
        </button>
    </header>

    <nav class="sidebar-nav">
        <!-- Primary Top Nav -->
        <ul class="nav-list primary-nav">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    <span class="material-symbols-rounded">dashboard</span>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>

            <!-- Invoices Dropdown -->
            <li class="nav-item dropdown-container">
                <a href="#" class="nav-link dropdown-toggle">
                    <span class="material-symbols-rounded">receipt</span>
                    <span class="nav-label">Invoices</span>
                    <span class="dropdown-icon material-symbols-rounded">keyboard_arrow_down</span>
                </a>

                <ul class="dropdown-menu">
                    <li class="nav-item"><a class="nav-link dropdown-title">Invoices</a></li>
                    <li class="nav-item">
                        <a href="{{ route('invoices.create') }}" class="nav-link dropdown-link">
                            <span class="material-symbols-rounded">add_notes</span>Create Invoice
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('invoices.index') }}" class="nav-link dropdown-link">
                            <span class="material-symbols-rounded">settings</span>Manage Invoices
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('invoices.download-csv') }}" class="nav-link dropdown-link">
                            <span class="material-symbols-rounded">file_save</span>Download CSV
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Categories Dropdown --}}
            <li class="nav-item dropdown-container">
                <a href="#" class="nav-link dropdown-toggle">
                    <span class="material-symbols-rounded">category</span>
                    <span class="nav-label">Categories</span>
                    <span class="dropdown-icon material-symbols-rounded">keyboard_arrow_down</span>
                </a>

                <ul class="dropdown-menu">
                    <li class="nav-item"><a class="nav-link dropdown-title">Categories</a></li>
                    <li class="nav-item">
                        <a href="{{ route('categories.create') }}" class="nav-link dropdown-link">
                            <span class="material-symbols-rounded">add</span>Add Category
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('categories.index') }}" class="nav-link dropdown-link">
                            <span class="material-symbols-rounded">settings</span>Manage Categories
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Products Dropdown -->
            <li class="nav-item dropdown-container">
                <a href="#" class="nav-link dropdown-toggle">
                    <span class="material-symbols-rounded">box</span>
                    <span class="nav-label">Products</span>
                    <span class="dropdown-icon material-symbols-rounded">keyboard_arrow_down</span>
                </a>

                <ul class="dropdown-menu">
                    <li class="nav-item"><a class="nav-link dropdown-title">Products</a></li>
                    <li class="nav-item">
                        <a href="{{ route('products.create') }}" class="nav-link dropdown-link">
                            <span class="material-symbols-rounded">add_box</span>Add Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}" class="nav-link dropdown-link">
                            <span class="material-symbols-rounded">box_edit</span>Manage Products
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Customers Dropdown -->
            <li class="nav-item dropdown-container">
                <a href="#" class="nav-link dropdown-toggle">
                    <span class="material-symbols-rounded">people</span>
                    <span class="nav-label">Customers</span>
                    <span class="dropdown-icon material-symbols-rounded">keyboard_arrow_down</span>
                </a>

                <ul class="dropdown-menu">
                    <li class="nav-item"><a class="nav-link dropdown-title">Customers</a></li>
                    <li class="nav-item">
                        <a href="{{ route('customers.create') }}" class="nav-link dropdown-link">
                            <span class="material-symbols-rounded">person_add</span>Add Customer
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('customers.index') }}" class="nav-link dropdown-link">
                            <span class="material-symbols-rounded">person_edit</span>Manage Customers
                        </a>
                    </li>
                </ul>
            </li>

            @if (auth()->user()->isAdmin())
                <!-- Users Dropdown -->
                <li class="nav-item dropdown-container">
                    <a href="#" class="nav-link dropdown-toggle">
                        <span class="material-symbols-rounded">admin_panel_settings</span>
                        <span class="nav-label">Users</span>
                        <span class="dropdown-icon material-symbols-rounded">keyboard_arrow_down</span>
                    </a>

                    <ul class="dropdown-menu">
                        <li class="nav-item"><a class="nav-link dropdown-title">System Users</a></li>
                        <li class="nav-item">
                            <a href="{{ route('users.create') }}" class="nav-link dropdown-link">
                                <span class="material-symbols-rounded">person_add</span>Add User
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link dropdown-link">
                                <span class="material-symbols-rounded">manage_accounts</span>Manage Users
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>

        <!-- Secondary Nav (Bottom) -->
        <x-login-status />
    </nav>
</aside>