@extends('layouts.app')

@section('title', 'My Bids - One Place Agro')

@section('content')
<div class="relative flex h-full min-h-screen w-full flex-col overflow-x-hidden pb-24 bg-background-light dark:bg-background-dark">
    
    <!-- Header -->
    <x-header title="My Bids" :notificationCount="auth()->user()->unreadNotifications->count()" />
    
    <!-- Main Content -->
    <main class="flex flex-col gap-6 p-4 pt-6">
        
        <!-- Page Title -->
        <div>
            <h1 class="text-2xl font-bold text-[#181511] dark:text-white">My Bids</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Track all your placed bids</p>
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
        
        <!-- Filter Tabs -->
        <div class="flex gap-2 overflow-x-auto pb-2">
            <a href="{{ route('trader.bids.index') }}" class="px-4 py-2 rounded-lg font-semibold text-sm whitespace-nowrap transition {{ !request('status') ? 'bg-primary text-white' : 'bg-white dark:bg-surface-dark text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                All ({{ $bids->total() }})
            </a>
            <a href="{{ route('trader.bids.index', ['status' => 'pending']) }}" class="px-4 py-2 rounded-lg font-semibold text-sm whitespace-nowrap transition {{ request('status') === 'pending' ? 'bg-primary text-white' : 'bg-white dark:bg-surface-dark text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                Pending
            </a>
            <a href="{{ route('trader.bids.index', ['status' => 'accepted']) }}" class="px-4 py-2 rounded-lg font-semibold text-sm whitespace-nowrap transition {{ request('status') === 'accepted' ? 'bg-primary text-white' : 'bg-white dark:bg-surface-dark text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                Accepted
            </a>
            <a href="{{ route('trader.bids.index', ['status' => 'rejected']) }}" class="px-4 py-2 rounded-lg font-semibold text-sm whitespace-nowrap transition {{ request('status') === 'rejected' ? 'bg-primary text-white' : 'bg-white dark:bg-surface-dark text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                Rejected
            </a>
        </div>
        
        <!-- Bids List -->
        @if($bids->count() > 0)
        <div class="space-y-4">
            @foreach($bids as $bid)
            <x-bid-card :bid="$bid" :showActions="$bid->status === 'pending'" viewType="trader" />
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($bids->hasPages())
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-4">
            {{ $bids->links() }}
        </div>
        @endif
        @else
        <!-- Empty State -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-12 text-center">
            <div class="flex justify-center mb-4">
                <div class="flex h-20 w-20 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                    <span class="material-symbols-outlined text-4xl text-gray-400">gavel</span>
                </div>
            </div>
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">
                @if(request('status'))
                    No {{ ucfirst(request('status')) }} Bids
                @else
                    No Bids Yet
                @endif
            </h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                @if(request('status'))
                    You don't have any {{ request('status') }} bids at the moment.
                @else
                    Start browsing yields and place your first bid to get started.
                @endif
            </p>
            <a href="{{ route('trader.yields.browse') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition shadow-sm">
                <span class="material-symbols-outlined">search</span>
                <span>Browse Yields</span>
            </a>
        </div>
        @endif
        
        <!-- Info Card -->
        <div class="rounded-xl bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 p-6">
            <div class="flex gap-3">
                <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">info</span>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-blue-900 dark:text-blue-300 mb-2">About Bids</p>
                    <ul class="text-xs text-blue-800 dark:text-blue-400 space-y-1 list-disc list-inside">
                        <li><strong>Pending:</strong> Waiting for farmer's response</li>
                        <li><strong>Accepted:</strong> Farmer accepted your bid - proceed with transaction</li>
                        <li><strong>Rejected:</strong> Farmer declined your bid</li>
                        <li>You can update pending bids or cancel them if needed</li>
                    </ul>
                </div>
            </div>
        </div>
        
    </main>
    
    <!-- Bottom Navigation -->
    <x-bottom-nav active="home" />
    
</div>
@endsection
