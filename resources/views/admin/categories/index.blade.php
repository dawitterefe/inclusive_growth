<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-igp-text">Manage Categories</h1>
            <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">Add Category</a>
        </div>
    </x-slot>

    <div class="space-y-4">
        <form method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="rounded-md border-gray-300">
            <button type="submit" class="px-4 py-2 bg-igp-text-muted/10 rounded-lg hover:bg-igp-text-muted/20">Search</button>
        </form>
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-igp-surface">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-igp-text-muted uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-igp-text-muted uppercase">Slug</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-igp-text-muted uppercase">Parent</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-igp-text-muted uppercase">Documents</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-igp-text-muted uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($categories as $cat)
                        <tr>
                            <td class="px-6 py-4 font-medium">{{ $cat->name }}</td>
                            <td class="px-6 py-4 text-igp-text-muted">{{ $cat->slug }}</td>
                            <td class="px-6 py-4 text-igp-text-muted">{{ $cat->parent?->name ?? '—' }}</td>
                            <td class="px-6 py-4 text-igp-text-muted">{{ $cat->documents_count }}</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('admin.categories.show', $cat) }}" class="text-primary hover:underline">View</a>
                                <a href="{{ route('admin.categories.edit', $cat) }}" class="text-primary hover:underline">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" class="inline" onsubmit="return confirm('Delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-8 text-center text-igp-text-muted">No categories.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-3">{{ $categories->withQueryString()->links() }}</div>
        </div>
    </div>
</x-app-layout>
