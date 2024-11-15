@extends('layouts.app')

@section('title')
    Import Queries
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
                        <h3 class="page-title">Import Queries</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('queries.index') }}">View Queries</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Import Queries</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-md-8 grid-margin stretch-card mx-auto">
                            <div class="card">
                                <div class="card-body small">
                                    <h4 class="card-title mb-4">Query form</h4>
                                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                        <b>Note: The excel file's first row or headers should include something like the
                                            following, it is important to note that the columns can be in any order, allowing
                                            for a more flexible import process.
                                        </b><br><br>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-sm small" style="backgroud-color: blue;">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="font-weight-bold">Name</th>
                                                        <th scope="col" class="font-weight-bold">Is Member</th>
                                                        <th scope="col" class="font-weight-bold">Branch</th>
                                                        <th scope="col" class="font-weight-bold">Department</th>
                                                        <th scope="col" class="font-weight-bold">Channel</th>
                                                        <th scope="col" class="font-weight-bold">Concern</th>
                                                        <th scope="col" class="font-weight-bold">Issue</th>
                                                        <th scope="col" class="font-weight-bold">Action Taken</th>
                                                        <th scope="col" class="font-weight-bold">Status</th>
                                                        <th scope="col" class="font-weight-bold">Remarks</th>
                                                        <th scope="col" class="font-weight-bold">Resolved By</th>
                                                        <th scope="col" class="font-weight-bold">Resolved At</th>
                                                        <th scope="col" class="font-weight-bold">Created At</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td scope="col" class="text-wrap">Lorem Ipsum</td>
                                                        <td scope="col" class="text-wrap">Yes</td>
                                                        <td scope="col" class="text-wrap">AAP Main</td>
                                                        <td scope="col" class="text-wrap">Membership</td>
                                                        <td scope="col" class="text-wrap">Chat</td>
                                                        <td scope="col" class="text-wrap">ERS inquiry</td>
                                                        <td scope="col" class="text-wrap">Customer is for reinstatement. Inquired if she can enroll 3 vehicles</td>
                                                        <td scope="col" class="text-wrap">Membership email address was forwarded to the customer</td>
                                                        <td scope="col" class="text-wrap">Resolved</td>
                                                        <td scope="col" class="text-wrap">A staff from Fairview terraces promptly addressed his issues</td>
                                                        <td scope="col" class="text-wrap">Lorem & Ipsum</td>
                                                        <td scope="col" class="text-wrap">2024-03-24</td>
                                                        <td scope="col" class="text-wrap">2024-03-25</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <br>
                                        Optional columns are <b>Issue</b>, <b>Action Taken</b>, <b>Remarks</b>, <b>Resolved By</b> and <b>Resolved At</b>.<br><br>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('queries.import') }}" method="POST"
                                        enctype="multipart/form-data" class="forms-sample">
                                        @csrf
                                        <div class="form-group">
                                            <label>Excel File </label>
                                            <input type="file" name="excel_file" class="file-upload-default">
                                            <div class="input-group col-xs-12">
                                                <input type="text" class="form-control file-upload-info" disabled=""
                                                    placeholder="Excel File">
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-primary" type="button">
                                                        Upload </button>
                                                </span>
                                            </div>
                                            @error('excel_file')
                                                <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                                                    {{ $message }}
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
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
    @vite(['resources/js/users/create.js'])
@endsection
