@extends('layouts.app')

@section('content')
<h1>Edit Project</h1>

@if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('projects.update', $project->id) }}" method="POST" class="card card-body shadow-sm mt-3">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $project->name) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description', $project->description) }}</textarea>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Start Date</label>
            <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $project->start_date) }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">End Date</label>
            <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $project->end_date) }}">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Assign To</label>
        <select name="user_id" class="form-select" required>
            <option value="">-- Select Employee --</option>
            @foreach ($employees as $employee)
                <option value="{{ $employee->id }}"
                    {{ old('user_id', $project->user_id) == $employee->id ? 'selected' : '' }}>
                    {{ $employee->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
            <option value="pending" {{ old('status', $project->status) == 'pending' ? 'selected' : '' }}>
                Pending
            </option>
            <option value="active" {{ old('status', $project->status) == 'active' ? 'selected' : '' }}>
                Active
            </option>
            <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>
                Completed
            </option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">
        Update Project
    </button>
</form>

@endsection
