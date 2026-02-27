<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-igp-text antialiased bg-igp-surface">
    <header class="bg-primary sticky top-0 z-50 shadow-md" x-data="{ mobileMenuOpen: false }">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        @if(file_exists(public_path('images/logo.png')) && filesize(public_path('images/logo.png')) > 0)
                            <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" class="h-10 w-auto" />
                        @else
                            <div class="h-10 w-10 rounded-lg bg-accent flex items-center justify-center">
                                <span class="text-primary font-bold text-lg">IG</span>
                            </div>
                        @endif
                        <span class="text-white font-semibold text-lg hidden sm:inline">{{ config('app.name') }}</span>
                    </a>
                    <div class="hidden md:flex md:ml-10 md:space-x-6">
                        <a href="{{ route('home') }}" class="text-white hover:text-accent px-3 py-2 text-sm font-medium {{ request()->routeIs('home') ? 'text-accent' : '' }}">Home</a>
                        <a href="{{ route('public.announcements') }}" class="text-white hover:text-accent px-3 py-2 text-sm font-medium {{ request()->routeIs('public.announcements*') ? 'text-accent' : '' }}">Announcements</a>
                        <a href="{{ route('public.documents') }}" class="text-white hover:text-accent px-3 py-2 text-sm font-medium {{ request()->routeIs('public.documents*') ? 'text-accent' : '' }}">Documents</a>
                        <a href="{{ route('public.directory') }}" class="text-white hover:text-accent px-3 py-2 text-sm font-medium {{ request()->routeIs('public.directory*') ? 'text-accent' : '' }}">Directory</a>
                        <a href="{{ route('public.links') }}" class="text-white hover:text-accent px-3 py-2 text-sm font-medium {{ request()->routeIs('public.links*') ? 'text-accent' : '' }}">Links</a>
                    </div>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-accent text-primary font-semibold rounded-lg hover:bg-accent-light transition">
                        Sign in
                    </a>
                    <button type="button" @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden ml-2 p-2 rounded-lg text-white hover:bg-white/10" aria-label="Toggle menu">
                        <i class="bi bi-list text-2xl"></i>
                    </button>
                </div>
            </div>
            <div x-show="mobileMenuOpen" x-transition x-cloak class="md:hidden pb-4">
                <div class="space-y-0.5">
                    <a href="{{ route('home') }}" class="block text-white hover:bg-white/10 px-4 py-3 rounded-lg text-base">Home</a>
                    <a href="{{ route('public.announcements') }}" class="block text-white hover:bg-white/10 px-4 py-3 rounded-lg text-base">Announcements</a>
                    <a href="{{ route('public.documents') }}" class="block text-white hover:bg-white/10 px-4 py-3 rounded-lg text-base">Documents</a>
                    <a href="{{ route('public.directory') }}" class="block text-white hover:bg-white/10 px-4 py-3 rounded-lg text-base">Directory</a>
                    <a href="{{ route('public.links') }}" class="block text-white hover:bg-white/10 px-4 py-3 rounded-lg text-base">Links</a>
                </div>
            </div>
        </nav>
    </header>

    <main class="min-h-[calc(100vh-12rem)]">
        @yield('content')
    </main>

    <footer class="bg-primary-dark text-white mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-center md:text-left">
                <p class="text-white text-sm sm:text-base">Growth, inclusion, sustainability, and empowerment—together.</p>
                <div class="flex flex-wrap justify-center gap-4 sm:gap-6">
                    <a href="{{ route('home') }}" class="text-white hover:text-accent text-sm">Home</a>
                    <a href="{{ route('public.announcements') }}" class="text-white hover:text-accent text-sm">Announcements</a>
                    <a href="{{ route('public.links') }}" class="text-white hover:text-accent text-sm">Quick Links</a>
                    <a href="{{ route('login') }}" class="text-white hover:text-accent text-sm">Sign in</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('mobileNav', () => ({ mobileMenuOpen: false }));
        });
    </script>
</body>
</html>
