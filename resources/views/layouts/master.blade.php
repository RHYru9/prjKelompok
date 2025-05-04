<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <base href="{{ url('/') }}/">
    <title>@yield('title') | ReBox</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('build/images/favicon.ico') }}">

    {{-- Pastikan ini juga menggunakan asset() di dalam head-css --}}
    @include('layouts.head-css')
</head>

@section('body')
<body data-sidebar="dark" data-layout-mode="light">
@show

    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.topbar')
        @include('layouts.sidebar')

        <!-- Start right Content here -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

            @include('layouts.footer')
        </div>
        <!-- end main content -->
    </div>
    <!-- END layout-wrapper -->

    @include('layouts.right-sidebar')

    <!-- JAVASCRIPT -->
    {{-- Pastikan ini juga pakai asset() --}}
    @include('layouts.vendor-scripts')

</body>
</html>
