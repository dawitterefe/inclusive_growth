<?php

namespace App\Http\Controllers;

use App\Models\QuickLink;
use Illuminate\View\View;

class QuickLinkController extends Controller
{
    public function index(): View
    {
        $links = QuickLink::orderBy('sort_order')->orderBy('title')->get();

        return view('links.index', compact('links'));
    }
}
