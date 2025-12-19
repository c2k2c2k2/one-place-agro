@extends('layouts.app')

@section('title', 'Bid Details - One Place Agro')

@section('content')
<div class="relative flex h-full min-h-screen w-full flex-col overflow-x-hidden pb-24 bg-background-light dark:bg-background-dark">
    
    <!-- Header -->
    <x-header title="Bid Details" :notificationCount="auth()->user()->unreadNotifications->count()" />
    
    <!-- Main Content -->
    <main class="flex flex-col gap-6 p-4 pt-6">
        
        <!-- Back Button -->
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('trader.bids.index') }}" class="flex h-10 w-10 items-center justify-center rounded-full bg-white dark:bg-surface-dark shadow-sm">
                <span class="material-symbols-outlined text-gray-600 dark:text-gray-400">arrow_back</span>
            </a>
            <div>
                <h1 class="text-xl font-bold text-[#181511] dark:text-white">Bid Details</h1>
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
        
        <!-- Bid Status Card -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-[#181511] dark:text-white">Bid Status</h2>
                @if($bid->status === 'pending')
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400">
                    <span class="material-symbols-outlined text-sm">schedule</span>
                    Pending
                </span>
                @elseif($bid->status === 'accepted')
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400">
                    <span class="material-symbols-outlined text-sm">check_circle</span>
                    Accepted
                </span>
                @else
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400">
                    <span class="material-symbols-outlined text-sm">cancel</span>
                    Rejected
                </span>
                @endif
            </div>
            
            <!-- Bid Amount -->
            <div class="bg-primary/10 dark:bg-primary/20 rounded-lg p-4 mb-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Your Bid Amount</span>
                    <span class="text-2xl font-bold text-primary">₹{{ number_format($bid->bid_amount) }}</span>
                </div>
            </div>
            
            <!-- Bid Details -->
            <div class="space-y-3">
                <div class="flex items-center justify-between py-2 border-b border-gray-200 dark:border-gray-700">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Quantity</span>
                    <span class="text-sm font-semibold text-[#181511] dark:text-white">{{ number_format($bid->quantity, 2) }} tons</span>
                </div>
                
                <div class="flex items-center justify-between py-2 border-b border-gray-200 dark:border-gray-700">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Total Value</span>
                    <span class="text-sm font-semibold text-[#181511] dark:text-white">₹{{ number_format($bid->bid_amount * $bid->quantity) }}</span>
                </div>
                
                <div class="flex items-center justify-between py-2 border-b border-gray-200 dark:border-gray-700">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Placed On</span>
                    <span class="text-sm font-semibold text-[#181511] dark:text-white">{{ $bid->created_at->format('d M Y, h:i A') }}</span>
                </div>
                
                @if($bid->updated_at != $bid->created_at)
                <div class="flex items-center justify-between py-2">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Last Updated</span>
                    <span class="text-sm font-semibold text-[#181511] dark:text-white">{{ $bid->updated_at->diffForHumans() }}</span>
                </div>
                @endif
            </div>
            
            <!-- Your Message -->
            @if($bid->message)
            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Your Message</p>
                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ $bid->message }}</p>
            </div>
            @endif
        </div>
        
        <!-- Yield Information -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <h3 class="text-lg font-bold text-[#181511] dark:text-white mb-4">Yield Information</h3>
            
            <div class="flex items-start gap-4 mb-4">
                @if($bid->yield->images && count($bid->yield->images) > 0)
                <img src="{{ asset('storage/' . $bid->yield->images[0]) }}" alt="{{ $bid->yield->variety->name }}" class="w-20 h-20 rounded-lg object-cover">
                @else
                <div class="w-20 h-20 rounded-lg bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                    <span class="material-symbols-outlined text-gray-400">image</span>
                </div>
                @endif
                
                <div class="flex-1">
                    <h4 class="font-bold text-[#181511] dark:text-white mb-1">{{ $bid->yield->variety->name }}</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ number_format($bid->yield->quantity, 2) }} tons @ ₹{{ number_format($bid->yield->price_per_ton) }}/ton</p>
                    <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">{{ $bid->yield->location }}</p>
                </div>
            </div>
            
            <a href="{{ route('trader.yields.show', $bid->yield) }}" class="block w-full px-4 py-2 bg-gray-100 dark:bg-gray-800 text-center text-sm font-semibold text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                View Yield Details
            </a>
        </div>
        
        <!-- Farmer Information -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <h3 class="text-lg font-bold text-[#181511] dark:text-white mb-4">Farmer Information</h3>
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10">
                    <span class="material-symbols-outlined text-primary text-2xl">person</span>
                </div>
                <div>
                    <p class="font-semibold text-[#181511] dark:text-white">{{ $bid->yield->farmer->name }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $bid->yield->farmer->location }}</p>
                    @if($bid->yield->farmer->phone)
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $bid->yield->farmer->phone }}</p>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Actions -->
        @if($bid->status === 'pending')
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <h3 class="text-lg font-bold text-[#181511] dark:text-white mb-4">Actions</h3>
            
            <!-- Update Bid Form -->
            <form action="{{ route('trader.bids.update', $bid) }}" method="POST" class="mb-4">
                @csrf
                @method('PUT')
                
                <x-form.input
                    name="bid_amount"
                    label="Update Bid Amount (₹)"
                    type="number"
                    step="0.01"
                    min="1"
                    :value="$bid->bid_amount"
                    placeholder="Enter new bid amount"
                    required
                />
                
                <x-form.input
                    name="quantity"
                    label="Update Quantity (tons)"
                    type="number"
                    step="0.01"
                    min="0.01"
                    :max="$bid->yield->quantity"
                    :value="$bid->quantity"
                    placeholder="Enter quantity"
                    required
                />
                
                <x-form.textarea
                    name="message"
                    label="Update Message (Optional)"
                    :value="$bid->message"
                    placeholder="Update your message to the farmer..."
                    rows="3"
                />
                
                <button type="submit" class="w-full px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition shadow-sm">
                    <span class="flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">update</span>
                        <span>Update Bid</span>
                    </span>
                </button>
            </form>
            
            <!-- Cancel Bid -->
            <form action="{{ route('trader.bids.cancel', $bid) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this bid?');">
                @csrf
                <button type="submit" class="w-full px-6 py-3 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-lg font-semibold hover:bg-red-200 dark:hover:bg-red-900/50 transition">
                    <span class="flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">cancel</span>
                        <span>Cancel Bid</span>
                    </span>
                </button>
            </form>
        </div>
        @elseif($bid->status === 'accepted')
        <!-- Accepted Bid Info -->
        <div class="rounded-xl bg-green-50 dark:bg-green-900/20 border-2 border-green-200 dark:border-green-800 p-6">
            <div class="flex gap-3">
                <span class="material-symbols-outlined text-green-600 dark:text-green-400">celebration</span>
                <div class="flex-1">
                    <h3 class="font-bold text-green-900 dark:text-green-300 mb-2">Congratulations! Your bid was accepted</h3>
                    <p class="text-sm text-green-800 dark:text-green-400 mb-3">
                        The farmer has accepted your bid. Please contact them to proceed with the transaction.
                    </p>
                    <div class="bg-white dark:bg-green-900/30 rounded-lg p-3">
                        <p class="text-xs text-green-900 dark:text-green-300 font-semibold mb-1">Next Steps:</p>
                        <ul class="text-xs text-green-800 dark:text-green-400 space-y-1 list-disc list-inside">
                            <li>Contact the farmer to arrange payment and delivery</li>
                            <li>Verify quality and quantity before finalizing</li>
                            <li>Complete the transaction as per agreed terms</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif
        
    </main>
    
    <!-- Bottom Navigation -->
    <x-bottom-nav active="home" />
    
</div>
@endsection
