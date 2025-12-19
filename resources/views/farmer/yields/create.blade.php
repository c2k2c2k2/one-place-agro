@extends('layouts.app')

@section('title', 'Add New Yield - One Place Agro')

@section('content')
<div class="relative flex h-full min-h-screen w-full flex-col overflow-x-hidden pb-24 bg-background-light dark:bg-background-dark">
    
    <!-- Header -->
    <x-header title="Add New Yield" :notificationCount="auth()->user()->unreadNotifications->count()" />
    
    <!-- Main Content -->
    <main class="flex flex-col gap-6 p-4 pt-6">
        
        <!-- Page Title -->
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('farmer.yields.index') }}" class="flex h-10 w-10 items-center justify-center rounded-full bg-white dark:bg-surface-dark shadow-sm">
                <span class="material-symbols-outlined text-gray-600 dark:text-gray-400">arrow_back</span>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-[#181511] dark:text-white">Add New Yield</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">List your orange crop for traders</p>
            </div>
        </div>
        
        <!-- Form Card -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <form action="{{ route('farmer.yields.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Variety Selection -->
                <x-form.select
                    name="variety_id"
                    label="Orange Variety"
                    :options="$varieties->pluck('name', 'id')->toArray()"
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
                    placeholder="e.g., 25000"
                    required
                />
                
                <!-- Harvest Date -->
                <x-form.input
                    name="harvest_date"
                    label="Harvest Date"
                    type="date"
                    :min="date('Y-m-d', strtotime('-30 days'))"
                    :max="date('Y-m-d', strtotime('+90 days'))"
                    required
                />
                
                <!-- Location -->
                <x-form.input
                    name="location"
                    label="Location"
                    type="text"
                    placeholder="e.g., Katol, Nagpur"
                    required
                />
                
                <!-- Description -->
                <x-form.textarea
                    name="description"
                    label="Description (Optional)"
                    placeholder="Add details about quality, packaging, delivery terms, etc."
                    rows="4"
                />
                
                <!-- Image Upload -->
                <x-form.image-upload
                    name="images"
                    label="Upload Images"
                    :maxFiles="5"
                    :maxSize="5"
                    required
                />
                
                <!-- Info Box -->
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-6">
                    <div class="flex gap-3">
                        <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">info</span>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-blue-900 dark:text-blue-300 mb-1">Tips for better listing:</p>
                            <ul class="text-xs text-blue-800 dark:text-blue-400 space-y-1 list-disc list-inside">
                                <li>Upload clear, well-lit photos of your oranges</li>
                                <li>Provide accurate quantity and pricing</li>
                                <li>Mention quality grade and packaging details</li>
                                <li>Specify delivery or pickup terms</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Submit Buttons -->
                <div class="flex gap-3">
                    <button type="submit" class="flex-1 px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition shadow-sm">
                        <span class="flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">check_circle</span>
                            <span>Publish Yield</span>
                        </span>
                    </button>
                    <a href="{{ route('farmer.yields.index') }}" class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
        
    </main>
    
    <!-- Bottom Navigation -->
    <x-bottom-nav active="home" />
    
</div>
@endsection
