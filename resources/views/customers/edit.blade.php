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

                <!-- Billing Information Section -->
                <div class="section-header-form">
                    <span class="material-symbols-rounded">receipt_long</span>
                    <h3>Billing Information</h3>
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
                            <span class="required">*</span>
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

                    <!-- County -->
                    <div class="form-group">
                        <label for="county">
                            <span class="material-symbols-rounded">public</span>
                            Country
                            <span class="required">*</span>
                        </label>
                        <input type="text" id="county" name="county"
                            class="form-control @error('county') is-invalid @enderror"
                            value="{{ old('county', $customer->county) }}" required placeholder="Enter country">
                        @error('county')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Address 1 -->
                    <div class="form-group">
                        <label for="address_1">
                            <span class="material-symbols-rounded">home</span>
                            Address Line 1
                            <span class="required">*</span>
                        </label>
                        <input type="text" id="address_1" name="address_1"
                            class="form-control @error('address_1') is-invalid @enderror"
                            value="{{ old('address_1', $customer->address_1) }}" required placeholder="Street address">
                        @error('address_1')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Address 2 -->
                    <div class="form-group">
                        <label for="address_2">
                            <span class="material-symbols-rounded">home</span>
                            Address Line 2
                        </label>
                        <input type="text" id="address_2" name="address_2"
                            class="form-control @error('address_2') is-invalid @enderror"
                            value="{{ old('address_2', $customer->address_2) }}"
                            placeholder="Apartment, suite, etc. (optional)">
                        @error('address_2')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Town -->
                    <div class="form-group">
                        <label for="town">
                            <span class="material-symbols-rounded">location_city</span>
                            Town/City
                            <span class="required">*</span>
                        </label>
                        <input type="text" id="town" name="town"
                            class="form-control @error('town') is-invalid @enderror"
                            value="{{ old('town', $customer->town) }}" required placeholder="Enter town/city">
                        @error('town')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Postcode -->
                    <div class="form-group">
                        <label for="postcode">
                            <span class="material-symbols-rounded">pin_drop</span>
                            Postcode
                            <span class="required">*</span>
                        </label>
                        <input type="text" id="postcode" name="postcode"
                            class="form-control @error('postcode') is-invalid @enderror"
                            value="{{ old('postcode', $customer->postcode) }}" required placeholder="Enter postcode">
                        @error('postcode')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Shipping Information Section -->
                <div class="section-header-form" style="margin-top: 40px;">
                    <span class="material-symbols-rounded">local_shipping</span>
                    <h3>Shipping Information</h3>
                </div>

                <div class="form-grid">
                    <!-- Name Ship -->
                    <div class="form-group">
                        <label for="name_ship">
                            <span class="material-symbols-rounded">person</span>
                            Full Name
                            <span class="required">*</span>
                        </label>
                        <input type="text" id="name_ship" name="name_ship"
                            class="form-control @error('name_ship') is-invalid @enderror"
                            value="{{ old('name_ship', $customer->name_ship) }}" required
                            placeholder="Enter recipient name">
                        @error('name_ship')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- County Ship -->
                    <div class="form-group">
                        <label for="county_ship">
                            <span class="material-symbols-rounded">public</span>
                            Country
                            <span class="required">*</span>
                        </label>
                        <input type="text" id="county_ship" name="county_ship"
                            class="form-control @error('county_ship') is-invalid @enderror"
                            value="{{ old('county_ship', $customer->county_ship) }}" required
                            placeholder="Enter country">
                        @error('county_ship')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Address 1 Ship -->
                    <div class="form-group">
                        <label for="address_1_ship">
                            <span class="material-symbols-rounded">home</span>
                            Address Line 1
                            <span class="required">*</span>
                        </label>
                        <input type="text" id="address_1_ship" name="address_1_ship"
                            class="form-control @error('address_1_ship') is-invalid @enderror"
                            value="{{ old('address_1_ship', $customer->address_1_ship) }}" required
                            placeholder="Street address">
                        @error('address_1_ship')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Address 2 Ship -->
                    <div class="form-group">
                        <label for="address_2_ship">
                            <span class="material-symbols-rounded">home</span>
                            Address Line 2
                        </label>
                        <input type="text" id="address_2_ship" name="address_2_ship"
                            class="form-control @error('address_2_ship') is-invalid @enderror"
                            value="{{ old('address_2_ship', $customer->address_2_ship) }}"
                            placeholder="Apartment, suite, etc. (optional)">
                        @error('address_2_ship')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Town Ship -->
                    <div class="form-group">
                        <label for="town_ship">
                            <span class="material-symbols-rounded">location_city</span>
                            Town/City
                            <span class="required">*</span>
                        </label>
                        <input type="text" id="town_ship" name="town_ship"
                            class="form-control @error('town_ship') is-invalid @enderror"
                            value="{{ old('town_ship', $customer->town_ship) }}" required placeholder="Enter town/city">
                        @error('town_ship')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Postcode Ship -->
                    <div class="form-group">
                        <label for="postcode_ship">
                            <span class="material-symbols-rounded">pin_drop</span>
                            Postcode
                            <span class="required">*</span>
                        </label>
                        <input type="text" id="postcode_ship" name="postcode_ship"
                            class="form-control @error('postcode_ship') is-invalid @enderror"
                            value="{{ old('postcode_ship', $customer->postcode_ship) }}" required
                            placeholder="Enter postcode">
                        @error('postcode_ship')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>