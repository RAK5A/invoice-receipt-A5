<x-layout title="Users - Invoice System" :navbar="true">
    <div class="page-container">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>System Users</h1>
                <p>Manage user accounts and permissions</p>
            </div>
            <a href="{{ route('users.create') }}" class="btn-primary">
                <span class="material-symbols-rounded">person_add</span>
                Add User
            </a>
        </div>

        <!-- Success/Error Message -->
        @if(session('success'))
            <div class="alert alert-success">
                <span class="material-symbols-rounded">check_circle</span>
                <div>
                    <p>{{ session('success') }}</p>
                </div>
                <button class="alert-close" onclick="this.parentElement.remove()">
                    <span class="material-symbols-rounded">close</span>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <span class="material-symbols-rounded">error</span>
                <div>
                    <p>{{ session('error') }}</p>
                </div>
                <button class="alert-close" onclick="this.parentElement.remove()">
                    <span class="material-symbols-rounded">close</span>
                </button>
            </div>
        @endif

        <!-- Users Table -->
        <div class="card">
            <div class="card-header">
                <h2>All Users</h2>
                <div class="search-box">
                    <span class="material-symbols-rounded">search</span>
                    <input type="text" id="searchInput" placeholder="Search users">
                </div>
            </div>

            <div class="table-responsive">
                @if($users->count() > 0)
                    <table class="data-table" id="usersTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                {{-- <th>Created</th> --}}
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td><strong>#{{ $user->id }}</strong></td>
                                    <td>
                                        <div class="user-info">
                                            <span class="user-avatar">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                                            <div>
                                                <strong>{{ $user->name }}</strong>
                                                @if($user->id === auth()->id())
                                                    <span class="badge-you">You</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone ?? 'N/A' }}</td>
                                    <td>{{ $user->role }}</td>
                                    {{-- <td>{{ $user->created_at->format('M d, Y') }}</td> --}}
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('users.edit', $user->id) }}" class="action-btn edit" title="Edit">
                                                <span class="material-symbols-rounded">edit</span>
                                            </a>
                                            @if($user->id !== auth()->id())
                                                <button type="button" class="action-btn delete"
                                                    onclick="showDeleteModal('{{ route('users.destroy', $user->id) }}', 
                                                    'Delete user &quot;{{ $user->name }}&quot;? All their data will be removed.')"
                                                    title="Delete">
                                                    <span class="material-symbols-rounded">delete</span>
                                                </button>
                                            @else
                                                <button class="action-btn delete" disabled title="Cannot delete yourself"
                                                    style="opacity: 0.5; cursor: not-allowed;">
                                                    <span class="material-symbols-rounded">delete</span>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        {{ $users->links() }}
                    </div>
                @else
                    <div class="empty-state">
                        <span class="material-symbols-rounded">people</span>
                        <p>No users found. Add your first user!</p>
                        <a href="{{ route('users.create') }}" class="btn-primary">Add User</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>
<x-delete-modal></x-delete-modal>