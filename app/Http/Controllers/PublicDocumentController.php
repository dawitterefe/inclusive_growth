<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Department;
use App\Models\Document;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PublicDocumentController extends Controller
{
    public function index(Request $request): View
    {
        $query = Document::where('access_level', 'public')
            ->with(['category', 'department', 'uploadedBy']);

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        $documents = $query->latest('uploaded_at')->paginate(15);
        $categories = Category::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();

        return view('public.documents.index', compact('documents', 'categories', 'departments'));
    }

    public function show(Document $document): View|RedirectResponse
    {
        if ($document->access_level !== 'public') {
            abort(403, 'This document is not publicly available.');
        }

        return view('public.documents.show', compact('document'));
    }

    public function download(Document $document): RedirectResponse|StreamedResponse
    {
        if ($document->access_level !== 'public') {
            abort(403, 'This document is not publicly available.');
        }

        if (! Storage::disk('documents')->exists($document->file_path)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        return Storage::disk('documents')->download(
            $document->file_path,
            $document->title . '.' . ($document->file_type ?? 'pdf')
        );
    }
}
