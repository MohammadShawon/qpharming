<!DOCTYPE html>
<html ng-app="qfarming" lang="{{ app()->getLocale() }}">
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="CRM, Accounting" />
    <meta name="author" content="Qbytesoft" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- google font -->
   
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
	<!-- icons -->
    <link href="{{ asset('admin/assets/plugins/simple-line-icons/simple-line-icons.min.css') }} " rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/fonts/font-awesome/css/font-awesome.min.css') }} " rel="stylesheet" type="text/css"/>
	<link href="{{ asset('admin/fonts/material-design-icons/material-icon.css') }} " rel="stylesheet" type="text/css" />
	<!--bootstrap -->
	<link href="{{ asset('admin/assets/plugins/bootstrap/css/bootstrap.css') }} " rel="stylesheet" type="text/css" />

	<link href="{{ asset('admin/assets/plugins/summernote/summernote.css') }} " rel="stylesheet">
    <!-- Material Design Lite CSS -->
	<link rel="stylesheet" href="{{ asset('admin/assets/plugins/material/material.min.css') }} ">
	<link rel="stylesheet" href="{{ asset('admin/assets/css/material_style.css') }} ">
	<!-- animation -->
	<link href="{{ asset('admin/assets/css/pages/animate_page.css') }} " rel="stylesheet">
	<!-- inbox style -->
    <link href="{{ asset('admin/assets/css/pages/inbox.min.css') }} " rel="stylesheet" type="text/css" />
	<!-- Theme Styles -->
    
    <link href="{{ asset('admin/assets/css/plugins.min.css') }} " rel="stylesheet" type="text/css" />
   
    <link href="{{ asset('admin/assets/css/theme-color.css') }} " rel="stylesheet" type="text/css" />
	<!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/img/favicon.ico') }} " /> 

    <link href="{{ asset('admin/assets/css/style.css') }} " rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/responsive.css') }} " rel="stylesheet" type="text/css" />

    <!-- toastr js -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/toastr.min.css') }}">

    {{-- PAGE LOADER CSS --}}

    <link href="{{ asset('admin/assets/css/pageloader/preloader.css') }} " rel="stylesheet" type="text/css" />

    <!--  quicklink css -->
    <link href="{{ asset('admin/assets/quicklink/style.css') }} " rel="stylesheet" type="text/css" />



    
    
    @stack('css')

</head>

 <!-- END HEAD -->
<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white white-sidebar-color logo-green header-green">

    {{-- START PAGE LOADER --}}
        <div id="preloader">
            <div class="canvas">
                <img src="{{ asset('admin/assets/img/qbytsoft_logo.png') }}"  class="loader-logo">
                {{-- <img src="{{ asset('admin/assets/img/Preloader_fan.gif') }}"  class="loader-logo"> --}}
                <div class="spinner"></div>
            </div>
        </div>
    {{-- END PAGE LOADER --}}
        <div class="page-wrapper">
            <!-- start header -->
            @include('template.partials.topbar')
            @include('template.partials.quicklink')
            <!-- end header -->


            <!-- start page container -->
            <div class="page-container">

                <!-- start sidebar menu -->
                @include('template.partials.sidebar')
                <!-- end sidebar menu -->

                <!-- start page content -->
                <div class="page-content-wrapper">
                    <div class="page-content">
                        @yield('content')

                    </div>
                </div>
                <!-- end page content -->

            </div>
            <!-- end page container -->



            <!-- start footer -->
            @include('template.partials.footer')
            <!-- end footer -->
        </div>

 <!-- start js include path -->


 <script src="{{ asset('admin/assets/plugins/jquery/jquery-3.4.1.min.js') }} " ></script>
 <script src="{{ asset('admin/assets/plugins/popper/popper.min.js') }} " ></script>

 <script src="{{ asset('admin/assets/plugins/jquery-blockui/jquery.blockui.min.js') }} " ></script>
 <script src="{{ asset('admin/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }} "></script>

 <script src="{{ asset('admin/assets/plugins/sparkline/jquery.sparkline.min.js') }} " ></script>
 <script src="{{ asset('admin/assets/js/pages/sparkline/sparkline-data.js') }} " ></script>

    <!-- bootstrap -->
    <script type="application/javascript" src="{{ asset('admin/assets/plugins/bootstrap/js/bootstrap.js') }} " ></script>


 <!-- Common js-->
 <script src="{{ asset('admin/assets/js/app.js') }} " ></script>
 <script src="{{ asset('admin/assets/js/layout.js') }} " ></script>
 <script src="{{ asset('admin/assets/js/theme-color.js') }} " ></script>
 <!-- material -->
 <script src="{{ asset('admin/assets/plugins/material/material.min.js') }} "></script>
 <!-- animation -->
 <script src="{{ asset('admin/assets/js/pages/ui/animations.js') }} " ></script>
 <!-- chart js -->
{{-- <script src="{{ asset('admin/assets/plugins/chart-js/Chart.bundle.js') }} " ></script>--}}
{{-- <script src="{{ asset('admin/assets/plugins/chart-js/utils.js') }} " ></script>--}}
{{-- <script src="{{ asset('admin/assets/js/pages/chart/chartjs/home-data.js')}} " ></script>--}}
 <!-- summernote -->
{{-- <script src="{{ asset('admin/assets/plugins/summernote/summernote.min.js') }} " ></script>--}}
{{-- <script src="{{ asset('admin/assets/js/pages/summernote/summernote-data.js') }} " ></script>--}}
<!--  quicklink js -->
<script src="{{ asset('admin/assets/quicklink/main.js') }}" ></script>

 <!-- end js include path -->

 {{-- PAGE LOADER JS SCRIPT START --}}
<script src="{{ asset('admin/assets/js/pageloader/preloader.min.js') }}"></script>
        <script>
            $(window).on("load", function () {
            $(".loader").fadeOut();
            $("#preloader").delay(100).fadeOut("fast");
            });
        </script>
 {{-- PAGE LOADER JS SCRIPT END --}}

<!-- toastr js -->
 <script src="{{ asset('admin/assets/js/toastr.min.js') }}"></script>
 {!! Toastr::message() !!}

 <script>
    @if($errors->any())
        @foreach($errors->all() as $error)
        toastr["error"]("{{ $error }}", 'Error', {
        "closeButton" : true,
        "progressBar" : true,
        "positionClass": "toast-bottom-center",
        });
        @endforeach
    @endif
</script>
<script>
   $(".link-button").click(function () {
  window.location.href = $(this).data('href');
});
</script>

 @stack('js')

</body>
</html>
