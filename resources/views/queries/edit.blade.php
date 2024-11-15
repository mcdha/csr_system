@extends('layouts.app')

@section('title')
    Edit Query
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
                        <h3 class="page-title">Edit Query</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#">View Queries</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Query</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Query form</h4>

                                    <form action="{{ route('queries.update', ['query' => $query->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="name-input">Name <span class="text-danger font-weight-bold">*</span></label>
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name-input" name="name" value="{{ $query->name }}" />
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
                                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email-input" name="email" value="{{ $query->email }}" />
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
                                                    <input type="text" class="form-control @error('contact_no') is-invalid @enderror" id="contact_no-input" name="contact_no" value="{{ $query->contact_no }}" />
                                                    @error('contact_no')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="department-input">Department <span class="text-danger font-weight-bold">*</span></label>
                                                    <select class="form-control @error('department') is-invalid @enderror" id="department-input" name="department">
                                                        <option value="">Select department</option>
                                                        @foreach ($departments as $department)
                                                            <option @if ($query->department == $department) selected @endif>
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
                                                            <option @if ($query->channel == $channel) selected @endif>
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
                                                            <option @if ($query->concern == $concern) selected @endif>
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
                                                        <option value="{{ $query->urgency }}">{{ ucfirst($query->urgency) }}</option>
                                                        <option @if ($query->urgency == 'Low') selected @endif>Low</option>
                                                        <option @if ($query->urgency == 'Medium') selected @endif>Medium</option>
                                                        <option @if ($query->urgency == 'High') selected @endif>High</option>
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
                                                        <option @if ($query->status == 'Pending') selected @endif>Pending</option>
                                                        <option @if ($query->status == 'Resolved') selected @endif>Resolved</option>
                                                    </select>
                                                    @error('status')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="resolved-by-input">Resolved By</label>
                                                    <select class="form-control @error('resolved_by') is-invalid @enderror" id="resolved-by-input" name="resolved_by">
                                                        <option value="">Select user</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}" @if ($query->resolved_by == $user->id) selected @endif>
                                                                {{ $user->first_name }} {{ $user->agent_code }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('resolved_by')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                </div>
                                            </div>
                                            {{-- <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="resolved_at-input">Resolved At</label>
                                                    <input type="text" class="form-control @error('resolved_at') is-invalid @enderror" id="resolved_at-input" name="resolved_at" value="{{ $query->resolved_at ? $query->resolved_at->format('Y-m-d\TH:i') : '' }}" />
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
                                                    <textarea class="form-control @error('issue') is-invalid @enderror" id="issue-input" name="issue" rows="4">{{ $query->issue }}</textarea>
                                                    @error('issue')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="action-taken-input">Action Taken</label>
                                                    <textarea class="form-control @error('action_taken') is-invalid @enderror" id="action-taken-input" name="action_taken" rows="4">{{ $query->action_taken }}</textarea>
                                                    @error('action_taken')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
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
