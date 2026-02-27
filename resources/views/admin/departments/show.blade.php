<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-igp-text">{{ $department->name }}</h1>
            <a href="{{ route('admin.departments.edit', $department) }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">Edit</a>
        </div>
    </x-slot>

    <div class="space-y-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="font-medium text-igp-text mb-2">Users ({{ $department->users->count() }})</h2>
            @if($department->users->count() > 0)
                <ul class="list-disc list-inside text-igp-text-muted">
                    @foreach($department->users as $u)
                        <li>{{ $u->name }} ({{ $u->email }})</li>
                    @endforeach
                </ul>
            @else
                <p class="text-igp-text-muted">No users in this department.</p>
            @endif
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="font-medium text-igp-text mb-2">Employees ({{ $department->employees->count() }})</h2>
            @if($department->employees->count() > 0)
                <ul class="list-disc list-inside text-igp-text-muted">
                    @foreach($department->employees as $e)
                        <li>{{ $e->name }} — {{ $e->position ?? '—' }}</li>
                    @endforeach
                </ul>
            @else
                <p class="text-igp-text-muted">No employees in this department.</p>
            @endif
        </div>
        <div>
            <a href="{{ route('admin.departments.index') }}" class="text-primary hover:underline">← Back to list</a>
        </div>
    </div>
</x-app-layout>
