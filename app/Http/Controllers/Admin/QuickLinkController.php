<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuickLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuickLinkController extends Controller
{
    public function index(): View
    {
        $links = QuickLink::orderBy('sort_order')->orderBy('title')->paginate(15);

        return view('admin.links.index', compact('links'));
    }

    public function create(): View
    {
        return view('admin.links.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'category' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        QuickLink::create([
            ...$validated,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.links.index')->with('success', 'Quick link created.');
    }

    public function edit(QuickLink $link): View
    {
        return view('admin.links.edit', compact('link'));
    }

    public function update(Request $request, QuickLink $link): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'category' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $link->update($validated);

        return redirect()->route('admin.links.index')->with('success', 'Quick link updated.');
    }

    public function destroy(QuickLink $link): RedirectResponse
    {
        $link->delete();

        return redirect()->route('admin.links.index')->with('success', 'Quick link deleted.');
    }
}
