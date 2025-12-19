@extends('layouts.app')

@section('title', 'Browse Requirements - One Place Agro')

@section('content')
<div class="relative flex h-full min-h-screen w-full flex-col overflow-x-hidden pb-24 bg-background-light dark:bg-background-dark">
    
    <!-- Header -->
    <x-header title="Browse Requirements" :notificationCount="auth()->user()->unreadNotifications->count()" />
    
    <!-- Main Content -->
    <main class="flex flex-col gap-6 p-4 pt-6">
        
        <!-- Page Title -->
        <div>
            <h1 class="text-2xl font-bold text-[#181511] dark:text-white">What Traders Want</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">See what traders are looking to buy</p>
        </div>
        
        <!-- Search Bar -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-4">
            <form action="{{ route('farmer.requirements.browse') }}" method="GET" class="space-y-4">
                <!-- Search Input -->
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search by variety name..."
                        class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-[#181511] dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-primary focus:border-transparent"
                    >
                </div>
                
                <!-- Filter Toggle Button -->
                <button type="button" onclick="toggleFilters()" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                    <span class="material-symbols-outlined">tune</span>
                    <span class="font-semibold">Filters & Sort</span>
                    <span class="material-symbols-outlined" id="filterIcon">expand_more</span>
                </button>
                
                <!-- Filters Section (Hidden by default) -->
                <div id="filtersSection" class="hidden space-y-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <!-- Variety Filter -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Variety</label>
                        <select name="variety_id" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-[#181511] dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="">All Varieties</option>
                            @foreach($varieties as $variety)
                            <option value="{{ $variety->id }}" {{ request('variety_id') == $variety->id ? 'selected' : '' }}>
                                {{ $variety->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Location Filter -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Location</label>
                        <input
                            type="text"
                            name="location"
                            value="{{ request('location') }}"
                            placeholder="e.g., Nagpur"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-[#181511] dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-primary focus:border-transparent"
                        >
                    </div>
                    
                    <!-- Sort By -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Sort By</label>
                        <select name="sort_by" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-[#181511] dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="latest" {{ request('sort_by') == 'latest' ? 'selected' : '' }}>Latest First</option>
                            <option value="budget_high" {{ request('sort_by') == 'budget_high' ? 'selected' : '' }}>Budget: High to Low</option>
                            <option value="budget_low" {{ request('sort_by') == 'budget_low' ? 'selected' : '' }}>Budget: Low to High</option>
                            <option value="quantity_high" {{ request('sort_by') == 'quantity_high' ? 'selected' : '' }}>Quantity: High to Low</option>
                            <option value="quantity_low" {{ request('sort_by') == 'quantity_low' ? 'selected' : '' }}>Quantity: Low to High</option>
                        </select>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex gap-3 pt-2">
                        <button type="submit" class="flex-1 px-4 py-2 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition">
                            Apply Filters
                        </button>
                        <a href="{{ route('farmer.requirements.browse') }}" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                            Clear
                        </a>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Results Count -->
        <div class="flex items-center justify-between">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                <span class="font-semibold text-[#181511] dark:text-white">{{ $requirements->total() }}</span> requirements found
            </p>
            @if(request()->hasAny(['search', 'variety_id', 'location']))
            <a href="{{ route('farmer.requirements.browse') }}" class="text-sm text-primary hover:text-primary-dark font-semibold">
                Clear all filters
            </a>
            @endif
        </div>
        
        <!-- Requirements List -->
        @if($requirements->count() > 0)
        <div class="space-y-4">
            @foreach($requirements as $requirement)
            <x-requirement-card :requirement="$requirement" :showActions="false" viewType="farmer" />
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($requirements->hasPages())
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-4">
            {{ $requirements->links() }}
        </div>
        @endif
        @else
        <!-- Empty State -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-12 text-center">
            <div class="flex justify-center mb-4">
                <div class="flex h-20 w-20 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                    <span class="material-symbols-outlined text-4xl text-gray-400">search_off</span>
                </div>
            </div>
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">No Requirements Found</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                @if(request()->hasAny(['search', 'variety_id', 'location']))
                    No requirements match your search criteria. Try adjusting your filters.
                @else
                    There are no active requirements at the moment. Check back later!
                @endif
            </p>
            @if(request()->hasAny(['search', 'variety_id', 'location']))
            <a href="{{ route('farmer.requirements.browse') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition">
                <span class="material-symbols-outlined">refresh</span>
                <span>Clear Filters</span>
            </a>
            @endif
        </div>
        @endif
        
        <!-- Info Card -->
        <div class="rounded-xl bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 p-6">
            <div class="flex gap-3">
                <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">info</span>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-blue-900 dark:text-blue-300 mb-2">About Requirements</p>
                    <ul class="text-xs text-blue-800 dark:text-blue-400 space-y-1 list-disc list-inside">
                        <li>These are what traders are actively looking to buy</li>
                        <li>Contact traders directly if you have matching produce</li>
                        <li>Requirements show the variety, quantity, and budget</li>
                        <li>Only active requirements are shown here</li>
                    </ul>
                </div>
            </div>
        </div>
        
    </main>
    
    <!-- Bottom Navigation -->
    <x-bottom-nav active="market" />
    
</div>

<script>
function toggleFilters() {
    const filtersSection = document.getElementById('filtersSection');
    const filterIcon = document.getElementById('filterIcon');
    
    if (filtersSection.classList.contains('hidden')) {
        filtersSection.classList.remove('hidden');
        filterIcon.textContent = 'expand_less';
    } else {
        filtersSection.classList.add('hidden');
        filterIcon.textContent = 'expand_more';
    }
}

// Auto-expand filters if any filter is active
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const hasFilters = urlParams.has('variety_id') || urlParams.has('location') || urlParams.has('sort_by');
    
    if (hasFilters) {
        toggleFilters();
    }
});
</script>
@endsection
