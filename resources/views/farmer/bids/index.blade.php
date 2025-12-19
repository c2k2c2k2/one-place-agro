@extends('layouts.app')

@section('title', 'Bids on My Yields - One Place Agro')

@section('content')
<div class="relative flex h-full min-h-screen w-full flex-col overflow-x-hidden pb-24 bg-background-light dark:bg-background-dark">
    
    <!-- Header -->
    <x-header title="Bids" :notificationCount="auth()->user()->unreadNotifications->count()" />
    
    <!-- Main Content -->
    <main class="flex flex-col gap-6 p-4 pt-6">
        
        <!-- Page Header -->
        <div>
            <h1 class="text-2xl font-bold text-[#181511] dark:text-white">Bids on My Yields</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Review and manage trader bids</p>
        </div>
        
        <!-- Filter Tabs -->
        <div class="flex gap-2 overflow-x-auto pb-2">
            <a href="{{ route('farmer.bids.index') }}" class="px-4 py-2 rounded-full text-sm font-semibold whitespace-nowrap {{ !request('status') ? 'bg-primary text-white' : 'bg-white dark:bg-surface-dark text-gray-700 dark:text-gray-300' }} transition">
                All ({{ $stats['total'] }})
            </a>
            <a href="{{ route('farmer.bids.index', ['status' => 'pending']) }}" class="px-4 py-2 rounded-full text-sm font-semibold whitespace-nowrap {{ request('status') === 'pending' ? 'bg-primary text-white' : 'bg-white dark:bg-surface-dark text-gray-700 dark:text-gray-300' }} transition">
                Pending ({{ $stats['pending'] }})
            </a>
            <a href="{{ route('farmer.bids.index', ['status' => 'accepted']) }}" class="px-4 py-2 rounded-full text-sm font-semibold whitespace-nowrap {{ request('status') === 'accepted' ? 'bg-primary text-white' : 'bg-white dark:bg-surface-dark text-gray-700 dark:text-gray-300' }} transition">
                Accepted ({{ $stats['accepted'] }})
            </a>
            <a href="{{ route('farmer.bids.index', ['status' => 'rejected']) }}" class="px-4 py-2 rounded-full text-sm font-semibold whitespace-nowrap {{ request('status') === 'rejected' ? 'bg-primary text-white' : 'bg-white dark:bg-surface-dark text-gray-700 dark:text-gray-300' }} transition">
                Rejected ({{ $stats['rejected'] }})
            </a>
        </div>
        
        <!-- Bids List -->
        @if($bids->count() > 0)
            <div class="grid grid-cols-1 gap-4">
                @foreach($bids as $bid)
                    <x-bid-card :bid="$bid" :showActions="$bid->status === 'pending'" viewType="farmer" />
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($bids->hasPages())
                <div class="mt-4">
                    {{ $bids->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="flex flex-col items-center justify-center py-12 px-4">
                <div class="w-24 h-24 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-5xl text-gray-400">gavel</span>
                </div>
                <h3 class="text-lg font-bold text-[#181511] dark:text-white mb-2">
                    @if(request('status'))
                        No {{ request('status') }} bids
                    @else
                        No bids yet
                    @endif
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 text-center mb-6">
                    @if(request('status'))
                        You don't have any {{ request('status') }} bids at the moment.
                    @else
                        Traders will place bids on your yields. Check back later!
                    @endif
                </p>
                <a href="{{ route('farmer.yields.index') }}" class="px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition">
                    <span class="flex items-center gap-2">
                        <span class="material-symbols-outlined">inventory_2</span>
                        <span>View My Yields</span>
                    </span>
                </a>
            </div>
        @endif
        
    </main>
    
    <!-- Bottom Navigation -->
    <x-bottom-nav active="bids" />
    
</div>
@endsection
