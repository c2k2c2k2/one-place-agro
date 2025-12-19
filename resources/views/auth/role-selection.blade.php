@extends('layouts.app')

@section('title', 'Role Selection - One Place Agro')

@section('content')
<!-- Main Container -->
<div class="relative flex flex-col flex-grow w-full max-w-md mx-auto px-6 pt-8 pb-6 justify-between min-h-screen safe-area-inset-top safe-area-inset-bottom">
    <!-- Header Section -->
    <div class="flex flex-col items-center text-center mt-6">
        <!-- Decorative Icon -->
        <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mb-6 text-primary animate-pulse">
            <span class="material-symbols-outlined text-4xl">sunny</span>
        </div>
        <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight leading-tight mb-3 text-text-main-light dark:text-text-main-dark">
            Welcome!<br/>Who are you?
        </h1>
        <p class="text-text-sub-light dark:text-text-sub-dark text-base font-medium leading-relaxed max-w-[280px]">
            Choose your role to customize your experience.
        </p>
    </div>

    <!-- Role Selection Form -->
    <form id="roleForm" method="GET" action="{{ route('register') }}" class="flex flex-col gap-4 mt-8 flex-grow justify-center">
        <!-- Farmer Option -->
        <label class="relative cursor-pointer group">
            <input 
                type="radio" 
                name="role" 
                value="farmer" 
                class="peer sr-only" 
                checked
            />
            <div class="card-border flex items-center gap-5 p-5 rounded-2xl border-2 border-transparent bg-surface-light dark:bg-surface-dark shadow-soft transition-all duration-300 hover:scale-[1.02]">
                <!-- Icon -->
                <div class="icon-wrapper w-14 h-14 rounded-xl bg-background-light dark:bg-background-dark flex items-center justify-center text-text-sub-light dark:text-text-sub-dark transition-colors duration-300">
                    <span class="material-symbols-outlined text-3xl">agriculture</span>
                </div>
                <!-- Text Content -->
                <div class="flex flex-col flex-grow">
                    <span class="text-lg font-bold text-text-main-light dark:text-text-main-dark">I am a Farmer</span>
                    <span class="text-sm font-medium text-text-sub-light dark:text-text-sub-dark mt-1">Sell harvest & track market prices</span>
                </div>
                <!-- Check Circle Indicator -->
                <div class="check-icon w-6 h-6 rounded-full border-2 border-gray-300 dark:border-gray-600 flex items-center justify-center transition-colors duration-300 bg-transparent">
                    <span class="material-symbols-outlined text-[16px]">check</span>
                </div>
            </div>
        </label>

        <!-- Trader Option -->
        <label class="relative cursor-pointer group">
            <input 
                type="radio" 
                name="role" 
                value="trader" 
                class="peer sr-only"
            />
            <div class="card-border flex items-center gap-5 p-5 rounded-2xl border-2 border-transparent bg-surface-light dark:bg-surface-dark shadow-soft transition-all duration-300 hover:scale-[1.02]">
                <!-- Icon -->
                <div class="icon-wrapper w-14 h-14 rounded-xl bg-background-light dark:bg-background-dark flex items-center justify-center text-text-sub-light dark:text-text-sub-dark transition-colors duration-300">
                    <span class="material-symbols-outlined text-3xl">storefront</span>
                </div>
                <!-- Text Content -->
                <div class="flex flex-col flex-grow">
                    <span class="text-lg font-bold text-text-main-light dark:text-text-main-dark">I am a Trader</span>
                    <span class="text-sm font-medium text-text-sub-light dark:text-text-sub-dark mt-1">Source oranges & connect with growers</span>
                </div>
                <!-- Check Circle Indicator -->
                <div class="check-icon w-6 h-6 rounded-full border-2 border-gray-300 dark:border-gray-600 flex items-center justify-center transition-colors duration-300 bg-transparent">
                    <span class="material-symbols-outlined text-[16px]">check</span>
                </div>
            </div>
        </label>
    </form>

    <!-- Footer / Action Button -->
    <div class="mt-8 mb-4 w-full">
        <button 
            type="submit" 
            form="roleForm"
            class="w-full flex items-center justify-center gap-2 h-14 bg-gradient-to-r from-primary to-[#ffaa2b] hover:from-primary-dark hover:to-primary active:scale-[0.98] text-white dark:text-[#181511] text-lg font-bold rounded-2xl shadow-glow transition-all duration-200"
        >
            <span>Continue</span>
            <span class="material-symbols-outlined text-xl">arrow_forward</span>
        </button>
        
        <!-- Divider -->
        <div class="w-full my-6 flex items-center justify-center gap-4">
            <div class="h-px bg-gray-300 dark:bg-gray-600 flex-1"></div>
            <span class="text-sm text-text-sub-light dark:text-text-sub-dark">or</span>
            <div class="h-px bg-gray-300 dark:bg-gray-600 flex-1"></div>
        </div>

        <!-- Login Link -->
        <div class="text-center mb-4">
            <p class="text-sm text-text-sub-light dark:text-text-sub-dark">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-primary font-bold hover:underline transition-colors">Login</a>
            </p>
        </div>
        
        <p class="text-center text-xs text-text-sub-light dark:text-text-sub-dark mt-4 font-medium">
            By continuing, you agree to our <a class="underline hover:text-primary transition-colors" href="{{ route('terms-of-service') }}">Terms of Service</a>
        </p>
    </div>
</div>

<!-- Background decorative blur element -->
<div class="fixed top-0 left-0 w-full h-64 bg-gradient-to-b from-primary/5 to-transparent pointer-events-none z-0"></div>

@push('styles')
<style>
    /* Custom radio styling adjustments */
    .peer:checked ~ .card-border {
        border-color: #f2930d;
        background-color: rgba(242, 147, 13, 0.05);
    }
    .peer:checked ~ .card-border .check-icon {
        background-color: #f2930d;
        border-color: #f2930d;
        color: white;
    }
    .peer:checked ~ .card-border .icon-wrapper {
        background-color: rgba(242, 147, 13, 0.15);
        color: #f2930d;
    }
</style>
@endpush
@endsection
