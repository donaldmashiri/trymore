<x-app-layout>
    <div class="pagetitle">
        <h1>Citizens / Business</h1>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Citizens Platform</h5>

                        @include('partials.errors')

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Find If the Persons is Wanted </h5>
                                <form method="POST" action="{{route('citizens.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <label for="inputText" class="col-sm-2 col-form-label">Image</label>
                                            <input type="file" name="image" class="form-control" required>
                                            <div class="modal-footer mt-3">
                                                <button type="submit" class="btn btn-primary">Find</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="modal fade" id="criminals" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="{{route('criminals.store')}}" enctype="multipart/form-data">
                                        @csrf
                                            <div class="row mb-3">
                                                <label for="inputText" class="col-sm-2 col-form-label">Image</label>
                                                <div class="col-sm-10">
                                                    <input type="file" name="image" class="form-control" required>
                                                </div>
                                            </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Find</button>
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

