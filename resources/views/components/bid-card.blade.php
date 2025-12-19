@props([
    'bid',
    'showActions' => false,
    'viewType' => 'farmer' // 'farmer' or 'trader'
])

<div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm hover:shadow-md transition p-4">
    <div class="flex items-start justify-between mb-3">
        <div class="flex-1">
            @if($viewType === 'farmer')
                <!-- Farmer View: Show Trader Info -->
                <div class="flex items-center gap-3 mb-2">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary/10 text-primary">
                        <span class="material-symbols-outlined">store</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-[#181511] dark:text-white">{{ $bid->trader->name }}</h4>
                        @if($bid->trader->company_name)
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $bid->trader->company_name }}</p>
                        @endif
                    </div>
                </div>
            @else
                <!-- Trader View: Show Yield Info -->
                <div class="flex items-center gap-3 mb-2">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-secondary-green/10 text-secondary-green">
                        <span class="material-symbols-outlined">agriculture</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-[#181511] dark:text-white">{{ $bid->yield->variety->name }}</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $bid->yield->farmer->name }}</p>
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Status Badge -->
        <div>
            @if($bid->status === 'pending')
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400">
                    Pending
                </span>
            @elseif($bid->status === 'accepted')
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                    Accepted
                </span>
            @else
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400">
                    Rejected
                </span>
            @endif
        </div>
    </div>
    
    <!-- Bid Details -->
    <div class="grid grid-cols-2 gap-3 mb-3">
        <div>
            <p class="text-xs text-gray-500 dark:text-gray-400">Bid Amount</p>
            <p class="text-lg font-bold text-primary">₹{{ number_format($bid->bid_amount) }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">per ton</p>
        </div>
        <div>
            <p class="text-xs text-gray-500 dark:text-gray-400">Quantity</p>
            <p class="text-lg font-bold text-[#181511] dark:text-white">{{ number_format($bid->quantity, 2) }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">tons</p>
        </div>
    </div>
    
    <!-- Total Amount -->
    <div class="bg-gray-50 dark:bg-gray-800/50 rounded-lg p-3 mb-3">
        <div class="flex items-center justify-between">
            <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Amount</span>
            <span class="text-xl font-bold text-[#181511] dark:text-white">
                ₹{{ number_format($bid->bid_amount * $bid->quantity) }}
            </span>
        </div>
    </div>
    
    @if($bid->message)
        <div class="mb-3">
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Message:</p>
            <p class="text-sm text-gray-700 dark:text-gray-300 italic">"{{ $bid->message }}"</p>
        </div>
    @endif
    
    <!-- Timestamp -->
    <div class="flex items-center gap-2 text-xs text-gray-400 mb-3">
        <span class="material-symbols-outlined text-sm">schedule</span>
        <span>{{ $bid->created_at->diffForHumans() }}</span>
    </div>
    
    <!-- Actions -->
    @if($showActions && $bid->status === 'pending')
        @if($viewType === 'farmer')
            <!-- Farmer Actions: Accept/Reject -->
            <div class="flex gap-2 pt-3 border-t border-gray-100 dark:border-gray-700">
                <form action="{{ route('farmer.bids.accept', $bid) }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" 
                            class="w-full px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition flex items-center justify-center gap-1">
                        <span class="material-symbols-outlined text-sm">check</span>
                        <span>Accept</span>
                    </button>
                </form>
                <form action="{{ route('farmer.bids.reject', $bid) }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" 
                            class="w-full px-4 py-2 text-sm font-medium text-red-600 border border-red-600 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition flex items-center justify-center gap-1">
                        <span class="material-symbols-outlined text-sm">close</span>
                        <span>Reject</span>
                    </button>
                </form>
            </div>
        @else
            <!-- Trader Actions: Update/Cancel -->
            <div class="flex gap-2 pt-3 border-t border-gray-100 dark:border-gray-700">
                <a href="{{ route('trader.bids.show', $bid) }}" 
                   class="flex-1 px-4 py-2 text-center text-sm font-medium text-primary border border-primary rounded-lg hover:bg-primary hover:text-white transition flex items-center justify-center gap-1">
                    <span class="material-symbols-outlined text-sm">edit</span>
                    <span>Update</span>
                </a>
                <form action="{{ route('trader.bids.cancel', $bid) }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" 
                            class="w-full px-4 py-2 text-sm font-medium text-red-600 border border-red-600 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition flex items-center justify-center gap-1">
                        <span class="material-symbols-outlined text-sm">cancel</span>
                        <span>Cancel</span>
                    </button>
                </form>
            </div>
        @endif
    @endif
    
    @if(!$showActions && $viewType === 'trader' && $bid->status !== 'pending')
        <div class="pt-3 border-t border-gray-100 dark:border-gray-700">
            <a href="{{ route('trader.bids.show', $bid) }}" 
               class="block w-full px-4 py-2 text-center text-sm font-medium text-primary border border-primary rounded-lg hover:bg-primary hover:text-white transition">
                View Details
            </a>
        </div>
    @endif
</div>
