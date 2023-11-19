<!DOCTYPE html>
<html lang="en" class="dark">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
@include('admin.layouts.style')
<!-- END: Head -->

<body class="py-5">
    <div class="flex mt-[4.7rem] md:mt-0">

        <!-- BEGIN: Side Menu -->
        @include('admin.layouts.side-menu')
        <!-- END: Side Menu -->

        <!-- BEGIN: Content -->
        @yield('content')
        <!-- END: Content -->

    </div>
    @include('admin.layouts.footer-js')
</body>

</html>
