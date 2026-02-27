<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-igp-text">{{ $employee->name }}</h1>
            <a href="{{ route('admin.employees.edit', $employee) }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">Edit</a>
        </div>
    </x-slot>

    <div class="bg-white rounded-lg shadow p-6">
        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <dt class="text-sm font-medium text-igp-text-muted">Position</dt>
                <dd class="mt-1">{{ $employee->position ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-igp-text-muted">Department</dt>
                <dd class="mt-1">{{ $employee->department?->name ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-igp-text-muted">Phone</dt>
                <dd class="mt-1">{{ $employee->phone ?: '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-igp-text-muted">Email</dt>
                <dd class="mt-1">{{ $employee->email ?: '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-igp-text-muted">Office Location</dt>
                <dd class="mt-1">{{ $employee->office_location ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-igp-text-muted">Status</dt>
                <dd class="mt-1"><span class="px-2 py-0.5 rounded text-xs {{ $employee->status === 'active' ? 'bg-accent/20' : 'bg-gray-200' }}">{{ $employee->status }}</span></dd>
            </div>
        </dl>
        <div class="mt-6">
            <a href="{{ route('admin.employees.index') }}" class="text-primary hover:underline">← Back to list</a>
        </div>
    </div>
</x-app-layout>
