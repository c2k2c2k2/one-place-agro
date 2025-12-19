@props([
    'news',
    'compact' => false
])

@if($compact)
    <!-- Compact Version for Lists -->
    <a href="{{ route('news.show', $news) }}" class="flex gap-3 rounded-xl bg-white dark:bg-surface-dark shadow-sm hover:shadow-md transition p-3">
        @if($news->thumbnail)
            <div class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden bg-gray-200 dark:bg-gray-700">
                <img src="{{ asset('storage/' . $news->thumbnail) }}" 
                     alt="{{ $news->title }}" 
                     class="w-full h-full object-cover">
            </div>
        @endif
        
        <div class="flex-1 min-w-0">
            <h3 class="text-sm font-bold text-[#181511] dark:text-white mb-1 line-clamp-2">{{ $news->title }}</h3>
            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                <span>{{ $news->source }}</span>
                <span>•</span>
                <span>{{ $news->published_at->diffForHumans() }}</span>
            </div>
        </div>
    </a>
@else
    <!-- Full Version -->
    <a href="{{ route('news.show', $news) }}" class="block rounded-xl bg-white dark:bg-surface-dark shadow-sm hover:shadow-md transition overflow-hidden">
        @if($news->thumbnail)
            <div class="relative h-48 bg-gray-200 dark:bg-gray-700">
                <img src="{{ asset('storage/' . $news->thumbnail) }}" 
                     alt="{{ $news->title }}" 
                     class="w-full h-full object-cover">
            </div>
        @endif
        
        <div class="p-4">
            <h3 class="text-lg font-bold text-[#181511] dark:text-white mb-2 line-clamp-2">{{ $news->title }}</h3>
            
            @if($news->content)
                <p class="text-sm text-gray-600 dark:text-gray-300 mb-3 line-clamp-3">
                    {{ Str::limit(strip_tags($news->content), 150) }}
                </p>
            @endif
            
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                    <span class="material-symbols-outlined text-sm">article</span>
                    <span>{{ $news->source }}</span>
                </div>
                <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                    <span class="material-symbols-outlined text-sm">schedule</span>
                    <span>{{ $news->published_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>
    </a>
@endif
