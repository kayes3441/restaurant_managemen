<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8" />
    <title>@yield('document-title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themes brand" name="author" />

    @include('admin.include.style')

</head>

<body data-sidebar="dark">

<!-- Begin page -->
<div id="layout-wrapper">
    @include('admin.include.header-nav')
    <!-- Left Sidebar End -->
    @include('admin.include.left-menu')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                @include('admin.include.page-title')
                <!-- end page title -->
                @yield('body')
                <!-- end row -->
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        @include('admin.include.footer')
    </div>
    <!-- end main content-->
</div>
<!-- JAVASCRIPT -->
@include('admin.include.js')
@yield('js')
</body>
</html>
