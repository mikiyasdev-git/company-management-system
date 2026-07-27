@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- Welcome --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Welcome, {{ Auth::user()->name }}</h2>
            <p class="text-muted">Employee Dashboard</p>
        </div>

        <a href="{{ route('reports.create') }}" class="btn btn-success">
            + Create Report
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    {{-- Statistics --}}
    <div class="row">

        <div class="col-md-3 mb-3">

            <div class="card border-0 shadow">

                <div class="card-body">

                    <h6 class="text-muted">
                        My Projects
                    </h6>

                    <h2>{{ $myProjects }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card border-0 shadow">

                <div class="card-body">

                    <h6 class="text-muted">
                        Assigned Tasks
                    </h6>

                    <h2>{{ $myTasks }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card border-0 shadow">

                <div class="card-body">

                    <h6 class="text-muted">
                        My Reports
                    </h6>

                    <h2>{{ $myReports }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card border-0 shadow">

                <div class="card-body">

                    <h6 class="text-muted">
                        Completion
                    </h6>

                    <h2>{{ $taskCompletionRate }}%</h2>

                    <div class="progress mt-3">

                        <div class="progress-bar bg-success"
                            style="width: {{ $taskCompletionRate }}%">
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- Assigned Tasks --}}
    <div class="card shadow mt-4">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">
                Assigned Tasks
            </h5>

        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead>

                <tr>

                    <th>Title</th>

                    <th>Project</th>

                    <th>Status</th>

                    <th>Deadline</th>

                    <th>Action</th>

                </tr>

                </thead>

                <tbody>

                @forelse($assignedTasks as $task)

                    <tr>

                        <td>{{ $task->title }}</td>

                        <td>
                            {{ optional($task->project)->name }}
                        </td>

                        <td>

                            @if($task->status=="Pending")

                                <span class="badge bg-warning">
                                    Pending
                                </span>

                            @elseif($task->status=="In Progress")

                                <span class="badge bg-info">
                                    In Progress
                                </span>

                            @else

                                <span class="badge bg-success">
                                    Completed
                                </span>

                            @endif

                        </td>

                        <td>

                            {{ $task->deadline }}

                        </td>

                        <td>

                            <a href="{{ route('tasks.show',$task->id) }}"
                               class="btn btn-sm btn-primary">

                                View

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center">

                            No assigned tasks.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>



    {{-- My Reports --}}
    <div class="card shadow mt-4">

        <div class="card-header bg-success text-white">

            <div class="d-flex justify-content-between">

                <h5 class="mb-0">

                    My Reports

                </h5>

                <a href="{{ route('reports.index') }}"
                   class="btn btn-light btn-sm">

                    View All

                </a>

            </div>

        </div>

        <div class="card-body">

            <table class="table table-striped">

                <thead>

                <tr>

                    <th>Title</th>

                    <th>Status</th>

                    <th>Date</th>

                    <th>Action</th>

                </tr>

                </thead>

                <tbody>

                @forelse($myReportsList as $report)

                    <tr>

                        <td>{{ $report->title }}</td>

                        <td>

                            @if($report->status=="draft")

                                <span class="badge bg-warning">
                                    Draft
                                </span>

                            @else

                                <span class="badge bg-success">
                                    Submitted
                                </span>

                            @endif

                        </td>

                        <td>

                            {{ $report->report_date }}

                        </td>

                        <td>

                            @if($report->status=="draft")

                                <a href="{{ route('reports.edit',$report->id) }}"
                                   class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                            @else

                                <a href="{{ route('reports.show',$report->id) }}"
                                   class="btn btn-secondary btn-sm">

                                    View

                                </a>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4"
                            class="text-center">

                            No reports found.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>



    {{-- Recent Activities --}}
    <div class="card shadow mt-4">

        {{-- Recent Activities --}}
<div class="card shadow mt-4">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            Recent Activities
        </h5>

        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addActivityModal">
            + Add Activity
        </button>

    </div>

    <div class="card-body">

        <ul class="list-group">

            @forelse($recentActivities as $activity)

                <li class="list-group-item">

                    <strong>
                        {{ $activity->title }}
                    </strong>

                    <br>

                    {{ $activity->description }}

                    <br>

                    <small class="text-muted">
                        {{ $activity->activity_date }}
                    </small>

                </li>

            @empty

                <li class="list-group-item">
                    No activities yet.
                </li>

            @endforelse

        </ul>

    </div>

</div>

{{-- Add Activity Modal --}}
<div class="modal fade" id="addActivityModal" tabindex="-1" aria-labelledby="addActivityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('activities.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="addActivityModalLabel">Add Activity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="activity_date" class="form-control" value="{{ old('activity_date', date('Y-m-d')) }}" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Activity</button>
                </div>

            </form>

        </div>
    </div>
</div>

    </div>

</div>

@endsection


