<x-layout title="Register - Invoice System" :navbar="false">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>Create Account</h1>
                <p>Sign up to get started with Invoice System</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <span class="material-symbols-rounded">error</span>
                    <div>
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="auth-form">
                @csrf

                <div class="form-group">
                    <label for="name">
                        <span class="material-symbols-rounded">badge</span>
                        Full Name
                    </label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" required autofocus placeholder="Enter your full name">
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="username">
                        <span class="material-symbols-rounded">person</span>
                        Username
                    </label>
                    <input type="text" id="username" name="username"
                        class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}"
                        required placeholder="Choose a username">
                    @error('username')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">
                        <span class="material-symbols-rounded">mail</span>
                        Email Address
                    </label>
                    <input type="email" id="email" name="email"
                        class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required
                        placeholder="Enter your email">
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">
                        <span class="material-symbols-rounded">phone</span>
                        Phone Number
                    </label>
                    <input type="tel" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror"
                        value="{{ old('phone') }}" placeholder="Enter your phone number (optional)">
                    @error('phone')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">
                        <span class="material-symbols-rounded">lock</span>
                        Password
                    </label>
                    <input type="password" id="password" name="password"
                        class="form-control @error('password') is-invalid @enderror" required
                        placeholder="Create a password">
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">
                        <span class="material-symbols-rounded">lock</span>
                        Confirm Password
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                        required placeholder="Confirm your password">
                </div>

                <button type="submit" class="btn-submit">
                    <span class="material-symbols-rounded">person_add</span>
                    Create Account
                </button>
            </form>

            <div class="auth-footer">
                <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
            </div>
        </div>
    </div>
</x-layout>