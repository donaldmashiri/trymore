<x-app-layout>
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-light">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
{{--                                @php--}}
{{--                                    $currentMonth = \Carbon\Carbon::now()->format('F');--}}
{{--                                @endphp--}}
                                <div class="card-title"> Employeee:</div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">
                                        <strong>Fullname:</strong>
                                    </div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">
                                        <strong>Email:</strong>
                                    </div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->email }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">
                                        <strong>Department:</strong>
                                    </div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->role }}</div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="row mt-3 mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Search</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="search" class="form-control" placeholder="search by ID number..." required>
                                    </div>
                                    <button class="btn btn-primary col-sm-2">
                                        Find
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
