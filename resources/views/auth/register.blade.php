{{-- <x-layout :navbar="false">
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $er)
            <li>{{ $er }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="post" action="/register" class="w-50">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword2" class="form-label">Confirm password</label>
            <input type="password" class="form-control" id="exampleInputPassword2" name="password_confirmation">
        </div>
        <button type="submit" class="btn btn-primary">Sign up</button>
    </form>
</x-layout> --}}


<{{-- x-layout title="Register - Invoice System" :navbar="false">
    <section
        style="min-height: 100vh; background: linear-gradient(#F1F3FF, #CBD4FF); display: flex; align-items: center; justify-content: center; padding: 40px 20px;">
        <div style="width: 100%; max-width: 450px;">
            <div style="border-radius: 1rem; background: #151A2D; padding: 50px; color: white;">
                @if($errors->any())
                <div style="background: #dc3545; color: white; padding: 15px; border-radius: 8px; margin-bottom: 25px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $er)
                        <li>{{ $er }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="post" action="/register">
                    @csrf
                    <div style="margin-bottom: 40px;">
                        <h2
                            style="font-weight: 700; margin-bottom: 10px; text-transform: uppercase; text-align: center;">
                            Sign Up</h2>
                        <p style="color: rgba(255, 255, 255, 0.5); margin-bottom: 50px; text-align: center;">Create your
                            account to get started!</p>

                        <div style="margin-bottom: 25px;">
                            <label style="display: block; margin-bottom: 8px; font-size: 16px;" for="name">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                style="width: 100%; padding: 12px 15px; font-size: 16px; border-radius: 8px; border: 1px solid rgba(255, 255, 255, 0.2); background: rgba(255, 255, 255, 0.1); color: white; outline: none;"
                                required />
                        </div>

                        <div style="margin-bottom: 25px;">
                            <label style="display: block; margin-bottom: 8px; font-size: 16px;" for="typeEmailX">Email
                                address</label>
                            <input type="email" id="typeEmailX" name="email" value="{{ old('email') }}"
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

                        <div style="margin-bottom: 25px;">
                            <label style="display: block; margin-bottom: 8px; font-size: 16px;"
                                for="typePasswordConfirm">Confirm Password</label>
                            <input type="password" id="typePasswordConfirm" name="password_confirmation"
                                style="width: 100%; padding: 12px 15px; font-size: 16px; border-radius: 8px; border: 1px solid rgba(255, 255, 255, 0.2); background: rgba(255, 255, 255, 0.1); color: white; outline: none;"
                                required />
                        </div>

                        <button type="submit"
                            style="width: 100%; padding: 12px 40px; font-size: 16px; font-weight: 500; border-radius: 8px; background: #EEF2FF; color: #151A2D; border: none; cursor: pointer; transition: 0.3s;">Sign
                            Up</button>
                    </div>

                    <div style="text-align: center;">
                        <p style="margin: 0;">Already have an account? <a href="/login"
                                style="color: rgba(255, 255, 255, 0.5); font-weight: 700; text-decoration: none;">Login</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    </x-layout> --}}


    <x-layout title="Register - Invoice System" :navbar="false">
        <div class="auth-container">
            <div class="auth-card">
                <div class="auth-header">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="auth-logo">
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
                        <input type="text" id="name" name="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required
                            autofocus placeholder="Enter your full name">
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
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                            required placeholder="Enter your email">
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">
                            <span class="material-symbols-rounded">phone</span>
                            Phone Number
                        </label>
                        <input type="tel" id="phone" name="phone"
                            class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                            placeholder="Enter your phone number (optional)">
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
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-control" required placeholder="Confirm your password">
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