<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>CSR - @yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('plus-admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plus-admin/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plus-admin/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('plus-admin/vendors/jquery-bar-rating/css-stars.css') }}" />
    <link rel="stylesheet" href="{{ asset('plus-admin/vendors/font-awesome/css/font-awesome.min.css') }}" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    {{-- Datatables --}}
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.4/css/dataTables.dataTables.min.css">
    {{-- End Datatables --}}

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('plus-admin/css/style.css') }}" />
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('images/square-logo.png') }}" sizes="10x16" type="image/png"/>

    {{-- Tagify --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.26.1/tagify.css"
        integrity="sha512-OU8tJUDuM2CkHziZNY/tmIXPHkP2ngzw9weL4iON3Tq+M1rCJhEqyg346QF3OVIc3NVLdT/ZowzGuxESOXvlUA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />




    @yield('stylesheets')

    <style>
        #file-upload-button {
            background-color: aqua !important;
        }

        .badge-warning {
            border-color: #EAB208 !important;
            background-color: #EAB208 !important;
        }

        .badge-success {
            border-color: rgb(22 163 74) !important;
            background-color: rgb(22 163 74) !important;
        }

        .table th,
        .table td,
        table.dataTable>tbody>tr>th,
        table.dataTable>tbody>tr>td {
            padding: 16px !important;
            line-height: 24px !important;
        }

        .custom-table th img,
        .custom-table td img {
            object-fit: cover !important;
        }

        select.form-control.is-invalid {
            outline: 1px solid #dc3545;
        }


        .form-control,
        .select2-container--default .select2-selection--single,
        .select2-container--default .select2-selection--single .select2-search__field,
        .typeahead,
        .tt-query,
        .tt-hint {
            min-height: 2.875rem;
            height: auto;
        }

        .tagify{
            --tag-inset-shadow-size: 1.5em;
        }
    </style>

    {{--    Refresh page when there's changes --}}
    {{-- @vite('resources/js/app.js') --}}

</head>

<body>

    @yield('content')

    <!-- plugins:js -->
    <script src="{{ asset('plus-admin/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('plus-admin/vendors/jquery-bar-rating/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('plus-admin/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('plus-admin/vendors/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('plus-admin/vendors/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('plus-admin/vendors/flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('plus-admin/vendors/flot/jquery.flot.fillbetween.js') }}"></script>
    <script src="{{ asset('plus-admin/vendors/flot/jquery.flot.stack.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('plus-admin/js/off-canvas.js') }}"></script>
    <script src="{{ asset('plus-admin/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('plus-admin/js/misc.js') }}"></script>
    <script src="{{ asset('plus-admin/js/settings.js') }}"></script>
    <script src="{{ asset('plus-admin/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    {{-- <script src="{{ asset('plus-admin/js/dashboard.js') }}"></script> --}}
    <!-- End custom js for this page -->
    {{-- Datatables --}}
    <script src="//cdn.datatables.net/2.0.4/js/dataTables.min.js"></script>
    {{-- End datatables --}}

    {{-- Custom file upload js --}}
    <script src="{{ asset('plus-admin/js/file-upload.js') }}"></script>
    {{-- End custom file upload js --}}

    {{-- Tagify --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.26.1/tagify.min.js"
        integrity="sha512-B809ewCpINSkNh7RA5dP5U+/Yv6cyA9aU1WyC+cOXC87RHpNYpwPCmFGSIGtfbc9mdbNgjgEDLUg4WRr+nadJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Chart.js Color Schemes --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-colorschemes/0.4.0/chartjs-plugin-colorschemes.min.js" integrity="sha512-AcghRXJUs1RaSrhWEbtX2W0cpgclyjDqEtKUw+bRzzvGU5NikAMVwGlrRKqUvQWHr15SkogpMFXFRnnkkHhxXw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    @yield('scripts')
</body>

</html>
