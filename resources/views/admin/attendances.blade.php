<x-app-layout>
    <div class="pagetitle">
        <h1>Detect Wanted Persons</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Detect Wanted Persons</li>
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
                      <h5 class="card-title">Detect Wanted Persons</h5>
                      <div class="float-right" style="justify-content: right;">
                        <button type="button" class="btn btn-dark m-2" style="float: right;" data-bs-toggle="modal" data-bs-target="#basicModal3">
                            <i class="bi bi-book-half"></i>
                            Report
                        </button>
                        <button type="button" class="btn btn-danger m-2" style="float: right;" data-bs-toggle="modal" data-bs-target="#basicModal2">
                            <i class="bi bi-box-arrow-left"></i>
                            Detect Face out
                        </button>
                        <button type="button" class="btn btn-success m-2" style="float: right;" data-bs-toggle="modal" data-bs-target="#basicModal1">
                            <i class="bi bi-box-arrow-in-right"></i>
                            Detect Face In
                        </button>
                      </div>
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">National ID</th>
                            <th scope="col">Fullname</th>
                            <th scope="col">Date</th>
                            <th scope="col">Result after Detection</th>
                            <th scope="col">Checking status</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 0;
                            @endphp
                            @foreach ($attendances as $att)
                                <tr>
                                    <th scope="row">
                                        @php
                                            $emp = \App\Models\Employee::find($att->employee_id);
                                            $count++;
                                            echo $count;
                                        @endphp
                                    </th>
                                    <td>{{$emp->ecnum}}</td>
                                    <td>{{$emp->fname}} {{$emp->lname}}</td>
                                    <td>{{$att->date}}</td>
                                    <td>
                                        {{$att->time_in}}
                                    @if($att->time_in != null)
                                        Detected.
                                    @endif
                                    </td>
                                    <td>{{$att->time_out}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="basicModal1" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="POST" action="{{route('admin-check-in')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Detect Criminal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to Detect a face?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes continue</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    <div class="modal fade" id="basicModal2" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="POST" action="{{route('admin-check-out')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Check Out Recording</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to start recording check out time?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes continue</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    <div class="modal fade" id="basicModal3" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="POST" action="{{route('admin-attendance-report')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Attendance Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">From</label>
                        <div class="col-sm-10">
                            <input type="date" name="from" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">To</label>
                        <div class="col-sm-10">
                            <input type="date" name="to" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Generate report</button>
                </div>
            </form>
          </div>
        </div>
    </div>
</x-app-layout>

