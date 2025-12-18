<x-layout title="Customers - Invoice System">
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
                    <span class="material-symbols-rounded">search</span>
                    <input type="text" id="searchInput" placeholder="Search customers..." onkeyup="searchTable()">
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
                                <th>Created</th>
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
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->address }}</td>
                                    <td>{{ $customer->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('customers.edit', $customer->id) }}" class="action-btn edit"
                                                title="Edit">
                                                <span class="material-symbols-rounded">edit</span>
                                            </a>
                                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                                                class="delete-form"
                                                onsubmit="return confirm('Are you sure you want to delete this customer?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-btn delete" title="Delete">
                                                    <span class="material-symbols-rounded">delete</span>
                                                </button>
                                            </form>
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

    <script>
        // Search Table Function
        function searchTable() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toUpperCase();
            const table = document.getElementById('customersTable');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                let txtValue = tr[i].textContent || tr[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        }
    </script>
</x-layout>