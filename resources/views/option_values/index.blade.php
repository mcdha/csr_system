@extends('layouts.app')

@section('title')
    Edit Query Option Values
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
                        <h3 class="page-title">Edit Query Option Values</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('queries.index') }}">View Queries</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Option Values</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-md-5 grid-margin stretch-card mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    @session('success')
                                        <div class="alert alert-success alert-dismissible fade show small" role="alert">
                                            {{ Session::get('success') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endsession
                                    <h4 class="card-title mb-4">Option values form</h4>
                                    <form
                                        action="{{ route('option-values.update', ['option_value' => $option_value->id]) }}"
                                        method="POST" enctype="multipart/form-data" class="forms-sample">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="table" value="queries">
                                        <div class="form-group">
                                            <label for="field-input">Field <span
                                                    class="text-danger font-weight-bold">*</span></label>
                                            <select class="form-control @error('field') is-invalid @enderror"
                                                id="field-input" name="field">
                                                {{-- <option value="branch" @if ($field == 'branch') selected @endif>
                                                    Branch</option> --}}
                                                <option value="department"
                                                    @if ($field == 'department') selected @endif>Department</option>
                                                <option value="channel" @if ($field == 'channel') selected @endif>
                                                    Channel</option>
                                                <option value="concern" @if ($field == 'concern') selected @endif>
                                                    Concern</option>
                                            </select>
                                            @error('field')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="values-input">Values <span
                                                    class="text-danger font-weight-bold">*</span></label>
                                            <input type="text" class="form-control @error('values') is-invalid @enderror" name="values" id="values-input" />
                                            @error('values')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary mr-2"> Submit </button>
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
        var optionValues = @json($option_value->values);
        var queriesOptionValues = "{{ route('option-values.index', ['field' => ':field']) }}";
    </script>

    @vite(['resources/js/option_values/index.js'])
@endsection
