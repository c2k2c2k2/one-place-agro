@extends('layouts.app')

@section('title', 'Market Prices - One Place Agro')

@section('content')
<div class="relative flex h-full min-h-screen w-full flex-col overflow-x-hidden pb-24 bg-background-light dark:bg-background-dark">
    
    <!-- Header -->
    <x-header title="Market Prices" :notificationCount="auth()->user()->unreadNotifications->count()" />
    
    <!-- Main Content -->
    <main class="flex flex-col gap-6 p-4 pt-6">
        
        <!-- Page Title -->
        <div>
            <h1 class="text-2xl font-bold text-[#181511] dark:text-white">Orange Market Prices</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Latest prices from major markets</p>
        </div>
        
        <!-- Date Filter -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-4">
            <form action="{{ route('market-prices.index') }}" method="GET" class="flex gap-3">
                <input
                    type="date"
                    name="date"
                    value="{{ request('date', date('Y-m-d')) }}"
                    max="{{ date('Y-m-d') }}"
                    class="flex-1 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-[#181511] dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent"
                >
                <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition">
                    Filter
                </button>
            </form>
        </div>
        
        <!-- Price Cards -->
        @if($prices->count() > 0)
        <div class="space-y-4">
            @foreach($prices as $price)
            <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
                <!-- Market & Variety -->
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-[#181511] dark:text-white">{{ $price->variety->name }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $price->market_name }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($price->date)->format('d M Y') }}</p>
                    </div>
                </div>
                
                <!-- Price Details -->
                <div class="grid grid-cols-3 gap-4">
                    <div class="text-center p-3 rounded-lg bg-green-50 dark:bg-green-900/20">
                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Min Price</p>
                        <p class="text-lg font-bold text-green-600 dark:text-green-400">₹{{ number_format($price->min_price) }}</p>
                    </div>
                    
                    <div class="text-center p-3 rounded-lg bg-blue-50 dark:bg-blue-900/20">
                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Max Price</p>
                        <p class="text-lg font-bold text-blue-600 dark:text-blue-400">₹{{ number_format($price->max_price) }}</p>
                    </div>
                    
                    <div class="text-center p-3 rounded-lg bg-primary/10 dark:bg-primary/20">
                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Modal Price</p>
                        <p class="text-lg font-bold text-primary">₹{{ number_format($price->modal_price) }}</p>
                    </div>
                </div>
                
                <!-- Price Trend -->
                @if($price->price_change)
                <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center gap-2">
                        @if($price->price_change > 0)
                        <span class="material-symbols-outlined text-green-600 dark:text-green-400">trending_up</span>
                        <span class="text-sm font-semibold text-green-600 dark:text-green-400">
                            +₹{{ number_format(abs($price->price_change)) }} ({{ number_format(abs($price->price_change_percent), 2) }}%)
                        </span>
                        @elseif($price->price_change < 0)
                        <span class="material-symbols-outlined text-red-600 dark:text-red-400">trending_down</span>
                        <span class="text-sm font-semibold text-red-600 dark:text-red-400">
                            -₹{{ number_format(abs($price->price_change)) }} ({{ number_format(abs($price->price_change_percent), 2) }}%)
                        </span>
                        @else
                        <span class="material-symbols-outlined text-gray-600 dark:text-gray-400">trending_flat</span>
                        <span class="text-sm font-semibold text-gray-600 dark:text-gray-400">No change</span>
                        @endif
                        <span class="text-xs text-gray-500 dark:text-gray-400">from previous day</span>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($prices->hasPages())
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-4">
            {{ $prices->links() }}
        </div>
        @endif
        @else
        <!-- Empty State -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-12 text-center">
            <div class="flex justify-center mb-4">
                <div class="flex h-20 w-20 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                    <span class="material-symbols-outlined text-4xl text-gray-400">trending_up</span>
                </div>
            </div>
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">No Price Data Available</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                No market price data is available for the selected date.
            </p>
        </div>
        @endif
        
        <!-- Info Card -->
        <div class="rounded-xl bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 p-6">
            <div class="flex gap-3">
                <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">info</span>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-blue-900 dark:text-blue-300 mb-2">About Market Prices</p>
                    <ul class="text-xs text-blue-800 dark:text-blue-400 space-y-1 list-disc list-inside">
                        <li><strong>Min Price:</strong> Lowest price recorded in the market</li>
                        <li><strong>Max Price:</strong> Highest price recorded in the market</li>
                        <li><strong>Modal Price:</strong> Most common price (recommended reference)</li>
                        <li>Prices are updated daily from major agricultural markets</li>
                        <li>All prices are per quintal (100 kg)</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Quick Links -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <h3 class="text-lg font-bold text-[#181511] dark:text-white mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <a href="{{ route('market-prices.compare') }}" class="flex items-center justify-between p-4 rounded-lg bg-gray-50 dark:bg-gray-800/50 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-purple-100 dark:bg-purple-900/30">
                            <span class="material-symbols-outlined text-purple-600 dark:text-purple-400">compare_arrows</span>
                        </div>
                        <div>
                            <p class="font-semibold text-[#181511] dark:text-white">Compare Markets</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Compare prices across markets</p>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-gray-400">chevron_right</span>
                </a>
                
                @auth
                @if(auth()->user()->role === 'trader')
                <a href="{{ route('trader.yields.browse') }}" class="flex items-center justify-between p-4 rounded-lg bg-gray-50 dark:bg-gray-800/50 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/30">
                            <span class="material-symbols-outlined text-green-600 dark:text-green-400">search</span>
                        </div>
                        <div>
                            <p class="font-semibold text-[#181511] dark:text-white">Browse Yields</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Find oranges to buy</p>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-gray-400">chevron_right</span>
                </a>
                @elseif(auth()->user()->role === 'farmer')
                <a href="{{ route('farmer.yields.create') }}" class="flex items-center justify-between p-4 rounded-lg bg-gray-50 dark:bg-gray-800/50 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-100 dark:bg-orange-900/30">
                            <span class="material-symbols-outlined text-orange-600 dark:text-orange-400">add_circle</span>
                        </div>
                        <div>
                            <p class="font-semibold text-[#181511] dark:text-white">Add Yield</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">List your produce</p>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-gray-400">chevron_right</span>
                </a>
                @endif
                @endauth
            </div>
        </div>
        
    </main>
    
    <!-- Bottom Navigation -->
    <x-bottom-nav active="market" />
    
</div>
@endsection
