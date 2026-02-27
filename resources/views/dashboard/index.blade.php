<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-igp-text">Welcome, {{ $user->name }}</h1>
    </x-slot>

    <div class="space-y-6">
        @if($announcements->isNotEmpty())
            <div class="rounded-lg border border-accent/30 bg-accent/5 p-4">
                <h2 class="text-lg font-semibold text-igp-text mb-2">Latest Announcement</h2>
                <div class="space-y-2">
                    @foreach($announcements->take(1) as $announcement)
                        <h3 class="font-medium text-primary">{{ $announcement->title }}</h3>
                        <p class="text-igp-text-muted text-sm">{{ Str::limit($announcement->content, 200) }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-sm text-igp-text-muted">Total Documents</p>
                <p class="text-2xl font-bold text-primary">{{ $documentsCount }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-sm text-igp-text-muted">Users</p>
                <p class="text-2xl font-bold text-primary">{{ $usersCount }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="font-semibold text-igp-text">Quick Links</h2>
                </div>
                <div class="p-6">
                    @forelse($quickLinks as $link)
                        <a href="{{ $link->url }}" target="_blank" rel="noopener" class="flex items-center gap-2 py-2 text-primary hover:underline">
                            <i class="bi bi-link-45deg h-4 w-4 shrink-0"></i>
                            {{ $link->title }}
                        </a>
                    @empty
                        <p class="text-igp-text-muted text-sm">No quick links yet.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h2 class="font-semibold text-igp-text">Recent Documents</h2>
                    <a href="{{ route('documents.index') }}" class="text-sm text-primary hover:underline">View all</a>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($recentDocuments as $doc)
                        <a href="{{ route('documents.show', $doc) }}" class="block px-6 py-4 hover:bg-igp-surface/50">
                            <p class="font-medium text-igp-text">{{ $doc->title }}</p>
                            <p class="text-sm text-igp-text-muted">{{ $doc->category?->name }} · {{ $doc->uploaded_at?->diffForHumans() }}</p>
                        </a>
                    @empty
                        <div class="px-6 py-8 text-center text-igp-text-muted text-sm">No documents yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
