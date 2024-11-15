@extends('layouts.app')

@section('title')
    Edit User
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
                        <h3 class="page-title">Edit User</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">View Users</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">User form</h4>
                                    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST"
                                        enctype="multipart/form-data" class="forms-sample">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="first-name-input">First Name</label>
                                            <input type="text"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                id="first-name-input" name="first_name" value="{{ $user->first_name }}" />
                                            @error('first_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="last-name-input">Last Name</label>
                                            <input type="text"
                                                class="form-control @error('last_name') is-invalid @enderror"
                                                id="last-name-input" name="last_name" value="{{ $user->last_name }}" />
                                            @error('last_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email-input">Email</label>
                                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                                id="email-input" name="email" value="{{ $user->email }}" />
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                       <!-- Role -->
                                       <div class="form-group">
                                        <label for="role-input">Role <span class="text-danger font-weight-bold">*</span></label>
                                        <select class="form-control @error('role') is-invalid @enderror" id="role-input" name="role">
                                            <option value="">Select role</option>
                                            <option value="Admin" {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="Agent" {{ old('role', $user->role) == 'Agent' ? 'selected' : '' }}>Agent</option>
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Agent Code -->
                                    <div class="form-group" id="agent-code-group" style="{{ old('role', $user->role) == 'Agent' ? 'display: block;' : 'display: none;' }}">
                                        <label for="agent_code-input">Agent Code <span class="text-danger font-weight-bold">*</span></label>
                                        <input type="text" class="form-control @error('agent_code') is-invalid @enderror"
                                               id="agent_code-input" name="agent_code" value="{{ old('agent_code', $user->agent_code) }}">
                                        @error('agent_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                        <div class="form-group">
                                            <label>File upload</label>
                                            <input type="file" name="image_file" class="file-upload-default">
                                            <div class="input-group col-xs-12">
                                                <input type="text" class="form-control file-upload-info" disabled=""
                                                    placeholder="Upload Image">
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-primary" type="button">
                                                        Upload </button>
                                                </span>
                                            </div>
                                            @error('image_file')
                                                <div class="alert alert-danger alert-dismissible fade show mt-4 small"
                                                    role="alert">
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleInput = document.getElementById('role-input');
        const agentCodeGroup = document.getElementById('agent-code-group');

        function toggleAgentCodeField() {
            if (roleInput.value === 'Agent') {
                agentCodeGroup.style.display = 'block';
            } else {
                agentCodeGroup.style.display = 'none';
            }
        }

        roleInput.addEventListener('change', toggleAgentCodeField);
        toggleAgentCodeField(); // Initialize on page load
    });
</script>

@section('scripts')
    {{-- @vite(['resources/js/users/create.js']) --}}
@endsection
