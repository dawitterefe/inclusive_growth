<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-igp-text">Add Employee</h1>
    </x-slot>

    <form method="POST" action="{{ route('admin.employees.store') }}" class="max-w-2xl space-y-4 bg-white rounded-lg shadow p-6">
        @csrf
        <div>
            <label class="block text-sm font-medium text-igp-text">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="mt-1 block w-full rounded-md border-gray-300">
            @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-igp-text">Position</label>
            <input type="text" name="position" value="{{ old('position') }}" class="mt-1 block w-full rounded-md border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-igp-text">Department</label>
            <select name="department_id" class="mt-1 block w-full rounded-md border-gray-300">
                <option value="">—</option>
                @foreach($departments as $d)
                    <option value="{{ $d->id }}" {{ old('department_id') == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-igp-text">Phone</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="mt-1 block w-full rounded-md border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-igp-text">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full rounded-md border-gray-300">
            @error('email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-igp-text">Office Location</label>
            <input type="text" name="office_location" value="{{ old('office_location') }}" class="mt-1 block w-full rounded-md border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-igp-text">Status</label>
            <select name="status" class="mt-1 block w-full rounded-md border-gray-300">
                <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">Create</button>
            <a href="{{ route('admin.employees.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Cancel</a>
        </div>
    </form>
</x-app-layout>
