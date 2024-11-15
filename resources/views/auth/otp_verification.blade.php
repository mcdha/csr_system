@extends('layouts.app')

@section('title')
    OTP Verification
@endsection

@section('content')
    <section class="h-100" style="background-color: #f8f9fb;">
        <div class="container h-100">
            <div class="row h-100 d-flex align-items-center justify-content-center">
                <div class="card-wrapper" style="min-width: 400px">
                    <div class="brand">
                        <img src="{{ asset('images/logo.png') }}" alt="logo" width="120" class="d-flex mx-auto">
                    </div>
                    <h3 class="card-title text-center">AAP: CSR System</h3>
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title">OTP Verification</h4>
                            <form class="forms-sample" action="{{ route('otp_verification.verify') }}" method="POST">
                                @csrf
                                <input type="text" name="uuid" value="{{ $uuid }}" hidden>
                                <div class="form-group">
                                    <label for="token">Code</label>
                                    <input type="text" class="form-control" id="token" placeholder="Enter code"
                                        name="token">
                                </div>
                                <div class="form-check form-check-flat form-check-primary d-flex justify-content-between">
                                    <div class="small text-danger">Token will expire in 5 minutes.</div>
                                    <a href="{{ route('login.index') }}" class="small">Back to login</a>
                                </div>

                                @if (Session::get('error') || Session::get('success'))
                                    <div class="alert alert-{{ Session::get('error') ? 'danger' : 'success' }} alert-dismissible fade show small" role="alert">
                                        {{ Session::get('error') ?? Session::get('success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <button type="submit" class="btn btn-primary mr-2 d-block w-100">Submit</button>
                            </form>
                            <form action="{{ route('password_reset.resend', ['uuid' => $uuid]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type='submit' class='btn btn-outline-primary bg-white mb-2 d-block w-100'>Resend
                                    OTP
                                </button>
                            </form>
                        </div>
                    </div>
                    {{-- <div class="footer">
                    Copyright &copy; 2017 &mdash; Your Company 
                </div> --}}
                </div>
            </div>
        </div>
    </section>
    <!-- Button trigger modal -->
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    @vite(['resources/js/auth/otp_verification.js'])
@endsection

{{-- @section('stylesheets')
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/auth/login.css') }}">
@endsection --}}
