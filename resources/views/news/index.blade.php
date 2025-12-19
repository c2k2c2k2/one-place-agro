@extends('layouts.app')

@section('title', 'Agri News - One Place Agro')

@section('content')
<div class="relative flex h-full min-h-screen w-full flex-col overflow-x-hidden pb-24 bg-background-light dark:bg-background-dark">
    
    <!-- Header -->
    <x-header title="Agri News" :notificationCount="auth()->user()->unreadNotifications->count()" />
    
    <!-- Main Content -->
    <main class="flex flex-col gap-6 p-4 pt-6">
        
        <!-- Page Title & Search -->
        <div>
            <h1 class="text-2xl font-bold text-[#181511] dark:text-white mb-4">Agriculture News</h1>
            
            <!-- Search Bar -->
            <form action="{{ route('news.index') }}" method="GET" class="relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search news..."
                    class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-[#181511] dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-primary focus:border-transparent"
                >
            </form>
        </div>
        
        <!-- Category Filter -->
        <div class="flex gap-2 overflow-x-auto pb-2">
            <a href="{{ route('news.index') }}" class="px-4 py-2 rounded-lg font-semibold text-sm whitespace-nowrap transition {{ !request('category') ? 'bg-primary text-white' : 'bg-white dark:bg-surface-dark text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                All
            </a>
            <a href="{{ route('news.index', ['category' => 'market']) }}" class="px-4 py-2 rounded-lg font-semibold text-sm whitespace-nowrap transition {{ request('category') === 'market' ? 'bg-primary text-white' : 'bg-white dark:bg-surface-dark text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                Market
            </a>
            <a href="{{ route('news.index', ['category' => 'weather']) }}" class="px-4 py-2 rounded-lg font-semibold text-sm whitespace-nowrap transition {{ request('category') === 'weather' ? 'bg-primary text-white' : 'bg-white dark:bg-surface-dark text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                Weather
            </a>
            <a href="{{ route('news.index', ['category' => 'technology']) }}" class="px-4 py-2 rounded-lg font-semibold text-sm whitespace-nowrap transition {{ request('category') === 'technology' ? 'bg-primary text-white' : 'bg-white dark:bg-surface-dark text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                Technology
            </a>
            <a href="{{ route('news.index', ['category' => 'policy']) }}" class="px-4 py-2 rounded-lg font-semibold text-sm whitespace-nowrap transition {{ request('category') === 'policy' ? 'bg-primary text-white' : 'bg-white dark:bg-surface-dark text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                Policy
            </a>
        </div>
        
        <!-- News List -->
        @if($news->count() > 0)
        <div class="space-y-4">
            @foreach($news as $article)
            <x-news-card :news="$article" />
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($news->hasPages())
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-4">
            {{ $news->links() }}
        </div>
        @endif
        @else
        <!-- Empty State -->
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-12 text-center">
            <div class="flex justify-center mb-4">
                <div class="flex h-20 w-20 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800">
                    <span class="material-symbols-outlined text-4xl text-gray-400">newspaper</span>
                </div>
            </div>
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">No News Found</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                @if(request('search') || request('category'))
                    No news articles match your search criteria.
                @else
                    No news articles are available at the moment.
                @endif
            </p>
        </div>
        @endif
        
    </main>
    
    <!-- Bottom Navigation -->
    <x-bottom-nav active="home" />
    
</div>
@endsection
