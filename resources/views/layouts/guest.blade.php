<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-igp-surface flex flex-col min-h-screen">
        <div class="flex-1 flex flex-col sm:justify-center items-center pt-6 sm:pt-0 pb-8 min-h-0">
            <div>
                <a href="/" class="flex items-center gap-2">
                    @if(file_exists(public_path('images/logo.png')) && filesize(public_path('images/logo.png')) > 0)
                        <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" class="h-16 w-auto" />
                    @else
                        <x-application-logo class="w-16 h-16 fill-current text-primary" />
                    @endif
                    <span class="text-xl font-semibold text-primary">{{ config('app.name') }}</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>

        <footer class="bg-primary-dark text-white shrink-0">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-center md:text-left">
                    <p class="text-white text-sm sm:text-base">Growth, inclusion, sustainability, and empowerment—together.</p>
                    <div class="flex flex-wrap justify-center gap-4 sm:gap-6">
                        <a href="{{ route('home') }}" class="text-white hover:text-accent text-sm">Home</a>
                        <a href="{{ route('public.announcements') }}" class="text-white hover:text-accent text-sm">Announcements</a>
                        <a href="{{ route('public.documents') }}" class="text-white hover:text-accent text-sm">Documents</a>
                        <a href="{{ route('public.directory') }}" class="text-white hover:text-accent text-sm">Directory</a>
                        <a href="{{ route('public.links') }}" class="text-white hover:text-accent text-sm">Quick Links</a>
                        <a href="{{ route('login') }}" class="text-white hover:text-accent text-sm">Sign in</a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
