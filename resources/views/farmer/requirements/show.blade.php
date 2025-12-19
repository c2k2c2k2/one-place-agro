@extends('layouts.app')

@section('title', 'Requirement Details - One Place Agro')

@section('content')
<div class="relative flex h-full min-h-screen w-full flex-col overflow-x-hidden pb-24 bg-background-light dark:bg-background-dark">
    
    <!-- Header -->
    <x-header title="Requirement Details" :notificationCount="auth()->user()->unreadNotifications->count()" />
    
    <!-- Main Content -->
    <main class="flex flex-col gap-6 p-4 pt-6">
        
        <!-- Back Button -->
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('farmer.requirements.browse') }}" class="flex h-10 w-10 items-center justify-center rounded-full bg-white dark:bg-surface-dark shadow-sm">
                <span class="material-symbols-outlined text-gray-600 dark:text-gray-400">arrow_back</span>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-[#181511] dark:text-white">Requirement Details</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">What this trader is looking for</p>
            </div>
        </div>
        
        <!-- Requirement Details Card -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <!-- Variety Name -->
            <h2 class="text-2xl font-bold text-[#181511] dark:text-white mb-4">{{ $requirement->variety->name }}</h2>
            
            <!-- Key Details Grid -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="flex items-start gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-100 dark:bg-orange-900/30">
                        <span class="material-symbols-outlined text-orange-600 dark:text-orange-400">scale</span>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Quantity Needed</p>
                        <p class="text-lg font-bold text-[#181511] dark:text-white">{{ number_format($requirement->quantity_required, 2) }} tons</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/30">
                        <span class="material-symbols-outlined text-green-600 dark:text-green-400">currency_rupee</span>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Max Budget</p>
                        <p class="text-lg font-bold text-[#181511] dark:text-white">₹{{ number_format($requirement->max_budget) }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">per ton</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-purple-100 dark:bg-purple-900/30">
                        <span class="material-symbols-outlined text-purple-600 dark:text-purple-400">location_on</span>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Location</p>
                        <p class="text-sm font-semibold text-[#181511] dark:text-white">{{ $requirement->location }}</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/30">
                        <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">calendar_today</span>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Posted</p>
                        <p class="text-sm font-semibold text-[#181511] dark:text-white">{{ $requirement->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Total Budget -->
            <div class="bg-primary/10 dark:bg-primary/20 rounded-lg p-4 mb-6">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Total Budget</span>
                    <span class="text-2xl font-bold text-primary">₹{{ number_format($requirement->quantity_required * $requirement->max_budget) }}</span>
                </div>
            </div>
            
            <!-- Description -->
            @if($requirement->description)
            <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mb-6">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Description</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ $requirement->description }}</p>
            </div>
            @endif
            
            <!-- Trader Info -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Posted By</h3>
                <div class="flex items-center gap-3 p-4 bg-gray-50 dark:bg-gray-800/50 rounded-lg">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10 text-primary">
                        <span class="material-symbols-outlined text-2xl">store</span>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-[#181511] dark:text-white">{{ $requirement->trader->name }}</h4>
                        @if($requirement->trader->company_name)
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $requirement->trader->company_name }}</p>
                        @endif
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            <span class="material-symbols-outlined text-xs align-middle">location_on</span>
                            {{ $requirement->trader->location }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Contact Info Card -->
        <div class="rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 p-6">
            <div class="flex gap-3">
                <span class="material-symbols-outlined text-green-600 dark:text-green-400">phone</span>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-green-900 dark:text-green-300 mb-2">Interested in this requirement?</p>
                    <p class="text-xs text-green-800 dark:text-green-400 mb-3">
                        If you have matching produce, contact the trader directly to discuss the deal.
                    </p>
                    @if($requirement->trader->phone)
                    <a href="tel:{{ $requirement->trader->phone }}" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition text-sm">
                        <span class="material-symbols-outlined text-sm">call</span>
                        <span>Call Trader</span>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        
    </main>
    
    <!-- Bottom Navigation -->
    <x-bottom-nav active="market" />
    
</div>
@endsection
