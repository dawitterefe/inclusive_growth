<?php

namespace App\Http\Controllers;

use App\Models\AnnouncementAttachment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AnnouncementAttachmentController extends Controller
{
    public function download(AnnouncementAttachment $attachment): RedirectResponse|StreamedResponse
    {
        if (! Storage::disk('announcements')->exists($attachment->file_path)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        return Storage::disk('announcements')->download(
            $attachment->file_path,
            $attachment->original_name
        );
    }
}
