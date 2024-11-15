@php
    $date_range = $start_date != $end_date ? ($start_date->format('F j, Y') . ' - ' . $end_date->format('F j, Y')) : $start_date->format('F j, Y');
@endphp

@extends('layouts.app')

@section('title')
    Dashboard
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
                <div class="content-wrapper pb-0">
                    @session('success')
                    <div class="alert alert-success alert-dismissible fade show small" role="alert">
                        {{ Session::get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endsession
                    <div class="page-header mb-0">
                        <h3 class="page-title">Dashboard</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="page-header flex-wrap">
                        <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                            <p class="h4 font-weight-normal">
                                {{ $date_range }}</p>
                        </div>
                        <div class="header-left">
                            <a href="{{ route('dashboard.filter') }}"><button id="add-user-btn" class="btn btn-primary mb-2 mb-md-0 mr-2">Filter Dashboard</button></a>
                        </div>
                    </div>
                    <!-- table row starts here -->
                    <div class="row">
                        <div class="col-xl-4 grid-margin">
                            <div class="card card-stat stretch-card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="text-white">
                                            <h3 class="font-weight-bold mb-0">{{ $total_queries }} Queries</h3>
                                            <h6>From {{ $date_range }}</h6>
                                            {{-- <div class="badge badge-warning"
                                                style="background-color: #0033c4 !important; border-color: #0033c4 !important;">
                                                +23%</div> --}}
                                        </div>
                                        <div class="flot-bar-wrapper">
                                            <div id="column-chart" class="flot-chart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card stretch-card mb-3">
                                <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                                    <div>
                                        <h4 class="font-weight-semibold mb-1 text-black"> Pending Queries </h4>
                                        <h6 class="text-muted">From
                                            {{ $date_range }}</h6>
                                    </div>
                                    <h3 class="text-success font-weight-bold">+{{ $pending_queries_count }}</h3>
                                </div>
                            </div>
                            <div class="card stretch-card mb-3">
                                <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                                    <div>
                                        <h4 class="font-weight-semibold mb-1 text-black"> Resolved Queries </h4>
                                        <h6 class="text-muted">From
                                            {{ $date_range }}</h6>
                                    </div>
                                    <h3 class="text-success font-weight-bold">+{{ $resolved_queries_count }}</h3>
                                </div>
                            </div>
                            <div class="card stretch-card mb-3">
                                <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                                    <div>
                                        <h4 class="font-weight-semibold mb-1 text-black">Top Concern</h4>
                                        <h6 class="text-muted">From
                                            {{ $date_range }}</h6>
                                    </div>
                                    <h3 class="text-black font-weight-bold">{{ $top_concerns }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 stretch-card grid-margin">
                            <div class="card">
                                <div class="card-body pb-0">
                                    <h4 class="card-title mb-0">New Queries</h4>
                                    <div class="table-responsive">
                                        <table class="table custom-table text-dark">
                                            <thead>
                                                <tr>
                                                    {{-- <th>#</th> --}}
                                                    <th>Name</th>
                                                    <th>Concern</th>
                                                    <th>Urgency</th>
                                                    {{-- <th>Contact No.</th>
                                                    <th>Email</th> --}}
                                                    {{-- <th>Branch</th> --}}

                                                    <th>Status</th>
                                                    <th>Handled By</th>
                                                    <th>Ticket No.</th>
                                                    <th>Action</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($new_queries as $new_query)
                                                    {{-- @php
                                                        if ($loop->iteration == 8) {
                                                            break;
                                                        }
                                                    @endphp --}}
                                                    <tr>
                                                        {{-- <td>
                                                            {{ $loop->iteration }}
                                                        </td> --}}
                                                        <td>
                                                            {{ $new_query->name }}
                                                        </td>
                                                        {{-- <td>
                                                            {{ $new_query->contact_no }}
                                                        </td>
                                                        <td>
                                                            {{ $new_query->email }}
                                                        </td> --}}
                                                        <td>{{ $new_query->concern }}</td>
                                                        <td>
                                                            <label class="badge
                                                                badge-{{ $new_query->urgency == 'low' ? 'success' :
                                                                         ($new_query->urgency == 'medium' ? 'warning' : 'danger') }}">
                                                                {{ ucfirst($new_query->urgency) }}
                                                            </label>
                                                        </td>


                                                        {{-- <td>
                                                            {{ $new_query->branch }}
                                                        </td> --}}

                                                        <td>
                                                            <label
                                                                class="badge badge-{{ $new_query->status == 'Resolved' ? 'Success' : 'warning' }}">{{ $new_query->status }}</label>
                                                        </td>
                                                        <td>
                                                            {{ $new_query->handler->first_name ?? '' }}
                                                        </td>
                                                        <td>
                                                            {{ $new_query->ticket_number }}
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('queries.show', ['query' => $new_query->id]) }}"
                                                                class="text-decoration-none">
                                                                <button type="submit"
                                                                    class="btn btn-outline-primary bg-white mb-2 mb-md-0">View</button>
                                                            </a>
                                                        </td>
                                                        {{-- <td>{{ $new_query->created_at->format('M d, Y h:i A') }}</td> --}}
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <a class="text-black font-13 d-block pt-2 pb-2 pb-lg-0 font-weight-bold pl-4"
                                        href="{{ route('queries.index') }}">Show more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- chart row starts here -->
                    <div class="row">
                        <div class="col-sm-6 stretch-card grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">Query Statuses</div>
                                    <div class="d-flex">
                                        <div class="doughnut-wrapper w-50 mx-auto">
                                            <canvas id="piechart" width="100" height="100"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 stretch-card grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">Query Concerns</div>
                                    <div class="d-flex align-items-center h-100">
                                        <div class="bar-chart-wrapper w-100">
                                            <canvas id="barchart"></canvas>
                                        </div>
                                    </div>
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
    <script defer>
        var resolvedQueriesCount = '{{ $resolved_queries_count }}';
        var pendingQueriesCount = '{{ $pending_queries_count }}';
        var concernsCountArray = @json($concerns_count_array);
    </script>

    @vite(['resources/js/dashboard/index.js'])
@endsection
