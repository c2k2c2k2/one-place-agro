@props([
    'active' => 'home'
])

<!-- Bottom Navigation -->
<div class="fixed bottom-0 left-0 right-0 z-50 bg-white dark:bg-surface-dark border-t border-gray-100 dark:border-gray-800 shadow-[0_-4px_20px_-4px_rgba(0,0,0,0.05)] pb-5 pt-3 px-6">
    <div class="flex items-center justify-between max-w-md mx-auto">
        @auth
            @if(auth()->user()->role === 'farmer')
                <!-- Farmer Navigation -->
                <a href="{{ route('farmer.dashboard') }}" class="flex flex-col items-center gap-1 {{ $active === 'home' ? 'text-primary' : 'text-gray-400 dark:text-gray-500 hover:text-primary dark:hover:text-primary' }} transition">
                    <span class="material-symbols-outlined {{ $active === 'home' ? 'fill-current' : '' }}">dashboard</span>
                    <span class="text-[10px] {{ $active === 'home' ? 'font-bold' : 'font-medium' }}">Home</span>
                </a>
                
                <a href="{{ route('market-prices.index') }}" class="flex flex-col items-center gap-1 {{ $active === 'market' ? 'text-primary' : 'text-gray-400 dark:text-gray-500 hover:text-primary dark:hover:text-primary' }} transition">
                    <span class="material-symbols-outlined {{ $active === 'market' ? 'fill-current' : '' }}">storefront</span>
                    <span class="text-[10px] {{ $active === 'market' ? 'font-bold' : 'font-medium' }}">Market</span>
                </a>
                
                <!-- Center Add Button -->
                <div class="relative -top-8">
                    <a href="{{ route('farmer.yields.create') }}" class="flex h-14 w-14 items-center justify-center rounded-full bg-primary text-white shadow-lg shadow-primary/40 hover:scale-105 transition-transform">
                        <span class="material-symbols-outlined" style="font-size: 28px;">add</span>
                    </a>
                </div>
                
                <a href="{{ route('farmer.bids.index') }}" class="flex flex-col items-center gap-1 {{ $active === 'bids' ? 'text-primary' : 'text-gray-400 dark:text-gray-500 hover:text-primary dark:hover:text-primary' }} transition">
                    <span class="material-symbols-outlined {{ $active === 'bids' ? 'fill-current' : '' }}">gavel</span>
                    <span class="text-[10px] {{ $active === 'bids' ? 'font-bold' : 'font-medium' }}">Bids</span>
                </a>
                
                <a href="{{ route('farmer.profile') }}" class="flex flex-col items-center gap-1 {{ $active === 'profile' ? 'text-primary' : 'text-gray-400 dark:text-gray-500 hover:text-primary dark:hover:text-primary' }} transition">
                    <span class="material-symbols-outlined {{ $active === 'profile' ? 'fill-current' : '' }}">person</span>
                    <span class="text-[10px] {{ $active === 'profile' ? 'font-bold' : 'font-medium' }}">Profile</span>
                </a>
                
            @elseif(auth()->user()->role === 'trader')
                <!-- Trader Navigation -->
                <a href="{{ route('trader.dashboard') }}" class="flex flex-col items-center gap-1 {{ $active === 'home' ? 'text-primary' : 'text-gray-400 dark:text-gray-500 hover:text-primary dark:hover:text-primary' }} transition">
                    <span class="material-symbols-outlined {{ $active === 'home' ? 'fill-current' : '' }}">dashboard</span>
                    <span class="text-[10px] {{ $active === 'home' ? 'font-bold' : 'font-medium' }}">Home</span>
                </a>
                
                <a href="{{ route('trader.yields.browse') }}" class="flex flex-col items-center gap-1 {{ $active === 'browse' ? 'text-primary' : 'text-gray-400 dark:text-gray-500 hover:text-primary dark:hover:text-primary' }} transition">
                    <span class="material-symbols-outlined {{ $active === 'browse' ? 'fill-current' : '' }}">search</span>
                    <span class="text-[10px] {{ $active === 'browse' ? 'font-bold' : 'font-medium' }}">Browse</span>
                </a>
                
                <!-- Center Add Button -->
                <div class="relative -top-8">
                    <a href="{{ route('trader.requirements.create') }}" class="flex h-14 w-14 items-center justify-center rounded-full bg-primary text-white shadow-lg shadow-primary/40 hover:scale-105 transition-transform">
                        <span class="material-symbols-outlined" style="font-size: 28px;">add</span>
                    </a>
                </div>
                
                <a href="{{ route('trader.bids.index') }}" class="flex flex-col items-center gap-1 {{ $active === 'bids' ? 'text-primary' : 'text-gray-400 dark:text-gray-500 hover:text-primary dark:hover:text-primary' }} transition">
                    <span class="material-symbols-outlined {{ $active === 'bids' ? 'fill-current' : '' }}">gavel</span>
                    <span class="text-[10px] {{ $active === 'bids' ? 'font-bold' : 'font-medium' }}">My Bids</span>
                </a>
                
                <a href="{{ route('trader.profile') }}" class="flex flex-col items-center gap-1 {{ $active === 'profile' ? 'text-primary' : 'text-gray-400 dark:text-gray-500 hover:text-primary dark:hover:text-primary' }} transition">
                    <span class="material-symbols-outlined {{ $active === 'profile' ? 'fill-current' : '' }}">person</span>
                    <span class="text-[10px] {{ $active === 'profile' ? 'font-bold' : 'font-medium' }}">Profile</span>
                </a>
            @endif
        @endauth
    </div>
</div>
