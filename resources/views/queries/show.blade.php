@extends('layouts.app')

@section('title')
    Query #{{ $query->id }}
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
                        <h3 class="page-title">Query Information</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('queries.index') }}">View Queries</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Query #{{ $query->id }}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="page-header flex-wrap">
                        <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                        </div>
                        <div class="header-left">
                            <a href="{{ route('queries.edit', ['query' => $query->id]) }}"
                                class="text-decoration-none"><button id="add-user-btn"
                                    class="btn btn-primary mb-2 mb-md-0 mr-2">Edit query</button></a>
                        </div>
                    </div>
                    <!-- table row starts here -->
                    <div class="row">
                        <div class="col-xl-12 stretch-card grid-margin">
                            <div class="card p-4">
                                <div class="card-body px-0 py-2">
                                    @session('success')
                                        <div class="alert alert-success alert-dismissible fade show small" role="alert">
                                            {{ Session::get('success') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endsession
                                    <h4 class="card-title mb-0" style="font-size: 20px">Query #{{ $query->id }}</h4>
                                    <div class="table-responsive">
                                        <table class="table table-hover lh-lg text-nowrap">
                                            <tbody>
                                                <tr>
                                                    <td class="font-weight-bold">Name</td>
                                                    <td>{{ $query->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Email</td>
                                                    <td>{{ $query->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Contact No.</td>
                                                    <td>{{ $query->contact_no }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Department</td>
                                                    <td>{{ $query->department }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Channel</td>
                                                    <td>{{ $query->channel }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Concern</td>
                                                    <td>{{ $query->concern }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Urgency</td>
                                                    <td>
                                                        <label class="badge
                                                            badge-{{ $query->urgency == 'low' ? 'success' :
                                                                     ($query->urgency == 'medium' ? 'warning' : 'danger') }}">
                                                            {{ ucfirst($query->urgency) }}
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Issue</td>
                                                    <td class="text-wrap">
                                                        {{ $query->issue }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Action Taken</td>
                                                    <td class="text-wrap">
                                                        {{ $query->action_taken }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Status</td>
                                                    <td>
                                                        <label
                                                            class="badge badge-{{ $query->status == 'Resolved' ? 'success' : 'warning' }}">{{ $query->status }}</label>
                                                    </td>
                                                </tr>
                                                {{-- <tr>
                                                    <td class="font-weight-bold">Handled by</td>
                                                    <td>
                                                        {{ $query->resolved_by }}
                                                    </td>
                                                </tr> --}}

                                                <tr>
                                                    <td class="font-weight-bold">Handled by</td>
                                                    <td>
                                                        {{ $query->handler->first_name ?? '' }} {{ $query->handler->last_name ?? '' }}
                                                    </td>
                                                </tr>



                                                <tr>
                                                    <td class="font-weight-bold">Ticket Number</td>
                                                    <td>
                                                        {{ $query->ticket_number }}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="font-weight-bold">Resolved at</td>
                                                    <td>
                                                        {{ $query->resolved_at?->format('M d, Y h:i A') }}
                                                    </td>
                                                </tr>
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
        var usersCreateRoute = "{{ route('users.create') }}";
    </script>
    @vite(['resources/js/users/index.js'])
@endsection
