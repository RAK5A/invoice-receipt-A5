<x-layout title="Invoices - Invoice System">
    <div class="page-container">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>Invoices</h1>
                <p>Manage all your invoices, quotes, and receipts</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('invoices.download-csv') }}" class="btn-secondary">
                    <span class="material-symbols-rounded">download</span>
                    Download CSV
                </a>
                <a href="{{ route('invoices.create') }}" class="btn-primary">
                    <span class="material-symbols-rounded">add</span>
                    Create Invoice
                </a>
            </div>
        </div>

        <!-- Messages -->
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

        @if(session('info'))
            <div class="alert alert-info">
                <span class="material-symbols-rounded">info</span>
                <div>
                    <p>{{ session('info') }}</p>
                </div>
                <button class="alert-close" onclick="this.parentElement.remove()">
                    <span class="material-symbols-rounded">close</span>
                </button>
            </div>
        @endif

        <!-- Invoices Table -->
        <div class="card">
            <div class="card-header">
                <h2>All Invoices</h2>
                <div class="search-box">
                    <span class="material-symbols-rounded">search</span>
                    <input type="text" id="searchInput" placeholder="Search invoices..." onkeyup="searchTable()">
                </div>
            </div>

            <div class="table-responsive">
                @if($invoices->count() > 0)
                    <table class="data-table" id="invoicesTable">
                        <thead>
                            <tr>
                                <th>Invoice #</th>
                                <th>Customer</th>
                                <th>Issue Date</th>
                                <th>Due Date</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td><strong>#{{ $invoice->invoice }}</strong></td>
                                    <td>
                                        <div class="customer-cell">
                                            <strong>{{ $invoice->customer->name ?? 'N/A' }}</strong>
                                            <small>{{ $invoice->customer->email ?? '' }}</small>
                                        </div>
                                    </td>
                                    <td>{{ $invoice->invoice_date }}</td>
                                    <td>{{ $invoice->invoice_due_date }}</td>
                                    <td>
                                        <span class="type-badge {{ $invoice->invoice_type }}">
                                            {{ ucfirst($invoice->invoice_type) }}
                                        </span>
                                    </td>
                                    <td><strong>${{ number_format($invoice->total, 2) }}</strong></td>
                                    <td>
                                        <span class="status-badge {{ $invoice->status }}">
                                            {{ ucfirst($invoice->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('invoices.edit', $invoice->id) }}" class="action-btn edit"
                                                title="Edit">
                                                <span class="material-symbols-rounded">edit</span>
                                            </a>
                                            <a href="{{ route('invoices.pdf', $invoice->id) }}" class="action-btn view"
                                                title="View PDF" target="_blank">
                                                <span class="material-symbols-rounded">picture_as_pdf</span>
                                            </a>
                                            <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST"
                                                class="delete-form"
                                                onsubmit="return confirm('Are you sure you want to delete this invoice?')">
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
                        {{ $invoices->links() }}
                    </div>
                @else
                    <div class="empty-state">
                        <span class="material-symbols-rounded">receipt_long</span>
                        <p>No invoices found. Create your first invoice!</p>
                        <a href="{{ route('invoices.create') }}" class="btn-primary">Create Invoice</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>