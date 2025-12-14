{{-- <x-layout>
    <div class="row p-2">
        <div class="col-3 bg-light">Name</div>
        <div class="col-9">: {{ $user->name }}</div>

        <div class="col-3 bg-light">Email</div>
        <div class="col-9">: {{ $user->email }}</div>
        <div class="col-12">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $er)
                    <li>{{ $er }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="/change-password" method="post">
                @csrf
                <fieldset>
                    <legend>Change password zone</legend>
                    <div class="row g-2">
                        <label for="current_password" class="col-3 form-label">Current Password</label>
                        <div class="col-9">
                            <input type="password" class="form-control" id="current_password" name="current_password">
                        </div>

                        <label for="new_password" class="col-3 form-label">New Password</label>
                        <div class="col-9">
                            <input type="password" class="form-control" id="new_password" name="new_password">
                        </div>

                        <label for="new_password_confirmation" class="col-3 form-label">Confrim New Password</label>
                        <div class="col-9">
                            <input type="password" class="form-control" id="new_password_confirmation"
                                name="new_password_confirmation">
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col">
                            <button class="btn btn-primary">Change password</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</x-layout> --}}


<x-layout>
    <section style="min-height: 100vh; background: linear-gradient(#F1F3FF, #CBD4FF); padding: 40px 20px;">
        <div style="max-width: 900px; margin: 0 auto;">
            <!-- Profile Information Card -->
            <div style="border-radius: 1rem; background: #151A2D; padding: 50px; color: white; margin-bottom: 30px;">
                <h4 style="font-weight: 700; margin-bottom: 30px; font-size: 24px;">Profile Information</h4>
                <div style="display: grid; gap: 30px;">
                    <div>
                        <div style="display: grid; grid-template-columns: 1fr 3fr; gap: 15px; align-items: center;">
                            <label style="color: rgba(255, 255, 255, 0.5);">Name</label>
                            <p style="margin: 0;">: {{ $user->name }}</p>
                        </div>
                    </div>
                    <div>
                        <div style="display: grid; grid-template-columns: 1fr 3fr; gap: 15px; align-items: center;">
                            <label style="color: rgba(255, 255, 255, 0.5);">Email</label>
                            <p style="margin: 0;">: {{ $user->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Change Password Card -->
            <div style="border-radius: 1rem; background: #151A2D; padding: 50px; color: white;">
                @if ($errors->any())
                    <div style="background: #dc3545; color: white; padding: 15px; border-radius: 8px; margin-bottom: 25px;">
                        <ul style="margin: 0; padding-left: 20px;">
                            @foreach ($errors->all() as $er)
                                <li>{{ $er }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="/change-password" method="post">
                    @csrf
                    <h4 style="font-weight: 700; margin-bottom: 30px; font-size: 24px;">Change Password</h4>

                    <div style="margin-bottom: 25px;">
                        <label style="display: block; margin-bottom: 8px; font-size: 16px;"
                            for="current_password">Current Password</label>
                        <input type="password" id="current_password" name="current_password"
                            style="width: 100%; padding: 12px 15px; font-size: 16px; border-radius: 8px; border: 1px solid rgba(255, 255, 255, 0.2); background: rgba(255, 255, 255, 0.1); color: white; outline: none;"
                            required>
                    </div>

                    <div style="margin-bottom: 25px;">
                        <label style="display: block; margin-bottom: 8px; font-size: 16px;" for="new_password">New
                            Password</label>
                        <input type="password" id="new_password" name="new_password"
                            style="width: 100%; padding: 12px 15px; font-size: 16px; border-radius: 8px; border: 1px solid rgba(255, 255, 255, 0.2); background: rgba(255, 255, 255, 0.1); color: white; outline: none;"
                            required>
                    </div>

                    <div style="margin-bottom: 25px;">
                        <label style="display: block; margin-bottom: 8px; font-size: 16px;"
                            for="new_password_confirmation">Confirm New Password</label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                            style="width: 100%; padding: 12px 15px; font-size: 16px; border-radius: 8px; border: 1px solid rgba(255, 255, 255, 0.2); background: rgba(255, 255, 255, 0.1); color: white; outline: none;"
                            required>
                    </div>

                    <button type="submit"
                        style="padding: 12px 40px; font-size: 16px; font-weight: 500; border-radius: 8px; background: #EEF2FF; color: #151A2D; border: none; cursor: pointer; transition: 0.3s;">
                        Change Password
                    </button>
                </form>
            </div>
        </div>
    </section>

    <style>
        @media (max-width: 768px) {
            section>div>div:first-child>div>div>div {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
</x-layout>