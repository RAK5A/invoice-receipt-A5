{{-- <!DOCTYPE html>
<html>

<head>
    <title>Invoice #{{ $invoice->id }}</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .totals {
            text-align: right;
        }
    </style>
</head>

<body>
    <h1>Invoice #{{ $invoice->id }}</h1>
    <p>
        <strong>To:</strong> {{ $invoice->customer->name }}<br>
        {{ $invoice->customer->address_1 }}<br>
        {{ $invoice->customer->town }}
    </p>
    <p><strong>Date:</strong> {{ $invoice->invoice_date }}</p>

    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                    <td>{{ number_format($item->total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <p>Subtotal: {{ number_format($invoice->subtotal, 2) }}</p>
        <p>Tax: {{ number_format($invoice->tax, 2) }}</p>
        <h3>Total: {{ number_format($invoice->total, 2) }}</h3>
    </div>
</body>

</html> --}}