<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-igp-text">Announcements</h1>
    </x-slot>

    <div class="space-y-4">
        @forelse($announcements as $announcement)
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="font-semibold text-igp-text">{{ $announcement->title }}</h2>
                <p class="text-sm text-igp-text-muted mt-1">Posted by {{ $announcement->postedBy?->name }} · {{ $announcement->created_at->format('M d, Y') }}
                    @if($announcement->expiry_date)
                        · Expires {{ $announcement->expiry_date->format('M d, Y') }}
                    @endif
                </p>
                <div class="mt-3 text-igp-text-muted prose prose-sm max-w-none">
                    {!! nl2br(e($announcement->content)) !!}
                </div>
                @if($announcement->attachments->isNotEmpty())
                    <div class="mt-4 pt-4 border-t border-gray-100">
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
</x-app-layout>
