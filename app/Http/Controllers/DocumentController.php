<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Document;
use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DocumentController extends Controller
{
    public function index(Request $request): View
    {
        $query = Document::with(['category', 'department', 'uploadedBy']);

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

        return view('documents.index', compact('documents', 'categories', 'departments'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();

        return view('documents.create', compact('categories', 'departments'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'department_id' => 'nullable|exists:departments,id',
            'access_level' => 'required|in:public,internal,restricted',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
        ]);

        $file = $request->file('file');
        $path = $file->store(
            date('Y') . '/' . date('m'),
            'documents'
        );

        Document::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'],
            'department_id' => $validated['department_id'] ?? null,
            'access_level' => $validated['access_level'],
            'file_path' => $path,
            'file_type' => $file->getClientOriginalExtension(),
            'uploaded_by' => $request->user()->id,
            'uploaded_at' => now(),
        ]);

        return redirect()->route('documents.index')->with('success', 'Document uploaded successfully.');
    }

    public function show(Document $document): View|RedirectResponse
    {
        return view('documents.show', compact('document'));
    }

    public function edit(Document $document): View|RedirectResponse
    {
        $this->authorizeDocumentManage($document);

        $document->load(['category', 'department']);
        $categories = Category::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();

        return view('documents.edit', compact('document', 'categories', 'departments'));
    }

    public function update(Request $request, Document $document): RedirectResponse
    {
        $this->authorizeDocumentManage($document);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'department_id' => 'nullable|exists:departments,id',
            'access_level' => 'required|in:public,internal,restricted',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
        ]);

        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'],
            'department_id' => $validated['department_id'] ?? null,
            'access_level' => $validated['access_level'],
        ];

        if ($request->hasFile('file')) {
            Storage::disk('documents')->delete($document->file_path);
            $file = $request->file('file');
            $path = $file->store(date('Y') . '/' . date('m'), 'documents');
            $data['file_path'] = $path;
            $data['file_type'] = $file->getClientOriginalExtension();
            $data['uploaded_at'] = now();
            $data['version'] = ($document->version ?? 1) + 1;
        }

        $document->update($data);

        return redirect()->route('documents.show', $document)->with('success', 'Document updated.');
    }

    public function destroy(Document $document): RedirectResponse
    {
        $this->authorizeDocumentManage($document);

        Storage::disk('documents')->delete($document->file_path);
        $document->delete();

        return redirect()->route('documents.index')->with('success', 'Document deleted.');
    }

    private function authorizeDocumentManage(Document $document): void
    {
        if (! in_array(auth()->user()->role ?? 'staff', ['admin', 'super_admin'])) {
            abort(403);
        }
    }

    public function download(Document $document): RedirectResponse|\Symfony\Component\HttpFoundation\StreamedResponse
    {
        if (! Storage::disk('documents')->exists($document->file_path)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        return Storage::disk('documents')->download(
            $document->file_path,
            $document->title . '.' . ($document->file_type ?? 'pdf')
        );
    }
}
