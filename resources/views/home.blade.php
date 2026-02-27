@extends('layouts.public')

@section('title', config('app.name'))

@section('content')
    {{-- Hero --}}
    <section class="relative overflow-hidden min-h-[50vh] sm:min-h-[60vh] flex items-center">
        <div class="absolute inset-0 bg-gradient-to-br from-primary/15 via-igp-surface to-accent/15"></div>
        <div class="relative w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20 lg:py-28">
            <div class="text-center max-w-4xl mx-auto">
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 tracking-tight">
                    {{ config('app.name') }}
                </h1>
                <p class="mt-4 sm:mt-6 text-base sm:text-lg md:text-xl text-gray-700 leading-relaxed">
                    Growth, inclusion, sustainability, and empowerment—together.
                </p>
                <div class="mt-8 sm:mt-10 flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center items-center">
                    <a href="{{ route('login') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-3.5 bg-primary text-white font-semibold rounded-lg hover:bg-primary-dark transition shadow-lg">
                        Sign in
                    </a>
                    <a href="#resources" class="w-full sm:w-auto inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-3.5 bg-white text-primary font-semibold rounded-lg border-2 border-primary hover:bg-primary/5 transition">
                        Explore resources
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- About IG --}}
    <section class="py-12 sm:py-16 lg:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 mb-6">About Inclusive Growth</h2>
            <p class="text-gray-700 max-w-3xl text-base sm:text-lg leading-relaxed">
                A secure internal platform for document management, employee directory, and organizational communication.
                Our values—growth, inclusion, sustainability, nature, empowerment—drive our work in education, health,
                and technology. Hope, creativity, energy, innovation, and optimism inspire the communities we serve.
            </p>
            <div class="mt-6 sm:mt-8 flex flex-wrap gap-2 sm:gap-3">
                <span class="px-3 sm:px-4 py-2 rounded-full bg-primary text-white font-medium text-sm shadow-sm">Growth</span>
                <span class="px-3 sm:px-4 py-2 rounded-full bg-primary text-white font-medium text-sm shadow-sm">Inclusion</span>
                <span class="px-3 sm:px-4 py-2 rounded-full bg-primary-dark text-white font-medium text-sm shadow-sm">Sustainability</span>
                <span class="px-3 sm:px-4 py-2 rounded-full bg-primary text-white font-medium text-sm shadow-sm">Empowerment</span>
            </div>
        </div>
    </section>

    {{-- Resource cards --}}
    <section id="resources" class="py-12 sm:py-16 lg:py-20 bg-igp-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 mb-6 sm:mb-8 text-center">Explore Resources</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                <a href="{{ route('public.announcements') }}" class="group block bg-white rounded-xl shadow hover:shadow-lg border-l-4 border-accent p-5 sm:p-6 transition">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-lg bg-accent/20 flex items-center justify-center mb-4 group-hover:bg-accent/30 transition">
                        <i class="bi bi-megaphone text-2xl sm:text-3xl text-primary"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 text-base sm:text-lg">Announcements</h3>
                    <p class="mt-2 text-sm text-gray-600">Latest organizational news and updates</p>
                </a>
                <a href="{{ route('public.documents') }}" class="group block bg-white rounded-xl shadow hover:shadow-lg border-l-4 border-primary p-5 sm:p-6 transition">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-lg bg-primary/15 flex items-center justify-center mb-4 group-hover:bg-primary/25 transition">
                        <i class="bi bi-file-earmark-text text-2xl sm:text-3xl text-primary"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 text-base sm:text-lg">Public Documents</h3>
                    <p class="mt-2 text-sm text-gray-600">Browse and download public documents</p>
                </a>
                <a href="{{ route('public.directory') }}" class="group block bg-white rounded-xl shadow hover:shadow-lg border-l-4 border-primary p-5 sm:p-6 transition">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-lg bg-primary/15 flex items-center justify-center mb-4 group-hover:bg-primary/25 transition">
                        <i class="bi bi-people text-2xl sm:text-3xl text-primary"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 text-base sm:text-lg">Employee Directory</h3>
                    <p class="mt-2 text-sm text-gray-600">Find contacts and team members</p>
                </a>
                <a href="{{ route('public.links') }}" class="group block bg-white rounded-xl shadow hover:shadow-lg border-l-4 border-accent p-5 sm:p-6 transition">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-lg bg-accent/20 flex items-center justify-center mb-4 group-hover:bg-accent/30 transition">
                        <i class="bi bi-link-45deg text-2xl sm:text-3xl text-primary"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 text-base sm:text-lg">Quick Links</h3>
                    <p class="mt-2 text-sm text-gray-600">HR forms, templates, and useful links</p>
                </a>
            </div>
        </div>
    </section>
@endsection
