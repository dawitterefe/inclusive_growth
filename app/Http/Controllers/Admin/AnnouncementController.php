<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\AnnouncementAttachment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(): View
    {
        $announcements = Announcement::with(['postedBy', 'attachments'])->latest()->paginate(15);

        return view('admin.announcements.index', compact('announcements'));
    }

    public function create(): View
    {
        return view('admin.announcements.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'expiry_date' => 'nullable|date',
            'category' => 'nullable|string|max:100',
            'attachments.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
        ]);

        $announcement = Announcement::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'expiry_date' => $validated['expiry_date'] ?? null,
            'category' => $validated['category'] ?? null,
            'posted_by' => $request->user()->id,
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                if ($file->isValid()) {
                    $path = $file->store($announcement->id, 'announcements');
                    AnnouncementAttachment::create([
                        'announcement_id' => $announcement->id,
                        'file_path' => $path,
                        'original_name' => $file->getClientOriginalName(),
                        'file_type' => $file->getClientOriginalExtension(),
                        'file_size' => $file->getSize(),
                    ]);
                }
            }
        }

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement created.');
    }

    public function edit(Announcement $announcement): View
    {
        $announcement->load('attachments');

        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'expiry_date' => 'nullable|date',
            'category' => 'nullable|string|max:100',
            'attachments.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'remove_attachments' => 'nullable|array',
            'remove_attachments.*' => 'exists:announcement_attachments,id',
        ]);

        $announcement->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'expiry_date' => $validated['expiry_date'] ?? null,
            'category' => $validated['category'] ?? null,
        ]);

        if (! empty($validated['remove_attachments'])) {
            foreach ($validated['remove_attachments'] as $id) {
                $att = AnnouncementAttachment::find($id);
                if ($att && $att->announcement_id === $announcement->id) {
                    Storage::disk('announcements')->delete($att->file_path);
                    $att->delete();
                }
            }
        }

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                if ($file->isValid()) {
                    $path = $file->store($announcement->id, 'announcements');
                    AnnouncementAttachment::create([
                        'announcement_id' => $announcement->id,
                        'file_path' => $path,
                        'original_name' => $file->getClientOriginalName(),
                        'file_type' => $file->getClientOriginalExtension(),
                        'file_size' => $file->getSize(),
                    ]);
                }
            }
        }

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement updated.');
    }

    public function destroy(Announcement $announcement): RedirectResponse
    {
        foreach ($announcement->attachments as $att) {
            Storage::disk('announcements')->delete($att->file_path);
        }
        $announcement->delete();

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement deleted.');
    }
}
