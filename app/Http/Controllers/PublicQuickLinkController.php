<?php

namespace App\Http\Controllers;

use App\Models\QuickLink;
use Illuminate\View\View;

class PublicQuickLinkController extends Controller
{
    public function index(): View
    {
        $links = QuickLink::orderBy('sort_order')->orderBy('title')->get();

        return view('public.links.index', compact('links'));
    }
}
