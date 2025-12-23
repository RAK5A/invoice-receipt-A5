<x-layout title="Customers - Invoice System" :navbar="true">
    <div class="page-container">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>Customers</h1>
                <p>Manage your customer database</p>
            </div>
            <a href="{{ route('customers.create') }}" class="btn-primary">
                <span class="material-symbols-rounded">person_add</span>
                Add Customer
            </a>
        </div>

        <!-- Success Message -->
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

        <!-- Customers Table -->
        <div class="card">
            <div class="card-header">
                <h2>All Customers</h2>
                <div class="search-box">
                    <span class="material-symbols-rounded">person_search</span>
                    <input type="text" id="searchInput" placeholder="Search customers">
                </div>
            </div>

            <div class="table-responsive">
                @if($customers->count() > 0)
                    <table class="data-table" id="customersTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                {{-- <th>Created</th> --}}
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td><strong>#{{ $customer->id }}</strong></td>
                                    <td>
                                        <div class="customer-info">
                                            <span class="customer-avatar">{{ strtoupper(substr($customer->name, 0, 2)) }}</span>
                                            <strong>{{ $customer->name }}</strong>
                                        </div>
                                    </td>
                                    <td>{{ $customer->email ?: 'N/A'}}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->address ?: 'N/A' }}</td>
                                    {{-- <td>{{ $customer->created_at->format('M d, Y') }}</td> --}}
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('customers.edit', $customer->id) }}" class="action-btn edit"
                                                title="Edit">
                                                <span class="material-symbols-rounded">edit</span>
                                            </a>
                                            <button type="button" class="action-btn delete"
                                                onclick="showDeleteModal('{{ route('customers.destroy', $customer->id) }}', 
                                                'Are you sure you want to delete the customer &quot;{{ $customer->name }}&quot;? This action cannot be undone.')"
                                                title="Delete">
                                                <span class="material-symbols-rounded">delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        {{ $customers->links() }}
                    </div>
                @else
                    <div class="empty-state">
                        <span class="material-symbols-rounded">people</span>
                        <p>No customers found. Add your first customer!</p>
                        <a href="{{ route('customers.create') }}" class="btn-primary">Add Customer</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>
<x-delete-modal />