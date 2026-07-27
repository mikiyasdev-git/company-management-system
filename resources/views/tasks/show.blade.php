@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Task Details</h3>
            <a href="{{ url()->previous() }}" class="btn btn-light btn-sm">Back</a>
        </div>

        <div class="card-body">

            <dl class="row mb-0">
                <dt class="col-sm-3">Title</dt>
                <dd class="col-sm-9">{{ $task->title }}</dd>

                <dt class="col-sm-3">Project</dt>
                <dd class="col-sm-9">{{ $task->project->name ?? 'No Project' }}</dd>

                <dt class="col-sm-3">Assigned To</dt>
                <dd class="col-sm-9">{{ optional($task->user)->name ?? 'Not Assigned' }}</dd>

                <dt class="col-sm-3">Description</dt>
                <dd class="col-sm-9">{{ $task->description ?? 'No description provided.' }}</dd>

                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">
                    <span class="badge bg-info text-dark">{{ $task->status }}</span>
                </dd>

                <dt class="col-sm-3">Priority</dt>
                <dd class="col-sm-9">
                    <span class="badge bg-warning text-dark">{{ $task->priority }}</span>
                </dd>

                <dt class="col-sm-3">Deadline</dt>
                <dd class="col-sm-9">{{ $task->deadline ?? 'No Deadline' }}</dd>
            </dl>

            <div class="mt-3">
                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit Task</a>
            </div>

            <div class="mt-3">
    <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST" class="d-flex align-items-center gap-2">
        @csrf
        @method('PATCH')

        <label class="form-label mb-0">Update Status:</label>

        <select name="status" class="form-select w-auto">
            <option value="todo" @if($task->status == 'todo') selected @endif>To Do</option>
            <option value="in_progress" @if($task->status == 'in_progress') selected @endif>In Progress</option>
            <option value="done" @if($task->status == 'done') selected @endif>Done</option>
        </select>

        <button type="submit" class="btn btn-success btn-sm">Save</button>
    </form>
</div>

        </div>
    </div>

</div>
@endsection
