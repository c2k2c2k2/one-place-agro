@extends('layouts.app')

@section('title', 'Notifications - One Place Agro')

@section('content')
<div class="relative flex h-full min-h-screen w-full flex-col overflow-x-hidden pb-24 bg-background-light dark:bg-background-dark">
    
    <!-- Header -->
    <x-header title="Notifications" :notificationCount="auth()->user()->unreadNotifications->count()" />
    
    <!-- Main Content -->
    <main class="flex flex-col gap-6 p-4 pt-6">
        
        <!-- Page Title & Actions -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-[#181511] dark:text-white">Notifications</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Stay updated with latest activities</p>
            </div>
            @if($notifications->where('is_read', false)->count() > 0)
            <form action="{{ route('notifications.read-all') }}" method="POST">
                @csrf
                <button type="submit" class="text-sm font-semibold text-primary hover:text-primary-dark transition">
                    Mark all read
                </button>
            </form>
            @endif
        </div>
        
        <!-- Success Message -->
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
            <a href="{{ route('notifications.index') }}" class="px-4 py-2 rounded-lg font-semibold text-sm whitespace-nowrap transition {{ !request('filter') ? 'bg-primary text-white' : 'bg-white dark:bg-surface-dark text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                All ({{ $notifications->total() }})
            </a>
            <a href="{{ route('notifications.index', ['filter' => 'unread']) }}" class="px-4 py-2 rounded-lg font-semibold text-sm whitespace-nowrap transition {{ request('filter') === 'unread' ? 'bg-primary text-white' : 'bg-white dark:bg-surface-dark text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                Unread ({{ auth()->user()->unreadNotifications->count() }})
            </a>
        </div>
        
        <!-- Notifications List -->
        @if($notifications->count() > 0)
        <div class="space-y-3">
            @foreach($notifications as $notification)
            <x-notification-card :notification="$notification" />
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($notifications->hasPages())
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-4">
            {{ $notifications->links() }}
        </div>
        @endif
        
        <!-- Clear Read Notifications -->
        @if($notifications->where('is_read', true)->count() > 0)
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <form action="{{ route('notifications.clear-read') }}" method="POST" onsubmit="return confirm('Are you sure you want to clear all read notifications?');">
                @csrf
                <button type="submit" class="w-full px-6 py-3 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-lg font-semibold hover:bg-red-200 dark:hover:bg-red-900/50 transition">
                    <span class="flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">delete_sweep</span>
                        <span>Clear Read Notifications</span>
                    </span>
                </button>
            </form>
        </div>
        @endif
        @else
        <!-- Empty State -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-12 text-center">
            <div class="flex justify-center mb-4">
                <div class="flex h-20 w-20 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                    <span class="material-symbols-outlined text-4xl text-gray-400">notifications</span>
                </div>
            </div>
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">
                @if(request('filter') === 'unread')
                    No Unread Notifications
                @else
                    No Notifications
                @endif
            </h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                @if(request('filter') === 'unread')
                    You're all caught up! No unread notifications at the moment.
                @else
                    You don't have any notifications yet. We'll notify you when something important happens.
                @endif
            </p>
        </div>
        @endif
        
        <!-- Info Card -->
        <div class="rounded-xl bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 p-6">
            <div class="flex gap-3">
                <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">info</span>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-blue-900 dark:text-blue-300 mb-2">About Notifications</p>
                    <ul class="text-xs text-blue-800 dark:text-blue-400 space-y-1 list-disc list-inside">
                        <li>Get notified about new bids on your yields</li>
                        <li>Receive updates when bids are accepted or rejected</li>
                        <li>Stay informed about market price changes</li>
                        <li>Get alerts for important news and updates</li>
                    </ul>
                </div>
            </div>
        </div>
        
    </main>
    
    <!-- Bottom Navigation -->
    <x-bottom-nav active="profile" />
    
</div>
@endsection
