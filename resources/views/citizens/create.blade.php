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
                                @if ($find)
                                    <h2>Details</h2>
                                    <p>First Name: {{ $find->fname }}</p>
                                    <p>Last Name: {{ $find->lname }}</p>
                                    <p>Sex: {{ $find->sex }}</p>
                                    <p>National ID: {{ $find->natid }}</p>
                                    <p>Crime: {{ $find->crime }}</p>
                                @else
                                    <p>Image not available</p>
                                @endif

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>

