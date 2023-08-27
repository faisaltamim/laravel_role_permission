<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Role And Permission Management')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('Backend.layouts.partials.style')
</head>

<body>
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->

    <!-- page container area start -->
    <div class="page-container pl-0">

        <!-- main content area start -->
        <div class="main-content">

            <!-- dynamic content area start -->
            @yield('main_content')
            <!-- dynamic content area end -->
        </div>
        <!-- main content area end -->
    </div>
    <!-- page container area end -->

    <!-- jquery latest version -->
    @include('Backend.layouts.partials.script_code')

    {{-- toastr js just initialize here for whole the application activities --}}
    {!! Toastr::message() !!}
</body>

</html>
