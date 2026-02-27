@extends('layouts.public')

@section('title', 'Employee Directory - ' . config('app.name'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-igp-text mb-8">Employee Directory</h1>

    <div class="space-y-4">
        <form method="GET" class="flex flex-wrap gap-2 items-end bg-white p-4 rounded-lg shadow">
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
            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">Filter</button>
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
                <div class="col-span-full text-center py-12 text-igp-text-muted bg-white rounded-lg shadow">No employees found.</div>
            @endforelse
        </div>
        <div>
            {{ $employees->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
