<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Order Panel">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin') }}/assets/img/favicon.png">
    <title>{{ config('app.name', 'Order Panel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/dashforge.dashboard.css">
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
    <script src="{{ asset('admin') }}/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/dashforge.js"></script>
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