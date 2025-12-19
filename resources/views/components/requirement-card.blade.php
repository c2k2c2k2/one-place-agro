@props([
    'requirement',
    'showActions' => false,
    'viewType' => 'trader' // 'trader' or 'farmer'
])

<div class="rounded-xl bg-white dark:bg-surface-dark shadow-sm hover:shadow-md transition p-4">
    <div class="flex items-start justify-between mb-3">
        <div class="flex-1">
            <h3 class="text-lg font-bold text-[#181511] dark:text-white mb-1">{{ $requirement->variety->name }}</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400">Posted by {{ $requirement->user->name }}</p>
        </div>
        
        <!-- Status Badge -->
        <div>
            @if($requirement->is_active)
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                    Active
                </span>
            @else
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-700 dark:bg-gray-900/30 dark:text-gray-400">
                    Inactive
                </span>
            @endif
        </div>
    </div>
    
    <!-- Requirement Details -->
    <div class="grid grid-cols-2 gap-3 mb-3">
        <div>
            <p class="text-xs text-gray-500 dark:text-gray-400">Quantity Needed</p>
            <p class="text-lg font-bold text-[#181511] dark:text-white">{{ number_format($requirement->quantity_required, 2) }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">tons</p>
        </div>
        <div>
            <p class="text-xs text-gray-500 dark:text-gray-400">Max Budget</p>
            <p class="text-lg font-bold text-primary">₹{{ number_format($requirement->max_budget) }}</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">per ton</p>
        </div>
    </div>
    
    <!-- Total Budget -->
    <div class="bg-gray-50 dark:bg-gray-800/50 rounded-lg p-3 mb-3">
        <div class="flex items-center justify-between">
            <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Budget</span>
            <span class="text-xl font-bold text-[#181511] dark:text-white">
                ₹{{ number_format($requirement->max_budget * $requirement->quantity_required) }}
            </span>
        </div>
    </div>
    
    <!-- Location -->
    <div class="flex items-center gap-2 mb-3 text-sm text-gray-600 dark:text-gray-300">
        <span class="material-symbols-outlined text-sm text-gray-400">location_on</span>
        <span>{{ $requirement->location }}</span>
    </div>
    
    @if($requirement->description)
        <div class="mb-3">
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Description:</p>
            <p class="text-sm text-gray-700 dark:text-gray-300">{{ $requirement->description }}</p>
        </div>
    @endif
    
    <!-- Timestamp -->
    <div class="flex items-center gap-2 text-xs text-gray-400 mb-3">
        <span class="material-symbols-outlined text-sm">schedule</span>
        <span>{{ $requirement->created_at->diffForHumans() }}</span>
    </div>
    
    <!-- Actions -->
    @if($showActions && $viewType === 'trader')
        <div class="flex gap-2 pt-3 border-t border-gray-100 dark:border-gray-700">
            <a href="{{ route('trader.requirements.show', $requirement) }}" 
               class="flex-1 px-4 py-2 text-center text-sm font-medium text-primary border border-primary rounded-lg hover:bg-primary hover:text-white transition">
                View Details
            </a>
            <a href="{{ route('trader.requirements.edit', $requirement) }}" 
               class="flex-1 px-4 py-2 text-center text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary-dark transition">
                Edit
            </a>
            <form action="{{ route('trader.requirements.toggle', $requirement) }}" method="POST">
                @csrf
                <button type="submit" 
                        class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-400 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                    {{ $requirement->is_active ? 'Deactivate' : 'Activate' }}
                </button>
            </form>
        </div>
    @elseif(!$showActions && $viewType === 'farmer')
        <div class="pt-3 border-t border-gray-100 dark:border-gray-700">
            <a href="{{ route('farmer.requirements.show', $requirement) }}" 
               class="block w-full px-4 py-2 text-center text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary-dark transition">
                View Details
            </a>
        </div>
    @endif
</div>
