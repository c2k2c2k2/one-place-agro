@extends('layouts.app')

@section('title', 'Post Requirement - One Place Agro')

@section('content')
<div class="relative flex h-full min-h-screen w-full flex-col overflow-x-hidden pb-24 bg-background-light dark:bg-background-dark">
    
    <!-- Header -->
    <x-header title="Post Requirement" :notificationCount="auth()->user()->unreadNotifications->count()" />
    
    <!-- Main Content -->
    <main class="flex flex-col gap-6 p-4 pt-6">
        
        <!-- Page Title -->
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('trader.requirements.index') }}" class="flex h-10 w-10 items-center justify-center rounded-full bg-white dark:bg-surface-dark shadow-sm">
                <span class="material-symbols-outlined text-gray-600 dark:text-gray-400">arrow_back</span>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-[#181511] dark:text-white">Post Requirement</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Let farmers know what you need</p>
            </div>
        </div>
        
        <!-- Form Card -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <form action="{{ route('trader.requirements.store') }}" method="POST">
                @csrf
                
                <!-- Variety Selection -->
                <x-form.select
                    name="variety_id"
                    label="Orange Variety"
                    :options="$varieties->pluck('name', 'id')->toArray()"
                    placeholder="Select variety"
                    required
                />
                
                <!-- Quantity Required -->
                <x-form.input
                    name="quantity_required"
                    label="Quantity Required (in tons)"
                    type="number"
                    step="0.01"
                    min="0.01"
                    placeholder="e.g., 50"
                    required
                />
                
                <!-- Max Budget -->
                <x-form.input
                    name="max_budget"
                    label="Maximum Budget (₹)"
                    type="number"
                    step="0.01"
                    min="1"
                    placeholder="e.g., 500000"
                    required
                />
                
                <!-- Location -->
                <x-form.input
                    name="location"
                    label="Delivery Location"
                    type="text"
                    placeholder="e.g., Nagpur, Maharashtra"
                    required
                />
                
                <!-- Description -->
                <x-form.textarea
                    name="description"
                    label="Additional Details"
                    placeholder="Specify quality requirements, packaging preferences, delivery terms, payment terms, etc."
                    rows="5"
                    required
                />
                
                <!-- Info Box -->
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-6">
                    <div class="flex gap-3">
                        <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">info</span>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-blue-900 dark:text-blue-300 mb-1">Tips for posting requirements:</p>
                            <ul class="text-xs text-blue-800 dark:text-blue-400 space-y-1 list-disc list-inside">
                                <li>Be specific about quality and quantity needs</li>
                                <li>Mention packaging and delivery preferences</li>
                                <li>Include payment terms if applicable</li>
                                <li>Set realistic budget and timeline</li>
                                <li>Farmers will be able to see and respond to your requirement</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Submit Buttons -->
                <div class="flex gap-3">
                    <button type="submit" class="flex-1 px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition shadow-sm">
                        <span class="flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">check_circle</span>
                            <span>Post Requirement</span>
                        </span>
                    </button>
                    <a href="{{ route('trader.requirements.index') }}" class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 transition">
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
