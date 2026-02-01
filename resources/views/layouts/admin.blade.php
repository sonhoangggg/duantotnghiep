<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Admin Panel')</title>
    @include('admin.partials.head')
    @stack('css')

</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">


        <!-- ========== Topbar Start ========== -->
        @include('admin.partials.topbar')
        <!-- ========== Topbar End ========== -->


        <!-- ========== Left Sidebar Start ========== -->
        @include('admin.partials.sidebar')
        <!-- ========== Left Sidebar End ========== -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            @yield('content')
            <!-- Start Content-->


            <!-- Footer Start -->
            @include('admin.partials.footer')
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Theme Settings -->
    @include('admin.partials.setting')



    <!-- Vendor js -->
    <script src="{{ asset('assets/admin/assets/js/vendor.min.js') }}"></script>

    @stack('js')
    <!-- App js -->
    <script src="{{ asset('assets/admin/assets/js/app.min.js') }}"></script>





</body>


</html>
