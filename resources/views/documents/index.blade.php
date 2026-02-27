<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h1 class="text-2xl font-semibold text-igp-text">Documents</h1>
            @if(in_array(auth()->user()->role ?? 'staff', ['admin', 'super_admin', 'dept_head']))
                <a href="{{ route('documents.create') }}" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">
                    Upload Document
                </a>
            @endif
        </div>
    </x-slot>

    <div class="space-y-4">
        <form method="GET" class="flex flex-wrap gap-2 items-end">
            <div>
                <label class="block text-sm font-medium text-igp-text-muted mb-1">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Title..."
                    class="rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-igp-text-muted mb-1">Category</label>
                <select name="category_id" class="rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    <option value="">All</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-igp-text-muted mb-1">Department</label>
                <select name="department_id" class="rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    <option value="">All</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ request('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-igp-text-muted/10 text-igp-text rounded-lg hover:bg-igp-text-muted/20">Filter</button>
        </form>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-igp-surface">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-igp-text-muted uppercase">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-igp-text-muted uppercase">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-igp-text-muted uppercase">Department</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-igp-text-muted uppercase">Uploaded</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-igp-text-muted uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($documents as $doc)
                        <tr>
                            <td class="px-6 py-4">
                                <a href="{{ route('documents.show', $doc) }}" class="text-primary hover:underline font-medium">{{ $doc->title }}</a>
                            </td>
                            <td class="px-6 py-4 text-sm text-igp-text-muted">{{ $doc->category?->name }}</td>
                            <td class="px-6 py-4 text-sm text-igp-text-muted">{{ $doc->department?->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-igp-text-muted">{{ $doc->uploaded_at?->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('documents.download', $doc) }}" class="text-primary hover:underline text-sm">Download</a>
                                @if(in_array(auth()->user()->role ?? 'staff', ['admin', 'super_admin']))
                                    <a href="{{ route('documents.edit', $doc) }}" class="text-primary hover:underline text-sm">Edit</a>
                                    <form action="{{ route('documents.destroy', $doc) }}" method="POST" class="inline" onsubmit="return confirm('Delete this document?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-igp-text-muted">No documents found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-3 border-t border-gray-200">
                {{ $documents->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
