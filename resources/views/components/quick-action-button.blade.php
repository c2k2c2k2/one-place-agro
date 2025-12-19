@props([
    'icon' => 'add',
    'label' => 'Action',
    'href' => '#',
    'bgColor' => 'orange-50',
    'iconColor' => 'primary',
    'darkBgColor' => 'orange-900/20'
])

<a href="{{ $href }}" class="flex flex-col items-center justify-center gap-3 rounded-xl bg-white dark:bg-surface-dark p-4 shadow-sm hover:shadow-md transition active:scale-95 group">
    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-{{ $bgColor }} dark:bg-{{ $darkBgColor }} text-{{ $iconColor }} group-hover:bg-{{ $iconColor }} group-hover:text-white transition-colors duration-300">
        <span class="material-symbols-outlined" style="font-size: 28px;">{{ $icon }}</span>
    </div>
    <span class="text-xs font-bold text-center leading-tight dark:text-gray-200">{!! $label !!}</span>
</a>
