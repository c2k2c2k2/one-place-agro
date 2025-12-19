@extends('layouts.app')

@section('title', 'Requirement Details - One Place Agro')

@section('content')
<div class="relative flex h-full min-h-screen w-full flex-col overflow-x-hidden pb-24 bg-background-light dark:bg-background-dark">
    
    <!-- Header -->
    <x-header title="Requirement Details" :notificationCount="auth()->user()->unreadNotifications->count()" />
    
    <!-- Main Content -->
    <main class="flex flex-col gap-6 p-4 pt-6">
        
        <!-- Back Button & Actions -->
        <div class="flex items-center justify-between mb-2">
            <a href="{{ route('trader.requirements.index') }}" class="flex h-10 w-10 items-center justify-center rounded-full bg-white dark:bg-surface-dark shadow-sm">
                <span class="material-symbols-outlined text-gray-600 dark:text-gray-400">arrow_back</span>
            </a>
            <div class="flex gap-2">
                <a href="{{ route('trader.requirements.edit', $requirement) }}" class="flex h-10 w-10 items-center justify-center rounded-full bg-primary text-white shadow-sm hover:bg-primary-dark transition">
                    <span class="material-symbols-outlined">edit</span>
                </a>
                <form action="{{ route('trader.requirements.destroy', $requirement) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this requirement?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="flex h-10 w-10 items-center justify-center rounded-full bg-red-500 text-white shadow-sm hover:bg-red-600 transition">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </form>
            </div>
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
        
        <!-- Requirement Details Card -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <!-- Status Badge & Toggle -->
            <div class="flex items-center justify-between mb-4">
                <div>
                    @if($requirement->is_active)
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400">
                        <span class="material-symbols-outlined text-sm">check_circle</span>
                        Active
                    </span>
                    @else
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-400">
                        <span class="material-symbols-outlined text-sm">pause_circle</span>
                        Inactive
                    </span>
                    @endif
                </div>
                
                <form action="{{ route('trader.requirements.toggle', $requirement) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-lg text-sm font-semibold transition {{ $requirement->is_active ? 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600' : 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 hover:bg-green-200 dark:hover:bg-green-900/50' }}">
                        {{ $requirement->is_active ? 'Mark Inactive' : 'Mark Active' }}
                    </button>
                </form>
            </div>
            
            <!-- Variety Name -->
            <h2 class="text-2xl font-bold text-[#181511] dark:text-white mb-4">{{ $requirement->variety->name }}</h2>
            
            <!-- Key Details Grid -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="flex items-start gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-100 dark:bg-orange-900/30">
                        <span class="material-symbols-outlined text-orange-600 dark:text-orange-400">scale</span>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Quantity Required</p>
                        <p class="text-lg font-bold text-[#181511] dark:text-white">{{ number_format($requirement->quantity_required, 2) }} tons</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/30">
                        <span class="material-symbols-outlined text-green-600 dark:text-green-400">currency_rupee</span>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Maximum Budget</p>
                        <p class="text-lg font-bold text-[#181511] dark:text-white">₹{{ number_format($requirement->max_budget) }}</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-3 col-span-2">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-purple-100 dark:bg-purple-900/30">
                        <span class="material-symbols-outlined text-purple-600 dark:text-purple-400">location_on</span>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Delivery Location</p>
                        <p class="text-sm font-semibold text-[#181511] dark:text-white">{{ $requirement->location }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Description -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Additional Details</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ $requirement->description }}</p>
            </div>
            
            <!-- Posted Date -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-4">
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    Posted on {{ $requirement->created_at->format('d M Y, h:i A') }}
                </p>
                @if($requirement->updated_at != $requirement->created_at)
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    Last updated {{ $requirement->updated_at->diffForHumans() }}
                </p>
                @endif
            </div>
        </div>
        
        <!-- Matching Yields (if any) -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <h3 class="text-lg font-bold text-[#181511] dark:text-white mb-4">Potentially Matching Yields</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                Browse yields that might match your requirement
            </p>
            <a href="{{ route('trader.yields.browse', ['variety_id' => $requirement->variety_id]) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition">
                <span class="material-symbols-outlined">search</span>
                <span>Browse {{ $requirement->variety->name }} Yields</span>
            </a>
        </div>
        
        <!-- Contact Information -->
        <div class="rounded-xl bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 p-6">
            <div class="flex gap-3">
                <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">info</span>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-blue-900 dark:text-blue-300 mb-2">Farmers can see this requirement</p>
                    <p class="text-xs text-blue-800 dark:text-blue-400">
                        Farmers browsing requirements will be able to see your contact details and reach out to you directly if they have matching produce.
                    </p>
                </div>
            </div>
        </div>
        
    </main>
    
    <!-- Bottom Navigation -->
    <x-bottom-nav active="home" />
    
</div>
@endsection
