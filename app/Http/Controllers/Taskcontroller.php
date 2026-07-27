<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;

class Taskcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (! $user->hasPermission('view_tasks')) {
            abort(403, 'You do not have permission to view tasks.');
        }

        if ($user->isManagerOrAbove()) {

            $tasks = Task::with([
                'user',
                'project'
            ])
            ->latest()
            ->get();

        } else {

            $tasks = Task::with([
                'project'
            ])
            ->where('assigned_to', $user->id)
            ->latest()
            ->get();

        }

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (! $user->hasPermission('create_tasks')) {
            abort(403, 'You do not have permission to create tasks.');
        }

        $projects = Project::all();
        $employees = User::all();

        return view('tasks.create', compact('projects', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $r)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (! $user->hasPermission('create_tasks')) {
            abort(403, 'You do not have permission to create tasks.');
        }

        $r->validate([
            'project_id' => 'required|exists:projects,id',
            'assigned_to' => 'nullable|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required',
            'priority' => 'required',
            'deadline' => 'nullable|date',
        ]);

        Task::create([
            'project_id' => $r->project_id,
            'assigned_to' => $r->assigned_to,
            'title' => $r->title,
            'description' => $r->description,
            'status' => $r->status,
            'priority' => $r->priority,
            'deadline' => $r->deadline,
        ]);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    if ($task->assigned_to !== $user->id && ! $user->hasPermission('view_tasks')) {
        abort(403, 'You do not have permission to view this task.');
    }

    $task->load(['project', 'user']);

    return view('tasks.show', compact('task'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($task->assigned_to !== $user->id && ! $user->hasPermission('edit_tasks')) {
            abort(403, 'You do not have permission to edit this task.');
        }

        $projects = Project::all();
        $users = User::all();

        return view('tasks.edit', compact('task', 'projects', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r, Task $task)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($task->assigned_to !== $user->id && ! $user->hasPermission('edit_tasks')) {
            abort(403, 'You do not have permission to edit this task.');
        }
// use of associative array.
        $r->validate([
            'project_id' => 'required',
            'title' => 'required|min:3',
            'status' => 'required',
            'priority' => 'required'
        ]);

        $task->update([
            'project_id' => $r->project_id,
            'assigned_to' => $r->assigned_to,
            'title' => $r->title,
            'description' => $r->description,
            'status' => $r->status,
            'priority' => $r->priority,
            'deadline' => $r->deadline
        ]);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (! $user->hasPermission('delete_tasks')) {
            abort(403, 'You do not have permission to delete tasks.');
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }

    public function updateStatus(Request $r, Task $task)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Security check: employees can only update their OWN task
        if ($task->assigned_to !== $user->id && ! $user->hasPermission('edit_tasks')) {
            abort(403, 'You can only update your own tasks.');
        }

        $r->validate([
            'status' => 'required|in:todo,in_progress,done',
        ]);

        $task->update(['status' => $r->status]);

        return back()->with('success', 'Task status updated.');
    }

    public function myTasks()
    {
        return view('tasks.my-tasks');
    }
}
