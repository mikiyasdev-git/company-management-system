<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Task Management</h3>

            <a href="{{ route('tasks.create') }}" class="btn btn-light">
                + Add Task
            </a>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Title</th>
                            <th>Project</th>
                            <th>Assigned To</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Deadline</th>
                            <th width="170">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>

                            <td>{{ $task->project->name }}</td>

                            <td>  {{ optional($task->user)->name ?? 'Not Assigned' }}</td>

                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ $task->status }}
                                </span>
                            </td>

                            <td>
                                <span class="badge bg-warning text-dark">
                                    {{ $task->priority }}
                                </span>
                            </td>

                            <td>{{ $task->deadline ?? 'No Deadline' }}</td>

                            <td>
                                <a href="{{ route('tasks.edit', $task->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

    <form action="{{ route('tasks.destroy',$task->id) }}"
      method="POST"
      class="d-inline">

    @csrf
    @method('DELETE')

    <button type="submit"
            class="btn btn-danger btn-sm"
            onclick="return confirm('Delete this task?')">

        Delete

    </button>

</form>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                No tasks available.
                            </td>
                        </tr>

                    @endforelse

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
