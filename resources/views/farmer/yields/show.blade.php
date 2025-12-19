@extends('layouts.app')

@section('title', 'Yield Details - One Place Agro')

@section('content')
<div class="relative flex h-full min-h-screen w-full flex-col overflow-x-hidden pb-24 bg-background-light dark:bg-background-dark">
    
    <!-- Header -->
    <x-header title="Yield Details" :notificationCount="auth()->user()->unreadNotifications->count()" />
    
    <!-- Main Content -->
    <main class="flex flex-col gap-6 p-4 pt-6">
        
        <!-- Back Button & Actions -->
        <div class="flex items-center justify-between mb-2">
            <a href="{{ route('farmer.yields.index') }}" class="flex h-10 w-10 items-center justify-center rounded-full bg-white dark:bg-surface-dark shadow-sm">
                <span class="material-symbols-outlined text-gray-600 dark:text-gray-400">arrow_back</span>
            </a>
            <div class="flex gap-2">
                <a href="{{ route('farmer.yields.edit', $yield) }}" class="flex h-10 w-10 items-center justify-center rounded-full bg-primary text-white shadow-sm hover:bg-primary-dark transition">
                    <span class="material-symbols-outlined">edit</span>
                </a>
                <form action="{{ route('farmer.yields.destroy', $yield) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this yield?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="flex h-10 w-10 items-center justify-center rounded-full bg-red-500 text-white shadow-sm hover:bg-red-600 transition">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </form>
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
            <!-- Status Badge -->
            <div class="mb-4">
                @if($yield->status === 'active')
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400">
                    <span class="material-symbols-outlined text-sm">check_circle</span>
                    Active
                </span>
                @elseif($yield->status === 'sold')
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400">
                    <span class="material-symbols-outlined text-sm">shopping_cart</span>
                    Sold
                </span>
                @else
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-400">
                    <span class="material-symbols-outlined text-sm">schedule</span>
                    {{ ucfirst($yield->status) }}
                </span>
                @endif
            </div>
            
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
            
            <!-- Posted Date -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-4">
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    Posted on {{ $yield->created_at->format('d M Y, h:i A') }}
                </p>
            </div>
        </div>
        
        <!-- Bids Section -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-[#181511] dark:text-white">Bids Received</h3>
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-primary/10 text-primary">
                    {{ $yield->bids->count() }} {{ $yield->bids->count() === 1 ? 'Bid' : 'Bids' }}
                </span>
            </div>
            
            @if($yield->bids->count() > 0)
            <div class="space-y-3">
                @foreach($yield->bids as $bid)
                <x-bid-card :bid="$bid" :showActions="true" />
                @endforeach
            </div>
            @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <div class="flex justify-center mb-4">
                    <div class="flex h-20 w-20 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                        <span class="material-symbols-outlined text-4xl text-gray-400">gavel</span>
                    </div>
                </div>
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">No Bids Yet</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Traders haven't placed any bids on this yield yet.</p>
            </div>
            @endif
        </div>
        
    </main>
    
    <!-- Bottom Navigation -->
    <x-bottom-nav active="home" />
    
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
