<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>One Place Agro - The Marketplace for Orange Farmers & Traders</title>
    <meta name="description" content="Connect Orange Farmers with Traders in Nagpur. List yields, fulfill requirements, and access real-time weather & agri-news.">
    
    <!-- Favicons -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-display antialiased bg-background-light dark:bg-background-dark text-gray-900 dark:text-gray-100 overflow-x-hidden">
    
    <!-- Header -->
    <header class="sticky top-0 z-50 w-full bg-white/90 dark:bg-background-dark/90 backdrop-blur-md border-b border-gray-200 dark:border-gray-800 transition-all duration-300">
        <div class="px-4 md:px-10 py-3 flex items-center justify-between max-w-7xl mx-auto">
            <div class="flex items-center gap-2 md:gap-4 cursor-pointer">
                <div class="size-8 text-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-3xl">nutrition</span>
                </div>
                <h2 class="text-lg md:text-xl font-bold leading-tight">One Place Agro</h2>
            </div>
            
            <nav class="hidden md:flex gap-8 items-center">
                <a class="text-sm font-medium hover:text-primary transition-colors" href="#how-it-works">How it Works</a>
                <a class="text-sm font-medium hover:text-primary transition-colors" href="#features">Features</a>
                <a class="text-sm font-medium hover:text-primary transition-colors" href="#about">About Us</a>
                <a class="text-sm font-medium hover:text-primary transition-colors" href="#contact">Contact</a>
            </nav>
            
            @auth
                <a href="{{ auth()->user()->role === 'farmer' ? route('farmer.dashboard') : (auth()->user()->role === 'trader' ? route('trader.dashboard') : route('admin.dashboard')) }}" 
                   class="flex items-center justify-center rounded-lg h-10 px-6 bg-primary hover:bg-primary-dark transition-colors text-white text-sm font-bold shadow-sm">
                    <span class="truncate">Go to Dashboard</span>
                </a>
            @else
                <a href="{{ route('role.selection') }}" 
                   class="flex items-center justify-center rounded-lg h-10 px-6 bg-primary hover:bg-primary-dark transition-colors text-white text-sm font-bold shadow-sm">
                    <span class="truncate">Get Started</span>
                </a>
            @endauth
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative flex flex-col items-center justify-center min-h-[600px] lg:min-h-[700px] w-full overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img alt="Orange Orchard Background" 
                 class="w-full h-full object-cover" 
                 src="https://lh3.googleusercontent.com/aida-public/AB6AXuCvZ7onFDKOGIkAyisAo4_VtEYULEpTYZJfNVC_TANg7TNJhrdpttmTZlhXmKxgvfX8bb3qKBDfH1c7-VAF59x_HDLvyJ6Xd744OF0F4EfU23kBv5YDhxOHWOjoRfBLWL7nMfxpjc60oMpOewWiV07IqyMqqpy7UVnu-F3O6S4vkw2j5qRyfao2PpvTUNlm5a5gUtrrt10gjfUIm9l3hRp1UASJde3ZF7XAJnL2a_8M-42HO1Sy_9z7RtdKWB-0tvV9-qCR1uTCwWk" 
                 loading="lazy">
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-transparent"></div>
        </div>
        
        <div class="relative z-10 w-full max-w-7xl px-4 md:px-10 py-12 lg:py-20 flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
            <div class="flex flex-col gap-6 text-center lg:text-left max-w-2xl flex-1 animate-fade-in">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 w-fit mx-auto lg:mx-0">
                    <span class="size-2 rounded-full bg-secondary-green animate-pulse"></span>
                    <span class="text-xs font-bold text-white uppercase tracking-wider">Now Live</span>
                </div>
                
                <h1 class="text-white text-4xl md:text-5xl lg:text-6xl font-black leading-tight">
                    The Central Marketplace for Orange <span class="text-primary">Farmers</span> & <span class="text-primary">Traders</span>
                </h1>
                
                <p class="text-gray-200 text-base md:text-lg font-normal leading-relaxed max-w-[600px] mx-auto lg:mx-0">
                    Directly connect, list your yields, fulfill requirements, and access real-time weather & agri-news—all in one powerful app designed for the citrus industry.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start pt-4">
                    <a href="{{ route('role.selection') }}" 
                       class="flex items-center justify-center gap-3 bg-primary hover:bg-primary-dark transition-all rounded-lg h-14 px-8 text-white shadow-lg transform hover:-translate-y-1">
                        <span class="material-symbols-outlined">rocket_launch</span>
                        <div class="flex flex-col items-start leading-none">
                            <span class="text-[10px] uppercase font-bold opacity-80">GET STARTED</span>
                            <span class="text-lg font-bold">Join Now</span>
                        </div>
                    </a>
                    
                    <a href="#" 
                       class="flex items-center justify-center gap-3 bg-white hover:bg-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 transition-all rounded-lg h-14 px-8 text-gray-900 dark:text-white shadow-lg transform hover:-translate-y-1 border border-gray-200 dark:border-gray-700">
                        <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.609 1.814L13.792 12 3.61 22.186a.996.996 0 0 1-.61-.92V2.734a1 1 0 0 1 .609-.92zm11.336 11.04l5.69 3.286c.733.42 1.54-.45 1.055-1.128L15.42 12.854l-.475.46v-.928l.475.46 6.27-2.162c.484-.676-.322-1.548-1.055-1.128l-5.69 3.286-1.155 1.156 1.155 1.156z"></path>
                            <path d="M12.945 12.854L2.85 22.95c.42.364 1.054.26 1.346-.226l8.749-9.87zM2.85 1.05c-.292-.486-.926-.59-1.346-.226l10.095 10.096-8.75-9.87z"></path>
                        </svg>
                        <div class="flex flex-col items-start leading-none">
                            <span class="text-[10px] uppercase font-bold opacity-60">DOWNLOAD ON</span>
                            <span class="text-lg font-bold">Google Play</span>
                        </div>
                    </a>
                </div>
            </div>
            
            <div class="flex-1 relative w-full flex justify-center lg:justify-end animate-scale-in">
                <div class="relative w-full max-w-[500px] aspect-[4/3] lg:aspect-square">
                    {{-- <img alt="App Mockups" 
                         class="relative z-10 w-full h-full object-contain drop-shadow-2xl hover:scale-105 transition-transform duration-500" 
                         src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?q=80&w=2070&auto=format&fit=crop" 
                         loading="lazy"> --}}
                    
                    {{-- <div class="absolute bottom-10 -left-4 lg:-left-12 z-20 bg-white dark:bg-gray-800 p-4 rounded-xl shadow-xl border border-gray-100 dark:border-gray-700 flex items-center gap-3 animate-bounce-slow">
                        <div class="bg-green-100 dark:bg-green-900 p-2 rounded-full text-green-600 dark:text-green-300">
                            <span class="material-symbols-outlined">check_circle</span>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase">Total Volume Traded</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white">12,500+ Tons</p>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>

    <!-- How it Works Section -->
    <section id="how-it-works" class="py-20 px-4 md:px-10 bg-white dark:bg-background-dark scroll-animate">
        <div class="max-w-6xl mx-auto flex flex-col gap-12">
            <div class="text-center flex flex-col gap-4">
                <h2 class="text-gray-900 dark:text-white text-3xl md:text-4xl font-black leading-tight">
                    Simplifying the Orange Supply Chain
                </h2>
                <p class="text-gray-500 dark:text-gray-400 text-lg max-w-2xl mx-auto">
                    Connecting the two pillars of the orange industry with dedicated tools for both sides of the trade.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12 relative">
                <!-- Connector Line -->
                <div class="hidden md:flex absolute left-1/2 top-0 bottom-0 w-px bg-gradient-to-b from-transparent via-primary/30 to-transparent -translate-x-1/2 justify-center items-center">
                    <div class="bg-white dark:bg-background-dark p-2 rounded-full border border-primary/20 shadow-sm z-10">
                        <span class="material-symbols-outlined text-primary">sync_alt</span>
                    </div>
                </div>
                
                <!-- For Farmers -->
                <div class="group bg-green-50/50 dark:bg-green-900/10 border border-green-100 dark:border-green-800/30 rounded-2xl p-8 flex flex-col items-center text-center gap-6 hover:shadow-lg transition-all hover:-translate-y-1">
                    <div class="size-16 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center text-green-600 dark:text-green-400 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-3xl">potted_plant</span>
                    </div>
                    <div class="flex flex-col gap-3">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">For Farmers</h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            Register easily, list your crop varieties (Nagpur, Kinnow, etc.) and harvest capacity. Get discovered by verified traders instantly without middlemen.
                        </p>
                    </div>
                    <ul class="text-left w-full space-y-3 mt-2">
                        <li class="flex items-center gap-3 text-sm text-gray-700 dark:text-gray-300">
                            <span class="material-symbols-outlined text-green-500 text-lg">check_circle</span> List Produce in Seconds
                        </li>
                        <li class="flex items-center gap-3 text-sm text-gray-700 dark:text-gray-300">
                            <span class="material-symbols-outlined text-green-500 text-lg">check_circle</span> Direct Buyer Connection
                        </li>
                        <li class="flex items-center gap-3 text-sm text-gray-700 dark:text-gray-300">
                            <span class="material-symbols-outlined text-green-500 text-lg">check_circle</span> Best Market Rates
                        </li>
                    </ul>
                </div>
                
                <!-- For Traders -->
                <div class="group bg-orange-50/50 dark:bg-orange-900/10 border border-orange-100 dark:border-orange-800/30 rounded-2xl p-8 flex flex-col items-center text-center gap-6 hover:shadow-lg transition-all hover:-translate-y-1">
                    <div class="size-16 rounded-full bg-orange-100 dark:bg-orange-900 flex items-center justify-center text-orange-600 dark:text-orange-400 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-3xl">local_shipping</span>
                    </div>
                    <div class="flex flex-col gap-3">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">For Traders</h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            Create a company profile, float your specific purchasing requirements, and browse available yields in your desired region with ease.
                        </p>
                    </div>
                    <ul class="text-left w-full space-y-3 mt-2">
                        <li class="flex items-center gap-3 text-sm text-gray-700 dark:text-gray-300">
                            <span class="material-symbols-outlined text-primary text-lg">check_circle</span> Quality Assurance
                        </li>
                        <li class="flex items-center gap-3 text-sm text-gray-700 dark:text-gray-300">
                            <span class="material-symbols-outlined text-primary text-lg">check_circle</span> Wide Supplier Network
                        </li>
                        <li class="flex items-center gap-3 text-sm text-gray-700 dark:text-gray-300">
                            <span class="material-symbols-outlined text-primary text-lg">check_circle</span> Secure Transactions
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 px-4 md:px-10 bg-background-light dark:bg-surface-dark scroll-animate">
        <div class="max-w-6xl mx-auto flex flex-col gap-12">
            <div class="flex flex-col gap-4 text-center md:text-left">
                <h2 class="text-gray-900 dark:text-white text-3xl md:text-4xl font-black leading-tight">
                    Everything You Need to Grow & Trade
                </h2>
                <p class="text-gray-500 dark:text-gray-400 text-lg">Tools designed to maximize your yield and profit.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-background-dark p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 hover:-translate-y-1 transition-all duration-300 group">
                    <div class="size-12 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined">partly_cloudy_day</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Accurate Weather</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                        Plan your harvest and logistics with real-time local weather data, including rain alerts and humidity levels tailored for orchards.
                    </p>
                </div>
                
                <div class="bg-white dark:bg-background-dark p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 hover:-translate-y-1 transition-all duration-300 group">
                    <div class="size-12 rounded-lg bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined">newspaper</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Curated Agri-News</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                        Stay informed with the latest news specifically for orange cultivation, market trends, government schemes, and export policies.
                    </p>
                </div>
                
                <div class="bg-white dark:bg-background-dark p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 hover:-translate-y-1 transition-all duration-300 group">
                    <div class="size-12 rounded-lg bg-primary/20 text-primary flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined">verified_user</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Secure Connections</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                        Trade with confidence. All farmer and trader profiles are verified to ensure a safe and trustworthy marketplace.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 px-4 md:px-10 bg-white dark:bg-background-dark scroll-animate">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-12">
            <div class="flex-1 flex flex-col gap-6">
                <span class="text-primary font-bold tracking-widest uppercase text-sm">About Us</span>
                <h2 class="text-gray-900 dark:text-white text-3xl md:text-4xl font-black leading-tight">
                    Empowering the Citrus Community
                </h2>
                <p class="text-gray-500 dark:text-gray-400 text-lg leading-relaxed">
                    One Place Agro is the first digital ecosystem dedicated entirely to the orange supply chain. We believe in transparency, fair trade, and the power of technology to transform agriculture. By removing intermediaries, we ensure farmers get the best value for their hard work and traders get the freshest produce directly from the source.
                </p>
                <div class="grid grid-cols-2 gap-6 mt-4">
                    <div>
                        <h4 class="text-2xl font-bold text-primary">5000+</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Farmers Onboarded</p>
                    </div>
                    <div>
                        <h4 class="text-2xl font-bold text-primary">₹10Cr+</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Trade Facilitated</p>
                    </div>
                </div>
            </div>
            
            <div class="flex-1 w-full">
                <div class="bg-orange-50 dark:bg-gray-800 rounded-2xl p-8 aspect-video flex items-center justify-center relative overflow-hidden border border-orange-100 dark:border-gray-700">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-100 to-white dark:from-gray-800 dark:to-gray-900 opacity-50"></div>
                    <span class="material-symbols-outlined text-9xl text-orange-200 dark:text-gray-700/50 absolute">agriculture</span>
                    <div class="relative z-10 text-center">
                        <p class="font-bold text-gray-900 dark:text-white text-lg">Our Mission</p>
                        <p class="text-gray-600 dark:text-gray-400">To make orange farming sustainable and profitable.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Interface Section -->
    <section id="interface" class="py-20 px-4 md:px-10 overflow-hidden bg-background-light dark:bg-surface-dark scroll-animate">
        <div class="max-w-7xl mx-auto flex flex-col gap-12">
            <div class="text-center mb-4">
                <span class="text-primary font-bold tracking-widest uppercase text-sm">Interface</span>
                <h2 class="text-gray-900 dark:text-white text-3xl md:text-4xl font-bold mt-2">A Look Inside the App</h2>
                <p class="text-gray-500 dark:text-gray-400 mt-4">Experience the intuitive design of our platform</p>
            </div>
            
            <div class="relative w-full">
                <div class="absolute top-1/2 left-0 w-64 h-64 bg-orange-200/50 dark:bg-orange-900/20 rounded-full blur-3xl -z-10 -translate-y-1/2"></div>
                <div class="absolute top-1/2 right-0 w-64 h-64 bg-green-200/50 dark:bg-green-900/20 rounded-full blur-3xl -z-10 -translate-y-1/2"></div>
                
                <div class="flex overflow-x-auto gap-8 pb-8 px-4 snap-x hide-scrollbar justify-start lg:justify-center">
                    <!-- Mockup 1 - Farmer Dashboard -->
                    <div class="snap-center shrink-0 w-[280px] md:w-[300px] bg-gray-900 rounded-[2.5rem] p-3 border-4 border-gray-200 dark:border-gray-700 shadow-2xl relative hover:scale-105 transition-transform duration-300">
                        <div class="absolute top-0 left-1/2 -translate-x-1/2 h-6 w-32 bg-gray-900 rounded-b-xl z-20"></div>
                        <div class="bg-white dark:bg-gray-800 w-full h-[580px] rounded-[2rem] overflow-hidden relative">
                            <!-- Placeholder for mockup image -->
                            <div class="w-full h-full bg-gradient-to-br from-green-50 to-orange-50 dark:from-gray-800 dark:to-gray-900 flex items-center justify-center">
                                <div class="text-center p-6">
                                    <span class="material-symbols-outlined text-6xl text-primary mb-4">dashboard</span>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Farmer Dashboard Mockup</p>
                                </div>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex items-end p-6">
                                <div class="text-white">
                                    <p class="text-xs font-bold uppercase text-primary mb-1">Farmer Dashboard</p>
                                    <h4 class="font-bold text-lg">Manage Your Yields</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mockup 2 - Marketplace -->
                    <div class="snap-center shrink-0 w-[280px] md:w-[300px] bg-gray-900 rounded-[2.5rem] p-3 border-4 border-gray-200 dark:border-gray-700 shadow-2xl relative translate-y-4 md:translate-y-8 hover:scale-105 transition-transform duration-300">
                        <div class="absolute top-0 left-1/2 -translate-x-1/2 h-6 w-32 bg-gray-900 rounded-b-xl z-20"></div>
                        <div class="bg-white dark:bg-gray-800 w-full h-[580px] rounded-[2rem] overflow-hidden relative">
                            <!-- Placeholder for mockup image -->
                            <div class="w-full h-full bg-gradient-to-br from-orange-50 to-green-50 dark:from-gray-800 dark:to-gray-900 flex items-center justify-center">
                                <div class="text-center p-6">
                                    <span class="material-symbols-outlined text-6xl text-primary mb-4">storefront</span>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Marketplace Mockup</p>
                                </div>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex items-end p-6">
                                <div class="text-white">
                                    <p class="text-xs font-bold uppercase text-primary mb-1">Marketplace</p>
                                    <h4 class="font-bold text-lg">Browse Requirements</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mockup 3 - Weather & News -->
                    <div class="snap-center shrink-0 w-[280px] md:w-[300px] bg-gray-900 rounded-[2.5rem] p-3 border-4 border-gray-200 dark:border-gray-700 shadow-2xl relative hover:scale-105 transition-transform duration-300">
                        <div class="absolute top-0 left-1/2 -translate-x-1/2 h-6 w-32 bg-gray-900 rounded-b-xl z-20"></div>
                        <div class="bg-white dark:bg-gray-800 w-full h-[580px] rounded-[2rem] overflow-hidden relative">
                            <!-- Placeholder for mockup image -->
                            <div class="w-full h-full bg-gradient-to-br from-blue-50 to-purple-50 dark:from-gray-800 dark:to-gray-900 flex items-center justify-center">
                                <div class="text-center p-6">
                                    <span class="material-symbols-outlined text-6xl text-primary mb-4">partly_cloudy_day</span>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Weather & Tools Mockup</p>
                                </div>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex items-end p-6">
                                <div class="text-white">
                                    <p class="text-xs font-bold uppercase text-primary mb-1">Tools</p>
                                    <h4 class="font-bold text-lg">Weather & News</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-8">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        <span class="material-symbols-outlined text-base align-middle">info</span>
                        Swipe to see more screens
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 px-4 md:px-10 bg-background-light dark:bg-surface-dark scroll-animate">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <span class="text-primary font-bold tracking-widest uppercase text-sm">Contact Us</span>
                <h2 class="text-gray-900 dark:text-white text-3xl md:text-4xl font-black mt-2">Get in Touch</h2>
                <p class="text-gray-500 dark:text-gray-400 mt-4">Have questions? We're here to help you grow.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 bg-white dark:bg-background-dark rounded-2xl p-8 md:p-12 shadow-sm border border-gray-100 dark:border-gray-800">
                <div class="flex flex-col gap-8">
                    <div>
                        <h3 class="text-xl font-bold mb-4 dark:text-white">Contact Information</h3>
                        <p class="text-gray-500 dark:text-gray-400 mb-6">Fill out the form or contact us directly via these channels.</p>
                        
                        <div class="flex flex-col gap-4">
                            <div class="flex items-center gap-4">
                                <div class="size-10 rounded-full bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined">call</span>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase font-bold">Phone</p>
                                    <p class="text-gray-900 dark:text-white font-medium">+91 8766890852</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-4">
                                <div class="size-10 rounded-full bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined">mail</span>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase font-bold">Email</p>
                                    <p class="text-gray-900 dark:text-white font-medium">support@oneplaceagro.in</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-4">
                                <div class="size-10 rounded-full bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined">location_on</span>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase font-bold">Headquarters</p>
                                    <p class="text-gray-900 dark:text-white font-medium">Warud ,Maharashtra, India</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <form class="flex flex-col gap-4" id="contactForm">
                    <div id="formMessage" class="hidden p-4 rounded-lg"></div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex flex-col gap-1">
                            <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">First Name</label>
                            <input name="first_name" class="px-4 py-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" 
                                   placeholder="John" 
                                   type="text" 
                                   required>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Last Name</label>
                            <input name="last_name" class="px-4 py-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" 
                                   placeholder="Doe" 
                                   type="text" 
                                   required>
                        </div>
                    </div>
                    
                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Email Address</label>
                        <input name="email" class="px-4 py-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" 
                               placeholder="john@example.com" 
                               type="email" 
                               required>
                    </div>
                    
                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Mobile Number</label>
                        <input name="mobile" class="px-4 py-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" 
                               placeholder="9876543210" 
                               type="tel" 
                               pattern="[0-9]{10}"
                               maxlength="10"
                               required>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Enter 10-digit mobile number</p>
                    </div>
                    
                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Message</label>
                        <textarea name="message" class="px-4 py-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" 
                                  placeholder="How can we help you?" 
                                  rows="4" 
                                  required></textarea>
                    </div>
                    
                    <button id="submitBtn" class="mt-2 bg-primary hover:bg-primary-dark text-white font-bold py-3 px-6 rounded-lg transition-all shadow-md hover:-translate-y-1 disabled:opacity-50 disabled:cursor-not-allowed" 
                            type="submit">
                        <span id="btnText">Send Message</span>
                        <span id="btnLoader" class="hidden">Sending...</span>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="px-4 py-16 scroll-animate">
        <div class="max-w-7xl mx-auto rounded-3xl overflow-hidden relative bg-gradient-to-br from-primary to-primary-dark shadow-2xl">
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>
            
            <div class="relative z-10 px-6 py-16 md:py-24 flex flex-col items-center text-center gap-8">
                <h2 class="text-white text-3xl md:text-5xl font-black leading-tight max-w-3xl">
                    Ready to transform your orange business?
                </h2>
                <p class="text-orange-50 text-lg max-w-xl">
                    Join thousands of farmers and traders who are getting better rates and faster deals today.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('role.selection') }}" 
                       class="flex items-center justify-center gap-3 bg-white hover:bg-gray-50 transition-all rounded-lg h-14 px-8 text-primary shadow-xl transform hover:-translate-y-1">
                        <span class="material-symbols-outlined">rocket_launch</span>
                        <div class="flex flex-col items-start leading-none">
                            <span class="text-[10px] uppercase font-bold opacity-60 text-gray-800">GET STARTED</span>
                            <span class="text-lg font-bold">Join Now</span>
                        </div>
                    </a>
                    
                    <a href="#" 
                       class="flex items-center justify-center gap-3 bg-white hover:bg-gray-50 transition-all rounded-lg h-14 px-8 text-primary shadow-xl transform hover:-translate-y-1">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.609 1.814L13.792 12 3.61 22.186a.996.996 0 0 1-.61-.92V2.734a1 1 0 0 1 .609-.92zm11.336 11.04l5.69 3.286c.733.42 1.54-.45 1.055-1.128L15.42 12.854l-.475.46v-.928l.475.46 6.27-2.162c.484-.676-.322-1.548-1.055-1.128l-5.69 3.286-1.155 1.156 1.155 1.156z"></path>
                            <path d="M12.945 12.854L2.85 22.95c.42.364 1.054.26 1.346-.226l8.749-9.87zM2.85 1.05c-.292-.486-.926-.59-1.346-.226l10.095 10.096-8.75-9.87z"></path>
                        </svg>
                        <div class="flex flex-col items-start leading-none">
                            <span class="text-[10px] uppercase font-bold opacity-60 text-gray-800">DOWNLOAD ON</span>
                            <span class="text-lg font-bold">Google Play</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white dark:bg-background-dark border-t border-gray-200 dark:border-gray-800 py-12 px-4 md:px-10">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="flex items-center gap-3">
                <div class="size-6 text-primary flex items-center justify-center">
                    <span class="material-symbols-outlined">nutrition</span>
                </div>
                <span class="font-bold text-lg dark:text-white">One Place Agro</span>
            </div>
            
            <div class="flex flex-wrap justify-center gap-6 md:gap-10">
                <a class="text-sm text-gray-500 dark:text-gray-400 hover:text-primary transition-colors" href="{{ route('privacy-policy') }}">Privacy Policy</a>
                <a class="text-sm text-gray-500 dark:text-gray-400 hover:text-primary transition-colors" href="{{ route('terms-of-service') }}">Terms of Service</a>
                <a class="text-sm text-gray-500 dark:text-gray-400 hover:text-primary transition-colors" href="#contact">Contact Support</a>
            </div>
            
            <div class="text-sm text-gray-400 dark:text-gray-600">
                © {{ date('Y') }} One Place Agro. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Mobile CTA Button -->
    <div class="md:hidden fixed bottom-0 left-0 w-full bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 p-3 z-50 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1)]">
        <div class="flex gap-2">
            <a href="{{ route('role.selection') }}" 
               class="flex-1 flex items-center justify-center gap-2 bg-primary text-white font-bold py-3 rounded-lg shadow-lg hover:bg-primary-dark transition-colors">
                <span class="material-symbols-outlined text-[18px]">rocket_launch</span>
                <span class="text-sm">Get Started</span>
            </a>
            <a href="#" 
               class="flex items-center justify-center gap-2 bg-white dark:bg-gray-800 text-primary dark:text-primary border-2 border-primary font-bold py-3 px-4 rounded-lg shadow-lg hover:bg-primary hover:text-white dark:hover:bg-primary transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.609 1.814L13.792 12 3.61 22.186a.996.996 0 0 1-.61-.92V2.734a1 1 0 0 1 .609-.92zm11.336 11.04l5.69 3.286c.733.42 1.54-.45 1.055-1.128L15.42 12.854l-.475.46v-.928l.475.46 6.27-2.162c.484-.676-.322-1.548-1.055-1.128l-5.69 3.286-1.155 1.156 1.155 1.156z"></path>
                    <path d="M12.945 12.854L2.85 22.95c.42.364 1.054.26 1.346-.226l8.749-9.87zM2.85 1.05c-.292-.486-.926-.59-1.346-.226l10.095 10.096-8.75-9.87z"></path>
                </svg>
                <span class="text-sm">Download</span>
            </a>
        </div>
    </div>

    <!-- Scroll to Top Button -->
    <button id="scrollToTop" 
            class="fixed bottom-20 md:bottom-8 right-8 bg-primary text-white p-3 rounded-full shadow-lg opacity-0 pointer-events-none transition-all hover:bg-primary-dark hover:-translate-y-1 z-40">
        <span class="material-symbols-outlined">arrow_upward</span>
    </button>

    <!-- Scripts -->
    <script>
        // Scroll Animation Observer
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        // Observe all scroll-animate elements
        document.querySelectorAll('.scroll-animate').forEach(el => {
            observer.observe(el);
        });

        // Scroll to Top Button
        const scrollToTopBtn = document.getElementById('scrollToTop');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.classList.remove('opacity-0', 'pointer-events-none');
                scrollToTopBtn.classList.add('opacity-100');
            } else {
                scrollToTopBtn.classList.add('opacity-0', 'pointer-events-none');
                scrollToTopBtn.classList.remove('opacity-100');
            }
        });

        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Header scroll effect
        let lastScroll = 0;
        const header = document.querySelector('header');
        
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 100) {
                header.classList.add('shadow-md');
            } else {
                header.classList.remove('shadow-md');
            }
            
            lastScroll = currentScroll;
        });

        // Contact Form Submission
        document.getElementById('contactForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const form = e.target;
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnLoader = document.getElementById('btnLoader');
            const formMessage = document.getElementById('formMessage');
            
            // Disable submit button
            submitBtn.disabled = true;
            btnText.classList.add('hidden');
            btnLoader.classList.remove('hidden');
            
            // Get form data
            const formData = new FormData(form);
            const data = Object.fromEntries(formData);
            
            try {
                const response = await fetch('{{ route("contact.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });
                
                const result = await response.json();
                
                if (response.ok && result.success) {
                    // Show success message
                    formMessage.textContent = result.message;
                    formMessage.className = 'p-4 rounded-lg bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200 border border-green-200 dark:border-green-800';
                    formMessage.classList.remove('hidden');
                    
                    // Reset form
                    form.reset();
                    
                    // Hide message after 5 seconds
                    setTimeout(() => {
                        formMessage.classList.add('hidden');
                    }, 5000);
                } else {
                    // Show error message
                    let errorMsg = result.message || 'An error occurred. Please try again.';
                    
                    if (result.errors) {
                        errorMsg = Object.values(result.errors).flat().join(', ');
                    }
                    
                    formMessage.textContent = errorMsg;
                    formMessage.className = 'p-4 rounded-lg bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200 border border-red-200 dark:border-red-800';
                    formMessage.classList.remove('hidden');
                }
            } catch (error) {
                // Show error message
                formMessage.textContent = 'An error occurred. Please try again later.';
                formMessage.className = 'p-4 rounded-lg bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200 border border-red-200 dark:border-red-800';
                formMessage.classList.remove('hidden');
            } finally {
                // Re-enable submit button
                submitBtn.disabled = false;
                btnText.classList.remove('hidden');
                btnLoader.classList.add('hidden');
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const headerOffset = 80;
                    const elementPosition = target.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Add parallax effect to hero section
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const heroImage = document.querySelector('section img[alt="Orange Orchard Background"]');
            if (heroImage && scrolled < window.innerHeight) {
                heroImage.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
        });

        // Add hover effect to feature cards
        document.querySelectorAll('.group').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Animate numbers on scroll
        const animateValue = (element, start, end, duration) => {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                const value = Math.floor(progress * (end - start) + start);
                element.textContent = value.toLocaleString() + (element.dataset.suffix || '');
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        };

        // Observe stats section
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const statElements = entry.target.querySelectorAll('h4');
                    statElements.forEach(el => {
                        const text = el.textContent;
                        if (text.includes('+')) {
                            const num = parseInt(text.replace(/\D/g, ''));
                            el.dataset.suffix = '+';
                            animateValue(el, 0, num, 2000);
                        }
                    });
                    statsObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        const aboutSection = document.querySelector('#about');
        if (aboutSection) {
            statsObserver.observe(aboutSection);
        }
    </script>
