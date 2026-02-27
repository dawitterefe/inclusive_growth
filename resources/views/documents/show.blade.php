<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-2">
            <h1 class="text-2xl font-semibold text-igp-text">{{ $document->title }}</h1>
            <div class="flex gap-2">
                <a href="{{ route('documents.download', $document) }}" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">
                    Download
                </a>
                @if(in_array(auth()->user()->role ?? 'staff', ['admin', 'super_admin']))
                    <a href="{{ route('documents.edit', $document) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Edit</a>
                    <form action="{{ route('documents.destroy', $document) }}" method="POST" class="inline" onsubmit="return confirm('Delete this document?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-red-300 text-red-600 rounded-lg hover:bg-red-50">Delete</button>
                    </form>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6 space-y-4">
            @if($document->description)
                <p class="text-igp-text-muted">{{ $document->description }}</p>
            @endif
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium text-igp-text-muted">Category</dt>
                    <dd class="mt-1">{{ $document->category?->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-igp-text-muted">Department</dt>
                    <dd class="mt-1">{{ $document->department?->name ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-igp-text-muted">Uploaded by</dt>
                    <dd class="mt-1">{{ $document->uploadedBy?->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-igp-text-muted">Upload date</dt>
                    <dd class="mt-1">{{ $document->uploaded_at?->format('M d, Y') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-igp-text-muted">Version</dt>
                    <dd class="mt-1">{{ $document->version }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-igp-text-muted">Access level</dt>
                    <dd class="mt-1"><span class="px-2 py-0.5 rounded text-xs bg-accent/20 text-igp-text">{{ $document->access_level }}</span></dd>
                </div>
            </dl>
        </div>
    </div>
</x-app-layout>
