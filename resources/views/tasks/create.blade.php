@extends('layouts.app')

@section('content')
<h1>Create New Task</h1>

@if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('tasks.store') }}" method="POST" class="card card-body shadow-sm mt-3">
    @csrf

    <div class="mb-3">
        <label class="form-label">Task Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Project</label>
        <select name="project_id" class="form-select" required>
            <option value="">-- Select Project --</option>
            @foreach ($projects as $project)
                <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                    {{ $project->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Assign To</label>
        <select name="assigned_to" class="form-select" required>
            <option value="">-- Select Employee --</option>
            @foreach ($employees as $employee)
                <option value="{{ $employee->id }}" {{ old('assigned_to') == $employee->id ? 'selected' : '' }}>
                    {{ $employee->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
    <label class="form-label">Priority</label>

    <select name="priority" class="form-select" required>

        <option value="">-- Select Priority --</option>

        <option value="high">
            High
        </option>

        <option value="medium">
            Medium
        </option>

        <option value="low">
            Low
        </option>

    </select>

</div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
            <option value="todo">To Do</option>
            <option value="in_progress">In Progress</option>
            <option value="done">Done</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Create Task</button>
</form>

@endsection
