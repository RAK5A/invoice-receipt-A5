<x-layout title="Add User - Invoice System" :navbar="true">
    <div class="page-container">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>Add New User</h1>
                <p>Create a new system user account</p>
            </div>
            <a href="{{ route('users.index') }}" class="btn-secondary">
                <span class="material-symbols-rounded">arrow_back</span>
                Back to Users
            </a>
        </div>

        <!-- Form Card -->
        <div class="form-card">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="form-grid">
                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">
                            <span class="material-symbols-rounded">badge</span>
                            Full Name
                            <span class="required">*</span>
                        </label>
                        <input type="text" id="name" name="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required
                            placeholder="Enter full name">
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div class="form-group">
                        <label for="username">
                            <span class="material-symbols-rounded">person</span>
                            Username
                            <span class="required">*</span>
                        </label>
                        <input type="text" id="username" name="username"
                            class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}"
                            required placeholder="Choose a username">
                        @error('username')
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
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                            required placeholder="user@example.com">
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="form-group">
                        <label for="phone">
                            <span class="material-symbols-rounded">phone</span>
                            Phone Number
                        </label>
                        <input type="tel" id="phone" name="phone"
                            class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                            placeholder="Enter phone number (optional)">
                        @error('phone')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">
                            <span class="material-symbols-rounded">lock</span>
                            Password
                            <span class="required">*</span>
                        </label>
                        <input type="password" id="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" required
                            placeholder="Minimum 8 characters">
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                        <small class="form-hint">Password must be at least 8 characters long</small>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="password_confirmation">
                            <span class="material-symbols-rounded">lock</span>
                            Confirm Password
                            <span class="required">*</span>
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-control" required placeholder="Confirm password">
                    </div>

                    <!-- Role Selection -->
                    <div class="form-group">
                        <label for="role">
                            <span class="material-symbols-rounded">admin_panel_settings</span>
                            User Role
                            <span class="required">*</span>
                        </label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="employee">Employee</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('users.index') }}" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-submit">
                        <span class="material-symbols-rounded">save</span>
                        Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>