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
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 14px;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
        }

        /* Header */
        .header {
            display: table;
            width: 100%;
            margin-bottom: 40px;
            border-bottom: 3px solid #3b82f6;
            padding-bottom: 20px;
        }

        .header-left {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .header-right {
            display: table-cell;
            width: 50%;
            text-align: right;
            vertical-align: top;
        }

        .company-name {
            font-size: 28px;
            font-weight: bold;
            color: #3b82f6;
            margin-bottom: 5px;
        }

        .company-tagline {
            color: #64748b;
            font-size: 12px;
        }

        .invoice-title {
            font-size: 32px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 5px;
        }

        .invoice-number {
            font-size: 16px;
            color: #64748b;
        }

        /* Info Section */
        .info-section {
            display: table;
            width: 100%;
            margin-bottom: 40px;
        }

        .info-left,
        .info-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .info-box {
            background: #f8fafc;
            padding: 20px;
            border-radius: 8px;
            margin-right: 10px;
        }

        .info-right .info-box {
            margin-right: 0;
            margin-left: 10px;
        }

        .info-title {
            font-weight: bold;
            font-size: 12px;
            text-transform: uppercase;
            color: #64748b;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }

        .info-content {
            color: #1e293b;
        }

        .info-content strong {
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
        }

        /* Dates */
        .dates-section {
            background: #eff6ff;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            display: table;
            width: 100%;
        }

        .date-item {
            display: table-cell;
            width: 33.33%;
        }

        .date-label {
            font-size: 11px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .date-value {
            font-weight: bold;
            color: #1e293b;
            font-size: 14px;
        }

        /* Items Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table thead {
            background: #3b82f6;
            color: white;
        }

        table thead th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        table thead th:last-child,
        table tbody td:last-child {
            text-align: right;
        }

        table tbody tr {
            border-bottom: 1px solid #e2e8f0;
        }

        table tbody tr:last-child {
            border-bottom: 2px solid #cbd5e1;
        }

        table tbody td {
            padding: 12px;
            color: #475569;
        }

        table tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        /* Totals */
        .totals-section {
            float: right;
            width: 350px;
            margin-top: 20px;
        }

        .total-row {
            display: table;
            width: 100%;
            padding: 10px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .total-row.grand-total {
            background: #3b82f6;
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            margin-top: 10px;
            border: none;
        }

        .total-label {
            display: table-cell;
            font-weight: 500;
            color: #64748b;
        }

        .grand-total .total-label {
            color: white;
            font-size: 16px;
        }

        .total-value {
            display: table-cell;
            text-align: right;
            font-weight: bold;
            color: #1e293b;
        }

        .grand-total .total-value {
            color: white;
            font-size: 20px;
        }

        /* Notes */
        .notes-section {
            clear: both;
            margin-top: 60px;
            padding-top: 30px;
            border-top: 2px solid #e2e8f0;
        }

        .notes-title {
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .notes-content {
            color: #64748b;
            font-size: 13px;
            line-height: 1.8;
        }

        /* Footer */
        .footer {
            margin-top: 40px;
            text-align: center;
            color: #94a3b8;
            font-size: 11px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-badge.paid {
            background: #d1fae5;
            color: #10b981;
        }

        .status-badge.open {
            background: #fef3c7;
            color: #f59e0b;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <div class="company-name">Invoice System</div>
                <div class="company-tagline">Professional Invoicing Solution</div>
            </div>
            <div class="header-right">
                <div class="invoice-title">{{ strtoupper($invoice->invoice_type) }}</div>
                <div class="invoice-number">#{{ $invoice->invoice }}</div>
                <div style="margin-top: 10px;">
                    <span class="status-badge {{ $invoice->status }}">{{ ucfirst($invoice->status) }}</span>
                </div>
            </div>
        </div>

        <!-- Dates Section -->
        <div class="dates-section">
            <div class="date-item">
                <div class="date-label">Issue Date</div>
                <div class="date-value">{{ $invoice->invoice_date }}</div>
            </div>
            <div class="date-item">
                <div class="date-label">Due Date</div>
                <div class="date-value">{{ $invoice->invoice_due_date }}</div>
            </div>
            <div class="date-item">
                <div class="date-label">Invoice Type</div>
                <div class="date-value">{{ ucfirst($invoice->invoice_type) }}</div>
            </div>
        </div>

        <!-- Billing & Shipping Info -->
        <div class="info-section">
            <div class="info-left">
                <div class="info-box">
                    <div class="info-title">Bill To</div>
                    <div class="info-content">
                        <strong>{{ $invoice->customer->name }}</strong>
                        {{ $invoice->customer->address }}<br>
                        <br>
                        <strong>Contact:</strong><br>
                        {{ $invoice->customer->email }}<br>
                        {{ $invoice->customer->phone }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <table>
            <thead>
                <tr>
                    <th style="width: 45%;">Item Description</th>
                    <th style="width: 15%; text-align: center;">Qty</th>
                    <th style="width: 15%;">Price</th>
                    <th style="width: 10%;">Discount</th>
                    <th style="width: 15%;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->items as $item)
                    <tr>
                        <td><strong>{{ $item->product }}</strong></td>
                        <td style="text-align: center;">{{ $item->qty }}</td>
                        <td>${{ number_format($item->price, 2) }}</td>
                        <td>{{ $item->discount ?? '0' }}</td>
                        <td>${{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <div class="totals-section">
            <div class="total-row">
                <div class="total-label">Subtotal:</div>
                <div class="total-value">${{ number_format($invoice->subtotal, 2) }}</div>
            </div>

            @if($invoice->discount > 0)
                <div class="total-row">
                    <div class="total-label">Discount:</div>
                    <div class="total-value">-${{ number_format($invoice->discount, 2) }}</div>
                </div>
            @endif

            <div class="total-row">
                <div class="total-label">Tax/VAT (1%):</div>
                <div class="total-value">${{ number_format($invoice->vat, 2) }}</div>
            </div>

            <div class="total-row grand-total">
                <div class="total-label">TOTAL:</div>
                <div class="total-value">${{ number_format($invoice->total, 2) }}</div>
            </div>
        </div>

        <!-- Notes -->
        @if($invoice->notes)
            <div class="notes-section">
                <div class="notes-title">Additional Notes:</div>
                <div class="notes-content">
                    {{ $invoice->notes }}
                </div>
            </div>
        @endif

        <!-- Footer -->
        {{-- <div class="footer">
            <p>Thank you for your business!</p>
            <p style="margin-top: 5px;">This is a computer-generated invoice. No signature required.</p>
        </div> --}}
    </div>
</body>

</html>