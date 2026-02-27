<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-igp-text">Employee Directory</h1>
    </x-slot>

    <div class="space-y-4">
        <form method="GET" class="flex flex-wrap gap-2 items-end">
            <div>
                <label class="block text-sm font-medium text-igp-text-muted mb-1">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Name, email, position..."
                    class="rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-igp-text-muted mb-1">Department</label>
                <select name="department_id" class="rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    <option value="">All</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ request('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-igp-text-muted/10 text-igp-text rounded-lg hover:bg-igp-text-muted/20">Filter</button>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($employees as $emp)
                <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition">
                    <h3 class="font-semibold text-igp-text">{{ $emp->name }}</h3>
                    <p class="text-sm text-igp-text-muted">{{ $emp->position ?? '—' }}</p>
                    <p class="text-sm text-igp-text-muted mt-1">{{ $emp->department?->name ?? '—' }}</p>
                    @if($emp->phone)
                        <a href="tel:{{ $emp->phone }}" class="block mt-2 text-sm text-primary hover:underline">{{ $emp->phone }}</a>
                    @endif
                    @if($emp->email)
                        <a href="mailto:{{ $emp->email }}" class="block text-sm text-primary hover:underline">{{ $emp->email }}</a>
                    @endif
                    @if($emp->office_location)
                        <p class="text-sm text-igp-text-muted mt-1">{{ $emp->office_location }}</p>
                    @endif
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-igp-text-muted">No employees found.</div>
            @endforelse
        </div>
        <div>
            {{ $employees->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
