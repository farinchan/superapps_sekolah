<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('/storage/setting/favicon.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('/storage/setting/favicon.png') }}" />

    @yield('seo')

    <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/flaticon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/video.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/lightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/progess.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('front/css/colors/switch.css') }}">
    {{-- <link href="{{ asset('front/css/colors/color-2.css') }}" rel="alternate stylesheet" type="text/css"
        title="color-2">
    <link href="{{ asset('front/css/colors/color-3.css') }}" rel="alternate stylesheet" type="text/css"
        title="color-3">
    <link href="{{ asset('front/css/colors/color-4.css') }}" rel="alternate stylesheet" type="text/css"
        title="color-4">
    <link href="{{ asset('front/css/colors/color-5.css') }}" rel="alternate stylesheet" type="text/css"
        title="color-5">
    <link href="{{ asset('front/css/colors/color-6.css') }}" rel="alternate stylesheet" type="text/css"
        title="color-6">
    <link href="{{ asset('front/css/colors/color-7.css') }}" rel="alternate stylesheet" type="text/css"
        title="color-7">
    <link href="{{ asset('front/css/colors/color-8.css') }}" rel="alternate stylesheet" type="text/css"
        title="color-8">
    <link href="{{ asset('front/css/colors/color-9.css') }}" rel="alternate stylesheet" type="text/css"
        title="color-9"> --}}

    @yield('styles')


</head>

<body>

    {{-- PRELOADER --}}
    {{-- <div id="preloader"></div> --}}


    {{-- <div id="switch-color" class="color-switcher">
        <div class="open"><i class="fas fa-cog fa-spin"></i></div>
        <h4>COLOR OPTION</h4>
        <ul>
            <li><a class="color-2" onclick="setActiveStyleSheet('color-2'); return true;" href="#!"><i
                        class="fas fa-circle"></i></a> </li>
            <li><a class="color-3" onclick="setActiveStyleSheet('color-3'); return true;" href="#!"><i
                        class="fas fa-circle"></i></a> </li>
            <li><a class="color-4" onclick="setActiveStyleSheet('color-4'); return true;" href="#!"><i
                        class="fas fa-circle"></i></a> </li>
            <li><a class="color-5" onclick="setActiveStyleSheet('color-5'); return true;" href="#!"><i
                        class="fas fa-circle"></i></a> </li>
            <li><a class="color-6" onclick="setActiveStyleSheet('color-6'); return true;" href="#!"><i
                        class="fas fa-circle"></i></a> </li>
            <li><a class="color-7" onclick="setActiveStyleSheet('color-7'); return true;" href="#!"><i
                        class="fas fa-circle"></i></a> </li>
            <li><a class="color-8" onclick="setActiveStyleSheet('color-8'); return true;" href="#!"><i
                        class="fas fa-circle"></i></a> </li>
            <li><a class="color-9" onclick="setActiveStyleSheet('color-9'); return true;" href="#!"><i
                        class="fas fa-circle"></i></a> </li>
        </ul>
        <button class="switcher-light">WIDE </button>
        <button class="switcher-dark">BOX </button>
        <a class="rtl-v" href="RTL_Genius/index.html">RTL </a>
    </div> --}}


    <!-- Start of Header section
  ============================================= -->
    @include('front.partials.header')
    <!-- Start of Header section
 ============================================= -->



    <!-- CONTENT
  ============================================= -->
    @yield('content')
    <!-- End of CONTENT
  ============================================= -->



    <!-- Start of footer section
  ============================================= -->
    @include('front.partials.footer')
    <!-- End of footer section
  ============================================= -->

    @include('sweetalert::alert')


    <!-- For Js Library -->
    <script src="{{ asset('front/js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/js/popper.min.js') }}"></script>
    <script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front/js/jarallax.js') }}"></script>
    <script src="{{ asset('front/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('front/js/lightbox.js') }}"></script>
    <script src="{{ asset('front/js/jquery.meanmenu.js') }}"></script>
    <script src="{{ asset('front/js/scrollreveal.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('front/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('front/js/gmap3.min.js') }}"></script>
    <script src="{{ asset('front/js/switch.js') }}"></script>
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyC61_QVqt9LAhwFdlQmsNwi5aUJy9B2SyA"></script>
    <script src="{{ asset('front/js/script.js') }}"></script>

    @yield('scripts')

</body>

</html>
