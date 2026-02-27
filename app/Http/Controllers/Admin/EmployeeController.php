<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function index(Request $request): View
    {
        $employees = Employee::with('department')
            ->when($request->search, fn ($q) => $q->where('name', 'like', "%{$request->search}%")
                ->orWhere('email', 'like', "%{$request->search}%")
                ->orWhere('position', 'like', "%{$request->search}%"))
            ->when($request->department_id, fn ($q) => $q->where('department_id', $request->department_id))
            ->orderBy('name')
            ->paginate(20);

        $departments = Department::orderBy('name')->get();

        return view('admin.employees.index', compact('employees', 'departments'));
    }

    public function create(): View
    {
        $departments = Department::orderBy('name')->get();

        return view('admin.employees.create', compact('departments'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'department_id' => 'nullable|exists:departments,id',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email',
            'office_location' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        Employee::create($validated);

        return redirect()->route('admin.employees.index')->with('success', 'Employee created.');
    }

    public function show(Employee $employee): View
    {
        $employee->load('department');

        return view('admin.employees.show', compact('employee'));
    }

    public function edit(Employee $employee): View
    {
        $departments = Department::orderBy('name')->get();

        return view('admin.employees.edit', compact('employee', 'departments'));
    }

    public function update(Request $request, Employee $employee): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'department_id' => 'nullable|exists:departments,id',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email',
            'office_location' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $employee->update($validated);

        return redirect()->route('admin.employees.index')->with('success', 'Employee updated.');
    }

    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->delete();

        return redirect()->route('admin.employees.index')->with('success', 'Employee deleted.');
    }
}
