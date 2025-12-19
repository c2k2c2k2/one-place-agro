@extends('layouts.app')

@section('title', $news->title . ' - One Place Agro')

@section('content')
<div class="relative flex h-full min-h-screen w-full flex-col overflow-x-hidden pb-24 bg-background-light dark:bg-background-dark">
    
    <!-- Header -->
    <x-header title="News Article" :notificationCount="auth()->user()->unreadNotifications->count()" />
    
    <!-- Main Content -->
    <main class="flex flex-col gap-6 p-4 pt-6">
        
        <!-- Back Button -->
        <div class="flex items-center gap-3">
            <a href="{{ route('news.index') }}" class="flex h-10 w-10 items-center justify-center rounded-full bg-white dark:bg-surface-dark shadow-sm">
                <span class="material-symbols-outlined text-gray-600 dark:text-gray-400">arrow_back</span>
            </a>
        </div>
        
        <!-- Article Card -->
        <article class="rounded-xl bg-white dark:bg-surface-dark shadow-sm overflow-hidden">
            <!-- Featured Image -->
            @if($news->image)
            <div class="relative aspect-video bg-gray-100 dark:bg-gray-800">
                <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="w-full h-full object-cover">
            </div>
            @endif
            
            <div class="p-6">
                <!-- Category Badge -->
                <div class="mb-3">
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold
                        @if($news->category === 'market') bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400
                        @elseif($news->category === 'weather') bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400
                        @elseif($news->category === 'technology') bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400
                        @else bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400
                        @endif">
                        {{ ucfirst($news->category) }}
                    </span>
                </div>
                
                <!-- Title -->
                <h1 class="text-2xl font-bold text-[#181511] dark:text-white mb-3 leading-tight">{{ $news->title }}</h1>
                
                <!-- Meta Information -->
                <div class="flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400 mb-6 pb-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">calendar_today</span>
                        <span>{{ $news->published_at->format('d M Y') }}</span>
                    </div>
                    @if($news->source)
                    <div class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">source</span>
                        <span>{{ $news->source }}</span>
                    </div>
                    @endif
                </div>
                
                <!-- Content -->
                <div class="prose prose-sm dark:prose-invert max-w-none">
                    <div class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">{{ $news->content }}</div>
                </div>
                
                <!-- Tags -->
                @if($news->tags && count($news->tags) > 0)
                <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex flex-wrap gap-2">
                        @foreach($news->tags as $tag)
                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                            #{{ $tag }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Share Section -->
                <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Share this article</p>
                    <div class="flex gap-3">
                        <button class="flex-1 px-4 py-2 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-lg font-semibold hover:bg-blue-200 dark:hover:bg-blue-900/50 transition">
                            <span class="flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined">share</span>
                                <span>Share</span>
                            </span>
                        </button>
                        <button class="flex-1 px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-lg font-semibold hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                            <span class="flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined">bookmark</span>
                                <span>Save</span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </article>
        
        <!-- Related News -->
        @if($relatedNews && $relatedNews->count() > 0)
        <div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-6">
            <h3 class="text-lg font-bold text-[#181511] dark:text-white mb-4">Related News</h3>
            <div class="space-y-3">
                @foreach($relatedNews as $related)
                <x-news-card :news="$related" />
                @endforeach
            </div>
        </div>
        @endif
        
    </main>
    
    <!-- Bottom Navigation -->
    <x-bottom-nav active="home" />
    
</div>
@endsection
