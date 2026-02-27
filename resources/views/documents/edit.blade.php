<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-igp-text">Edit Document</h1>
    </x-slot>

    <div class="max-w-2xl">
        <form method="POST" action="{{ route('documents.update', $document) }}" enctype="multipart/form-data" class="space-y-4 bg-white rounded-lg shadow p-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-igp-text">Title</label>
                <input id="title" type="text" name="title" value="{{ old('title', $document->title) }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-igp-text">Description</label>
                <textarea id="description" name="description" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">{{ old('description', $document->description) }}</textarea>
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-igp-text">Category</label>
                <select id="category_id" name="category_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $document->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="department_id" class="block text-sm font-medium text-igp-text">Department</label>
                <select id="department_id" name="department_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    <option value="">Select...</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ old('department_id', $document->department_id) == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="access_level" class="block text-sm font-medium text-igp-text">Access Level</label>
                <select id="access_level" name="access_level" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    <option value="public" {{ old('access_level', $document->access_level) == 'public' ? 'selected' : '' }}>Public</option>
                    <option value="internal" {{ old('access_level', $document->access_level) == 'internal' ? 'selected' : '' }}>Internal</option>
                    <option value="restricted" {{ old('access_level', $document->access_level) == 'restricted' ? 'selected' : '' }}>Restricted</option>
                </select>
            </div>

            <div>
                <label for="file" class="block text-sm font-medium text-igp-text">Replace file (optional, PDF, DOCX, XLSX, max 10MB)</label>
                <input id="file" type="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx"
                    class="mt-1 block w-full">
                <p class="mt-1 text-sm text-igp-text-muted">Current: {{ $document->title }}.{{ $document->file_type }}</p>
                @error('file')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">
                    Update
                </button>
                <a href="{{ route('documents.show', $document) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Cancel</a>
                <a href="{{ route('documents.index') }}" class="inline-flex items-center px-4 py-2 text-igp-text-muted hover:underline">Back to list</a>
            </div>
        </form>
    </div>
</x-app-layout>
