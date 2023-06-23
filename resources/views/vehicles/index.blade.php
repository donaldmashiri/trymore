<x-app-layout>
    <div class="pagetitle">
        <h1>Vehicle Accidents</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Vehicle Accidents</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Vehicle Accidents</h5>

                        @include('partials.errors')

                        <div class="card">
                            <div class="card-body">

                                @if($vehicles->count() > 0)
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Accident Date</th>
                                            <th scope="col">vehicle Make</th>
                                            <th scope="col">Model</th>
                                            <th scope="col">Plate Number</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($vehicles as $vehicle)
                                            <tr>
                                                <td>{{$vehicle->id}}</td>
                                                <td>{{$vehicle->created_at}}</td>
                                                <td>{{$vehicle->make}}</td>
                                                <td>{{$vehicle->model}}</td>
                                                <td>{{$vehicle->plate_number}}</td>
                                                <td>{{$vehicle->description}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h1 class="text-center">No Accidents Recorded </h1>
                                @endif
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>

