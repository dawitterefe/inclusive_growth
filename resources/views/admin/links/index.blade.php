<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-igp-text">Manage Quick Links</h1>
            <a href="{{ route('admin.links.create') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">Add Link</a>
        </div>
    </x-slot>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-igp-surface">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-igp-text-muted uppercase">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-igp-text-muted uppercase">URL</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-igp-text-muted uppercase">Order</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-igp-text-muted uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($links as $link)
                    <tr>
                        <td class="px-6 py-4">{{ $link->title }}</td>
                        <td class="px-6 py-4 text-sm text-igp-text-muted truncate max-w-xs">{{ $link->url }}</td>
                        <td class="px-6 py-4">{{ $link->sort_order }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.links.edit', $link) }}" class="text-primary hover:underline">Edit</a>
                            <form action="{{ route('admin.links.destroy', $link) }}" method="POST" class="inline" onsubmit="return confirm('Delete this link?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-6 py-8 text-center text-igp-text-muted">No links.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-3">{{ $links->links() }}</div>
    </div>
</x-app-layout>
