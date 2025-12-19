@extends('layouts.app')

@section('title', 'My Yields - One Place Agro')

@section('content')
<div class="relative flex h-full min-h-screen w-full flex-col overflow-x-hidden pb-24 bg-background-light dark:bg-background-dark">
    
    <!-- Header -->
    <x-header title="My Yields" :notificationCount="auth()->user()->unreadNotifications->count()" />
    
    <!-- Main Content -->
    <main class="flex flex-col gap-6 p-4 pt-6">
        
        <!-- Page Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-[#181511] dark:text-white">My Yields</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Manage your crop listings</p>
            </div>
            <a href="{{ route('farmer.yields.create') }}" class="flex h-12 w-12 items-center justify-center rounded-full bg-primary text-white shadow-lg hover:scale-105 transition">
                <span class="material-symbols-outlined">add</span>
            </a>
        </div>
        
        <!-- Filter Tabs -->
        <div class="flex gap-2 overflow-x-auto pb-2">
            <a href="{{ route('farmer.yields.index') }}" class="px-4 py-2 rounded-full text-sm font-semibold whitespace-nowrap {{ !request('status') ? 'bg-primary text-white' : 'bg-white dark:bg-surface-dark text-gray-700 dark:text-gray-300' }} transition">
                All ({{ $stats['total'] }})
            </a>
            <a href="{{ route('farmer.yields.index', ['status' => 'active']) }}" class="px-4 py-2 rounded-full text-sm font-semibold whitespace-nowrap {{ request('status') === 'active' ? 'bg-primary text-white' : 'bg-white dark:bg-surface-dark text-gray-700 dark:text-gray-300' }} transition">
                Active ({{ $stats['active'] }})
            </a>
            <a href="{{ route('farmer.yields.index', ['status' => 'sold']) }}" class="px-4 py-2 rounded-full text-sm font-semibold whitespace-nowrap {{ request('status') === 'sold' ? 'bg-primary text-white' : 'bg-white dark:bg-surface-dark text-gray-700 dark:text-gray-300' }} transition">
                Sold ({{ $stats['sold'] }})
            </a>
            <a href="{{ route('farmer.yields.index', ['status' => 'expired']) }}" class="px-4 py-2 rounded-full text-sm font-semibold whitespace-nowrap {{ request('status') === 'expired' ? 'bg-primary text-white' : 'bg-white dark:bg-surface-dark text-gray-700 dark:text-gray-300' }} transition">
                Expired ({{ $stats['expired'] }})
            </a>
        </div>
        
        <!-- Yields List -->
        @if($yields->count() > 0)
            <div class="grid grid-cols-1 gap-4">
                @foreach($yields as $yield)
                    <x-yield-card :yield="$yield" :showActions="true" />
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($yields->hasPages())
                <div class="mt-4">
                    {{ $yields->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="flex flex-col items-center justify-center py-12 px-4">
                <div class="w-24 h-24 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-5xl text-gray-400">inventory_2</span>
                </div>
                <h3 class="text-lg font-bold text-[#181511] dark:text-white mb-2">
                    @if(request('status'))
                        No {{ request('status') }} yields found
                    @else
                        No yields yet
                    @endif
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 text-center mb-6">
                    @if(request('status'))
                        You don't have any {{ request('status') }} yields at the moment.
                    @else
                        Start by adding your first crop listing to connect with traders.
                    @endif
                </p>
                <a href="{{ route('farmer.yields.create') }}" class="px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition">
                    <span class="flex items-center gap-2">
                        <span class="material-symbols-outlined">add</span>
                        <span>Add Your First Yield</span>
                    </span>
                </a>
            </div>
        @endif
        
    </main>
    
    <!-- Bottom Navigation -->
    <x-bottom-nav active="home" />
    
</div>
@endsection
