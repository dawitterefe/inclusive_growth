<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-igp-text">Manage Employees</h1>
            <a href="{{ route('admin.employees.create') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">Add Employee</a>
        </div>
    </x-slot>

    <div class="space-y-4">
        <form method="GET" class="flex flex-wrap gap-2 items-end">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, email, position..." class="rounded-md border-gray-300">
            <select name="department_id" class="rounded-md border-gray-300">
                <option value="">All departments</option>
                @foreach($departments as $d)
                    <option value="{{ $d->id }}" {{ request('department_id') == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="px-4 py-2 bg-igp-text-muted/10 rounded-lg hover:bg-igp-text-muted/20">Filter</button>
        </form>
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-igp-surface">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-igp-text-muted uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-igp-text-muted uppercase">Position</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-igp-text-muted uppercase">Department</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-igp-text-muted uppercase">Phone</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-igp-text-muted uppercase">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-igp-text-muted uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($employees as $emp)
                        <tr>
                            <td class="px-6 py-4 font-medium">{{ $emp->name }}</td>
                            <td class="px-6 py-4 text-igp-text-muted">{{ $emp->position ?? '—' }}</td>
                            <td class="px-6 py-4 text-igp-text-muted">{{ $emp->department?->name ?? '—' }}</td>
                            <td class="px-6 py-4 text-igp-text-muted">{{ $emp->phone ?? '—' }}</td>
                            <td class="px-6 py-4"><span class="px-2 py-0.5 rounded text-xs {{ $emp->status === 'active' ? 'bg-accent/20' : 'bg-gray-200' }}">{{ $emp->status }}</span></td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('admin.employees.show', $emp) }}" class="text-primary hover:underline">View</a>
                                <a href="{{ route('admin.employees.edit', $emp) }}" class="text-primary hover:underline">Edit</a>
                                <form action="{{ route('admin.employees.destroy', $emp) }}" method="POST" class="inline" onsubmit="return confirm('Delete this employee?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-6 py-8 text-center text-igp-text-muted">No employees.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-3">{{ $employees->withQueryString()->links() }}</div>
        </div>
    </div>
</x-app-layout>
