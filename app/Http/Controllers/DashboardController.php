<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Document;
use App\Models\QuickLink;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $documentsCount = Document::count();
        $usersCount = User::count();

        $recentDocuments = Document::with(['category', 'uploadedBy'])
            ->latest('uploaded_at')
            ->limit(5)
            ->get();

        $announcements = Announcement::active()
            ->with('postedBy')
            ->latest()
            ->limit(5)
            ->get();

        $quickLinks = QuickLink::orderBy('sort_order')->get();

        return view('dashboard.index', compact(
            'user',
            'documentsCount',
            'usersCount',
            'recentDocuments',
            'announcements',
            'quickLinks'
        ));
    }
}
