@extends('layouts.app')

@section('title', 'Login - One Place Agro')

@section('content')
<div class="w-full max-w-md mx-auto bg-background-light dark:bg-surface-dark shadow-xl overflow-y-auto min-h-screen sm:min-h-0 sm:rounded-[2rem] relative flex flex-col">
   

    <!-- Hero Image Section -->
    <div class="relative h-2/5 w-full">
        <img 
            alt="Vibrant orange grove under sunlight" 
            class="w-full h-full object-cover rounded-b-[2rem] shadow-lg" 
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCXTx0mVNNVU8XaKu2E4ja9mlFqCZXsIB6b8gLzn2w-7HOG2D5ecpd878SibzyEuzvSpT_2Wz8pISU0WxERTxEIqkSy7ZMKDbs3ayG_d-nThyusGKRje9n7I8cWpuA4re51xOgH-Gz2vwdfSI-rC4C_QHkYj20DYV9TI_jDAriIol3AIW0MZ4shLPgGiS_7ToPdps_sD8IyO1PAJM6N0IbjS2AvSva5nKXlr4guKQUr9tdVoiZe6evRk11xKEhEN7thQ4wu5LImUAY"
        />
        <div class="absolute inset-0 bg-gradient-to-b from-black/20 to-transparent rounded-b-[2rem]"></div>
    </div>

    <!-- Login Form Section -->
    <div class="flex-1 flex flex-col items-center px-6 pt-8 pb-6">
        <!-- Logo & Branding -->
        <div class="mb-6 flex flex-col items-center">
            <div class="flex items-center gap-2 mb-2">
                <span class="text-3xl font-extrabold text-secondary-green dark:text-green-400 tracking-tight">One Place</span>
                <div class="relative w-8 h-8 bg-gradient-to-r from-primary to-orange-400 rounded-full shadow-md flex items-center justify-center">
                    <span class="material-symbols-outlined text-secondary-green absolute -top-1 -right-1 text-xs transform rotate-45">eco</span>
                </div>
            </div>
            <p class="text-primary font-bold text-sm tracking-wide uppercase">Best Solution for Farmers!</p>
        </div>

        <!-- Welcome Text -->
        <h1 class="text-2xl font-bold text-center text-text-main-light dark:text-white mb-8 leading-tight">
            Welcome to India's #1 <br/>
            <span class="bg-gradient-to-r from-primary to-orange-400 bg-clip-text text-transparent">Orange Farmer Connect App</span>
        </h1>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="w-full space-y-5">
            @csrf

            <div class="relative">
                <div class="absolute inset-0 flex items-center justify-center -z-10">
                    <span class="bg-surface-light dark:bg-surface-dark px-2 text-xs text-gray-400">Log in with mobile</span>
                </div>
                <div class="border-t border-[#e6e1db] dark:border-white/10 w-full"></div>
            </div>

            <!-- Mobile Number Input -->
            <div class="flex flex-col gap-2">
                <label class="text-sm font-semibold text-text-main-light dark:text-white">Mobile Number</label>
                <input 
                    type="tel" 
                    name="mobile" 
                    value="{{ old('mobile') }}"
                    class="block w-full rounded-xl border-[#e6e1db] dark:border-white/10 bg-white dark:bg-surface-dark text-text-main-light dark:text-white placeholder-gray-400 focus:border-primary focus:ring-primary py-3 px-4 text-base shadow-sm @error('mobile') border-red-500 @enderror" 
                    placeholder="Enter 10-digit mobile number"
                    maxlength="10"
                    pattern="[0-9]{10}"
                    required
                />
                @error('mobile')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password Input -->
            <div class="flex flex-col gap-2">
                <label class="text-sm font-semibold text-text-main-light dark:text-white">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    class="block w-full rounded-xl border-[#e6e1db] dark:border-white/10 bg-white dark:bg-surface-dark text-text-main-light dark:text-white placeholder-gray-400 focus:border-primary focus:ring-primary py-3 px-4 text-base shadow-sm @error('password') border-red-500 @enderror" 
                    placeholder="Enter your password"
                    required
                />
                @error('password')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me Checkbox -->
            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2">
                    <input 
                        type="checkbox" 
                        name="remember" 
                        class="rounded border-gray-300 text-primary focus:ring-primary"
                    />
                    <span class="text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                </label>
                <a href="#" class="text-sm text-primary font-semibold hover:underline">Forgot Password?</a>
            </div>

            <!-- Login Button -->
            <button 
                type="submit"
                class="w-full py-3.5 px-4 rounded-xl shadow-lg bg-gradient-to-r from-primary to-orange-400 text-white font-bold text-lg transform transition active:scale-[0.98] hover:shadow-orange-500/30"
            >
                Login
            </button>
        </form>

        <div class="flex-grow"></div>

        <!-- Divider -->
        <div class="w-full my-6 flex items-center justify-center gap-4">
            <div class="h-px bg-[#e6e1db] dark:bg-white/10 flex-1"></div>
            <span class="text-sm text-gray-400">or</span>
            <div class="h-px bg-[#e6e1db] dark:bg-white/10 flex-1"></div>
        </div>

        <!-- Sign Up Link -->
        <div class="text-center mb-6">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Don't have an account? 
                <a href="{{ route('role.selection') }}" class="text-primary font-bold hover:underline">Sign Up</a>
            </p>
        </div>

        <!-- Terms & Privacy -->
        <div class="text-center space-y-1">
            <p class="text-xs text-gray-500 dark:text-gray-400">By continuing you agree to our</p>
            <div class="text-xs flex gap-3 justify-center text-gray-600 dark:text-gray-300 font-medium">
                <a class="hover:underline" href="{{ route('terms-of-service') }}">Terms of Service</a>
                <a class="hover:underline" href="{{ route('privacy-policy') }}">Privacy Policy</a>
                <a class="hover:underline" href="{{ route('content-policy') }}">Content Policy</a>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
<style>
    .bg-gradient-citrus {
        background: linear-gradient(135deg, #FF8C00 0%, #FFA500 100%);
    }
</style>
@endpush
@endsection
