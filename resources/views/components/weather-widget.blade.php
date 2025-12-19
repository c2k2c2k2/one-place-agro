@props([
    'location' => 'Nagpur, India',
    'temperature' => '32',
    'condition' => 'Sunny',
    'conditionIcon' => 'wb_sunny',
    'humidity' => '45',
    'wind' => '12',
    'precipitation' => '0',
    'backgroundImage' => 'https://images.unsplash.com/photo-1592210454359-9043f067919b?w=800'
])

<section>
    <div class="relative overflow-hidden rounded-xl bg-white dark:bg-surface-dark shadow-[0_4px_20px_-4px_rgba(0,0,0,0.1)] transition-all">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0 opacity-20 dark:opacity-10" style="background-image: url('{{ $backgroundImage }}'); background-size: cover; background-position: center;">
        </div>
        
        <div class="relative z-10 flex flex-col p-5">
            <div class="flex items-start justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-[#181511] dark:text-white">{{ $temperature }}°C</h2>
                    <div class="flex items-center gap-2 mt-1 text-primary-dark dark:text-primary">
                        <span class="material-symbols-outlined text-xl">{{ $conditionIcon }}</span>
                        <span class="text-sm font-bold">{{ $condition }}</span>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-lg font-bold text-[#181511] dark:text-white">{{ $location }}</p>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Today's Forecast</p>
                </div>
            </div>
            
            <div class="mt-6 flex divide-x divide-gray-100 dark:divide-gray-700">
                <div class="flex flex-1 flex-col items-center justify-center pr-4">
                    <span class="material-symbols-outlined mb-1 text-gray-400 dark:text-gray-500" style="font-size: 20px;">water_drop</span>
                    <p class="text-xs font-bold text-[#181511] dark:text-white">{{ $humidity }}%</p>
                    <p class="text-[10px] uppercase tracking-wider text-gray-400">Humidity</p>
                </div>
                <div class="flex flex-1 flex-col items-center justify-center px-4">
                    <span class="material-symbols-outlined mb-1 text-gray-400 dark:text-gray-500" style="font-size: 20px;">air</span>
                    <p class="text-xs font-bold text-[#181511] dark:text-white">{{ $wind }} km/h</p>
                    <p class="text-[10px] uppercase tracking-wider text-gray-400">Wind</p>
                </div>
                <div class="flex flex-1 flex-col items-center justify-center pl-4">
                    <span class="material-symbols-outlined mb-1 text-gray-400 dark:text-gray-500" style="font-size: 20px;">umbrella</span>
                    <p class="text-xs font-bold text-[#181511] dark:text-white">{{ $precipitation }}%</p>
                    <p class="text-[10px] uppercase tracking-wider text-gray-400">Precip</p>
                </div>
            </div>
        </div>
    </div>
</section>
