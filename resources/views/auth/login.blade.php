<x-layout title="Login - Invoice System" :navbar="false">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-logo-container">
                    <div class="auth-logo-badge">
                        <span class="material-symbols-rounded">receipt</span>
                    </div>
                    <div class="auth-logo-text">
                        <span class="auth-logo-primary">Invoice</span>
                        <span class="auth-logo-secondary">System</span>
                    </div>
                </div>
                <h1>Welcome Back</h1>
                <p>Sign in to your account to continue</p>
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

            <form method="POST" action="{{ route('login') }}" class="auth-form">
                @csrf

                <div class="form-group">
                    <label for="username">
                        <span class="material-symbols-rounded">person</span>
                        Username or Email
                    </label>
                    <input type="text" id="username" name="username"
                        class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}"
                        required autofocus placeholder="Enter your username or email">
                    @error('username')
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
                        placeholder="Enter your password">
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember" id="remember">
                        <span>Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                    @endif
                </div> --}}

                <button type="submit" class="btn-submit">
                    <span class="material-symbols-rounded">login</span>
                    Sign In
                </button>
            </form>

            {{-- <div class="auth-footer">
                <p>Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
            </div> --}}
        </div>
    </div>
</x-layout>