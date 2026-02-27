<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::with('parent')
            ->withCount('documents')
            ->when($request->search, fn ($q) => $q->where('name', 'like', "%{$request->search}%"))
            ->orderBy('parent_id')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        $parentCategories = Category::whereNull('parent_id')->orderBy('name')->get();

        return view('admin.categories.create', compact('parentCategories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $baseSlug = Str::slug($validated['name']);
        $slug = $baseSlug;
        $c = 1;
        while (Category::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $c++;
        }
        $validated['slug'] = $slug;

        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category created.');
    }

    public function show(Category $category): View
    {
        $category->load(['parent', 'children', 'documents']);

        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category): View
    {
        $parentCategories = Category::whereNull('parent_id')->where('id', '!=', $category->id)->orderBy('name')->get();

        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        if ($validated['parent_id'] === (string) $category->id) {
            return redirect()->back()->with('error', 'Category cannot be its own parent.');
        }

        $baseSlug = Str::slug($validated['name']);
        $slug = $baseSlug;
        $c = 1;
        while (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
            $slug = $baseSlug . '-' . $c++;
        }
        $validated['slug'] = $slug;

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->documents()->count() > 0 || $category->children()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete category with documents or subcategories. Reassign or delete them first.');
        }
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted.');
    }
}
