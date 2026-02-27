<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(): View
    {
        $announcements = Announcement::active()
            ->with(['postedBy', 'attachments'])
            ->latest()
            ->paginate(15);

        return view('announcements.index', compact('announcements'));
    }
}
