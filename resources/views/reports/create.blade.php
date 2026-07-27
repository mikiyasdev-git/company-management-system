@extends('layouts.app')

@section('content')
<h1>Submit Report</h1>

@if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data" class="card card-body shadow-sm mt-3">
    @csrf

    @if (Auth::user()->hasRole('Manager') || Auth::user()->hasRole('System Administrator'))
        <div class="mb-3">
            <label class="form-label">Employee</label>
            <select name="user_id" class="form-select" required>
                <option value="">-- Select Employee --</option>
                @foreach ($users as $u)
                    <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? 'selected' : '' }}>
                        {{ $u->name }}
                    </option>
                @endforeach
            </select>
        </div>
    @endif

    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Project (optional)</label>
        <select name="project_id" class="form-select">
            <option value="">-- None --</option>
            @foreach ($projects as $project)
                <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                    {{ $project->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Task (optional)</label>
        <select name="task_id" class="form-select">
            <option value="">-- None --</option>
            @foreach ($tasks as $task)
                <option value="{{ $task->id }}" {{ old('task_id') == $task->id ? 'selected' : '' }}>
                    {{ $task->title }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Report Date</label>
        <input type="date" name="report_date" class="form-control" value="{{ old('report_date', date('Y-m-d')) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Attach Files (PDF, images, video, docs)</label>
        <input type="file" name="files[]" class="form-control" multiple>
        <small class="text-muted">Max 20MB per file.</small>
    </div>

    <button type="submit" class="btn btn-primary">Submit Report</button>
</form>
