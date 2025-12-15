<x-layout title="Edit User - Invoice System">
    <div class="page-container">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>Edit User</h1>
                <p>Update user account information</p>
            </div>
            <a href="{{ route('users.index') }}" class="btn-secondary">
                <span class="material-symbols-rounded">arrow_back</span>
                Back to Users
            </a>
        </div>

        <!-- Form Card -->
        <div class="form-card">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">
                            <span class="material-symbols-rounded">badge</span>
                            Full Name
                            <span class="required">*</span>
                        </label>
                        <input type="text" id="name" name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $user->name) }}" required placeholder="Enter full name">
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
                            class="form-control @error('username') is-invalid @enderror"
                            value="{{ old('username', $user->username) }}" required placeholder="Choose a username">
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
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}" required placeholder="user@example.com">
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
                            class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone', $user->phone) }}" placeholder="Enter phone number (optional)">
                        @error('phone')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">
                            <span class="material-symbols-rounded">lock</span>
                            New Password
                        </label>
                        <input type="password" id="password" name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Leave blank to keep current password">
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                        <small class="form-hint">Leave blank if you don't want to change the password</small>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="password_confirmation">
                            <span class="material-symbols-rounded">lock</span>
                            Confirm New Password
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-control" placeholder="Confirm new password">
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('users.index') }}" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-submit">
                        <span class="material-symbols-rounded">save</span>
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>