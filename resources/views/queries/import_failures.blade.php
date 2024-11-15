@extends('layouts.app')

@section('title')
    Query Import Failures
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
                <div class="content-wrapper pb-0 min-vh-100">
                    <div class="page-header mb-0">
                        <h3 class="page-title">View Queries Import Failures</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('queries.index') }}">View Queries</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('queries.upload') }}">Import Queries</a></li>
                                <li class="breadcrumb-item active" aria-current="page">View Queries Import Failures</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="page-header flex-wrap">
                    </div>
                    <!-- table row starts here -->
                    <div class="row">
                        <div class="col-xl-12 stretch-card grid-margin">
                            <div class="card p-4">
                                <div class="card-body px-0 py-2">
                                    <h4 class="card-title mb-0" style="font-size: 20px">Queries</h4>
                                </div>
                                <div class="card-body p-0">
                                    @if ($success_count > 0)
                                    <div class="alert alert-primary alert-dismissible fade show small" role="alert">
                                        There were {{ $success_count }} records imported successfully, but a number of rows failed.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif
                                    <div class="table-responsive">
                                        <table id="queries-table" class="table custom-table text-dark table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Row #</th>
                                                    <th>Full Name</th>
                                                    <th>Is Member</th>
                                                    <th>Branch</th>
                                                    <th>Department</th>
                                                    <th>Concern</th>
                                                    <th>Status</th>
                                                    <th>Date & Time</th>
                                                    <th>Errors</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($failures as $failure)
                                                    <tr>
                                                        <td>{{ $failure->row }}</td>
                                                        <td>{{ $failure->values->name }}</td>
                                                        <td>{{ $failure->values->is_member }}</td>
                                                        <td>{{ $failure->values->branch }}</td>
                                                        <td>{{ $failure->values->department }}</td>
                                                        <td>{{ $failure->values->concern }}</td>
                                                        <td>{{ $failure->values->status }}</td>
                                                        <td>{{ $failure->values->created_at }}</td>
                                                        <td class="text-danger">
                                                            {{ str_replace('_', ' ', $failure->errors[0]) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                {{-- @include('layouts.footer') --}}
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
@endsection

@section('scripts')
    {{-- <script>
        var usersCreateRoute = "{{ route('users.create') }}";
        var indexQueryRoute = "{{ route('queries.index') }}";
    </script>
    @vite(['resources/js/queries/index.js']) --}}
@endsection
