@extends('layouts.app')

@section('title')
    Users
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
                        <h3 class="page-title">View Users</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">View Users</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="page-header flex-wrap">
                        <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                        </div>
                        @if (auth()->user()->role === 'Admin')
                        <div class="header-left">
                            <form action="{{ route('users.create') }}" method="GET" class="text-decoration-none"><button
                                    id="add-user-btn" class="btn btn-primary mb-2 mb-md-0 mr-2">Add new user</button></form>
                            {{-- <button class="btn btn-outline-primary bg-white mb-2 mb-md-0">Import documents</button> --}}
                        </div>
                        @endif
                    </div>
                    <!-- table row starts here -->
                    <div class="row">
                        <div class="col-xl-12 stretch-card grid-margin">
                            <div class="card p-4">
                                <div class="card-body px-0 py-2">
                                    <h4 class="card-title mb-0" style="font-size: 20px">Users</h4>
                                </div>
                                <div class="card-body p-0">
                                    @session('success')
                                        <div class="alert alert-success alert-dismissible fade show small" role="alert">
                                            {{ Session::get('success') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endsession
                                    <div class="table-responsive">
                                        <table id="users-table" class="table custom-table text-dark table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="px-6 py-3">
                                                        #
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">

                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Full Name
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Email
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Role
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Agent Code
                                                    </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            Action
                                                        </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Created at
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @for ($i = 0; $i < 10; $i++)
                                                    <tr>
                                                        <td>
                                                            {{ $i + 1 }}
                                                        </td>
                                                        <td>
                                                            <img src="plus-admin/images/faces/face2.jpg"
                                                                class="mr-2" alt="image" /> Firstname Lastname
                                                        </td>
                                                        <td>Admin</td>
                                                        <td>
                                                            <a href="{{ route('users.edit', ['user' => '1']) }}"
                                                                class="text-decoration-none">
                                                                <button
                                                                    class="btn btn-outline-primary bg-white mb-2 mb-md-0">Edit</button>
                                                            </a>
                                                            <button
                                                                class="btn btn-outline-primary bg-white mb-2 mb-md-0">Delete</button>
                                                        </td>
                                                        <td>
                                                            Feb 9, 2024 4:56 PM
                                                        </td>
                                                    </tr>
                                                @endfor --}}
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
    <script>
        var usersIndexRoute = "{{ route('users.index') }}";
        var usersCreateRoute = "{{ route('users.create') }}";
    </script>
    @vite(['resources/js/users/index.js'])
@endsection
