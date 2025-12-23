<x-layout title="Update Invoice - Invoice System" :navbar="true">
    <div class="page-container">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>Update Invoice #{{ $invoice->invoice }}</h1>
                <p>Update invoice details and items</p>
            </div>
            <a href="{{ route('invoices.index') }}" class="btn-secondary">
                <span class="material-symbols-rounded">arrow_back</span>
                Back to Invoices
            </a>
        </div>

        <!-- Invoice Form -->
        <form action="{{ route('invoices.update', $invoice->id) }}" method="POST" id="invoiceForm">
            @csrf
            @method('PUT')

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
                            <option value="invoice" {{ $invoice->invoice_type == 'invoice' ? 'selected' : '' }}>Invoice
                            </option>
                            <option value="quote" {{ $invoice->invoice_type == 'quote' ? 'selected' : '' }}>Quote</option>
                            <option value="receipt" {{ $invoice->invoice_type == 'receipt' ? 'selected' : '' }}>Receipt
                            </option>
                        </select>
                    </div>

                    <!-- Invoice Status -->
                    <div class="form-group">
                        <label for="invoice_status">
                            <span class="material-symbols-rounded">flag</span>
                            Status
                        </label>
                        <select id="invoice_status" name="invoice_status" class="form-control" required>
                            <option value="open" {{ $invoice->status == 'open' ? 'selected' : '' }}>Open</option>
                            <option value="paid" {{ $invoice->status == 'paid' ? 'selected' : '' }}>Paid</option>
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
                            value="{{ $invoice->invoice_date }}" required>
                    </div>

                    <!-- Due Date -->
                    <div class="form-group">
                        <label for="invoice_due_date">
                            <span class="material-symbols-rounded">event</span>
                            Due Date
                        </label>
                        <input type="date" id="invoice_due_date" name="invoice_due_date" class="form-control"
                            value="{{ $invoice->invoice_due_date }}" required>
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
                    <div class="form-group">
                        <label for="customer_name">Name <span class="required">*</span></label>
                        <input type="text" id="customer_name" name="customer_name" class="form-control"
                            value="{{ $invoice->customer->name ?? '' }}" required>
                    </div>

                    <div class="form-group">
                        <label for="customer_email">Email</label>
                        <input type="email" id="customer_email" name="customer_email" class="form-control"
                            value="{{ $invoice->customer->email ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label for="customer_phone">Phone <span class="required">*</span></label>
                        <input type="tel" id="customer_phone" name="customer_phone" class="form-control" required
                            value="{{ $invoice->customer->phone ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label for="customer_address">Address</label>
                        <input type="text" id="customer_address" name="customer_address" class="form-control"
                            value="{{ $invoice->customer->address ?? '' }}">
                    </div>
                </div>
            </div>

            <!-- Product Selection -->
            <div class="form-card">
                <div class="section-header-form">
                    <span class="material-symbols-rounded">shopping_cart</span>
                    <h3>Select Products</h3>
                    <button type="button" class="btn-primary-sm" onclick="showProductModal()">
                        <span class="material-symbols-rounded">add</span>
                        Add Product
                    </button>
                </div>

                <!-- Selected Products Table -->
                <div class="selected-products-table">
                    <table class="items-table" id="selectedProductsTable">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>In Stock</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="selectedProductsBody">
                            <!-- Products will be loaded from existing invoice items -->
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
                        <span id="subtotalDisplay"
                            class="total-amount">${{ number_format($invoice->subtotal, 2) }}</span>
                        <input type="hidden" id="subtotal" name="subtotal" value="{{ $invoice->subtotal }}">
                    </div>

                    <div class="total-row">
                        <label>Discount:</label>
                        <div class="discount-input">
                            <input type="number" id="discount_amount" name="discount_amount"
                                class="total-input-editable" value="{{ $invoice->discount }}" min="0" step="0.01"
                                onchange="calculateTotals()" style="width: 100px;">
                            <select id="discount_type" name="discount_type" class="form-control"
                                onchange="calculateTotals()" style="width: 100px; margin-left: 10px;">
                                <option value="amount">$</option>
                                <option value="percent">%</option>
                            </select>
                        </div>
                    </div>

                    <div class="total-row">
                        <label>TAX/VAT:</label>
                        <div class="tax-input">
                            <input type="number" id="tax_rate" name="tax_rate" class="total-input-editable" value="0"
                                min="0" step="0.01" onchange="calculateTotals()" style="width: 80px;">
                            <span style="margin: 0 5px;">%</span>
                            <span id="taxAmountDisplay"
                                class="total-amount">${{ number_format($invoice->vat, 2) }}</span>
                            <input type="hidden" id="tax_amount" name="tax_amount" value="{{ $invoice->vat }}">
                        </div>
                    </div>

                    <div class="total-row grand-total">
                        <label>Total:</label>
                        <span id="totalDisplay" class="total-amount">${{ number_format($invoice->total, 2) }}</span>
                        <input type="hidden" id="total" name="total" value="{{ $invoice->total }}">
                    </div>
                </div>
            </div>

            <!-- Hidden fields for selected products -->
            <div id="productFields">
                <!-- Existing invoice items will be loaded here -->
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ route('invoices.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-submit">
                    <span class="material-symbols-rounded">save</span>
                    Update Invoice
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
                    <input type="text" id="customerSearch" placeholder="Search customers" onkeyup="filterCustomers()">
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
                                <td>{{ $customer->email ?: 'N/A'}}</td>
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

    <!-- Product Selection Modal -->
    <div id="productModal" class="modal" style="display:none;">
        <div class="modal-content" style="max-width: 800px;">
            <div class="modal-header">
                <h3>Select Products from Inventory</h3>
                <button type="button" class="modal-close" onclick="closeProductModal()">
                    <span class="material-symbols-rounded">close</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="search-box" style="margin-bottom: 20px;">
                    <span class="material-symbols-rounded">search</span>
                    <input type="text" id="productSearch" placeholder="Search products" onkeyup="filterProducts()">
                </div>

                <table class="data-table" id="productSelectTable">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>In Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr class="product-row">
                                <td>
                                    <strong>{{ $product->product_name }}</strong>
                                    @if($product->product_desc)
                                        <small class="text-muted">{{ Str::limit($product->product_desc, 50) }}</small>
                                    @endif
                                </td>
                                <td>{{ $product->category->name ?? 'N/A' }}</td>
                                <td>${{ number_format($product->product_price, 2) }}</td>
                                <td>
                                    <span
                                        class="stock-badge @if($product->quantity == 0) out-of-stock @elseif($product->quantity <= 5) low-stock @endif">
                                        {{ $product->quantity }}
                                    </span>
                                </td>
                                <td>
                                    <button type="button" class="btn-primary-sm" onclick='selectProduct(@json($product))'>
                                        Add
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

<script>
    window.invoiceItems = @json($invoice->items);
    window.availableProducts = @json($products);
</script>