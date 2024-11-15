@extends('layouts.app')

@section('title')
    Export Queries
@endsection

@section('content')
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('layouts.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper w-100">
            <!-- partial:partials/_navbar.html -->
            @include('layouts.navbar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper min-vh-100">
                    <div class="page-header">
                        <h3 class="page-title">Export Queries</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('queries.index') }}">View Queries</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Export Queries</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-md-5 grid-margin stretch-card mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    @session('success')
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ Session::get('success') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endsession
                                    <h4 class="card-title mb-4">Filter Queries Form</h4>
                                    <form action="{{ route('queries.export') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="start-date-input">Start at</label>
                                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start-date-input"
                                                        name="start_date" />
                                                    @error('start_date')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="end-date-input">End at</label>
                                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                                        id="end-date-input" name="end_date" />
                                                    @error('end_date')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                          </div>
                                        {{-- <div class="form-group">
                                            <label for="branches-input">Branches</label>
                                            <input type="text" class="form-control @error('branches') is-invalid @enderror"
                                                name="branches" id="branches-input" />
                                            @error('branches')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="departments-input">Departments</label>
                                            <input type="text"
                                                class="form-control @error('departments') is-invalid @enderror"
                                                name="departments" id="departments-input" />
                                            @error('departments')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="channels-input">Channels</label>
                                            <input type="text"
                                                class="form-control @error('channels') is-invalid @enderror" name="channels"
                                                id="channels-input" />
                                            @error('channels')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="concerns-input">Concerns</label>
                                            <input type="text"
                                                class="form-control @error('concerns') is-invalid @enderror" name="concerns"
                                                id="concerns-input" />
                                            @error('concerns')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2 float-right"> Download Excel File </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
@endsection

@section('scripts')
    <script>
        var branches = @json($branches);
        var departments = @json($departments);
        var channels = @json($channels);
        var concerns = @json($concerns);
    </script>

    @vite(['resources/js/queries/filter.js'])
@endsection
