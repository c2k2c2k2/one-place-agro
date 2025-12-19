@extends('layouts.app')

@section('title', 'Admin Dashboard - One Place Agro')

@section('content')
<div class="min-h-screen bg-background-light dark:bg-background-dark">
    <!-- Header -->
    <header class="bg-white dark:bg-surface-dark shadow-sm border-b border-[#e6e1db] dark:border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-text-main-light dark:text-white">Admin Dashboard</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Welcome back, Administrator!</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Stats Card 1 -->
            <div class="bg-white dark:bg-surface-dark rounded-2xl shadow-soft p-6 border border-[#e6e1db] dark:border-white/10">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-blue-500/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-blue-500 text-2xl">group</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Total Users</p>
                        <p class="text-2xl font-bold text-text-main-light dark:text-white">0</p>
                    </div>
                </div>
            </div>

            <!-- Stats Card 2 -->
            <div class="bg-white dark:bg-surface-dark rounded-2xl shadow-soft p-6 border border-[#e6e1db] dark:border-white/10">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-green-500/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-green-500 text-2xl">agriculture</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Total Farmers</p>
                        <p class="text-2xl font-bold text-text-main-light dark:text-white">0</p>
                    </div>
                </div>
            </div>

            <!-- Stats Card 3 -->
            <div class="bg-white dark:bg-surface-dark rounded-2xl shadow-soft p-6 border border-[#e6e1db] dark:border-white/10">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary text-2xl">storefront</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Total Traders</p>
                        <p class="text-2xl font-bold text-text-main-light dark:text-white">0</p>
                    </div>
                </div>
            </div>

            <!-- Stats Card 4 -->
            <div class="bg-white dark:bg-surface-dark rounded-2xl shadow-soft p-6 border border-[#e6e1db] dark:border-white/10">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-purple-500/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-purple-500 text-2xl">trending_up</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Total Transactions</p>
                        <p class="text-2xl font-bold text-text-main-light dark:text-white">0</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Coming Soon Notice -->
        <div class="mt-8 bg-gradient-to-r from-primary/10 to-orange-400/10 rounded-2xl p-8 text-center border border-primary/20">
            <span class="material-symbols-outlined text-primary text-6xl mb-4">admin_panel_settings</span>
            <h2 class="text-2xl font-bold text-text-main-light dark:text-white mb-2">Admin Panel Under Construction</h2>
            <p class="text-gray-600 dark:text-gray-400">
                Full admin features will be available in Phase 5. Stay tuned!
            </p>
        </div>
    </main>
</div>
@endsection
