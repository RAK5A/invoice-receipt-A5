{{-- @extends('layouts.app')

@section('content')
<form action="{{ route('invoices.store') }}" method="POST">
    @csrf <select name="customer_id">
        @foreach($customers as $customer)
        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
        @endforeach
    </select>

    <button type="submit">Save Invoice</button>
</form>
@endsection --}}

@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
        <h2>Invoices</h2>
        <a href="{{ route('invoices.create') }}" class="btn btn-primary">Create Invoice</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
                <tr>
                    <td>#{{ $invoice->id }}</td>
                    <td>{{ $invoice->customer->name }}</td>
                    <td>{{ $invoice->invoice_date }}</td>
                    <td>${{ number_format($invoice->total, 2) }}</td>
                    <td>
                        <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-sm btn-secondary">View PDF</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection