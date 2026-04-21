<!DOCTYPE html>
<html lang="en" class="h-full scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="robots" content="noindex, nofollow">

    <title>{{ $title ?? 'Dashboard Aplikasi' }}</title>

    {{-- Premium Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>

    {{-- Base Styles & Glassmorphism Utilities --}}
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8fafc;
        }

        /* Beautiful minimalist scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Essential Utility Classes */
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.4);
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }
    </style>

    {{-- Alpine.js for interactions --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full text-slate-800 antialiased bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-blue-50/50 via-slate-50 to-indigo-50/50">
    
    {{-- Core App Wrapper --}}
    <div class="min-h-full flex flex-col relative overflow-x-hidden">
        
        {{-- Aesthetic Background Blobs --}}
        <div class="fixed top-[-10%] right-[-5%] w-[500px] h-[500px] rounded-full bg-blue-400/20 blur-[120px] pointer-events-none z-[-1]"></div>
        <div class="fixed bottom-[-10%] left-[-10%] w-[600px] h-[600px] rounded-full bg-indigo-400/10 blur-[120px] pointer-events-none z-[-1]"></div>

        {{-- Component: Navbar --}}
        <x-navbar />
        
        {{-- Component: Header --}}
        @isset($subtitle)
            <x-header :subtitle="$subtitle" />
        @else
            <x-header subtitle="Overview" />
        @endisset

        {{-- Main Page Content --}}
        <main class="flex-1 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 relative z-0">
            <div class="animate-fade-in-up duration-500">
                {{ $slot }}
            </div>
        </main>
        
        {{-- App Footer --}}
        <footer class="w-full mt-auto py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-sm font-medium text-slate-500">
                    &copy; {{ date('Y') }} Terang Fajar Grup. All rights reserved.
                </p>
                <div class="flex items-center gap-2 text-sm font-medium text-slate-400">
                    <span>Designed with <i class="fa-solid fa-heart text-red-500 mx-1"></i> for excellence.</span>
                </div>
            </div>
        </footer>
    </div>

    @stack('scripts')
    <script src="https://kit.fontawesome.com/c2752fde40.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('gesturestart', function(e) {
            e.preventDefault();
        });
    </script>
</body>
</html>
