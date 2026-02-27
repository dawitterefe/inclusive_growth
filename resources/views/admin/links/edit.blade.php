<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-igp-text">Edit Quick Link</h1>
    </x-slot>

    <form method="POST" action="{{ route('admin.links.update', $link) }}" class="max-w-2xl space-y-4 bg-white rounded-lg shadow p-6">
        @csrf
        @method('PATCH')
        <div>
            <label class="block text-sm font-medium text-igp-text">Title</label>
            <input type="text" name="title" value="{{ old('title', $link->title) }}" required class="mt-1 block w-full rounded-md border-gray-300">
            @error('title')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-igp-text">URL</label>
            <input type="url" name="url" value="{{ old('url', $link->url) }}" required class="mt-1 block w-full rounded-md border-gray-300">
            @error('url')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-igp-text">Category</label>
            <input type="text" name="category" value="{{ old('category', $link->category) }}" class="mt-1 block w-full rounded-md border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-igp-text">Sort Order</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $link->sort_order) }}" min="0" class="mt-1 block w-full rounded-md border-gray-300">
        </div>
        <div class="flex gap-2">
            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">Update</button>
            <a href="{{ route('admin.links.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Cancel</a>
        </div>
    </form>
</x-app-layout>
