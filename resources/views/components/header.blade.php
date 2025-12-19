@props([
    'title' => 'One Place',
    'showNotifications' => true,
    'showMenu' => true,
    'notificationCount' => 0
])

<!-- Top Sticky Header -->
<div class="sticky top-0 z-50 bg-primary dark:bg-background-dark border-b border-primary/10 dark:border-white/10 shadow-sm transition-colors duration-200">
    <!-- Status Bar Placeholder (simulated safe area) -->
    <div class="h-10 w-full bg-primary dark:bg-background-dark"></div>
    
    <div class="flex items-center justify-between px-4 py-3">
        <!-- Logo Area -->
        <div class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/20 backdrop-blur-sm text-white">
                <span class="material-symbols-outlined">agriculture</span>
            </div>
            <h1 class="text-xl font-extrabold tracking-tight text-white">{{ $title }}</h1>
        </div>
        
        <!-- Actions -->
        <div class="flex items-center gap-2">
            @if($showNotifications)
                <a href="{{ route('notifications.index') }}" class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-white/20 focus:outline-none relative">
                    <span class="material-symbols-outlined">notifications</span>
                    @if($notificationCount > 0)
                        <span class="absolute top-2 right-2.5 h-2 w-2 rounded-full bg-red-500 ring-2 ring-primary"></span>
                    @endif
                </a>
            @endif
            
            @if($showMenu)
                <button onclick="toggleMenu()" class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-white/20 focus:outline-none">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            @endif
        </div>
    </div>
    
    <!-- Decorative curve at bottom of header -->
    <div class="h-4 w-full bg-primary dark:bg-background-dark rounded-b-2xl absolute -bottom-2 -z-10"></div>
</div>

<!-- Mobile Menu Overlay (Hidden by default) -->
<div id="mobileMenu" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm" onclick="toggleMenu()">
    <div class="absolute right-0 top-0 h-full w-64 bg-white dark:bg-surface-dark shadow-xl transform transition-transform duration-300" onclick="event.stopPropagation()">
        <div class="flex flex-col h-full">
            <!-- Menu Header -->
            <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">Menu</h2>
                <button onclick="toggleMenu()" class="flex h-8 w-8 items-center justify-center rounded-full hover:bg-gray-100 dark:hover:bg-gray-800">
                    <span class="material-symbols-outlined text-gray-600 dark:text-gray-400">close</span>
                </button>
            </div>
            
            <!-- Menu Items -->
            <nav class="flex-1 overflow-y-auto p-4">
                <ul class="space-y-2">
                    @auth
                        @if(auth()->user()->role === 'farmer')
                            <li>
                                <a href="{{ route('farmer.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                    <span class="material-symbols-outlined text-primary">dashboard</span>
                                    <span class="font-medium">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('farmer.yields.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                    <span class="material-symbols-outlined text-primary">inventory_2</span>
                                    <span class="font-medium">My Yields</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('farmer.bids.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                    <span class="material-symbols-outlined text-primary">gavel</span>
                                    <span class="font-medium">Bids</span>
                                </a>
                            </li>
                        @elseif(auth()->user()->role === 'trader')
                            <li>
                                <a href="{{ route('trader.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                    <span class="material-symbols-outlined text-primary">dashboard</span>
                                    <span class="font-medium">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('trader.yields.browse') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                    <span class="material-symbols-outlined text-primary">search</span>
                                    <span class="font-medium">Browse Yields</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('trader.requirements.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                    <span class="material-symbols-outlined text-primary">post_add</span>
                                    <span class="font-medium">My Requirements</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('trader.bids.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                    <span class="material-symbols-outlined text-primary">gavel</span>
                                    <span class="font-medium">My Bids</span>
                                </a>
                            </li>
                        @endif
                        
                        <!-- Common Menu Items -->
                        <li class="pt-2 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('market-prices.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                <span class="material-symbols-outlined text-secondary-green">trending_up</span>
                                <span class="font-medium">Market Prices</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('news.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                <span class="material-symbols-outlined text-secondary-green">newspaper</span>
                                <span class="font-medium">Agri News</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('notifications.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                <span class="material-symbols-outlined text-secondary-green">notifications</span>
                                <span class="font-medium">Notifications</span>
                            </a>
                        </li>
                        
                        <!-- Profile & Logout -->
                        <li class="pt-2 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ auth()->user()->role === 'farmer' ? route('farmer.profile') : route('trader.profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                <span class="material-symbols-outlined text-gray-600 dark:text-gray-400">person</span>
                                <span class="font-medium">Profile</span>
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 text-red-600 dark:text-red-400 transition">
                                    <span class="material-symbols-outlined">logout</span>
                                    <span class="font-medium">Logout</span>
                                </button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </nav>
        </div>
    </div>
</div>

@push('scripts')
<script>
function toggleMenu() {
    const menu = document.getElementById('mobileMenu');
    menu.classList.toggle('hidden');
}
</script>
@endpush
