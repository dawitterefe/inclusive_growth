@extends('layouts.public')

@section('title', 'Public Documents - ' . config('app.name'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-igp-text mb-8">Public Documents</h1>

    <div class="space-y-4">
        <form method="GET" class="flex flex-wrap gap-2 items-end bg-white p-4 rounded-lg shadow">
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
            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">Filter</button>
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
                                <a href="{{ route('public.documents.show', $doc) }}" class="text-primary hover:underline font-medium">{{ $doc->title }}</a>
                            </td>
                            <td class="px-6 py-4 text-sm text-igp-text-muted">{{ $doc->category?->name }}</td>
                            <td class="px-6 py-4 text-sm text-igp-text-muted">{{ $doc->department?->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-igp-text-muted">{{ $doc->uploaded_at?->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('public.documents.download', $doc) }}" class="text-primary hover:underline text-sm">Download</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-igp-text-muted">No public documents found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-3 border-t border-gray-200">
                {{ $documents->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
