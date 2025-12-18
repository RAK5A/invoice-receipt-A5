<x-layout title="Edit Customer - Invoice System">
    <div class="page-container">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>Edit Customer</h1>
                <p>Update customer information</p>
            </div>
            <a href="{{ route('customers.index') }}" class="btn-secondary">
                <span class="material-symbols-rounded">arrow_back</span>
                Back to Customers
            </a>
        </div>

        <!-- Form Card -->
        <div class="form-card">
            <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Customer Information Section -->
                <div class="section-header-form">
                    <span class="material-symbols-rounded">receipt_long</span>
                    <h3>Customer Information</h3>
                </div>

                <div class="form-grid">
                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">
                            <span class="material-symbols-rounded">person</span>
                            Full Name
                            <span class="required">*</span>
                        </label>
                        <input type="text" id="name" name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $customer->name) }}" required placeholder="Enter customer name">
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">
                            <span class="material-symbols-rounded">mail</span>
                            Email Address
                        </label>
                        <input type="email" id="email" name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $customer->email) }}" required placeholder="customer@example.com">
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="form-group">
                        <label for="phone">
                            <span class="material-symbols-rounded">phone</span>
                            Phone Number
                            <span class="required">*</span>
                        </label>
                        <input type="tel" id="phone" name="phone"
                            class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone', $customer->phone) }}" required placeholder="Enter phone number">
                        @error('phone')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="form-group">
                        <label for="address">
                            <span class="material-symbols-rounded">home</span>
                            Address
                        </label>
                        <input type="text" id="address" name="address"
                            class="form-control @error('address') is-invalid @enderror"
                            value="{{ old('address', $customer->address) }}"
                            placeholder="Apartment, suite, etc. (optional)">
                        @error('address')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('customers.index') }}" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-submit">
                        <span class="material-symbols-rounded">save</span>
                        Update Customer
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>