<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-igp-text">Manage Announcements</h1>
            <a href="{{ route('admin.announcements.create') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">Add Announcement</a>
        </div>
    </x-slot>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-igp-surface">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-igp-text-muted uppercase">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-igp-text-muted uppercase">Posted by</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-igp-text-muted uppercase">Expires</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-igp-text-muted uppercase">Attachments</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-igp-text-muted uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($announcements as $a)
                    <tr>
                        <td class="px-6 py-4">{{ $a->title }}</td>
                        <td class="px-6 py-4">{{ $a->postedBy?->name }}</td>
                        <td class="px-6 py-4">{{ $a->expiry_date?->format('M d, Y') ?? '—' }}</td>
                        <td class="px-6 py-4">{{ $a->attachments->count() }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.announcements.edit', $a) }}" class="text-primary hover:underline">Edit</a>
                            <form action="{{ route('admin.announcements.destroy', $a) }}" method="POST" class="inline" onsubmit="return confirm('Delete this announcement?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-6 py-8 text-center text-igp-text-muted">No announcements.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-3">{{ $announcements->links() }}</div>
    </div>
</x-app-layout>
