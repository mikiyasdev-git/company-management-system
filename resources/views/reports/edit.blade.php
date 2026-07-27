@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Edit Report</h2>
{{-- if there is an error to show that error in the page we need this code otherwise we can't know what is the problem is--}}
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card card-body shadow-sm">

        <form action="{{ route('reports.update', $report->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">User</label>
                <select name="user_id" class="form-select">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}"
                            @if($report->user_id == $user->id) selected @endif>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Project</label>
                <select name="project_id" class="form-select">
                    <option value="">No Project</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}"
                            @if($report->project_id == $project->id) selected @endif>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Task</label>
                <select name="task_id" class="form-select">
                    <option value="">No Task</option>
                    @foreach($tasks as $task)
                        <option value="{{ $task->id }}"
                            @if($report->task_id == $task->id) selected @endif>
                            {{ $task->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $report->title }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4">{{ $report->description }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Report Date</label>
                <input type="date" name="report_date" class="form-control" value="{{ $report->report_date }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="draft" @if($report->status == 'draft') selected @endif>Draft</option>
                    <option value="submitted" @if($report->status == 'submitted') selected @endif>Submitted</option>
                    <option value="approved" @if($report->status == 'approved') selected @endif>Approved</option>
                    <option value="rejected" @if($report->status == 'rejected') selected @endif>Rejected</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Report</button>

        </form>

    </div>

</div>
@endsection
