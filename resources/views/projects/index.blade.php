@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>Projects</h2>

        <a href="{{ route('projects.create') }}"
           class="btn btn-primary">

            + Add Project

        </a>

    </div>


    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif
  <div class="card shadow">
      <div class="card-body">
        <table class="table table-bordered table-striped">
           <thead class="table-dark">
              <tr>
                 <th>ID</th>
                 <th>Name</th>
                  <th>Status</th>
                  <th>Created</th>
                  <th>Actions</th>
             </tr>
            </thead>
     <tbody>
        @foreach($projects as $project)
          <tr>
            <td> {{ $project->id }} </td>
            <td> {{ $project->name }} </td>
            <td> @if($project->status == 'active')
                <span class="badge bg-success">Active</span>
                    @elseif($project->status == 'completed')
                 <span class="badge bg-primary"> Completed </span>
                    @else
                <span class="badge bg-warning">Pending</span>

                  @endif
            </td>

            <td>{{ $project->created_at ? $project->created_at->format('d M Y') : 'N/A' }}</td>
            <td><a href="{{ route('projects.edit',$project->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('projects.destroy',$project->id) }}"
                                  method="POST" style="display:inline">
                 @csrf
                @method('DELETE')
        <button class="btn btn-sm btn-danger">Delete</button>

                 </form>
             </td>

         </tr>

        @endforeach

       </tbody>

    </table>

    </div>

   </div>

</div>


@endsection
