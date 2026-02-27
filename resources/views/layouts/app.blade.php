<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Dashboard')</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-igp-surface">
        <div class="min-h-screen flex">
            @include('layouts.sidebar')

            <div class="flex-1 flex flex-col lg:pl-64">
                <!-- Top bar for mobile -->
                <header class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8 lg:hidden">
                    <button type="button" @click="$store.sidebar.open = !$store.sidebar.open" class="-m-2.5 p-2.5 text-gray-700" aria-label="Open sidebar">
                        <i class="bi bi-list text-2xl"></i>
                    </button>
                    <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                        <div class="flex flex-1 items-center">
                            <span class="text-lg font-semibold text-igp-text">{{ config('app.name') }}</span>
                        </div>
                    </div>
                </header>

                <main class="flex-1 py-6 px-4 sm:px-6 lg:px-8">
                    @isset($header)
                        <div class="mb-6">
                            {{ $header }}
                        </div>
                    @endisset

                    @if (session('success'))
                        <div class="mb-4 rounded-md bg-green-50 p-4 text-sm text-green-800">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mb-4 rounded-md bg-red-50 p-4 text-sm text-red-800">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{ $slot }}
                </main>
            </div>
        </div>

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('sidebar', () => ({
                    open: false,
                    get sidebarOpen() { return this.open; },
                    set sidebarOpen(val) { this.open = val; }
                }));
            });
        </script>
    </body>
</html>
