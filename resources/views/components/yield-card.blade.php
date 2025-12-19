@props([
    'yield',
    'showActions' => false,
    'showBidButton' => false
])

<div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm hover:shadow-md transition overflow-hidden">
    <!-- Image -->
    <div class="relative h-48 bg-gray-200 dark:bg-gray-700">
        @if($yield->images && is_array($yield->images) && count($yield->images) > 0)
            <img src="{{ asset('storage/' . $yield->images[0]) }}" 
                 alt="{{ $yield->variety->name }}" 
                 class="w-full h-full object-cover">
        @else
            <div class="w-full h-full flex items-center justify-center">
                <span class="material-symbols-outlined text-6xl text-gray-400">agriculture</span>
            </div>
        @endif
        
        <!-- Status Badge -->
        <div class="absolute top-3 right-3">
            @if($yield->status === 'active')
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-500 text-white">Active</span>
            @elseif($yield->status === 'sold')
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-500 text-white">Sold</span>
            @else
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-gray-500 text-white">Expired</span>
            @endif
        </div>
    </div>
    
    <!-- Content -->
    <div class="p-4">
        <!-- Variety Name -->
        <h3 class="text-lg font-bold text-[#181511] dark:text-white mb-2">{{ $yield->variety->name }}</h3>
        
        <!-- Details Grid -->
        <div class="grid grid-cols-2 gap-3 mb-3">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-sm text-gray-400">scale</span>
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Quantity</p>
                    <p class="text-sm font-bold text-[#181511] dark:text-white">{{ number_format($yield->quantity, 2) }} tons</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-sm text-gray-400">payments</span>
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Price</p>
                    <p class="text-sm font-bold text-primary">₹{{ number_format($yield->price_per_ton) }}/ton</p>
                </div>
            </div>
        </div>
        
        <!-- Location & Date -->
        <div class="flex items-center gap-2 mb-3 text-xs text-gray-500 dark:text-gray-400">
            <span class="material-symbols-outlined text-sm">location_on</span>
            <span>{{ $yield->location }}</span>
            <span class="mx-1">•</span>
            <span class="material-symbols-outlined text-sm">calendar_today</span>
            <span>{{ \Carbon\Carbon::parse($yield->harvest_date)->format('M d, Y') }}</span>
        </div>
        
        @if($yield->description)
            <p class="text-xs text-gray-600 dark:text-gray-300 mb-3 line-clamp-2">{{ $yield->description }}</p>
        @endif
        
        <!-- Actions -->
        @if($showActions)
            <div class="flex gap-2 pt-3 border-t border-gray-100 dark:border-gray-700">
                <a href="{{ route('farmer.yields.show', $yield) }}" 
                   class="flex-1 px-4 py-2 text-center text-sm font-medium text-primary border border-primary rounded-lg hover:bg-primary hover:text-white transition">
                    View Details
                </a>
                <a href="{{ route('farmer.yields.edit', $yield) }}" 
                   class="flex-1 px-4 py-2 text-center text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary-dark transition">
                    Edit
                </a>
            </div>
        @endif
        
        @if($showBidButton)
            <div class="pt-3 border-t border-gray-100 dark:border-gray-700">
                <a href="{{ route('trader.yields.show', $yield) }}" 
                   class="block w-full px-4 py-2 text-center text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary-dark transition">
                    View & Place Bid
                </a>
            </div>
        @endif
    </div>
</div>
