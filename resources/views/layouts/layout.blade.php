<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title')| TM - Dashboard</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="description" content="task management dashboard" />
        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('favico.ico') }}">
        <link rel="icon" href="{{ asset('favico.ico') }}" type="image/x-icon">
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/metisMenu.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/slicknav.min.css') }}">

        <link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/typography.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/default-css.css') }}">

        <link rel="stylesheet" href="{{ asset('assets/flatpickr/dist/flatpickr.min.css') }}">
        <link rel="stylesheet" href="{{asset('assets/dropify/dist/css/dropify.min.css')}}"/>
        <link rel="stylesheet" href="{{asset('assets/select2/dist/css/select2.min.css')}}"/>
        <link rel="stylesheet" href="{{asset('assets/dropzone/dist/dropzone.css')}}"/>
        <link rel="stylesheet" href="{{asset('assets/jquery-toast/jquery.toast.min.css')}}"/>

        <link rel="stylesheet" href="{{asset('assets/datatables/datatables/css/dataTables.bootstrap4.min.css')}}"/>
        <link rel="stylesheet" href="{{asset('assets/datatables/datatables.net-fixedheader-dt/css/fixedHeader.dataTables.css')}}"/>
        <link rel="stylesheet" href="{{ asset('assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/custom1.css') }}">
        @yield('header_styles')
    </head>

    <body>
        <div class="page-container">
                @include('partials.menu')
            <div class="main-content">
                @yield('content')
            </div>
            @include('partials.footer')
        </div>
        <!-- Modal -->
    </body>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('assets/dropify/dist/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/flatpickr/dist/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/jquery-toast/jquery.toast.min.js') }}"></script>

    <script src="{{ asset('assets/datatables/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/scripts1.js') }}"></script>
    <!-- JavaScript -->
    @yield('footer_scripts')
    <script>
        $(document).ready(function(){
            /* Select2 Init*/
            $(".select2").select2();
            $('[data-tip="tooltip"]').tooltip();
        });
    </script>

</html>
