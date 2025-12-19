@extends('layouts.app')

@section('title', 'My Requirements - One Place Agro')

@section('content')
<div class="relative flex h-full min-h-screen w-full flex-col overflow-x-hidden pb-24 bg-background-light dark:bg-background-dark">
    
    <!-- Header -->
    <x-header title="My Requirements" :notificationCount="auth()->user()->unreadNotifications->count()" />
    
    <!-- Main Content -->
    <main class="flex flex-col gap-6 p-4 pt-6">
        
        <!-- Page Title & Add Button -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-[#181511] dark:text-white">Requirements</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Manage your buying requirements</p>
            </div>
            <a href="{{ route('trader.requirements.create') }}" class="flex h-12 w-12 items-center justify-center rounded-full bg-primary text-white shadow-lg hover:bg-primary-dark transition">
                <span class="material-symbols-outlined">add</span>
            </a>
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
        
        <!-- Filter Tabs -->
        <div class="flex gap-2 overflow-x-auto pb-2">
            <a href="{{ route('trader.requirements.index') }}" class="px-4 py-2 rounded-lg font-semibold text-sm whitespace-nowrap transition {{ !request('status') ? 'bg-primary text-white' : 'bg-white dark:bg-surface-dark text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                All ({{ $requirements->total() }})
            </a>
            <a href="{{ route('trader.requirements.index', ['status' => 'active']) }}" class="px-4 py-2 rounded-lg font-semibold text-sm whitespace-nowrap transition {{ request('status') === 'active' ? 'bg-primary text-white' : 'bg-white dark:bg-surface-dark text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                Active
            </a>
            <a href="{{ route('trader.requirements.index', ['status' => 'inactive']) }}" class="px-4 py-2 rounded-lg font-semibold text-sm whitespace-nowrap transition {{ request('status') === 'inactive' ? 'bg-primary text-white' : 'bg-white dark:bg-surface-dark text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                Inactive
            </a>
            <a href="{{ route('trader.requirements.index', ['status' => 'fulfilled']) }}" class="px-4 py-2 rounded-lg font-semibold text-sm whitespace-nowrap transition {{ request('status') === 'fulfilled' ? 'bg-primary text-white' : 'bg-white dark:bg-surface-dark text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                Fulfilled
            </a>
        </div>
        
        <!-- Requirements List -->
        @if($requirements->count() > 0)
        <div class="space-y-4">
            @foreach($requirements as $requirement)
            <x-requirement-card :requirement="$requirement" :showActions="true" />
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
                    <span class="material-symbols-outlined text-4xl text-gray-400">list_alt</span>
                </div>
            </div>
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">
                @if(request('status'))
                    No {{ ucfirst(request('status')) }} Requirements
                @else
                    No Requirements Yet
                @endif
            </h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                @if(request('status'))
                    You don't have any {{ request('status') }} requirements at the moment.
                @else
                    Post your first requirement to let farmers know what you're looking for.
                @endif
            </p>
            <a href="{{ route('trader.requirements.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition shadow-sm">
                <span class="material-symbols-outlined">add</span>
                <span>Post Requirement</span>
            </a>
        </div>
        @endif
        
        <!-- Info Card -->
        <div class="rounded-xl bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 p-6">
            <div class="flex gap-3">
                <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">info</span>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-blue-900 dark:text-blue-300 mb-2">About Requirements</p>
                    <ul class="text-xs text-blue-800 dark:text-blue-400 space-y-1 list-disc list-inside">
                        <li>Post what you're looking to buy from farmers</li>
                        <li>Farmers can see your requirements and contact you</li>
                        <li>Toggle requirements active/inactive as needed</li>
                        <li>Mark as fulfilled when you've completed the purchase</li>
                    </ul>
                </div>
            </div>
        </div>
        
    </main>
    
    <!-- Bottom Navigation -->
    <x-bottom-nav active="home" />
    
</div>
@endsection
