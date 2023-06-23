<x-app-layout>
    <div class="pagetitle">
        <h1>Vehicle Accidents</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Record Vehicle Accidents</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Record Vehicle Accidents</h5>

                        @include('partials.errors')

                        <div class="card">
                            <div class="card-body">

                                <form method="POST" action="{{route('vehicles.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <div class="col-sm-10">
                                                <label for="inputText" class="col-sm-2 col-form-label">Vehicle Make</label>
                                                <input type="text" name="make" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-10">
                                                <label for="inputText" class="col-sm-2 col-form-label">Vehicle Model</label>
                                                <input type="text" name="model" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-10">
                                                <label for="inputText" class="col-sm-2 col-form-label">Plate Number</label>
                                                <input type="text" name="plate_number" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-10">
                                                <label for="inputText" class="col-sm-2 col-form-label">Accident Image</label>
                                                <input type="file" name="image" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-10">
                                                <label for="inputText" class="col-sm-2 col-form-label">Description of Accident</label>
                                                <textarea name="description" id="" class="form-control"  cols="5" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-6">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>

