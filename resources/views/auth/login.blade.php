@extends('layouts.app')

@section('title')
    Login
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
                            <h4 class="card-title">Login</h4>
                            <form class="forms-sample" action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="text" class="form-control" id="email" placeholder="Email"
                                        name="email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Password"
                                        name="password">
                                </div>
                                {{-- <div class="form-check form-check-flat form-check-primary d-flex justify-content-between">
                                    <label class="form-check-label" for="remember">
                                        <input type="checkbox" class="form-check-input" name="remember" id="remember">
                                        Remember me <i class="input-helper">
                                        </i>
                                    </label>
                                    <a href="" class="small" id="reset-password-btn">Reset Password</a>
                                </div> --}}
                                @session('error')
                                    <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                                        {{ Session::get('error') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endsession
                                <button type="submit" class="btn btn-primary mr-2 d-block w-100">Login</button>
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

    <!-- Modal -->
    <div id="reset-password-modal" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('password_reset.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Reset Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email-input">Email</label>
                            <input type="text" class="form-control" id="email-input" name="email" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
    @vite(['resources/js/auth/login.js'])
@endsection

{{-- @section('stylesheets')
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/auth/login.css') }}">
@endsection --}}
