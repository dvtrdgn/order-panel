<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="ThemePixels">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin') }}/assets/img/favicon.png">
    <title>{{ config('app.name', 'Order Panel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- vendor css -->
    {{-- <link href="{{ asset('admin') }}/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('admin') }}/lib/jqvmap/jqvmap.min.css" rel="stylesheet"> --}}
    <!-- DashForge CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/dashforge.css"> --}}
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/dashforge.dashboard.css">
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @livewireStyles
</head>

<body class="page-profile ">
    @auth
        @include('admin.partial._header')
    @endauth

    <div class="content content-fixed">
        <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
            {{ $slot }}
        </div>
    </div>

    @include('admin.partial._footer')

    <script src="{{ asset('admin') }}/lib/jquery/jquery.min.js"></script>
    <script src="{{ asset('admin') }}/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin') }}/lib/feather-icons/feather.min.js"></script>
    {{-- <script src="{{ asset('admin') }}/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script> --}}
    {{-- <script src="{{ asset('admin') }}/lib/jquery.flot/jquery.flot.js"></script>
    <script src="{{ asset('admin') }}/lib/jquery.flot/jquery.flot.stack.js"></script>
    <script src="{{ asset('admin') }}/lib/jquery.flot/jquery.flot.resize.js"></script> --}}

    {{-- <script src="{{ asset('admin') }}/lib/jqvmap/jquery.vmap.min.js"></script> --}}
    {{-- <script src="{{ asset('admin') }}/lib/jqvmap/maps/jquery.vmap.usa.js"></script> --}}

    <script src="{{ asset('admin') }}/assets/js/dashforge.js"></script>
    <script src="{{ asset('admin') }}/assets/js/dashforge.sampledata.js"></script>
    <script src="{{ asset('admin') }}/assets/js/dashboard-one.js"></script>

    @livewireScripts

    <script>
        window.addEventListener('alert', event => {
            toastr[event.detail.type](event.detail.message,
                event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
        });
    </script>
</body>

</html>
