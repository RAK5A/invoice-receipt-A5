<x-layout title="Profile - Invoice System" :navbar="true">
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
                    {{ strtoupper(substr( auth()->user()->name, 0, 2)) }}
                </div>
                
                <div class="profile-info">
                    <h2>{{ auth()->user()->name }}</h2>
                    <p class="profile-role">System Administrator</p>
                </div>
                
                <div class="profile-details">
                    <div class="detail-item">
                        <span class="material-symbols-rounded">badge</span>
                        <div>
                            <label>Full Name</label>
                            <p>{{ auth()->user()->name }}</p>
                        </div>
                    </div>

                    <div class="detail-item">
                        <span class="material-symbols-rounded">person</span>
                        <div>
                            <label>Username</label>
                            <p>{{ auth()->user()->username }}</p>
                        </div>
                    </div>
                    
                    <div class="detail-item">
                        <span class="material-symbols-rounded">mail</span>
                        <div>
                            <label>Email</label>
                            <p>{{ auth()->user()->email }}</p>
                        </div>
                    </div>

                    <div class="detail-item">
                        <span class="material-symbols-rounded">phone</span>
                        <div>
                            <label>Phone</label>
                            <p>{{ auth()->user()->phone ?? 'N/A' }}</p>
                        </div>
                    </div>
                    
                    <div class="detail-item">
                        <span class="material-symbols-rounded">admin_panel_settings</span>
                        <div>
                            <label>Role</label>
                            <p>{{ ucfirst(auth()->user()->role) }}</p>
                        </div>
                    </div>

                    <div class="detail-item">
                        <span class="material-symbols-rounded">calendar_today</span>
                        <div>
                            <label>Member Since</label>
                            <p>{{ auth()->user()->created_at->format('F d, Y') }}</p>
                        </div>
                    </div>
                </div>

                @if (auth()->user()->isAdmin())
                <div class="profile-actions">
                    <a href="{{ route('users.edit', auth()->user()->id) }}" class="btn-primary">
                        <span class="material-symbols-rounded">edit</span>
                        Edit Profile
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>