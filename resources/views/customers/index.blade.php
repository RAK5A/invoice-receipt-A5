@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
        <h2>Customer List</h2>
        <a href="{{ route('customers.create') }}" class="btn btn-primary">Add New Customer</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Town</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->town }}</td>
                    <td>
                        <button class="btn btn-sm btn-info">Edit</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection