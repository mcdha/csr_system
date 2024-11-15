@extends('layouts.app')

@section('title')
    Queries
@endsection

@section('content')
    <div class="container-scroller">
        @include('layouts.sidebar')
        <div class="container-fluid page-body-wrapper w-100">
            @include('layouts.navbar')
            <div class="main-panel">
                <div class="content-wrapper pb-0 min-vh-100">
                    <!-- Header Section -->
                    <div class="page-header mb-0">
                        <h3 class="page-title">View Queries</h3>
                        <nav aria-label="breadcrumb" style="margin-right: 15rem">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">View Queries</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="page-header flex-wrap" style="margin-right: 15rem">
                        <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                        </div>
                        <div class="header-left">

                            <a href="{{ route('queries.create') }}" class="btn btn-primary mb-2 mb-md-0 mr-2">Add new
                                query</a>
                            {{-- <a href="{{ route('queries.upload') }}" class="btn btn-primary mb-2 mb-md-0 mr-2">Import</a>
                            <a href="{{ route('queries.filter') }}" class="btn btn-primary mb-2 mb-md-0 mr-2">Export</a> --}}
                            <a href="{{ route('option-values.index', ['field' => 'branch']) }}"
                                class="btn btn-primary mb-2 mb-md-0 mr-2">Edit option values</a>
                        </div>
                    </div>
                    <!-- Table Section -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card" style="width: 100%">
                                <div class="card-body" style="width: 85%">
                                    <h4 class="card-title mb-4">Queries</h4>

                                    @session('success')
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ Session::get('success') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endsession

                                    <div class="table-responsive" >
                                        <table id="queries-table" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    {{-- <th>#</th> --}}
                                                    <th>Full Name</th>
                                                    <th>Contact No.</th>
                                                    <th>Email</th>
                                                    <th>Department</th>
                                                    <th>Concern</th>
                                                    <th>Urgency</th>
                                                    <th>Status</th>
                                                    <th>Ticket No.</th>
                                                    <th>Action</th>
                                                    <th>Created At</th>
                                                    <th>Resolved At</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for ($i = 0; $i < 10; $i++)
                                                    <tr>
                                                        {{-- <td>{{ $i + 1 }}</td> --}}
                                                        <td>Firstname Lastname</td>
                                                        <td>09453854660</td>
                                                        <td>test@gmail.com</td>
                                                        <td>Membership</td>
                                                        <td>ERS inquiry</td>
                                                        <td>High</td>
                                                        <td>
                                                            <select class="form-select form-select-sm">
                                                                <option>Pending</option>
                                                                <option>Resolved</option>
                                                            </select>
                                                        </td>
                                                        <td>K101202415</td>
                                                        <td>
                                                            <div class="d-flex gap-1">
                                                                <a href="{{ route('queries.show', ['query' => '1']) }}"
                                                                    class="btn btn-sm btn-outline-primary">View</a>
                                                                <a href="{{ route('queries.edit', ['query' => '1']) }}"
                                                                    class="btn btn-sm btn-outline-primary">Edit</a>
                                                                <button
                                                                    class="btn btn-sm btn-outline-danger">Delete</button>
                                                            </div>
                                                        </td>
                                                        <td>Nov, 2024 4:56 PM</td>
                                                        <td>Nov, 2024 4:56 PM</td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        var usersCreateRoute = "{{ route('users.create') }}";
        var indexQueryRoute = "{{ route('queries.index') }}";
    </script>

    @vite(['resources/js/queries/index.js'])
@endsection
