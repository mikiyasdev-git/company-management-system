<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class Usercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    if (! $user->hasPermission('view_users')) {
        abort(403, 'You do not have permission to view users.');
    }
// logic for search users
    $search = $request->input('search');

    $users = User::with('roles')
        ->when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        })
        ->latest()
        ->get();

    return view('users.index', compact('users'));
}

    public function toggleActive(User $targetUser)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (! $user->hasPermission('edit_users')) {
            abort(403, 'You do not have permission to modify users.');
        }

        $targetUser->update(['is_active' => ! $targetUser->is_active]);

        return back()->with('success', 'User status updated.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (! $user->hasPermission('create_users')) {
            abort(403, 'You do not have permission to create users.');
        }

        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $r)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (! $user->hasPermission('create_users')) {
            abort(403, 'You do not have permission to create users.');
        }

        $r->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        $newUser = User::create([
            'name' => $r->name,
            'email' => $r->email,
            'password' => Hash::make($r->password),
            'is_active' => $r->has('is_active'),
        ]);

        $newUser->roles()->attach($r->role_id);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        /** @var \App\Models\User $authUser */
        $authUser = Auth::user();

        if (! $authUser->hasPermission('edit_users')) {
            abort(403, 'You do not have permission to edit users.');
        }

        $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r, User $user)
    {
        /** @var \App\Models\User $authUser */
        $authUser = Auth::user();

        if (! $authUser->hasPermission('edit_users')) {
            abort(403, 'You do not have permission to edit users.');
        }

        $r->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->update([
            'name' => $r->name,
            'email' => $r->email,
            'is_active' => $r->has('is_active'),
            'password' => $r->filled('password') ? Hash::make($r->password) : $user->password,
        ]);

        $user->roles()->sync([$r->role_id]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        /** @var \App\Models\User $authUser */
        $authUser = Auth::user();

        if (! $authUser->hasPermission('delete_users')) {
            abort(403, 'You do not have permission to delete users.');
        }

        if ($user->id === $authUser->id) {
            abort(403, 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
