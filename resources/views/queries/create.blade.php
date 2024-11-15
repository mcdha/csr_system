@extends('layouts.app')

@section('title')
    Create Query
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
                        <h3 class="page-title">Create Query</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('queries.index') }}">View Queries</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Create Query</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show small" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    @if (session('error'))
                                        <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                                            {{ session('error') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <h4 class="card-title mb-4">Query form</h4>
                                    <form action="{{ route('queries.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="name-input">Name <span class="text-danger font-weight-bold">*</span></label>
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name-input" name="name" value="{{ old('name') }}" />
                                                    @error('name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="email-input">Email <span class="text-danger font-weight-bold">*</span></label>
                                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email-input" name="email" value="{{ old('email') }}" />
                                                    @error('email')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="contact_no-input">Contact No. <span class="text-danger font-weight-bold">*</span></label>
                                                    <input type="text" class="form-control @error('contact_no') is-invalid @enderror" id="contact_no-input" name="contact_no" value="{{ old('contact_no') }}" />
                                                    @error('contact_no')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="branch-input">Branch <span class="text-danger font-weight-bold">*</span></label>
                                                    <select class="form-control @error('branch') is-invalid @enderror" id="branch-input" name="branch">
                                                        <option value="">Select branch</option>
                                                        @foreach ($branches as $branch)
                                                            <option @if (old('branch') == $branch) selected @endif>
                                                                {{ $branch }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('branch')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div> --}}
                                            {{-- <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="is-member-input">Is Member <span class="text-danger font-weight-bold">*</span></label>
                                                    <select class="form-control @error('is_member') is-invalid @enderror" id="is-member-input" name="is_member">
                                                        <option value="">Select option</option>
                                                        <option value="1" @if (old('is_member') == '1') selected @endif>Yes</option>
                                                        <option value="0" @if (old('is_member') == '0') selected @endif>No</option>
                                                    </select>
                                                    @error('is_member')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div> --}}
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="department-input">Department <span class="text-danger font-weight-bold">*</span></label>
                                                    <select class="form-control @error('department') is-invalid @enderror" id="department-input" name="department">
                                                        <option value="">Select department</option>
                                                        @foreach ($departments as $department)
                                                            <option @if (old('department') == $department) selected @endif>
                                                                {{ $department }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('department')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="channel-input">Channel <span class="text-danger font-weight-bold">*</span></label>
                                                    <select class="form-control @error('channel') is-invalid @enderror" id="channel-input" name="channel">
                                                        <option value="">Select channel</option>
                                                        @foreach ($channels as $channel)
                                                            <option @if (old('channel') == $channel) selected @endif>
                                                                {{ $channel }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('channel')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="concern-input">Concern <span class="text-danger font-weight-bold">*</span></label>
                                                    <select class="form-control @error('concern') is-invalid @enderror" id="concern-input" name="concern">
                                                        <option value="">Select concern</option>
                                                        @foreach ($concerns as $concern)
                                                            <option @if (old('concern') == $concern) selected @endif>
                                                                {{ $concern }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('concern')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="urgency-input">Urgency <span class="text-danger font-weight-bold">*</span></label>
                                                    <select class="form-control @error('urgency') is-invalid @enderror" id="urgency-input" name="urgency">
                                                        <option value="">Select urgency</option>
                                                        <option @if (old('urgency') == 'Low') selected @endif value="low">Low</option>
                                                        <option @if (old('urgency') == 'Medium') selected @endif value="medium">Medium</option>
                                                        <option @if (old('urgency') == 'High') selected @endif value="high">High</option>
                                                    </select>
                                                    @error('urgency')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="status-input">Status <span class="text-danger font-weight-bold">*</span></label>
                                                    <select class="form-control @error('status') is-invalid @enderror" id="status-input" name="status">
                                                        <option value="">Select status</option>
                                                        <option @if (old('status') == 'Pending') selected @endif>Pending</option>
                                                        <option @if (old('status') == 'Resolved') selected @endif>Resolved</option>
                                                    </select>
                                                    @error('status')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="resolved-by-input">Resolved By</label>
                                                    <input type="text" class="form-control @error('resolved_by') is-invalid @enderror" id="resolved-by-input" name="resolved_by" value="{{ old('resolved_by') }}" />
                                                    @error('resolved_by')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div> --}}
                                            {{-- <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="resolved_at-input">Resolved At</label>
                                                    <input type="datetime-local" class="form-control @error('resolved_at') is-invalid @enderror" id="resolved_at-input" name="resolved_at" value="{{ old('resolved_at') }}" />
                                                    @error('resolved_at')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="issue-input">Issue</label>
                                                    <textarea class="form-control @error('issue') is-invalid @enderror" id="issue-input" name="issue" rows="4">{{ old('issue') }}</textarea>
                                                    @error('issue')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="action-taken-input">Action Taken</label>
                                                    <textarea class="form-control @error('action_taken') is-invalid @enderror" id="action-taken-input" name="action_taken" rows="4">{{ old('action_taken') }}</textarea>
                                                    @error('action_taken')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div> --}}
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
