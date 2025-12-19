@props([
    'notification'
])

@php
    $isClickable = !empty($notification->action_url);
    $wrapperTag = $isClickable ? 'a' : 'div';
    $wrapperAttrs = $isClickable ? 'href="' . $notification->action_url . '"' : '';
@endphp

<{{ $wrapperTag }} {!! $wrapperAttrs !!} class="flex gap-4 rounded-xl bg-white dark:bg-surface-dark p-4 shadow-sm hover:shadow-md transition {{ $notification->is_read ? 'opacity-75' : '' }} {{ $isClickable ? 'cursor-pointer' : '' }}">
    <div class="flex-shrink-0">
        <div class="flex h-10 w-10 items-center justify-center rounded-full 
            @if($notification->type === 'bid_received') bg-orange-100 dark:bg-orange-900/30 text-primary
            @elseif($notification->type === 'bid_accepted') bg-green-100 dark:bg-green-900/30 text-green-600
            @elseif($notification->type === 'bid_rejected') bg-red-100 dark:bg-red-900/30 text-red-600
            @elseif($notification->type === 'market_alert') bg-blue-100 dark:bg-blue-900/30 text-blue-600
            @elseif($notification->type === 'requirement_matched') bg-purple-100 dark:bg-purple-900/30 text-purple-600
            @else bg-gray-100 dark:bg-gray-800 text-gray-600
            @endif">
            <span class="material-symbols-outlined text-xl">
                @if($notification->type === 'bid_received') gavel
                @elseif($notification->type === 'bid_accepted') check_circle
                @elseif($notification->type === 'bid_rejected') cancel
                @elseif($notification->type === 'market_alert') trending_up
                @elseif($notification->type === 'requirement_matched') shopping_cart
                @else notifications
                @endif
            </span>
        </div>
    </div>
    
    <div class="flex flex-col flex-1 min-w-0">
        <div class="flex items-start justify-between gap-2 mb-1">
            <p class="text-sm font-bold text-[#181511] dark:text-white">{{ $notification->title }}</p>
            @if(!$notification->is_read)
                <span class="flex-shrink-0 h-2 w-2 rounded-full bg-primary"></span>
            @endif
        </div>
        
        <p class="text-xs text-gray-600 dark:text-gray-300 leading-relaxed mb-2">{{ $notification->message }}</p>
        
        <div class="flex items-center justify-between">
            <p class="text-[10px] font-medium text-gray-400">{{ $notification->created_at->diffForHumans() }}</p>
            
            <div class="flex gap-2" onclick="event.stopPropagation();">
                @if(!$notification->is_read)
                    <form action="{{ route('notifications.read', $notification) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-xs text-primary hover:text-primary-dark font-medium">
                            Mark as read
                        </button>
                    </form>
                @endif
            </div>
        </div>
        
        @if($isClickable)
        <div class="mt-2 pt-2 border-t border-gray-100 dark:border-gray-700">
            <p class="text-xs text-primary font-medium flex items-center gap-1">
                <span>View Details</span>
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </p>
        </div>
        @endif
    </div>
</{{ $wrapperTag }}>
