@extends('layouts.app')

@section('title', 'Edit Requirement - One Place Agro')

@section('content')
<div class="relative flex h-full min-h-screen w-full flex-col overflow-x-hidden pb-24 bg-background-light dark:bg-background-dark">
    
    <!-- Header -->
    <x-header title="Edit Requirement" :notificationCount="auth()->user()->unreadNotifications->count()" />
    
    <!-- Main Content -->
    <main class="flex flex-col gap-6 p-4 pt-6">
        
        <!-- Page Title -->
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('trader.requirements.show', $requirement) }}" class="flex h-10 w-10 items-center justify-center rounded-full bg-white dark:bg-surface-dark shadow-sm">
                <span class="material-symbols-outlined text-gray-600 dark:text-gray-400">arrow_back</span>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-[#181511] dark:text-white">Edit Requirement</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Update your requirement details</p>
            </div>
        </div>
        
        <!-- Form Card -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <form action="{{ route('trader.requirements.update', $requirement) }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Variety Selection -->
                <x-form.select
                    name="variety_id"
                    label="Orange Variety"
                    :options="$varieties->pluck('name', 'id')->toArray()"
                    :selected="$requirement->variety_id"
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
                    :value="$requirement->quantity_required"
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
                    :value="$requirement->max_budget"
                    placeholder="e.g., 500000"
                    required
                />
                
                <!-- Location -->
                <x-form.input
                    name="location"
                    label="Delivery Location"
                    type="text"
                    :value="$requirement->location"
                    placeholder="e.g., Nagpur, Maharashtra"
                    required
                />
                
                <!-- Description -->
                <x-form.textarea
                    name="description"
                    label="Additional Details"
                    :value="$requirement->description"
                    placeholder="Specify quality requirements, packaging preferences, delivery terms, payment terms, etc."
                    rows="5"
                    required
                />
                
                <!-- Info Box -->
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-6">
                    <div class="flex gap-3">
                        <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">info</span>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-blue-900 dark:text-blue-300 mb-1">Important Notes:</p>
                            <ul class="text-xs text-blue-800 dark:text-blue-400 space-y-1 list-disc list-inside">
                                <li>Changes will be visible to all farmers immediately</li>
                                <li>Farmers who have already contacted you will see the updates</li>
                                <li>Consider notifying interested farmers about major changes</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Submit Buttons -->
                <div class="flex gap-3">
                    <button type="submit" class="flex-1 px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition shadow-sm">
                        <span class="flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">check_circle</span>
                            <span>Update Requirement</span>
                        </span>
                    </button>
                    <a href="{{ route('trader.requirements.show', $requirement) }}" class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
        
        <!-- Requirement Statistics -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <h3 class="text-lg font-bold text-[#181511] dark:text-white mb-4">Requirement Statistics</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">visibility</span>
                        <div>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Views</p>
                            <p class="text-lg font-bold text-[#181511] dark:text-white">{{ $requirement->views ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-green-600 dark:text-green-400">{{ $requirement->is_active ? 'check_circle' : 'pause_circle' }}</span>
                        <div>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Status</p>
                            <p class="text-sm font-bold text-[#181511] dark:text-white">{{ $requirement->is_active ? 'Active' : 'Inactive' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    Posted on {{ $requirement->created_at->format('d M Y, h:i A') }}
                </p>
                @if($requirement->updated_at != $requirement->created_at)
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    Last updated {{ $requirement->updated_at->diffForHumans() }}
                </p>
                @endif
            </div>
        </div>
        
    </main>
    
    <!-- Bottom Navigation -->
    <x-bottom-nav active="home" />
    
</div>
@endsection
