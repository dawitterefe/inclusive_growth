<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::with('department')
            ->when($request->search, fn ($q) => $q->where('name', 'like', "%{$request->search}%")->orWhere('email', 'like', "%{$request->search}%"))
            ->latest()
            ->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        $departments = Department::orderBy('name')->get();

        return view('admin.users.create', compact('departments'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:super_admin,admin,dept_head,staff,guest',
            'department_id' => 'nullable|exists:departments,id',
            'status' => 'required|in:active,inactive',
        ]);

        User::create([
            ...$validated,
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created.');
    }

    public function edit(User $user): View
    {
        $departments = Department::orderBy('name')->get();

        return view('admin.users.edit', compact('user', 'departments'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:super_admin,admin,dept_head,staff,guest',
            'department_id' => 'nullable|exists:departments,id',
            'status' => 'required|in:active,inactive',
        ]);

        $data = collect($validated)->except('password')->toArray();
        if (! empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }
        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User updated.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        if ($user->id === $request->user()->id) {
            return redirect()->back()->with('error', 'You cannot delete yourself.');
        }
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted.');
    }
}
