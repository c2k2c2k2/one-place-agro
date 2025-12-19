@extends('layouts.app')

@section('title', 'Register - One Place Agro')

@section('content')
<!-- Top Navigation Bar -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-background-light/95 dark:bg-background-dark/95 backdrop-blur-md border-b border-[#e6e1db] dark:border-orange-900/20">
    <div class="flex items-center p-4 justify-between max-w-[480px] mx-auto w-full">
        <a href="{{ route('role.selection') }}" class="text-[#181511] dark:text-white flex size-10 shrink-0 items-center justify-center rounded-full hover:bg-black/5 dark:hover:bg-white/10 transition-colors active:scale-95">
            <span class="material-symbols-outlined">arrow_back_ios_new</span>
        </a>
        <h2 class="text-[#181511] dark:text-white text-lg font-bold leading-tight tracking-tight">
            Register as {{ ucfirst($role) }}
        </h2>
        <div class="size-10"></div>
    </div>
</nav>

<!-- Main Content Container -->
<main class="relative pt-24 pb-32 px-4 w-full max-w-[480px] mx-auto flex flex-col gap-6">
    <!-- Progress/Header Section -->
    <div class="flex flex-col gap-1">
        <div class="flex items-center gap-2 mb-1">
            <span class="h-1.5 w-8 rounded-full bg-primary"></span>
            <span class="h-1.5 w-8 rounded-full bg-[#e6e1db] dark:bg-white/10"></span>
        </div>
        <h1 class="text-2xl font-extrabold text-[#181511] dark:text-white tracking-tight">
            {{ $role === 'farmer' ? 'Farmer Details' : 'Company Details' }}
        </h1>
        <p class="text-base font-medium text-gray-500 dark:text-gray-400">
            {{ $role === 'farmer' ? "Let's get your orange grove on the map." : "Join the largest network of citrus traders." }}
        </p>
    </div>

    <!-- Registration Form -->
    <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-5">
        @csrf
        <input type="hidden" name="role" value="{{ $role }}">

        <!-- Personal Information Card -->
        <div class="flex flex-col gap-5 p-5 bg-white dark:bg-[#2c241b] rounded-2xl shadow-soft border border-[#e6e1db]/60 dark:border-white/5">
            <div class="flex items-center gap-3 border-b border-[#f0ebe5] dark:border-white/5 pb-3">
                <div class="size-8 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined text-[20px]">person</span>
                </div>
                <h3 class="font-bold text-[#181511] dark:text-white">Personal Info</h3>
            </div>

            <!-- Full Name Input -->
            <label class="flex flex-col w-full">
                <p class="text-[#181511] dark:text-gray-200 text-sm font-semibold mb-2">Full Name</p>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ old('name') }}"
                    class="form-input flex w-full rounded-xl text-[#181511] dark:text-white dark:bg-black/20 focus:outline-0 focus:ring-2 focus:ring-primary/20 border border-[#e6e1db] dark:border-white/10 bg-[#fbfaf9] focus:border-primary h-12 placeholder:text-[#8a7960] dark:placeholder:text-gray-500 px-4 text-base transition-all @error('name') border-red-500 @enderror" 
                    placeholder="Enter your full name"
                    required
                />
                @error('name')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </label>

            <!-- Mobile Number Input -->
            <label class="flex flex-col w-full">
                <p class="text-[#181511] dark:text-gray-200 text-sm font-semibold mb-2">Mobile Number</p>
                <input 
                    type="tel" 
                    name="mobile" 
                    value="{{ old('mobile') }}"
                    class="form-input flex w-full rounded-xl text-[#181511] dark:text-white dark:bg-black/20 focus:outline-0 focus:ring-2 focus:ring-primary/20 border border-[#e6e1db] dark:border-white/10 bg-[#fbfaf9] focus:border-primary h-12 placeholder:text-[#8a7960] dark:placeholder:text-gray-500 px-4 text-base transition-all @error('mobile') border-red-500 @enderror" 
                    placeholder="10-digit mobile number"
                    maxlength="10"
                    pattern="[0-9]{10}"
                    required
                />
                @error('mobile')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </label>

            <!-- Password Input -->
            <label class="flex flex-col w-full">
                <p class="text-[#181511] dark:text-gray-200 text-sm font-semibold mb-2">Password</p>
                <input 
                    type="password" 
                    name="password" 
                    class="form-input flex w-full rounded-xl text-[#181511] dark:text-white dark:bg-black/20 focus:outline-0 focus:ring-2 focus:ring-primary/20 border border-[#e6e1db] dark:border-white/10 bg-[#fbfaf9] focus:border-primary h-12 placeholder:text-[#8a7960] dark:placeholder:text-gray-500 px-4 text-base transition-all @error('password') border-red-500 @enderror" 
                    placeholder="Minimum 8 characters"
                    required
                />
                @error('password')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </label>

            <!-- Confirm Password Input -->
            <label class="flex flex-col w-full">
                <p class="text-[#181511] dark:text-gray-200 text-sm font-semibold mb-2">Confirm Password</p>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    class="form-input flex w-full rounded-xl text-[#181511] dark:text-white dark:bg-black/20 focus:outline-0 focus:ring-2 focus:ring-primary/20 border border-[#e6e1db] dark:border-white/10 bg-[#fbfaf9] focus:border-primary h-12 placeholder:text-[#8a7960] dark:placeholder:text-gray-500 px-4 text-base transition-all" 
                    placeholder="Re-enter password"
                    required
                />
            </label>

            <!-- Email Input (Optional) -->
            <label class="flex flex-col w-full">
                <p class="text-[#181511] dark:text-gray-200 text-sm font-semibold mb-2">
                    Email Address <span class="text-xs text-gray-400 font-normal">(Optional)</span>
                </p>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    class="form-input flex w-full rounded-xl text-[#181511] dark:text-white dark:bg-black/20 focus:outline-0 focus:ring-2 focus:ring-primary/20 border border-[#e6e1db] dark:border-white/10 bg-[#fbfaf9] focus:border-primary h-12 placeholder:text-[#8a7960] dark:placeholder:text-gray-500 px-4 text-base transition-all @error('email') border-red-500 @enderror" 
                    placeholder="name@example.com"
                />
                @error('email')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </label>

            <!-- Location Input -->
            <label class="flex flex-col w-full">
                <p class="text-[#181511] dark:text-gray-200 text-sm font-semibold mb-2">
                    {{ $role === 'farmer' ? 'Farm Location' : 'Business Location' }}
                </p>
                <input 
                    type="text" 
                    name="location" 
                    value="{{ old('location') }}"
                    class="form-input flex w-full rounded-xl text-[#181511] dark:text-white dark:bg-black/20 focus:outline-0 focus:ring-2 focus:ring-primary/20 border border-[#e6e1db] dark:border-white/10 bg-[#fbfaf9] focus:border-primary h-12 placeholder:text-[#8a7960] dark:placeholder:text-gray-500 px-4 text-base transition-all @error('location') border-red-500 @enderror" 
                    placeholder="Enter city or region"
                    required
                />
                @error('location')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </label>

            <!-- Company Name (Trader Only) -->
            @if($role === 'trader')
            <label class="flex flex-col w-full">
                <p class="text-[#181511] dark:text-gray-200 text-sm font-semibold mb-2">Company Name</p>
                <input 
                    type="text" 
                    name="company_name" 
                    value="{{ old('company_name') }}"
                    class="form-input flex w-full rounded-xl text-[#181511] dark:text-white dark:bg-black/20 focus:outline-0 focus:ring-2 focus:ring-primary/20 border border-[#e6e1db] dark:border-white/10 bg-[#fbfaf9] focus:border-primary h-12 placeholder:text-[#8a7960] dark:placeholder:text-gray-500 px-4 text-base transition-all @error('company_name') border-red-500 @enderror" 
                    placeholder="e.g. Sunshine Logistics Ltd."
                    required
                />
                @error('company_name')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </label>
            @endif
        </div>

        <!-- Footer / CTA -->
        <div class="mt-4 flex flex-col gap-4">
            <p class="text-xs text-center text-gray-500 dark:text-gray-400">
                By tapping Register, you agree to our 
                <a class="text-primary font-bold hover:underline" href="{{ route('terms-of-service') }}">Terms of Service</a> & 
                <a class="text-primary font-bold hover:underline" href="{{ route('privacy-policy') }}">Privacy Policy</a>
            </p>
            <button 
                type="submit"
                class="w-full h-14 rounded-xl bg-gradient-to-r from-primary to-orange-400 text-white font-bold text-lg shadow-lg shadow-orange-500/30 active:scale-[0.98] active:shadow-sm transition-all flex items-center justify-center gap-2"
            >
                <span>Complete Registration</span>
                <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
            </button>
            
            <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">Login</a>
            </p>
        </div>
    </form>
</main>
@endsection
