@extends('layouts.public')

@section('title', 'Quick Links - ' . config('app.name'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-igp-text mb-8">Quick Links</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($links as $link)
            <a href="{{ $link->url }}" target="_blank" rel="noopener"
                class="block bg-white rounded-lg shadow p-6 hover:shadow-md hover:border-primary/30 border border-transparent transition">
                <div class="flex items-center gap-3">
                    <div class="shrink-0 w-10 h-10 rounded-lg bg-accent/20 flex items-center justify-center">
                        <i class="bi bi-link-45deg h-5 w-5 text-primary"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-igp-text">{{ $link->title }}</h3>
                        @if($link->category)
                            <p class="text-sm text-igp-text-muted">{{ $link->category }}</p>
                        @endif
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full text-center py-12 text-igp-text-muted bg-white rounded-lg shadow">No quick links.</div>
        @endforelse
    </div>
</div>
@endsection
