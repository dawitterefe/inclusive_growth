<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public function index(Request $request): View
    {
        $departments = Department::withCount(['users', 'employees', 'documents'])
            ->when($request->search, fn ($q) => $q->where('name', 'like', "%{$request->search}%"))
            ->orderBy('name')
            ->paginate(15);

        return view('admin.departments.index', compact('departments'));
    }

    public function create(): View
    {
        return view('admin.departments.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Department::create($validated);

        return redirect()->route('admin.departments.index')->with('success', 'Department created.');
    }

    public function show(Department $department): View
    {
        $department->load(['users', 'employees', 'documents']);

        return view('admin.departments.show', compact('department'));
    }

    public function edit(Department $department): View
    {
        return view('admin.departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $department->update($validated);

        return redirect()->route('admin.departments.index')->with('success', 'Department updated.');
    }

    public function destroy(Department $department): RedirectResponse
    {
        if ($department->users()->count() > 0 || $department->employees()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete department with users or employees. Reassign them first.');
        }
        $department->delete();

        return redirect()->route('admin.departments.index')->with('success', 'Department deleted.');
    }
}
