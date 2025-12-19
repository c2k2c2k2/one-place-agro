@extends('layouts.app')

@section('title', 'Yield Details - One Place Agro')

@section('content')
<div class="relative flex h-full min-h-screen w-full flex-col overflow-x-hidden pb-24 bg-background-light dark:bg-background-dark">
    
    <!-- Header -->
    <x-header title="Yield Details" :notificationCount="auth()->user()->unreadNotifications->count()" />
    
    <!-- Main Content -->
    <main class="flex flex-col gap-6 p-4 pt-6">
        
        <!-- Back Button -->
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('trader.yields.browse') }}" class="flex h-10 w-10 items-center justify-center rounded-full bg-white dark:bg-surface-dark shadow-sm">
                <span class="material-symbols-outlined text-gray-600 dark:text-gray-400">arrow_back</span>
            </a>
            <div>
                <h1 class="text-xl font-bold text-[#181511] dark:text-white">Yield Details</h1>
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
        
        @if(session('error'))
        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
            <div class="flex gap-3">
                <span class="material-symbols-outlined text-red-600 dark:text-red-400">error</span>
                <p class="text-sm text-red-800 dark:text-red-300">{{ session('error') }}</p>
            </div>
        </div>
        @endif
        
        <!-- Image Gallery -->
        @if($yield->images && count($yield->images) > 0)
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm overflow-hidden">
            <div class="relative aspect-video bg-gray-100 dark:bg-gray-800">
                <img src="{{ asset('storage/' . $yield->images[0]) }}" alt="{{ $yield->variety->name }}" class="w-full h-full object-cover" id="mainImage">
                
                <!-- Image Counter -->
                <div class="absolute top-4 right-4 bg-black/60 text-white px-3 py-1 rounded-full text-sm">
                    <span id="currentImageIndex">1</span> / {{ count($yield->images) }}
                </div>
            </div>
            
            <!-- Thumbnail Gallery -->
            @if(count($yield->images) > 1)
            <div class="flex gap-2 p-4 overflow-x-auto">
                @foreach($yield->images as $index => $image)
                <button onclick="changeImage('{{ asset('storage/' . $image) }}', {{ $index + 1 }})" class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden border-2 {{ $index === 0 ? 'border-primary' : 'border-gray-200 dark:border-gray-700' }} hover:border-primary transition thumbnail-btn">
                    <img src="{{ asset('storage/' . $image) }}" alt="Thumbnail {{ $index + 1 }}" class="w-full h-full object-cover">
                </button>
                @endforeach
            </div>
            @endif
        </div>
        @endif
        
        <!-- Yield Details Card -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <!-- Variety Name -->
            <h2 class="text-2xl font-bold text-[#181511] dark:text-white mb-4">{{ $yield->variety->name }}</h2>
            
            <!-- Key Details Grid -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="flex items-start gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-orange-100 dark:bg-orange-900/30">
                        <span class="material-symbols-outlined text-orange-600 dark:text-orange-400">scale</span>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Quantity</p>
                        <p class="text-lg font-bold text-[#181511] dark:text-white">{{ number_format($yield->quantity, 2) }} tons</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/30">
                        <span class="material-symbols-outlined text-green-600 dark:text-green-400">currency_rupee</span>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Price per Ton</p>
                        <p class="text-lg font-bold text-[#181511] dark:text-white">₹{{ number_format($yield->price_per_ton) }}</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/30">
                        <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">calendar_today</span>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Harvest Date</p>
                        <p class="text-sm font-semibold text-[#181511] dark:text-white">{{ \Carbon\Carbon::parse($yield->harvest_date)->format('d M Y') }}</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-purple-100 dark:bg-purple-900/30">
                        <span class="material-symbols-outlined text-purple-600 dark:text-purple-400">location_on</span>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Location</p>
                        <p class="text-sm font-semibold text-[#181511] dark:text-white">{{ $yield->location }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Total Value -->
            <div class="bg-primary/10 dark:bg-primary/20 rounded-lg p-4 mb-6">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Total Value</span>
                    <span class="text-2xl font-bold text-primary">₹{{ number_format($yield->quantity * $yield->price_per_ton) }}</span>
                </div>
            </div>
            
            <!-- Description -->
            @if($yield->description)
            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Description</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ $yield->description }}</p>
            </div>
            @endif
        </div>
        
        <!-- Farmer Information -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <h3 class="text-lg font-bold text-[#181511] dark:text-white mb-4">Farmer Information</h3>
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10">
                    <span class="material-symbols-outlined text-primary text-2xl">person</span>
                </div>
                <div>
                    <p class="font-semibold text-[#181511] dark:text-white">{{ $yield->farmer->name }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $yield->farmer->location }}</p>
                    @if($yield->farmer->phone)
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $yield->farmer->phone }}</p>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Place Bid Section -->
        @if($existingBid)
        <!-- Existing Bid -->
        <div class="rounded-xl bg-blue-50 dark:bg-blue-900/20 border-2 border-blue-200 dark:border-blue-800 p-6">
            <div class="flex items-start gap-3 mb-4">
                <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">info</span>
                <div class="flex-1">
                    <h3 class="font-bold text-blue-900 dark:text-blue-300 mb-1">You've already placed a bid</h3>
                    <p class="text-sm text-blue-800 dark:text-blue-400">Your bid of ₹{{ number_format($existingBid->bid_amount) }} is {{ $existingBid->status }}.</p>
                </div>
            </div>
            
            <div class="bg-white dark:bg-blue-900/30 rounded-lg p-4">
                <div class="grid grid-cols-2 gap-4 mb-3">
                    <div>
                        <p class="text-xs text-gray-600 dark:text-gray-400">Bid Amount</p>
                        <p class="text-lg font-bold text-[#181511] dark:text-white">₹{{ number_format($existingBid->bid_amount) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 dark:text-gray-400">Status</p>
                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-semibold
                            @if($existingBid->status === 'pending') bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400
                            @elseif($existingBid->status === 'accepted') bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400
                            @else bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400
                            @endif">
                            {{ ucfirst($existingBid->status) }}
                        </span>
                    </div>
                </div>
                
                @if($existingBid->message)
                <div class="border-t border-gray-200 dark:border-gray-700 pt-3">
                    <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">Your Message</p>
                    <p class="text-sm text-gray-700 dark:text-gray-300">{{ $existingBid->message }}</p>
                </div>
                @endif
                
                <div class="flex gap-2 mt-4">
                    @if($existingBid->status === 'pending')
                    <a href="{{ route('trader.bids.show', $existingBid) }}" class="flex-1 px-4 py-2 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition text-center">
                        Update Bid
                    </a>
                    @endif
                    <a href="{{ route('trader.bids.show', $existingBid) }}" class="flex-1 px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 transition text-center">
                        View Details
                    </a>
                </div>
            </div>
        </div>
        @else
        <!-- Place New Bid Form -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <h3 class="text-lg font-bold text-[#181511] dark:text-white mb-4">Place Your Bid</h3>
            
            <form action="{{ route('trader.bids.store') }}" method="POST">
                @csrf
                <input type="hidden" name="yield_id" value="{{ $yield->id }}">
                
                <!-- Bid Amount -->
                <x-form.input
                    name="bid_amount"
                    label="Bid Amount (₹)"
                    type="number"
                    step="0.01"
                    min="1"
                    placeholder="Enter your bid amount"
                    required
                />
                
                <!-- Quantity Wanted -->
                <x-form.input
                    name="quantity"
                    label="Quantity Wanted (tons)"
                    type="number"
                    step="0.01"
                    min="0.01"
                    :max="$yield->quantity"
                    placeholder="Max: {{ $yield->quantity }} tons"
                    required
                />
                
                <!-- Message -->
                <x-form.textarea
                    name="message"
                    label="Message to Farmer (Optional)"
                    placeholder="Add any additional details or terms..."
                    rows="3"
                />
                
                <!-- Info Box -->
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-6">
                    <div class="flex gap-3">
                        <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">info</span>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-blue-900 dark:text-blue-300 mb-1">Bidding Tips:</p>
                            <ul class="text-xs text-blue-800 dark:text-blue-400 space-y-1 list-disc list-inside">
                                <li>Farmer's asking price: ₹{{ number_format($yield->price_per_ton) }}/ton</li>
                                <li>Be competitive but fair with your bid</li>
                                <li>Include clear terms in your message</li>
                                <li>Farmer will review and respond to your bid</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="w-full px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition shadow-sm">
                    <span class="flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">gavel</span>
                        <span>Place Bid</span>
                    </span>
                </button>
            </form>
        </div>
        @endif
        
        <!-- Other Bids (if any) -->
        @if($yield->bids->count() > 0)
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-[#181511] dark:text-white">Bids on this Yield</h3>
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-primary/10 text-primary">
                    {{ $yield->bids->count() }} {{ $yield->bids->count() === 1 ? 'Bid' : 'Bids' }}
                </span>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                {{ $yield->bids->count() }} trader(s) have placed bids on this yield.
            </p>
        </div>
        @endif
        
    </main>
    
    <!-- Bottom Navigation -->
    <x-bottom-nav active="market" />
    
</div>

<script>
function changeImage(imageSrc, index) {
    document.getElementById('mainImage').src = imageSrc;
    document.getElementById('currentImageIndex').textContent = index;
    
    // Update thumbnail borders
    const thumbnails = document.querySelectorAll('.thumbnail-btn');
    thumbnails.forEach((thumb, i) => {
        if (i === index - 1) {
            thumb.classList.remove('border-gray-200', 'dark:border-gray-700');
            thumb.classList.add('border-primary');
        } else {
            thumb.classList.remove('border-primary');
            thumb.classList.add('border-gray-200', 'dark:border-gray-700');
        }
    });
}
</script>
@endsection
