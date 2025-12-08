@extends('layouts.app')

@section('content')
    <div class="mt-4">
        <h2>Add Customer</h2>
        <form action="{{ route('customers.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label>Address 1</label>
                <input type="text" name="address_1" class="form-control">
            </div>
            <div class="form-group">
                <label>Town</label>
                <input type="text" name="town" class="form-control">
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control">
            </div>
            <button type="submit" class="btn btn-success mt-3">Save Customer</button>
        </form>
    </div>
@endsection