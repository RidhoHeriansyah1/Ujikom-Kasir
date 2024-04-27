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
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/select2-bootstrap-5-theme.min.css') }}" rel="stylesheet" />
    <style>
        .bg-purple {
            background-color: mediumpurple;
        }

        .text-purple {
            color: mediumpurple;
        }
    </style>
</head>

<body>
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    @include('partials.navbar')

    <div class="container-fluid mt-3">
        <div class="row">
            @if (Route::is('transaksi.index'))
            <div class="col-lg-12 mb-5">
                @yield('content')
            </div>
            @else    
            @include('partials.card-nav')
            <div class="col-lg-9 mb-5">
                @yield('content')
            </div>
            @endif
        </div>
    </div>

    @include('partials.footer')

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    @include('partials.toastr')
</body>

</html>
