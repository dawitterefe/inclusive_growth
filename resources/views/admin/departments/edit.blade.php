<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-igp-text">Edit Department</h1>
    </x-slot>

    <form method="POST" action="{{ route('admin.departments.update', $department) }}" class="max-w-2xl space-y-4 bg-white rounded-lg shadow p-6">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium text-igp-text">Name</label>
            <input type="text" name="name" value="{{ old('name', $department->name) }}" required class="mt-1 block w-full rounded-md border-gray-300">
            @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="flex gap-2">
            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">Update</button>
            <a href="{{ route('admin.departments.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Cancel</a>
        </div>
    </form>
</x-app-layout>
