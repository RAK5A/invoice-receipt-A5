{{-- <x-layout :navbar="false">
    <form method="post" action="/login" class="w-50">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
            <label class="form-check-label" for="exampleCheck1">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</x-layout> --}}


{{-- <x-layout title="Login - Invoice System" :navbar="false">
    <section
        style="min-height: 100vh; background: linear-gradient(#F1F3FF, #CBD4FF); display: flex; align-items: center; justify-content: center; padding: 40px 20px;">
        <div style="width: 100%; max-width: 450px;">
            <div style="border-radius: 1rem; background: #151A2D; padding: 50px; color: white;">
                <form method="post" action="/login">
                    @csrf
                    <div style="margin-bottom: 40px;">
                        <h2
                            style="font-weight: 700; margin-bottom: 10px; text-transform: uppercase; text-align: center;">
                            Login</h2>
                        <p style="color: rgba(255, 255, 255, 0.5); margin-bottom: 50px; text-align: center;">Please
                            enter your login and password!</p>

                        <div style="margin-bottom: 25px;">
                            <label style="display: block; margin-bottom: 8px; font-size: 16px;"
                                for="typeEmailX">Email</label>
                            <input type="email" id="typeEmailX" name="email"
                                style="width: 100%; padding: 12px 15px; font-size: 16px; border-radius: 8px; border: 1px solid rgba(255, 255, 255, 0.2); background: rgba(255, 255, 255, 0.1); color: white; outline: none;"
                                required />
                        </div>

                        <div style="margin-bottom: 25px;">
                            <label style="display: block; margin-bottom: 8px; font-size: 16px;"
                                for="typePasswordX">Password</label>
                            <input type="password" id="typePasswordX" name="password"
                                style="width: 100%; padding: 12px 15px; font-size: 16px; border-radius: 8px; border: 1px solid rgba(255, 255, 255, 0.2); background: rgba(255, 255, 255, 0.1); color: white; outline: none;"
                                required />
                        </div>

                        <div style="margin-bottom: 25px; display: flex; align-items: center; gap: 8px;">
                            <input type="checkbox" id="rememberCheck" name="remember"
                                style="width: 18px; height: 18px; cursor: pointer;">
                            <label style="color: rgba(255, 255, 255, 0.5); cursor: pointer; font-size: 14px;"
                                for="rememberCheck">Remember me</label>
                        </div>

                        <p style="font-size: 14px; margin-bottom: 50px; text-align: center;"><a
                                style="color: rgba(255, 255, 255, 0.5); text-decoration: none;" href="#!">Forgot
                                password?</a></p>

                        <button type="submit"
                            style="width: 100%; padding: 12px 40px; font-size: 16px; font-weight: 500; border-radius: 8px; background: #EEF2FF; color: #151A2D; border: none; cursor: pointer; transition: 0.3s;">Login</button>
                    </div>

                    <div style="text-align: center;">
                        <p style="margin: 0;">Don't have an account? <a href="/register"
                                style="color: rgba(255, 255, 255, 0.5); font-weight: 700; text-decoration: none;">Sign
                                Up</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-layout> --}}


<x-layout title="Login - Invoice System" :navbar="false">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="auth-logo">
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

                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember" id="remember">
                        <span>Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                    @endif
                </div>

                <button type="submit" class="btn-submit">
                    <span class="material-symbols-rounded">login</span>
                    Sign In
                </button>
            </form>

            <div class="auth-footer">
                <p>Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
            </div>
        </div>
    </div>
</x-layout>