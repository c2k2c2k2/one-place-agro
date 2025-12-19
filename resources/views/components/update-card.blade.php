@props([
    'icon' => 'notifications',
    'iconColor' => 'primary',
    'iconBgColor' => 'orange-100',
    'darkIconBgColor' => 'orange-900/30',
    'title' => 'Update',
    'message' => 'Update message',
    'timestamp' => 'Just now',
    'borderColor' => 'primary'
])

<div class="flex gap-4 rounded-xl bg-white dark:bg-surface-dark p-4 shadow-sm border-l-4 border-{{ $borderColor }}">
    <div class="flex-shrink-0">
        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-{{ $iconBgColor }} dark:bg-{{ $darkIconBgColor }} text-{{ $iconColor }}">
            <span class="material-symbols-outlined text-xl">{{ $icon }}</span>
        </div>
    </div>
    <div class="flex flex-col flex-1">
        <p class="text-sm font-bold text-[#181511] dark:text-white">{{ $title }}</p>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 leading-relaxed">{{ $message }}</p>
        <p class="text-[10px] font-medium text-gray-400 mt-2">{{ $timestamp }}</p>
    </div>
</div>
