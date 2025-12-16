<x-layout title="Profile - Invoice System">
    <div class="page-container">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>My Profile</h1>
                <p>View and manage your account information</p>
            </div>
        </div>

        <!-- Profile Card -->
        <div class="profile-container">
            <div class="profile-card">
                <div class="profile-avatar-large">
                    {{-- {{ strtoupper(substr(Auth::user()->name, 0, 2)) }} --}}
                    {{ strtoupper(substr( auth()->user()->name, 0, 2)) }}
                </div>

                <div class="profile-info">
                    {{-- <h2>{{ Auth::user()->name }}</h2> --}}
                    <h2>{{ auth()->user()->name }}</h2>
                    <p class="profile-role">System Administrator</p>
                </div>

                <div class="profile-details">
                    <div class="detail-item">
                        <span class="material-symbols-rounded">person</span>
                        <div>
                            <label>Username</label>
                            {{-- <p>{{ Auth::user()->username }}</p> --}}
                            <p>{{ auth()->user()->username }}</p>
                        </div>
                    </div>

                    <div class="detail-item">
                        <span class="material-symbols-rounded">mail</span>
                        <div>
                            <label>Email</label>
                            {{-- <p>{{ Auth::user()->email }}</p> --}}
                            <p>{{ auth()->user()->email }}</p>
                        </div>
                    </div>

                    <div class="detail-item">
                        <span class="material-symbols-rounded">phone</span>
                        <div>
                            <label>Phone</label>
                            {{-- <p>{{ Auth::user()->phone ?? 'Not provided' }}</p> --}}
                            <p>{{ auth()->user()->phone ?? 'Not provided' }}</p>
                        </div>
                    </div>

                    <div class="detail-item">
                        <span class="material-symbols-rounded">calendar_today</span>
                        <div>
                            <label>Member Since</label>
                            {{-- <p>{{ Auth::user()->created_at->format('F d, Y') }}</p> --}}
                            <p>{{ auth()->user()->created_at->format('F d, Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="profile-actions">
                    {{-- <a href="{{ route('users.edit', Auth::user()->id) }}" class="btn-primary"> --}}
                    <a href="{{ route('users.edit', auth()->user()->id) }}" class="btn-primary">
                        <span class="material-symbols-rounded">edit</span>
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout>