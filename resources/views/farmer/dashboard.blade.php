@extends('layouts.app')

@section('title', 'Farmer Dashboard - One Place Agro')

@section('content')
<div class="relative flex h-full min-h-screen w-full flex-col overflow-x-hidden pb-24 bg-background-light dark:bg-background-dark">
    
    <!-- Header Component -->
    <x-header 
        title="One Place" 
        :notificationCount="auth()->user()->unreadNotifications->count()" 
    />
    
    <!-- Main Content -->
    <main class="flex flex-col gap-6 p-4 pt-6">
        
        <!-- Weather Widget Component -->
        <x-weather-widget 
            location="Nagpur, India"
            temperature="32"
            condition="Sunny"
            conditionIcon="wb_sunny"
            humidity="45"
            wind="12"
            precipitation="0"
        />
        
        <!-- Quick Actions Section -->
        <section>
            <div class="flex items-center justify-between mb-3 px-1">
                <h2 class="text-lg font-bold text-[#181511] dark:text-white leading-tight">Quick Actions</h2>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <x-quick-action-button 
                    icon="inventory_2"
                    label="Add New<br/>Yield"
                    href="{{ route('farmer.yields.create') }}"
                    bgColor="orange-50"
                    iconColor="primary"
                    darkBgColor="orange-900/20"
                />
                
                <x-quick-action-button 
                    icon="list_alt"
                    label="Active<br/>Listings"
                    href="{{ route('farmer.yields.index') }}"
                    bgColor="blue-50"
                    iconColor="blue-600"
                    darkBgColor="blue-900/20"
                />
                
                <x-quick-action-button 
                    icon="shopping_cart"
                    label="What Traders<br/>Want"
                    href="{{ route('farmer.requirements.browse') }}"
                    bgColor="purple-50"
                    iconColor="purple-600"
                    darkBgColor="purple-900/20"
                />
                
                <x-quick-action-button 
                    icon="trending_up"
                    label="Market<br/>Prices"
                    href="{{ route('market-prices.index') }}"
                    bgColor="green-50"
                    iconColor="secondary-green"
                    darkBgColor="green-900/20"
                />
            </div>
        </section>
        
        <!-- Statistics Section -->
        <section>
            <div class="flex items-center justify-between mb-3 px-1">
                <h2 class="text-lg font-bold text-[#181511] dark:text-white leading-tight">Your Statistics</h2>
            </div>
            <div class="grid grid-cols-3 gap-3">
                <x-stat-card 
                    icon="inventory_2"
                    label="Active Yields"
                    :value="$stats['active_yields']"
                    bgColor="primary"
                />
                
                <x-stat-card 
                    icon="gavel"
                    label="Pending Bids"
                    :value="$stats['pending_bids']"
                    bgColor="blue-600"
                />
                
                <x-stat-card 
                    icon="check_circle"
                    label="Sold"
                    :value="$stats['sold_yields']"
                    bgColor="green-600"
                />
            </div>
        </section>
        
        <!-- Recent Updates Section -->
        <section>
            <div class="flex items-center justify-between mb-3 px-1">
                <h2 class="text-lg font-bold text-[#181511] dark:text-white leading-tight">Recent Updates</h2>
                <a class="text-sm font-semibold text-primary hover:text-primary-dark" href="{{ route('notifications.index') }}">View All</a>
            </div>
            <div class="flex flex-col gap-3">
                @forelse($recentBids->take(3) as $bid)
                    <x-update-card 
                        icon="person_search"
                        iconColor="primary"
                        iconBgColor="orange-100"
                        darkIconBgColor="orange-900/30"
                        title="New Bid Received"
                        message="{{ $bid->trader->name }} placed a bid of ₹{{ number_format($bid->bid_amount) }}/ton on your {{ $bid->yield->variety->name }}"
                        timestamp="{{ $bid->created_at->diffForHumans() }}"
                        borderColor="primary"
                    />
                @empty
                    <x-update-card 
                        icon="verified"
                        iconColor="gray-600"
                        iconBgColor="gray-100"
                        darkIconBgColor="gray-800"
                        title="Welcome to One Place Agro!"
                        message="Start by adding your first yield listing to connect with traders."
                        timestamp="Just now"
                        borderColor="gray-300"
                    />
                @endforelse
            </div>
        </section>
        
        <!-- Recent Yields Section -->
        @if($recentYields->count() > 0)
        <section>
            <div class="flex items-center justify-between mb-3 px-1">
                <h2 class="text-lg font-bold text-[#181511] dark:text-white leading-tight">Your Recent Yields</h2>
                <a class="text-sm font-semibold text-primary hover:text-primary-dark" href="{{ route('farmer.yields.index') }}">View All</a>
            </div>
            <div class="grid grid-cols-1 gap-4">
                @foreach($recentYields->take(3) as $yield)
                    <x-yield-card :yield="$yield" :showActions="true" />
                @endforeach
            </div>
        </section>
        @endif
        
    </main>
    
    <!-- Bottom Navigation Component -->
    <x-bottom-nav active="home" />
    
</div>
@endsection
