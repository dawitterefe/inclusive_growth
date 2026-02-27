<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-igp-text">Edit Announcement</h1>
    </x-slot>

    <form method="POST" action="{{ route('admin.announcements.update', $announcement) }}" enctype="multipart/form-data" class="max-w-2xl space-y-4 bg-white rounded-lg shadow p-6">
        @csrf
        @method('PATCH')
        <div>
            <label class="block text-sm font-medium text-igp-text">Title</label>
            <input type="text" name="title" value="{{ old('title', $announcement->title) }}" required class="mt-1 block w-full rounded-md border-gray-300">
            @error('title')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-igp-text">Content</label>
            <textarea name="content" rows="5" required class="mt-1 block w-full rounded-md border-gray-300">{{ old('content', $announcement->content) }}</textarea>
            @error('content')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-igp-text">Expiry Date</label>
            <input type="date" name="expiry_date" value="{{ old('expiry_date', $announcement->expiry_date?->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-igp-text">Category</label>
            <input type="text" name="category" value="{{ old('category', $announcement->category) }}" class="mt-1 block w-full rounded-md border-gray-300">
        </div>
        @if($announcement->attachments->isNotEmpty())
            <div>
                <label class="block text-sm font-medium text-igp-text mb-2">Existing attachments</label>
                <ul class="space-y-2">
                    @foreach($announcement->attachments as $att)
                        <li class="flex items-center gap-3">
                            <a href="{{ route('announcement-attachments.download', $att) }}" class="text-primary hover:underline">{{ $att->original_name }}</a>
                            <label class="flex items-center gap-1 text-sm text-red-600">
                                <input type="checkbox" name="remove_attachments[]" value="{{ $att->id }}"> Remove
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div>
            <label class="block text-sm font-medium text-igp-text">Add attachments (PDF, DOCX, XLSX, max 10MB each)</label>
            <input type="file" name="attachments[]" multiple accept=".pdf,.doc,.docx,.xls,.xlsx" class="mt-1 block w-full rounded-md border-gray-300">
            @error('attachments.*')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="flex gap-2">
            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">Update</button>
            <a href="{{ route('admin.announcements.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Cancel</a>
        </div>
    </form>
</x-app-layout>
