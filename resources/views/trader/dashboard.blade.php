@extends('layouts.app')

@section('title', 'Trader Dashboard - One Place Agro')

@section('content')
<div class="relative flex h-full min-h-screen w-full flex-col overflow-x-hidden pb-24 bg-background-light dark:bg-background-dark">
    
    <!-- Header -->
    <x-header title="Dashboard" :notificationCount="auth()->user()->unreadNotifications->count()" />
    
    <!-- Main Content -->
    <main class="flex flex-col gap-6 p-4 pt-6">
        
        <!-- Welcome Section -->
        <div class="rounded-xl bg-gradient-to-r from-primary to-orange-400 p-6 text-white shadow-lg">
            <h1 class="text-2xl font-bold mb-1">Welcome back, {{ auth()->user()->name }}!</h1>
            @if(auth()->user()->company_name)
            <p class="text-sm opacity-90">{{ auth()->user()->company_name }}</p>
            @endif
            <p class="text-sm opacity-80 mt-2">{{ now()->format('l, d F Y') }}</p>
        </div>
        
        <!-- Statistics Grid -->
        <div class="grid grid-cols-2 gap-4">
            <x-stat-card
                icon="gavel"
                label="Total Bids"
                :value="$stats['total_bids']"
                bgColor="bg-blue-100 dark:bg-blue-900/30"
                iconColor="text-blue-600 dark:text-blue-400"
            />
            
            <x-stat-card
                icon="schedule"
                label="Pending"
                :value="$stats['pending_bids']"
                bgColor="bg-yellow-100 dark:bg-yellow-900/30"
                iconColor="text-yellow-600 dark:text-yellow-400"
            />
            
            <x-stat-card
                icon="check_circle"
                label="Accepted"
                :value="$stats['accepted_bids']"
                bgColor="bg-green-100 dark:bg-green-900/30"
                iconColor="text-green-600 dark:text-green-400"
            />
            
            <x-stat-card
                icon="cancel"
                label="Rejected"
                :value="$stats['rejected_bids']"
                bgColor="bg-red-100 dark:bg-red-900/30"
                iconColor="text-red-600 dark:text-red-400"
            />
        </div>
        
        <!-- Quick Actions -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <h2 class="text-lg font-bold text-[#181511] dark:text-white mb-4">Quick Actions</h2>
            <div class="grid grid-cols-2 gap-3">
                <x-quick-action-button
                    icon="search"
                    label="Browse Yields"
                    bgColor="bg-blue-100 dark:bg-blue-900/30"
                    iconColor="text-blue-600 dark:text-blue-400"
                    href="{{ route('trader.yields.browse') }}"
                />
                
                <x-quick-action-button
                    icon="post_add"
                    label="Post Requirement"
                    bgColor="bg-green-100 dark:bg-green-900/30"
                    iconColor="text-green-600 dark:text-green-400"
                    href="{{ route('trader.requirements.create') }}"
                />
                
                <x-quick-action-button
                    icon="gavel"
                    label="My Bids"
                    bgColor="bg-orange-100 dark:bg-orange-900/30"
                    iconColor="text-orange-600 dark:text-orange-400"
                    href="{{ route('trader.bids.index') }}"
                />
                
                <x-quick-action-button
                    icon="list_alt"
                    label="Requirements"
                    bgColor="bg-purple-100 dark:bg-purple-900/30"
                    iconColor="text-purple-600 dark:text-purple-400"
                    href="{{ route('trader.requirements.index') }}"
                />
            </div>
        </div>
        
        <!-- Available Yields Section -->
        @if($recentYields->count() > 0)
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-[#181511] dark:text-white">Available Yields</h2>
                <a href="{{ route('trader.yields.browse') }}" class="text-sm font-semibold text-primary hover:text-primary-dark transition">
                    View All →
                </a>
            </div>
            <div class="space-y-3">
                @foreach($recentYields->take(4) as $yield)
                <x-yield-card :yield="$yield" :showActions="false" :showBidButton="true" />
                @endforeach
            </div>
        </div>
        @endif
        
        <!-- My Recent Bids Section -->
        @if($recentBids->count() > 0)
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-[#181511] dark:text-white">My Recent Bids</h2>
                <a href="{{ route('trader.bids.index') }}" class="text-sm font-semibold text-primary hover:text-primary-dark transition">
                    View All →
                </a>
            </div>
            <div class="space-y-3">
                @foreach($recentBids->take(4) as $bid)
                <x-bid-card :bid="$bid" :showActions="false" />
                @endforeach
            </div>
        </div>
        @endif
        
        <!-- Empty State -->
        @if($recentYields->count() === 0 && $recentBids->count() === 0)
        <div class="rounded-xl bg-gradient-to-r from-primary/10 to-orange-400/10 border-2 border-dashed border-primary/30 p-8 text-center">
            <div class="flex justify-center mb-4">
                <div class="flex h-20 w-20 items-center justify-center rounded-full bg-primary/20">
                    <span class="material-symbols-outlined text-4xl text-primary">storefront</span>
                </div>
            </div>
            <h3 class="text-xl font-bold text-[#181511] dark:text-white mb-2">Start Trading!</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-6 max-w-sm mx-auto">
                Browse available yields from farmers and place your first bid to get started with trading.
            </p>
            <a href="{{ route('trader.yields.browse') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition shadow-sm">
                <span class="material-symbols-outlined">search</span>
                <span>Browse Yields</span>
            </a>
        </div>
        @endif
        
        <!-- Market Insights -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <h2 class="text-lg font-bold text-[#181511] dark:text-white mb-4">Market Insights</h2>
            <div class="space-y-3">
                <a href="{{ route('market-prices.index') }}" class="flex items-center justify-between p-4 rounded-lg bg-gray-50 dark:bg-gray-800/50 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/30">
                            <span class="material-symbols-outlined text-green-600 dark:text-green-400">trending_up</span>
                        </div>
                        <div>
                            <p class="font-semibold text-[#181511] dark:text-white">Market Prices</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">View current orange prices</p>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-gray-400">chevron_right</span>
                </a>
                
                <a href="{{ route('news.index') }}" class="flex items-center justify-between p-4 rounded-lg bg-gray-50 dark:bg-gray-800/50 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/30">
                            <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">newspaper</span>
                        </div>
                        <div>
                            <p class="font-semibold text-[#181511] dark:text-white">Agri News</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Latest agriculture updates</p>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-gray-400">chevron_right</span>
                </a>
            </div>
        </div>
        
    </main>
    
    <!-- Bottom Navigation -->
    <x-bottom-nav active="home" />
    
</div>
@endsection
