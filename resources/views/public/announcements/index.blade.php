@extends('layouts.public')

@section('title', 'Announcements - ' . config('app.name'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-igp-text mb-8">Announcements</h1>

    <div class="space-y-6">
        @forelse($announcements as $announcement)
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="font-semibold text-igp-text text-lg">{{ $announcement->title }}</h2>
                <p class="text-sm text-igp-text-muted mt-1">Posted by {{ $announcement->postedBy?->name }} · {{ $announcement->created_at->format('M d, Y') }}
                    @if($announcement->expiry_date)
                        · Expires {{ $announcement->expiry_date->format('M d, Y') }}
                    @endif
                </p>
                <div class="mt-3 text-igp-text-muted prose prose-sm max-w-none">
                    {!! nl2br(e($announcement->content)) !!}
                </div>
                @if($announcement->attachments->isNotEmpty())
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <p class="text-sm font-medium text-igp-text mb-2">Attachments</p>
                        <ul class="space-y-1">
                            @foreach($announcement->attachments as $att)
                                <li>
                                    <a href="{{ route('announcement-attachments.download', $att) }}" class="inline-flex items-center gap-2 text-primary hover:underline text-sm">
                                        <i class="bi bi-file-earmark h-4 w-4 shrink-0"></i>
                                        {{ $att->original_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @empty
            <div class="bg-white rounded-lg shadow p-12 text-center text-igp-text-muted">No announcements.</div>
        @endforelse
        <div>
            {{ $announcements->links() }}
        </div>
    </div>
</div>
@endsection
