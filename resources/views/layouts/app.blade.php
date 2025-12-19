<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'One Place Agro - Orange Trading Platform')</title>
    
    <!-- Favicons -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    
    <!-- Google Fonts: Manrope -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&display=swap" rel="stylesheet">
    
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <!-- Theme Configuration -->
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#f2930d",
                        "primary-dark": "#d17d08",
                        "secondary-green": "#5c8c45",
                        "background-light": "#f8f7f5",
                        "background-dark": "#221b10",
                        "surface-light": "#ffffff",
                        "surface-dark": "#2d2418",
                        "text-main-light": "#181511",
                        "text-main-dark": "#f0ede8",
                        "text-sub-light": "#8a7960",
                        "text-sub-dark": "#a89b88",
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "1rem",
                        "xl": "1.5rem",
                        "2xl": "2rem",
                        "full": "9999px"
                    },
                    boxShadow: {
                        "soft": "0 8px 24px -6px rgba(24, 21, 17, 0.08)",
                        "glow": "0 0 16px rgba(242, 147, 13, 0.25)"
                    }
                },
            },
        }
    </script>
    
    @stack('styles')
    
    <style>
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>
<body class="font-display antialiased bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark min-h-screen flex flex-col transition-colors duration-200">
    
    @yield('content')
    
    @stack('scripts')
    
    <!-- Flash Messages -->
    @if(session('success'))
    <script>
        console.log('Success: {{ session('success') }}');
        // You can add toast notification here
    </script>
    @endif
    
    @if(session('error'))
    <script>
        console.log('Error: {{ session('error') }}');
        // You can add toast notification here
    </script>
    @endif
    
    @if(session('warning'))
    <script>
        console.log('Warning: {{ session('warning') }}');
        // You can add toast notification here
    </script>
    @endif
</body>
</html>
