<x-app-layout>
    <div class="pagetitle">
        <h1 style="color: red">Wanted Criminals</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Wanted Persons</li>
          </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Wanted Persons</h5>
                      <div class="float-right" style="justify-content: right;">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                            <i class="bi bi-plus"></i>
                            New Persons
                        </button>
                      </div>
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">National</th>
                            <th scope="col">Fullname</th>
                            <th scope="col">National ID</th>
                            <th scope="col">Sex</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 0;
                            @endphp
                            @foreach ($employees as $employee)
                                <tr>
                                    <th scope="row">
                                        @php
                                            $count++;
                                            echo $count;
                                        @endphp
                                    </th>
                                    <td>{{$employee->ecnum}}</td>
                                    <td>{{$employee->fname}} {{$employee->lname}}</td>
                                    <td>{{$employee->natid}}</td>
                                    <td>{{$employee->sex}}</td>
                                    <td>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal{{$employee->id}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{$employee->id}}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editModal{{$employee->id}}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="{{route('admin-update-employee')}}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update {{$employee->fname}} {{$employee->lname}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="employee_id" value="{{$employee->id}}" required>
                                                    <div class="row mb-3">
                                                        <label for="inputText" class="col-sm-2 col-form-label">Firstname</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="fname" value="{{$employee->fname}}" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="inputText" class="col-sm-2 col-form-label">Surname</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="lname" value="{{$employee->lname}}" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="inputText" class="col-sm-2 col-form-label">Gender</label>
                                                        <div class="col-sm-10">
                                                            <select name="sex" class="form-control" required>
                                                                <option selected disabled>Select Gender</option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="inputText" class="col-sm-2 col-form-label">National ID</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="natid" value="{{$employee->natid}}" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="inputText" class="col-sm-2 col-form-label">Address</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="address" value="{{$employee->address}}" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div><!-- End update Modal-->
                                <div class="modal fade" id="deleteModal{{$employee->id}}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="{{route('admin-delete-employee')}}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Delete Area</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="employee_id" value="{{$employee->id}}" required>
                                                    <p style="color: red">Are you sure you want to delete {{$employee->fname}} {{$employee->lname}} from employees?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Yes Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div><!-- End Basic Modal-->
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="basicModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="POST" action="{{route('admin-add-employee')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Wanted Person</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Firstname</label>
                        <div class="col-sm-10">
                            <input type="text" name="fname" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Surname</label>
                        <div class="col-sm-10">
                            <input type="text" name="lname" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-10">
                            <select name="sex" class="form-control" required>
                                <option selected disabled>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">National ID</label>
                        <div class="col-sm-10">
                            <input type="text" name="natid" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Crime Reason</label>
                        <div class="col-sm-10">
                            <textarea name="address" id="" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="file" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
          </div>
        </div>
    </div>
</x-app-layout>

