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
    <div class="page-container">

        <!-- sidebar menu area start -->
        @include('Backend.layouts.partials.sidebar')
        <!-- sidebar menu area end -->

        <!-- main content area start -->
        <div class="main-content">

            <!-- header area start -->
            @include('Backend.layouts.partials.header_area')
            <!-- header area end -->

            <!-- dynamic content area start -->
            @yield('main_content')
            <!-- dynamic content area end -->
        </div>
        <!-- main content area end -->

        <!-- footer area start-->
        @include('Backend.layouts.partials.footer')
        <!-- footer area end-->

    </div>
    <!-- page container area end -->

    <!-- offset area start -->
    @include('Backend.layouts.partials.offset_area')
    <!-- offset area end -->

    <!-- jquery latest version -->
    @include('Backend.layouts.partials.script_code')

    {{-- toastr js just initialize here for whole the application activities --}}
    {!! Toastr::message() !!}
</body>

</html>
