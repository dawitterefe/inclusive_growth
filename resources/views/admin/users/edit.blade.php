<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-igp-text">Edit User</h1>
    </x-slot>

    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="max-w-2xl space-y-4 bg-white rounded-lg shadow p-6">
        @csrf
        @method('PATCH')
        <div>
            <label class="block text-sm font-medium text-igp-text">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="mt-1 block w-full rounded-md border-gray-300">
            @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-igp-text">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="mt-1 block w-full rounded-md border-gray-300">
            @error('email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-igp-text">New Password (leave blank to keep)</label>
            <input type="password" name="password" class="mt-1 block w-full rounded-md border-gray-300">
            @error('password')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-igp-text">Confirm Password</label>
            <input type="password" name="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300">
        </div>
        <div>
            <label class="block text-sm font-medium text-igp-text">Role</label>
            <select name="role" required class="mt-1 block w-full rounded-md border-gray-300">
                <option value="staff" {{ old('role', $user->role) == 'staff' ? 'selected' : '' }}>Staff</option>
                <option value="dept_head" {{ old('role', $user->role) == 'dept_head' ? 'selected' : '' }}>Department Head</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="super_admin" {{ old('role', $user->role) == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                <option value="guest" {{ old('role', $user->role) == 'guest' ? 'selected' : '' }}>Guest</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-igp-text">Department</label>
            <select name="department_id" class="mt-1 block w-full rounded-md border-gray-300">
                <option value="">—</option>
                @foreach($departments as $d)
                    <option value="{{ $d->id }}" {{ old('department_id', $user->department_id) == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-igp-text">Status</label>
            <select name="status" class="mt-1 block w-full rounded-md border-gray-300">
                <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">Update</button>
            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Cancel</a>
        </div>
    </form>
</x-app-layout>
