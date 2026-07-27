@extends('layouts.app')

@section('content')
<h1>Welcome to Liqawunt Dashboard</h1>
<div class="row">


<div class="col-md-3">

<div class="card shadow">

<div class="card-body">
<a href="{{route('users.index')}}">
<h5>
Users
</h5>
</a>
<h2>
{{$totalUsers}}
</h2>


</div>

</div>

</div>



<div class="col-md-3">

<div class="card shadow">

<div class="card-body">
<a href="{{route('projects.index')}}">
<h5>
Projects
</h5>
</a>
<h2>
{{$totalProjects}}
</h2>


</div>

</div>

</div>



<div class="col-md-3">

<div class="card shadow">

<div class="card-body">
<a href="{{route('tasks.index')}}">
<h5>
Tasks
</h5>
</a>
<h2>
{{$totalTasks}}
</h2>


</div>

</div>

</div>


<div class="col-md-3">

<div class="card shadow">

<div class="card-body">
<a href="{{route('reports.index')}}">
<h5>
Reports
</h5>
</a>
<h2>
{{$totalReports}}
</h2>


</div>

</div>

</div>


</div>
<h3 class="mt-5">
Quick Actions
</h3>

<div class="d-flex flex-wrap gap-2">

    <a href="#" class="btn btn-primary">
        Create Project
    </a>

    <a href="#" class="btn btn-success">
        Add User
    </a>

    <a href="#" class="btn btn-warning">
        View Reports
    </a>

</div>


@endsection
