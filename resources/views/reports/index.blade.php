@extends('layouts.app')

@section('content')

<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Reports</h2>
        <a href="{{ route('reports.create') }}" class="btn btn-primary">
            + Add Report
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>User</th>
                    <th>Project</th>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Files</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($reports as $report)
                    <tr>
                        <td>{{ $report->title }}</td>
                        <td>{{ $report->user->name }}</td>
                        <td>{{ $report->project?->name ?? 'No Project' }}</td>
                        <td>{{ $report->task?->title ?? 'No Task' }}</td>
                        <td>
                            @php
                                $badgeClass = match($report->status) {
                                    'approved' => 'bg-success',
                                    'submitted' => 'bg-warning text-dark',
                                    'rejected' => 'bg-danger',
                                    default => 'bg-secondary', // draft
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}">
                                {{ ucfirst($report->status) }}
                            </span>

                            @if ($report->status === 'rejected' && $report->rejection_reason)
                                <div class="small text-danger mt-1">
                                    Reason: {{ $report->rejection_reason }}
                                </div>
                            @endif

                            @if ($report->status === 'approved' && $report->approvedBy)
                                <div class="small text-muted mt-1">
                                    Approved by {{ $report->approvedBy->name }}
                                </div>
                            @endif
                        </td>
                        <td>{{ $report->report_date }}</td>
                        <td>
                            @if ($report->files->count())
                                @foreach ($report->files as $file)
                                    <a href="{{ route('report-files.download', $file->id) }}" class="d-block">
                                        📎 {{ $file->original_name }}
                                    </a>
                                @endforeach
                            @else
                                <span class="text-muted">No files</span>
                            @endif
                        </td>
                        <td>
                            @if (auth()->user()->hasPermission('approve_reports') && $report->status === 'submitted')
                                <form action="{{ route('reports.approve', $report->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    <button class="btn btn-success btn-sm" onclick="return confirm('Approve this report?')">
                                        Approve
                                    </button>
                                </form>

                                <button type="button" class="btn btn-outline-danger btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#rejectModal{{ $report->id }}">
                                    Reject
                                </button>

                                <div class="modal fade" id="rejectModal{{ $report->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('reports.reject', $report->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Reject Report</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <label class="form-label">Reason for rejection</label>
                                                    <textarea name="rejection_reason" class="form-control" rows="3" required></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Reject</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($report->user_id === auth()->id() || auth()->user()->hasPermission('edit_reports'))
                                @if (auth()->user()->isManagerOrAbove() || in_array($report->status, ['draft', 'rejected']))
                                    <a href="{{ route('reports.edit', $report->id) }}" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                @endif
                            @endif

                            @if ($report->user_id === auth()->id() || auth()->user()->hasPermission('delete_reports'))
                                <form action="{{ route('reports.destroy', $report->id) }}"
                                      method="POST"
                                      style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete this report?')">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">
                            No reports found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
