<!doctype html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/all.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/toastr.css') }}" rel="stylesheet" />
    <style>
        .bg-purple {
            background-color: mediumpurple;
        }

        .text-purple {
            color: mediumpurple;
        }
    </style>
</head>

<body class="bg-body-secondary ">
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <div class="container-fluid">
        <div class="row justify-content-evenly mt-5">
            <div class="col-md-3 mb-5">
                <div class="card">
                    <div class="card-body">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
        @include('partials.toastr')
</body>

</html>
