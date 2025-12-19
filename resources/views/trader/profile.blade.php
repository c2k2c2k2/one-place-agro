@extends('layouts.app')

@section('title', 'My Profile - One Place Agro')

@section('content')
<div class="relative flex h-full min-h-screen w-full flex-col overflow-x-hidden pb-24 bg-background-light dark:bg-background-dark">
    
    <!-- Header -->
    <x-header title="My Profile" :notificationCount="auth()->user()->unreadNotifications->count()" />
    
    <!-- Main Content -->
    <main class="flex flex-col gap-6 p-4 pt-6">
        
        <!-- Page Title -->
        <div>
            <h1 class="text-2xl font-bold text-[#181511] dark:text-white">My Profile</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Manage your account information</p>
        </div>
        
        <!-- Success/Error Messages -->
        @if(session('success'))
        <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
            <div class="flex gap-3">
                <span class="material-symbols-outlined text-green-600 dark:text-green-400">check_circle</span>
                <p class="text-sm text-green-800 dark:text-green-300">{{ session('success') }}</p>
            </div>
        </div>
        @endif
        
        <!-- Profile Picture -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <div class="flex items-center gap-4">
                <div class="relative">
                    @if($trader->avatar)
                    <img src="{{ asset('storage/' . $trader->avatar) }}" alt="{{ $trader->name }}" class="w-20 h-20 rounded-full object-cover">
                    @else
                    <div class="w-20 h-20 rounded-full bg-primary/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary text-4xl">person</span>
                    </div>
                    @endif
                    <div class="absolute bottom-0 right-0 w-6 h-6 bg-green-500 rounded-full border-2 border-white dark:border-surface-dark"></div>
                </div>
                <div class="flex-1">
                    <h2 class="text-xl font-bold text-[#181511] dark:text-white">{{ $trader->name }}</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Trader</p>
                    @if($trader->company_name)
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $trader->company_name }}</p>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Profile Form -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <h3 class="text-lg font-bold text-[#181511] dark:text-white mb-4">Personal Information</h3>
            
            <form action="{{ route('trader.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Avatar Upload -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Profile Picture
                    </label>
                    <input
                        type="file"
                        name="avatar"
                        accept="image/jpeg,image/png,image/jpg"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-[#181511] dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent"
                    >
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">JPG, PNG. Max 2MB</p>
                    @error('avatar')
                    <p class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Name -->
                <x-form.input
                    name="name"
                    label="Full Name"
                    type="text"
                    :value="$trader->name"
                    placeholder="Enter your full name"
                    required
                />
                
                <!-- Company Name -->
                <x-form.input
                    name="company_name"
                    label="Company Name (Optional)"
                    type="text"
                    :value="$trader->company_name"
                    placeholder="Enter your company name"
                />
                
                <!-- Email -->
                <x-form.input
                    name="email"
                    label="Email Address"
                    type="email"
                    :value="$trader->email"
                    placeholder="Enter your email"
                />
                
                <!-- Phone -->
                <x-form.input
                    name="phone"
                    label="Phone Number"
                    type="tel"
                    :value="$trader->phone"
                    placeholder="Enter your phone number"
                />
                
                <!-- Location -->
                <x-form.input
                    name="location"
                    label="Location"
                    type="text"
                    :value="$trader->location"
                    placeholder="City, State"
                    required
                />
                
                <!-- Submit Button -->
                <button type="submit" class="w-full px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition shadow-sm">
                    <span class="flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">save</span>
                        <span>Save Changes</span>
                    </span>
                </button>
            </form>
        </div>
        
        <!-- Account Statistics -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <h3 class="text-lg font-bold text-[#181511] dark:text-white mb-4">Account Statistics</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">gavel</span>
                        <div>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Total Bids</p>
                            <p class="text-lg font-bold text-[#181511] dark:text-white">{{ $trader->bids()->count() }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-green-600 dark:text-green-400">check_circle</span>
                        <div>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Accepted</p>
                            <p class="text-lg font-bold text-[#181511] dark:text-white">{{ $trader->bids()->accepted()->count() }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-purple-50 dark:bg-purple-900/20 rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-purple-600 dark:text-purple-400">list_alt</span>
                        <div>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Requirements</p>
                            <p class="text-lg font-bold text-[#181511] dark:text-white">{{ $trader->requirements()->count() }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-orange-50 dark:bg-orange-900/20 rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-orange-600 dark:text-orange-400">calendar_today</span>
                        <div>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Member Since</p>
                            <p class="text-xs font-bold text-[#181511] dark:text-white">{{ $trader->created_at->format('M Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Account Settings -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <h3 class="text-lg font-bold text-[#181511] dark:text-white mb-4">Account Settings</h3>
            <div class="space-y-3">
                <button class="w-full flex items-center justify-between p-4 rounded-lg bg-gray-50 dark:bg-gray-800/50 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-gray-600 dark:text-gray-400">lock</span>
                        <span class="font-semibold text-[#181511] dark:text-white">Change Password</span>
                    </div>
                    <span class="material-symbols-outlined text-gray-400">chevron_right</span>
                </button>
                
                <button class="w-full flex items-center justify-between p-4 rounded-lg bg-gray-50 dark:bg-gray-800/50 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-gray-600 dark:text-gray-400">notifications</span>
                        <span class="font-semibold text-[#181511] dark:text-white">Notification Settings</span>
                    </div>
                    <span class="material-symbols-outlined text-gray-400">chevron_right</span>
                </button>
                
                <button class="w-full flex items-center justify-between p-4 rounded-lg bg-gray-50 dark:bg-gray-800/50 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-gray-600 dark:text-gray-400">help</span>
                        <span class="font-semibold text-[#181511] dark:text-white">Help & Support</span>
                    </div>
                    <span class="material-symbols-outlined text-gray-400">chevron_right</span>
                </button>
            </div>
        </div>
        
        <!-- Logout -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full px-6 py-3 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-lg font-semibold hover:bg-red-200 dark:hover:bg-red-900/50 transition">
                    <span class="flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">logout</span>
                        <span>Logout</span>
                    </span>
                </button>
            </form>
        </div>
        
    </main>
    
    <!-- Bottom Navigation -->
    <x-bottom-nav active="profile" />
    
</div>
@endsection
