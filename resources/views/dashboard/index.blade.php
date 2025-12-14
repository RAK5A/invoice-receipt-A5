<x-layout title="Dashboard" :navbar="true">
    <div class="dashboard-container">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1>Dashboard</h1>
            {{-- <p>Welcome back, {{ Auth::user()->name }}! Here's what's happening with your invoices today.</p> --}}
            <p>Welcome back, ! Here's what's happening with your invoices today.</p>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <!-- Sales Amount -->
            <div class="stat-card green">
                <div class="stat-header">
                    <div class="stat-content">
                        <h3>Sales Amount</h3>
                        <div class="stat-value">${{ number_format($salesAmount, 2) }}</div>
                        <p class="stat-label">Total Revenue</p>
                    </div>
                    <div class="stat-icon">
                        <span class="material-symbols-rounded">payments</span>
                    </div>
                </div>
            </div>

            <!-- Total Invoices -->
            <div class="stat-card purple">
                <div class="stat-header">
                    <div class="stat-content">
                        <h3>Total Invoices</h3>
                        <div class="stat-value">{{ $totalInvoices }}</div>
                        <p class="stat-label">All Time</p>
                    </div>
                    <div class="stat-icon">
                        <span class="material-symbols-rounded">receipt_long</span>
                    </div>
                </div>
            </div>

            <!-- Pending Bills -->
            <div class="stat-card yellow">
                <div class="stat-header">
                    <div class="stat-content">
                        <h3>Pending Bills</h3>
                        <div class="stat-value">{{ $pendingBills }}</div>
                        <p class="stat-label">Awaiting Payment</p>
                    </div>
                    <div class="stat-icon">
                        <span class="material-symbols-rounded">pending</span>
                    </div>
                </div>
            </div>

            <!-- Due Amount -->
            <div class="stat-card red">
                <div class="stat-header">
                    <div class="stat-content">
                        <h3>Due Amount</h3>
                        <div class="stat-value">${{ number_format($dueAmount, 2) }}</div>
                        <p class="stat-label">Outstanding</p>
                    </div>
                    <div class="stat-icon">
                        <span class="material-symbols-rounded">warning</span>
                    </div>
                </div>
            </div>

            <!-- Total Products -->
            <div class="stat-card blue">
                <div class="stat-header">
                    <div class="stat-content">
                        <h3>Total Products</h3>
                        <div class="stat-value">{{ $totalProducts }}</div>
                        <p class="stat-label">In Inventory</p>
                    </div>
                    <div class="stat-icon">
                        <span class="material-symbols-rounded">inventory_2</span>
                    </div>
                </div>
            </div>

            <!-- Total Customers -->
            <div class="stat-card indigo">
                <div class="stat-header">
                    <div class="stat-content">
                        <h3>Total Customers</h3>
                        <div class="stat-value">{{ $totalCustomers }}</div>
                        <p class="stat-label">Active Clients</p>
                    </div>
                    <div class="stat-icon">
                        <span class="material-symbols-rounded">groups</span>
                    </div>
                </div>
            </div>

            <!-- Paid Bills -->
            <div class="stat-card teal">
                <div class="stat-header">
                    <div class="stat-content">
                        <h3>Paid Bills</h3>
                        <div class="stat-value">{{ $paidBills }}</div>
                        <p class="stat-label">Completed</p>
                    </div>
                    <div class="stat-icon">
                        <span class="material-symbols-rounded">check_circle</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Invoices -->
        <div class="recent-activity">
            <div class="section-header">
                <h2>Recent Invoices</h2>
                <a href="{{ route('invoices.index') }}" class="view-all-btn">
                    View All
                    <span class="material-symbols-rounded">arrow_forward</span>
                </a>
            </div>

            @if($recentInvoices->count() > 0)
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Invoice #</th>
                            <th>Customer</th>
                            <th>Issue Date</th>
                            <th>Due Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentInvoices as $invoice)
                        <tr>
                            <td><strong>{{ $invoice->invoice }}</strong></td>
                            <td>{{ $invoice->customer->name ?? 'N/A' }}</td>
                            <td>{{ $invoice->invoice_date }}</td>
                            <td>{{ $invoice->invoice_due_date }}</td>
                            <td>${{ number_format($invoice->total, 2) }}</td>
                            <td>
                                <span class="status-badge {{ $invoice->status }}">
                                    {{ ucfirst($invoice->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('invoices.edit', $invoice->id) }}" class="action-btn" title="Edit">
                                    <span class="material-symbols-rounded">edit</span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <span class="material-symbols-rounded">receipt</span>
                    <p>No invoices yet. Create your first invoice!</p>
                    <a href="{{ route('invoices.create') }}" class="btn-primary">Create Invoice</a>
                </div>
            @endif
        </div>
    </div>
</x-layout>