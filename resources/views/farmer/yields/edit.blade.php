@extends('layouts.app')

@section('title', 'Edit Yield - One Place Agro')

@section('content')
<div class="relative flex h-full min-h-screen w-full flex-col overflow-x-hidden pb-24 bg-background-light dark:bg-background-dark">
    
    <!-- Header -->
    <x-header title="Edit Yield" :notificationCount="auth()->user()->unreadNotifications->count()" />
    
    <!-- Main Content -->
    <main class="flex flex-col gap-6 p-4 pt-6">
        
        <!-- Page Title -->
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('farmer.yields.show', $yield) }}" class="flex h-10 w-10 items-center justify-center rounded-full bg-white dark:bg-surface-dark shadow-sm">
                <span class="material-symbols-outlined text-gray-600 dark:text-gray-400">arrow_back</span>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-[#181511] dark:text-white">Edit Yield</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Update your listing details</p>
            </div>
        </div>
        
        <!-- Form Card -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <form action="{{ route('farmer.yields.update', $yield) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Variety Selection -->
                <x-form.select
                    name="variety_id"
                    label="Orange Variety"
                    :options="$varieties->pluck('name', 'id')->toArray()"
                    :selected="$yield->variety_id"
                    placeholder="Select variety"
                    required
                />
                
                <!-- Quantity -->
                <x-form.input
                    name="quantity"
                    label="Quantity (in tons)"
                    type="number"
                    step="0.01"
                    min="0.01"
                    :value="$yield->quantity"
                    placeholder="e.g., 10.5"
                    required
                />
                
                <!-- Price Per Ton -->
                <x-form.input
                    name="price_per_ton"
                    label="Price Per Ton (₹)"
                    type="number"
                    step="0.01"
                    min="1"
                    :value="$yield->price_per_ton"
                    placeholder="e.g., 25000"
                    required
                />
                
                <!-- Harvest Date -->
                <x-form.input
                    name="harvest_date"
                    label="Harvest Date"
                    type="date"
                    :value="$yield->harvest_date"
                    :min="date('Y-m-d', strtotime('-30 days'))"
                    :max="date('Y-m-d', strtotime('+90 days'))"
                    required
                />
                
                <!-- Location -->
                <x-form.input
                    name="location"
                    label="Location"
                    type="text"
                    :value="$yield->location"
                    placeholder="e.g., Katol, Nagpur"
                    required
                />
                
                <!-- Description -->
                <x-form.textarea
                    name="description"
                    label="Description (Optional)"
                    :value="$yield->description"
                    placeholder="Add details about quality, packaging, delivery terms, etc."
                    rows="4"
                />
                
                <!-- Existing Images Management -->
                @if($yield->images && count($yield->images) > 0)
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                        Existing Images
                    </label>
                    <div class="grid grid-cols-3 gap-3">
                        @foreach($yield->images as $index => $image)
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $image) }}" alt="Yield image {{ $index + 1 }}" class="w-full h-24 object-cover rounded-lg">
                            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                <label class="cursor-pointer">
                                    <input type="checkbox" name="delete_images[]" value="{{ $image }}" class="sr-only peer">
                                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-red-500 peer-checked:bg-red-600 text-white">
                                        <span class="material-symbols-outlined">delete</span>
                                    </div>
                                </label>
                            </div>
                            <div class="absolute top-2 right-2 bg-black/60 text-white px-2 py-1 rounded text-xs">
                                {{ $index + 1 }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                        <span class="material-symbols-outlined text-sm align-middle">info</span>
                        Hover over images and click the delete icon to remove them
                    </p>
                </div>
                @endif
                
                <!-- Add New Images -->
                <x-form.image-upload
                    name="images"
                    label="Add New Images (Optional)"
                    :maxFiles="5"
                    :maxSize="5"
                />
                
                <!-- Info Box -->
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-6">
                    <div class="flex gap-3">
                        <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">info</span>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-blue-900 dark:text-blue-300 mb-1">Important Notes:</p>
                            <ul class="text-xs text-blue-800 dark:text-blue-400 space-y-1 list-disc list-inside">
                                <li>You can delete existing images by hovering and clicking the delete icon</li>
                                <li>Add new images to replace deleted ones or add more photos</li>
                                <li>Changes will be saved when you click "Update Yield"</li>
                                @if($yield->bids()->accepted()->exists())
                                <li class="text-orange-600 dark:text-orange-400 font-semibold">⚠️ This yield has accepted bids. Major changes may affect agreements.</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Submit Buttons -->
                <div class="flex gap-3">
                    <button type="submit" class="flex-1 px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition shadow-sm">
                        <span class="flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">check_circle</span>
                            <span>Update Yield</span>
                        </span>
                    </button>
                    <a href="{{ route('farmer.yields.show', $yield) }}" class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
        
        <!-- Yield Statistics -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <h3 class="text-lg font-bold text-[#181511] dark:text-white mb-4">Yield Statistics</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">visibility</span>
                        <div>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Views</p>
                            <p class="text-lg font-bold text-[#181511] dark:text-white">{{ $yield->views ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-green-600 dark:text-green-400">gavel</span>
                        <div>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Total Bids</p>
                            <p class="text-lg font-bold text-[#181511] dark:text-white">{{ $yield->bids->count() }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-orange-50 dark:bg-orange-900/20 rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-orange-600 dark:text-orange-400">schedule</span>
                        <div>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Pending Bids</p>
                            <p class="text-lg font-bold text-[#181511] dark:text-white">{{ $yield->bids()->pending()->count() }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-purple-50 dark:bg-purple-900/20 rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-purple-600 dark:text-purple-400">check_circle</span>
                        <div>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Accepted Bids</p>
                            <p class="text-lg font-bold text-[#181511] dark:text-white">{{ $yield->bids()->accepted()->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    Listed on {{ $yield->created_at->format('d M Y, h:i A') }}
                </p>
                @if($yield->updated_at != $yield->created_at)
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    Last updated {{ $yield->updated_at->diffForHumans() }}
                </p>
                @endif
            </div>
        </div>
        
    </main>
    
    <!-- Bottom Navigation -->
    <x-bottom-nav active="home" />
    
</div>
@endsection
