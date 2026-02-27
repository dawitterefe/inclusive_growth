<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-igp-text">{{ $category->name }}</h1>
            <a href="{{ route('admin.categories.edit', $category) }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">Edit</a>
        </div>
    </x-slot>

    <div class="space-y-6">
        <div class="bg-white rounded-lg shadow p-6">
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium text-igp-text-muted">Slug</dt>
                    <dd class="mt-1">{{ $category->slug }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-igp-text-muted">Parent</dt>
                    <dd class="mt-1">{{ $category->parent?->name ?? '—' }}</dd>
                </div>
            </dl>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="font-medium text-igp-text mb-2">Documents ({{ $category->documents->count() }})</h2>
            @if($category->documents->count() > 0)
                <ul class="list-disc list-inside text-igp-text-muted">
                    @foreach($category->documents as $doc)
                        <li><a href="{{ route('documents.show', $doc) }}" class="text-primary hover:underline">{{ $doc->title }}</a></li>
                    @endforeach
                </ul>
            @else
                <p class="text-igp-text-muted">No documents in this category.</p>
            @endif
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="font-medium text-igp-text mb-2">Subcategories ({{ $category->children->count() }})</h2>
            @if($category->children->count() > 0)
                <ul class="list-disc list-inside text-igp-text-muted">
                    @foreach($category->children as $child)
                        <li><a href="{{ route('admin.categories.show', $child) }}" class="text-primary hover:underline">{{ $child->name }}</a></li>
                    @endforeach
                </ul>
            @else
                <p class="text-igp-text-muted">No subcategories.</p>
            @endif
        </div>
        <div>
            <a href="{{ route('admin.categories.index') }}" class="text-primary hover:underline">← Back to list</a>
        </div>
    </div>
</x-app-layout>
