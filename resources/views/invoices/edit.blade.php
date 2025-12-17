<x-layout title="Update Invoice - Invoice System">
    <div class="page-container">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>Update Invoice</h1>
                <p>Generate a new invoice, quote, or receipt</p>
            </div>
            <a href="{{ route('invoices.index') }}" class="btn-secondary">
                <span class="material-symbols-rounded">arrow_back</span>
                Back to Invoices
            </a>
        </div>

        <!-- Invoice Form -->
        <form action="{{ route('invoices.store') }}" method="POST" id="invoiceForm">
            @csrf

            <!-- Invoice Header Card -->
            <div class="invoice-header-card">
                <div class="invoice-header-grid">
                    <!-- Invoice Type -->
                    <div class="form-group">
                        <label for="invoice_type">
                            <span class="material-symbols-rounded">description</span>
                            Type
                        </label>
                        <select id="invoice_type" name="invoice_type" class="form-control" required>
                            <option value="invoice" selected>Invoice</option>
                            <option value="quote">Quote</option>
                            <option value="receipt">Receipt</option>
                        </select>
                    </div>

                    <!-- Invoice Status -->
                    <div class="form-group">
                        <label for="invoice_status">
                            <span class="material-symbols-rounded">flag</span>
                            Status
                        </label>
                        <select id="invoice_status" name="invoice_status" class="form-control" required>
                            <option value="open" selected>Open</option>
                            <option value="paid">Paid</option>
                        </select>
                    </div>

                    <!-- Invoice Number -->
                    <div class="form-group">
                        <label for="invoice_number">
                            <span class="material-symbols-rounded">tag</span>
                            Invoice Number
                        </label>
                        <input type="text" id="invoice_number" name="invoice_number" class="form-control"
                            value="{{ $invoice->invoice }}" required readonly>
                    </div>

                    <!-- Invoice Date -->
                    <div class="form-group">
                        <label for="invoice_date">
                            <span class="material-symbols-rounded">calendar_today</span>
                            Invoice Date
                        </label>
                        <input type="date" id="invoice_date" name="invoice_date" class="form-control"
                            value="{{ date('Y-m-d') }}" required>
                    </div>

                    <!-- Due Date -->
                    <div class="form-group">
                        <label for="invoice_due_date">
                            <span class="material-symbols-rounded">event</span>
                            Due Date
                        </label>
                        <input type="date" id="invoice_due_date" name="invoice_due_date" class="form-control"
                            value="{{ date('Y-m-d', strtotime('+1 week')) }}" required>
                    </div>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="form-card">
                <div class="section-header-form">
                    <span class="material-symbols-rounded">person</span>
                    <h3>Customer Information</h3>
                    <button type="button" class="btn-link" onclick="showCustomerModal()">
                        <span class="material-symbols-rounded">search</span>
                        Select Existing Customer
                    </button>
                </div>

                <div class="form-grid">
                    {{-- @foreach($invoice->customer as $customer) --}}
                    <div class="form-group">
                        <label for="customer_name">Name <span class="required">*</span></label>
                        <input type="text" id="customer_name" name="customer_name" class="form-control" required>
                        {{-- <input type="hidden" id="customer_id" name="customer_id" value="{{ $invoice->customer_id }}"> --}}
                    </div>

                    <div class="form-group">
                        <label for="customer_email">Email </label>
                        <input type="email" id="customer_email" name="customer_email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="customer_phone">Phone <span class="required">*</span></label>
                        <input type="tel" id="customer_phone" name="customer_phone" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="customer_address">Address</label>
                        <input type="text" id="customer_address" name="customer_address" class="form-control">
                    </div>
                </div>
                {{-- @endforeach --}}
            </div>

            <!-- Invoice Items -->
            <div class="form-card">
                <div class="section-header-form">
                    <span class="material-symbols-rounded">shopping_cart</span>
                    <h3>Invoice Items</h3>
                    <button type="button" class="btn-primary-sm" onclick="addInvoiceRow()">
                        <span class="material-symbols-rounded">add</span>
                        Add Item
                    </button>
                </div>

                <div class="invoice-items-table">
                    <table class="items-table" id="itemsTable">
                        <thead>
                            <tr>
                                <th style="width: 35%;">Product/Service</th>
                                <th style="width: 10%;">Qty</th>
                                <th style="width: 15%;">Price</th>
                                <th style="width: 15%;">Discount</th>
                                <th style="width: 15%;">Subtotal</th>
                                <th style="width: 10%;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="itemsTableBody">
                            @foreach($invoice->items as $index => $item)
                                <tr class="item-row">
                                    <td>
                                        <input type="text" name="products[{{ $index }}][name]"
                                            class="form-control item-name" value="{{ $item->product }}" required>
                                    </td>
                                    <td>
                                        <input type="number" name="products[{{ $index }}][qty]"
                                            class="form-control item-qty" value="{{ $item->qty }}" min="1" required
                                            onchange="calculateRow(this)">
                                    </td>
                                    <td>
                                        <input type="number" name="products[{{ $index }}][price]"
                                            class="form-control item-price" value="{{ $item->price }}" step="0.01" min="0"
                                            required onchange="calculateRow(this)">
                                    </td>
                                    <td>
                                        <input type="text" name="products[{{ $index }}][discount]"
                                            class="form-control item-discount" value="{{ $item->discount }}"
                                            placeholder="0 or 10%" onchange="calculateRow(this)">
                                    </td>
                                    <td>
                                        <input type="number" name="products[{{ $index }}][subtotal]"
                                            class="form-control item-subtotal" value="{{ $item->subtotal }}" step="0.01"
                                            readonly>
                                    </td>
                                    <td>
                                        <button type="button" class="action-btn delete-sm" onclick="removeInvoiceRow(this)"
                                            title="Remove">
                                            <span class="material-symbols-rounded">close</span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Invoice Totals -->
            <div class="invoice-totals-card">
                <div class="totals-left">
                    <div class="form-group">
                        <label for="notes">Additional Notes</label>
                        <textarea id="notes" name="notes" class="form-control" rows="4"
                            placeholder="Any special instructions or notes...">{{ $invoice->notes }}</textarea>
                    </div>
                </div>

                <div class="totals-right">
                    <div class="total-row">
                        <label>Subtotal:</label>
                        <input type="number" id="subtotal" name="subtotal" class="total-input"
                            value="{{ $invoice->subtotal }}" step="0.01" readonly>
                    </div>

                    <div class="total-row">
                        <label>Discount:</label>
                        <input type="number" id="discount" name="discount" class="total-input"
                            value="{{ $invoice->discount }}" step="0.01" readonly>
                    </div>

                    <div class="total-row">
                        <label>TAX/VAT (5%):</label>
                        <input type="number" id="vat" name="vat" class="total-input" value="{{ $invoice->vat }}"
                            step="0.01" readonly>
                    </div>

                    <div class="total-row grand-total">
                        <label>Total:</label>
                        <input type="number" id="total" name="total" class="total-input" value="{{ $invoice->total }}"
                            step="0.01" readonly>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ route('invoices.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-submit">
                    <span class="material-symbols-rounded">save</span>
                    Create Invoice
                </button>
            </div>
        </form>
    </div>

    <!-- Customer Selection Modal -->
    <div id="customerModal" class="modal" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Select Customer</h3>
                <button type="button" class="modal-close" onclick="closeCustomerModal()">
                    <span class="material-symbols-rounded">close</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="search-box" style="margin-bottom: 20px;">
                    <span class="material-symbols-rounded">search</span>
                    <input type="text" id="customerSearch" placeholder="Search customers..."
                        onkeyup="filterCustomers()">
                </div>

                <table class="data-table" id="customerSelectTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                            <tr class="customer-row">
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>
                                    <button type="button" class="btn-primary-sm" onclick='selectCustomer(@json($customer))'>
                                        Select
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>