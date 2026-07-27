<!DOCTYPE html>
<html>
  <head>
    <title>Student Registration Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <div class="container mt-4">

      <h1 class="header1" id="header1">Student Registration Form</h1>

      @if(session('success'))
      <h3 style="color:green;">
        {{ session('success') }}
      </h3>
      @endif

      <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"> -->
        <!-- Add New Student -->
      <!-- </button> -->
      <button type="button" class="btn {{ isset($student) ? 'btn-warning' : 'btn-primary' }}"
    data-bs-toggle="modal" data-bs-target="#myModal">
    {{ isset($student) ? 'Edit Student' : 'Add New Student' }}
  </button>
      <!-- MODAL -->
      <div class="modal" id="myModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">

            @if(isset($student))
            <form action="{{ url('/update/'. $student->id) }}" method="POST">
              @method('PUT')
            @else
            <form action="{{ url('/insertRecords/') }}" method="POST">
            @endif
              @csrf

              <div class="modal-header">
                <h5 class="modal-title">
                  {{ isset($student) ? 'Edit Student' : 'Add New Student' }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <div class="modal-body">
                <input class="form-control mb-3" type="text" name="firstname" placeholder="First name"
                  value="{{ $student->firstname ?? '' }}">

                <input class="form-control mb-3" type="text" name="lastname" placeholder="Last name"
                  value="{{ $student->lastname ?? '' }}">

                <input class="form-control mb-3" type="text" name="username" placeholder="Username"
                  value="{{ $student->username ?? '' }}">

                <input class="form-control mb-3" type="email" name="email" placeholder="Email"
                  value="{{ $student->email ?? '' }}">

                <input class="form-control mb-3" type="password" name="password" placeholder="Password"
                  value="{{ $student->password ?? '' }}">
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                @if(isset($student))
                <button type="submit" class="btn btn-warning">Update</button>
                @else
                <button type="submit" class="btn btn-primary">Save</button>
                @endif
              </div>

            </form>

          </div>
        </div>
      </div>
      <!-- END MODAL -->
    <h2>Student List</h2>
    <table class="table table-striped table-responsive table-sm">
    <tr>
      <th>ID</th>
      <th>First name</th>
      <th>Last name</th>
      <th>Username</th>
      <th>Email</th>
      
      <th>Action</th>
  </tr>
  @foreach($students as $row)
  <tr>
    <td>{{ $row->id}}</td>
    <td>{{ $row->firstname}}</td>
    <td>{{ $row->lastname}}</td>
    <td>{{ $row->username}}</td>
    <td>{{ $row->email}}</td>
    
    <td>
      <a href="{{url('/edit/' .$row->id)}}" class="text-warning"onclick="return confirm('Are you sure you want to edit this student?')">Edit</a>
      |
      <a href="{{url('/delete/' .$row->id)}}" class="text-danger" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
    </td>
  </tr>
  @endforeach

    </table>
  </body>
</html>
