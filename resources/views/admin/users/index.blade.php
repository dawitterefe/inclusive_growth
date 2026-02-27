<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-igp-text">Manage Users</h1>
            <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">Add User</a>
        </div>
    </x-slot>

    <div class="space-y-4">
        <form method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name or email..." class="rounded-md border-gray-300">
            <button type="submit" class="px-4 py-2 bg-igp-text-muted/10 rounded-lg hover:bg-igp-text-muted/20">Search</button>
        </form>
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-igp-surface">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-igp-text-muted uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-igp-text-muted uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-igp-text-muted uppercase">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-igp-text-muted uppercase">Department</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-igp-text-muted uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($users as $u)
                        <tr>
                            <td class="px-6 py-4">{{ $u->name }}</td>
                            <td class="px-6 py-4">{{ $u->email }}</td>
                            <td class="px-6 py-4"><span class="px-2 py-0.5 rounded text-xs bg-accent/20">{{ $u->role }}</span></td>
                            <td class="px-6 py-4">{{ $u->department?->name ?? '—' }}</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('admin.users.edit', $u) }}" class="text-primary hover:underline">Edit</a>
                                @if($u->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $u) }}" method="POST" class="inline" onsubmit="return confirm('Delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-8 text-center text-igp-text-muted">No users.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-3">{{ $users->withQueryString()->links() }}</div>
        </div>
    </div>
</x-app-layout>
