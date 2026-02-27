<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DirectoryController extends Controller
{
    public function index(Request $request): View
    {
        $query = Employee::with('department');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhere('position', 'like', '%' . $request->search . '%');
            });
        }
        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        $employees = $query->orderBy('name')->paginate(20);
        $departments = Department::orderBy('name')->get();

        return view('directory.index', compact('employees', 'departments'));
    }
}
