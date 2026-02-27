@extends('layouts.public')

@section('title', $document->title . ' - ' . config('app.name'))

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <h1 class="text-2xl font-semibold text-igp-text">{{ $document->title }}</h1>
                <a href="{{ route('public.documents.download', $document) }}" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">
                    Download
                </a>
            </div>

            @if($document->description)
                <p class="text-igp-text-muted mb-6">{{ $document->description }}</p>
            @endif

            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium text-igp-text-muted">Category</dt>
                    <dd class="mt-1">{{ $document->category?->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-igp-text-muted">Department</dt>
                    <dd class="mt-1">{{ $document->department?->name ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-igp-text-muted">Uploaded by</dt>
                    <dd class="mt-1">{{ $document->uploadedBy?->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-igp-text-muted">Upload date</dt>
                    <dd class="mt-1">{{ $document->uploaded_at?->format('M d, Y') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-igp-text-muted">Version</dt>
                    <dd class="mt-1">{{ $document->version }}</dd>
                </div>
            </dl>

            <div class="mt-6 pt-6 border-t border-gray-200">
                <a href="{{ route('public.documents') }}" class="text-primary hover:underline">← Back to documents</a>
            </div>
        </div>
    </div>
</div>
@endsection
