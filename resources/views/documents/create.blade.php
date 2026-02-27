<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-igp-text">Upload Document</h1>
    </x-slot>

    <div class="max-w-2xl">
        <form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data" class="space-y-4 bg-white rounded-lg shadow p-6">
            @csrf

            <div>
                <label for="title" class="block text-sm font-medium text-igp-text">Title</label>
                <input id="title" type="text" name="title" value="{{ old('title') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-igp-text">Description</label>
                <textarea id="description" name="description" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-igp-text">Category</label>
                <select id="category_id" name="category_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    <option value="">Select...</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="department_id" class="block text-sm font-medium text-igp-text">Department</label>
                <select id="department_id" name="department_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    <option value="">Select...</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="access_level" class="block text-sm font-medium text-igp-text">Access Level</label>
                <select id="access_level" name="access_level" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    <option value="public" {{ old('access_level') == 'public' ? 'selected' : '' }}>Public</option>
                    <option value="internal" {{ old('access_level', 'internal') == 'internal' ? 'selected' : '' }}>Internal</option>
                    <option value="restricted" {{ old('access_level') == 'restricted' ? 'selected' : '' }}>Restricted</option>
                </select>
            </div>

            <div>
                <label for="file" class="block text-sm font-medium text-igp-text">File (PDF, DOCX, XLSX, max 10MB)</label>
                <input id="file" type="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx" required
                    class="mt-1 block w-full">
                @error('file')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">
                    Upload
                </button>
                <a href="{{ route('documents.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
