@props([
    'icon' => 'analytics',
    'label' => 'Statistic',
    'value' => '0',
    'bgColor' => 'primary',
    'iconColor' => 'white',
    'trend' => null, // 'up', 'down', or null
    'trendValue' => null
])

<div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm p-4">
    <div class="flex items-start justify-between mb-3">
        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-{{ $bgColor }}/10 text-{{ $bgColor }}">
            <span class="material-symbols-outlined" style="font-size: 24px;">{{ $icon }}</span>
        </div>
        
        @if($trend)
            <div class="flex items-center gap-1 px-2 py-1 rounded-full {{ $trend === 'up' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' }}">
                <span class="material-symbols-outlined text-sm">{{ $trend === 'up' ? 'trending_up' : 'trending_down' }}</span>
                @if($trendValue)
                    <span class="text-xs font-bold">{{ $trendValue }}</span>
                @endif
            </div>
        @endif
    </div>
    
    <div>
        <p class="text-3xl font-bold text-[#181511] dark:text-white mb-1">{{ $value }}</p>
        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $label }}</p>
    </div>
</div>
