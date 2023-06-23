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
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Detect Wanted Persons</h5>

                        @include('partials.errors')

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Wanted Persons</h5>
                                <div class="float-right" style="justify-content: right;">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#criminals">
                                        <i class="bi bi-plus"></i>
                                        New Persons
                                    </button>
                                </div>

                                @if($criminals->count() > 0)
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">National ID</th>
                                            <th scope="col">Fullname</th>
                                            <th scope="col">Sex</th>
                                            <th scope="col">Crime</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($criminals as $criminal)
                                            <tr>
                                                <td>{{$criminal->id}}</td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $criminal->image) }}" alt="Criminal Image" width="100" height="60">
                                                </td>
                                                <td>{{$criminal->natid}}</td>
                                                <td>{{$criminal->fname}} {{$criminal->lname}}</td>
                                                <td> {{$criminal->sex}} </td>

                                                <td> {{$criminal->crime}} </td>
                                                <td> {{$criminal->created_at}} </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h1 class="text-center">No Criminal Added</h1>
                                @endif
                            </div>
                        </div>



                        <div class="modal fade" id="criminals" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="{{route('criminals.store')}}" enctype="multipart/form-data">
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
                                                    <textarea name="crime" id="" class="form-control" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputText" class="col-sm-2 col-form-label">Image</label>
                                                <div class="col-sm-10">
                                                    <input type="file" name="image" class="form-control" required>
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

                    </div>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>

