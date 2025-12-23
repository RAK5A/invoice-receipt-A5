<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $invoice->invoice }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'DejaVu Sans', 'Helvetica', 'Arial', sans-serif;
        }

        body {
            font-size: 12px;
            line-height: 1.5;
            color: #333;
            background: #fff;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #4f46e5;
        }

        .company-info h1 {
            font-size: 24px;
            color: #4f46e5;
            margin-bottom: 5px;
        }

        .company-info .tagline {
            color: #6b7280;
            font-size: 12px;
        }

        .invoice-header {
            text-align: right;
        }

        .invoice-header h2 {
            font-size: 28px;
            color: #111827;
            margin-bottom: 5px;
        }

        .invoice-type {
            display: inline-block;
            padding: 4px 12px;
            background: #f3f4f6;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            color: #6b7280;
            margin-bottom: 10px;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-paid {
            background: #dcfce7;
            color: #166534;
        }

        .status-open {
            background: #fef3c7;
            color: #92400e;
        }

        /* Sold By Badge */
        .sold-by {
            background: #4f46e5;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            margin-top: 10px;
            display: inline-block;
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
            padding: 15px;
            background: #f9fafb;
            border-radius: 8px;
        }

        .info-item {
            text-align: center;
        }

        .info-label {
            font-size: 10px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
            font-weight: 600;
        }

        .info-value {
            font-size: 13px;
            color: #111827;
            font-weight: 600;
        }

        /* Parties Section */
        .parties {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 30px;
        }

        .party-box {
            padding: 15px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: #f9fafb;
        }

        .party-title {
            font-size: 12px;
            color: #4f46e5;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
            padding-bottom: 8px;
            border-bottom: 2px solid #4f46e5;
        }

        .party-name {
            font-size: 14px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
        }

        .party-details {
            font-size: 11px;
            color: #6b7280;
            line-height: 1.6;
        }

        /* Items Table */
        .items-section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 14px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table thead {
            background: #4f46e5;
            color: white;
        }

        table thead th {
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        table tbody td {
            padding: 12px 15px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 11px;
        }

        table tbody tr:last-child td {
            border-bottom: 2px solid #e5e7eb;
        }

        .item-name {
            font-weight: 600;
            color: #111827;
        }

        /* Totals */
        .totals {
            max-width: 300px;
            margin-left: auto;
            margin-bottom: 30px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .total-label {
            font-weight: 500;
            color: #6b7280;
        }

        .total-value {
            font-weight: 600;
            color: #111827;
        }

        .grand-total {
            background: #4f46e5;
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-top: 10px;
            border: none;
        }

        .grand-total .total-label {
            color: white;
            font-size: 14px;
            font-weight: 700;
        }

        .grand-total .total-value {
            color: white;
            font-size: 18px;
            font-weight: 700;
        }

        /* Notes */
        .notes-section {
            margin-top: 30px;
            padding: 20px;
            background: #f9fafb;
            border-radius: 8px;
            border-left: 4px solid #4f46e5;
        }

        .notes-title {
            font-size: 12px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .notes-content {
            font-size: 11px;
            color: #6b7280;
            line-height: 1.6;
        }

        /* Footer */
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 10px;
        }

        .footer p {
            margin-bottom: 5px;
        }

        /* Discount */
        .discount-row .total-value {
            color: #dc2626;
        }

        /* Quantity alignment */
        .qty {
            text-align: center;
        }

        .amount {
            text-align: right;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="header">
            <div class="company-info">
                <h1>INVOICE SYSTEM</h1>
                <p class="tagline">Professional Invoicing Solution</p>
            </div>

            <div class="invoice-header">
                <h2>#{{ $invoice->invoice }}</h2>
                <div class="invoice-type">{{ strtoupper($invoice->invoice_type) }}</div>
                <br>
                <span class="status-badge status-{{ $invoice->status }}">
                    {{ ucfirst($invoice->status) }}
                </span>

                <!-- Sold By Badge -->
                @if($invoice->user)
                    <div class="sold-by">
                        Sold by: {{ $invoice->user->name }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Invoice Info -->
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Issue Date</div>
                <div class="info-value">{{ $invoice->invoice_date }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Due Date</div>
                <div class="info-value">{{ $invoice->invoice_due_date }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Invoice Type</div>
                <div class="info-value">{{ ucfirst($invoice->invoice_type) }}</div>
            </div>
        </div>

        <!-- Billing Information -->
        <div class="parties">
            <div class="party-box">
                <div class="party-title">Bill To</div>
                <div class="party-name">{{ $invoice->customer->name }}</div>
                <div class="party-details">
                    @if($invoice->customer->address)
                        {{ $invoice->customer->address }}<br>
                    @endif
                    @if($invoice->customer->email)
                        <strong>Email:</strong> {{ $invoice->customer->email }}<br>
                    @endif
                    @if($invoice->customer->phone)
                        <strong>Phone:</strong> {{ $invoice->customer->phone }}
                    @endif
                </div>
            </div>

            <div class="party-box">
                <div class="party-title">From</div>
                <div class="party-name">{{ config('app.name', 'Invoice System Inc.') }}</div>
                <div class="party-details">
                    123 Business Street<br>
                    City, State 12345<br>
                    <strong>Email:</strong> contact@invoicesystem.com<br>
                    <strong>Phone:</strong> +1 (555) 123-4567
                </div>
            </div>
        </div>

        <!-- Items -->
        <div class="items-section">
            <div class="section-title">Invoice Items</div>
            <table>
                <thead>
                    <tr>
                        <th style="width: 45%;">Description</th>
                        <th style="width: 10%;">Qty</th>
                        <th style="width: 15%;">Unit Price</th>
                        <th style="width: 15%;">Discount</th>
                        <th style="width: 15%;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoice->items as $item)
                        <tr>
                            <td class="item-name">{{ $item->product }}</td>
                            <td class="qty">{{ $item->qty }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>{{ $item->discount ?: '—' }}</td>
                            <td class="amount">${{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Totals -->
        <div class="totals">
            <div class="total-row">
                <div class="total-label">Subtotal</div>
                <div class="total-value">${{ number_format($invoice->subtotal, 2) }}</div>
            </div>

            @if($invoice->discount > 0)
                <div class="total-row discount-row">
                    <div class="total-label">Discount</div>
                    <div class="total-value">-${{ number_format($invoice->discount, 2) }}</div>
                </div>
            @endif

            <div class="total-row">
                <div class="total-label">Tax/VAT</div>
                <div class="total-value">${{ number_format($invoice->vat, 2) }}</div>
            </div>

            <div class="total-row grand-total">
                <div class="total-label">Total Amount</div>
                <div class="total-value">${{ number_format($invoice->total, 2) }}</div>
            </div>
        </div>

        <!-- Notes -->
        @if($invoice->notes)
            <div class="notes-section">
                <div class="notes-title">Additional Notes</div>
                <div class="notes-content">
                    {{ $invoice->notes }}
                </div>
            </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <p><strong>Thank You for Your Business!</strong></p>
            <p>This is a computer-generated invoice. No signature required.</p>
            <p>For any questions, please contact us at contact@invoicesystem.com</p>
        </div>
    </div>
</body>

</html>