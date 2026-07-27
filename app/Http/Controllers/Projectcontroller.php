<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;

class Projectcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (! $user->hasPermission('view_projects')) {
            abort(403, 'You do not have permission to view projects.');
        }

        $projects = $user->isManagerOrAbove()
            ? Project::with('user')->latest()->get()
            : $user->projects()->latest()->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (! $user->hasPermission('create_projects')) {
            abort(403, 'You do not have permission to create projects.');
        }

        $employees = User::whereHas('roles', function ($query) {
            $query->where('name', 'Employee');
        })->where('is_active', true)->get();

        return view('projects.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $r)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (! $user->hasPermission('create_projects')) {
            abort(403, 'You do not have permission to create projects.');
        }

        $r->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'user_id' => 'required|exists:users,id',
        ]);

        Project::create($r->only('name', 'description', 'start_date', 'end_date', 'user_id'));

        return redirect()->route('projects.index')->with('success', 'Project created.');
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
    public function edit(Project $project)
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    if (! $user->hasPermission('edit_projects')) {
        abort(403, 'You do not have permission to edit projects.');
    }

    $employees = User::whereHas('roles', function ($query) {
        $query->where('name', 'Employee');
    })->where('is_active', true)->get();

    return view('projects.edit', compact('project', 'employees'));
}

public function update(Request $r, Project $project)
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    if (! $user->hasPermission('edit_projects')) {
        abort(403, 'You do not have permission to edit projects.');
    }

    $r->validate([
        'name' => 'required|min:3',
        'description' => 'nullable',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'user_id' => 'required|exists:users,id',
        'status' => 'required',
    ]);

    $project->update([
        'name' => $r->name,
        'description' => $r->description,
        'start_date' => $r->start_date,
        'end_date' => $r->end_date,
        'user_id' => $r->user_id,
        'status' => $r->status,
    ]);

    return redirect()->route('projects.index')
        ->with('success', 'Project updated successfully');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (! $user->hasPermission('delete_projects')) {
            abort(403, 'You do not have permission to delete projects.');
        }

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted.');
    }

    public function myProjects()
    {
        return view('projects.my-projects');
    }
}
