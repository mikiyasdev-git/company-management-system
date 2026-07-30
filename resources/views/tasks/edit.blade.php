<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Edit Task</h3>
        </div>

        <div class="card-body">

            <form action="{{ route('tasks.update',$task->id) }}" method="POST">qcls
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@csrf
   @method('PUT')

                <!-- Project -->
                <div class="mb-3">
                    <label class="form-label">Project</label>

                    <select name="project_id" class="form-select">

                        @foreach($projects as $project)

                            <option value="{{ $project->id }}"
                                @if($task->project_id == $project->id)
                                    selected
                                @endif>

                                {{ $project->name }}

                            </option>

                        @endforeach

                    </select>
                </div>

                <!-- Assigned To -->
                <div class="mb-3">
                    <label class="form-label">Assigned To</label>

                    <select name="assigned_to" class="form-select">

                        <option value="">Not Assigned</option>

                        @foreach($users as $user)

                            <option value="{{ $user->id }}"
                                @if($task->assigned_to == $user->id)
                                    selected
                                @endif>

                                {{ $user->name }}

                            </option>

                        @endforeach

                    </select>
                </div>

                <!-- Title -->
                <div class="mb-3">
                    <label class="form-label">Title</label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="{{ $task->title }}">
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="form-label">Description</label>

                    <textarea
                        name="description"
                        rows="4"
                        class="form-control">{{ $task->description }}</textarea>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label class="form-label">Status</label>

                    <select name="status" class="form-select">

                        <option value="pending"
                            @if($task->status=='pending') selected @endif>
                            Pending
                        </option>

                        <option value="active"
                            @if($task->status=='active') selected @endif>
                            Active
                        </option>

                        <option value="completed"
                            @if($task->status=='completed') selected @endif>
                            Completed
                        </option>

                    </select>
                </div>

                <!-- Priority -->
                <div class="mb-3">
                    <label class="form-label">Priority</label>

                    <select name="priority" class="form-select">

                        <option value="low"
                            @if($task->priority=='low') selected @endif>
                            Low
                        </option>

                        <option value="medium"
                            @if($task->priority=='medium') selected @endif>
                            Medium
                        </option>

                        <option value="high"
                            @if($task->priority=='high') selected @endif>
                            High
                        </option>

                    </select>
                </div>

                <!-- Deadline -->
                <div class="mb-4">
                    <label class="form-label">Deadline</label>

                    <input
                        type="date"
                        name="deadline"
                        class="form-control"
                        value="{{ $task->deadline }}">
                </div>

                <!-- Buttons -->
                <div class="d-flex gap-2">

                    <button type="submit" class="btn btn-primary">
                        Update Task
                    </button>

                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
