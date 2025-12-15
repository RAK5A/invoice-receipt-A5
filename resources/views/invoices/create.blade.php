<x-layout title="Create Invoice - Invoice System">
    <div class="page-container">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>Create New Invoice</h1>
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
                            value="{{ $nextInvoiceNumber }}" required readonly>
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
                            value="{{ date('Y-m-d', strtotime('+30 days')) }}" required>
                    </div>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="form-card">
                <div class="section-header-form">
                    <span class="material-symbols-rounded">person</span>
                    <h3>Billing Information</h3>
                    <button type="button" class="btn-link" onclick="showCustomerModal()">
                        <span class="material-symbols-rounded">search</span>
                        Select Existing Customer
                    </button>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="customer_name">Name <span class="required">*</span></label>
                        <input type="text" id="customer_name" name="customer_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="customer_email">Email <span class="required">*</span></label>
                        <input type="email" id="customer_email" name="customer_email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="customer_phone">Phone <span class="required">*</span></label>
                        <input type="tel" id="customer_phone" name="customer_phone" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="customer_county">Country <span class="required">*</span></label>
                        <input type="text" id="customer_county" name="customer_county" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="customer_address_1">Address Line 1 <span class="required">*</span></label>
                        <input type="text" id="customer_address_1" name="customer_address_1" class="form-control"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="customer_address_2">Address Line 2</label>
                        <input type="text" id="customer_address_2" name="customer_address_2" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="customer_town">Town/City <span class="required">*</span></label>
                        <input type="text" id="customer_town" name="customer_town" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="customer_postcode">Postcode <span class="required">*</span></label>
                        <input type="text" id="customer_postcode" name="customer_postcode" class="form-control"
                            required>
                    </div>
                </div>
            </div>

            <!-- Shipping Information -->
            <div class="form-card">
                <div class="section-header-form">
                    <span class="material-symbols-rounded">local_shipping</span>
                    <h3>Shipping Information</h3>
                    <button type="button" class="btn-link" onclick="copyBillingToShipping()">
                        <span class="material-symbols-rounded">content_copy</span>
                        Copy from Billing
                    </button>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="customer_name_ship">Name <span class="required">*</span></label>
                        <input type="text" id="customer_name_ship" name="customer_name_ship" class="form-control"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="customer_county_ship">Country <span class="required">*</span></label>
                        <input type="text" id="customer_county_ship" name="customer_county_ship" class="form-control"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="customer_address_1_ship">Address Line 1 <span class="required">*</span></label>
                        <input type="text" id="customer_address_1_ship" name="customer_address_1_ship"
                            class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="customer_address_2_ship">Address Line 2</label>
                        <input type="text" id="customer_address_2_ship" name="customer_address_2_ship"
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="customer_town_ship">Town/City <span class="required">*</span></label>
                        <input type="text" id="customer_town_ship" name="customer_town_ship" class="form-control"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="customer_postcode_ship">Postcode <span class="required">*</span></label>
                        <input type="text" id="customer_postcode_ship" name="customer_postcode_ship"
                            class="form-control" required>
                    </div>
                </div>
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
                            <!-- Initial row -->
                            <tr class="item-row">
                                <td>
                                    <input type="text" name="product_name[]" class="form-control"
                                        placeholder="Item name" required>
                                </td>
                                <td>
                                    <input type="number" name="quantity[]" class="form-control qty" value="1" min="1"
                                        required>
                                </td>
                                <td>
                                    <input type="number" step="0.01" name="price[]" class="form-control price"
                                        value="0.00" required>
                                </td>
                                <td>
                                    <input type="number" step="0.01" name="discount[]" class="form-control discount"
                                        value="0.00" required>
                                </td>
                                <td>
                                    <input type="number" step="0.01" class="form-control subtotal" value="0.00"
                                        readonly>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn-link text-red-500 remove-row">x</button>
                                </td>
                                <td>
                                    <input type="text" name="products[0][name]" class="form-control item-name"
                                        placeholder="Product name" required>
                                </td>
                                <td>
                                    <input type="number" name="products[0][qty]" class="form-control item-qty" value="1"
                                        min="1" required onchange="calculateRow(this)">
                                </td>
                                <td>
                                    <input type="number" name="products[0][price]" class="form-control item-price"
                                        value="0.00" step="0.01" min="0" required onchange="calculateRow(this)">
                                </td>
                                <td>
                                    <input type="text" name="products[0][discount]" class="form-control item-discount"
                                        placeholder="0 or 10%" onchange="calculateRow(this)">
                                </td>
                                <td>
                                    <input type="number" name="products[0][subtotal]" class="form-control item-subtotal"
                                        value="0.00" step="0.01" readonly>
                                </td>
                                <td>
                                    <button type="button" class="action-btn delete-sm" onclick="removeInvoiceRow(this)"
                                        title="Remove">
                                        <span class="material-symbols-rounded">close</span>
                                    </button>
                                </td>
                            </tr>
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
                            placeholder="Any special instructions or notes..."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="custom_email">Custom Email Message</label>
                        <textarea id="custom_email" name="custom_email" class="form-control" rows="3"
                            placeholder="Optional custom email message..."></textarea>
                    </div>
                </div>

                <div class="totals-right">
                    <div class="total-row">
                        <label>Subtotal:</label>
                        <input type="number" id="subtotal" name="subtotal" class="total-input" value="0.00" step="0.01"
                            readonly>
                    </div>

                    <div class="total-row">
                        <label>Discount:</label>
                        <input type="number" id="discount" name="discount" class="total-input" value="0.00" step="0.01"
                            readonly>
                    </div>

                    <div class="total-row">
                        <label>Shipping:</label>
                        <input type="number" id="shipping" name="shipping" class="total-input-editable" value="0.00"
                            step="0.01" min="0" onchange="calculateTotals()">
                    </div>

                    <div class="total-row">
                        <label>TAX/VAT (10%):</label>
                        <input type="number" id="vat" name="vat" class="total-input" value="0.00" step="0.01" readonly>
                    </div>

                    <div class="total-row grand-total">
                        <label>Total:</label>
                        <input type="number" id="total" name="total" class="total-input" value="0.00" step="0.01"
                            readonly>
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

    <script src="{{ asset('js/invoice.js') }}"></script>
</x-layout>