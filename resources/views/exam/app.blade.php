<!DOCTYPE html>

<html lang="en">

<head>
    <base href="" />
    <title>E-Learning MAN 1 Padang Panjang</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="E-Learning ini adalah sebuah platform  yang digunakan untuk membantu proses belajar mengajar salah satunya adalah ujian online." />
    <meta name="keywords"
        content=" E-Learning, Ujian Online, Ujian, Online, MAN 1 Padang Panjang" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="id_ID" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="E-Learning MAN 1 Padang Panjang" />
    <meta property="og:url" content="https://elearning.man1kotapadangpanjang.sch.id/" />
    <meta property="og:site_name" content="Metronic by Keenthemes" />
    <link rel="canonical" href="https://elearning.man1kotapadangpanjang.sch.id/" />
    <link rel="shortcut icon" href="/storage/setting/favicon.png" />

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" /> <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('exam/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('exam/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('exam/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('exam/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    @livewireStyles
    @stack('style')

    <!--end::Global Stylesheets Bundle-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-drawer-dismiss="true"
    @if (!request()->routeIs('exam.home')) data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true"
    data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" @endif
    data-kt-app-toolbar-enabled="true" class="app-default">
    @include('exam/partials/theme-mode/_init')
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        {{ $slot }}

    </div>
    <!--end::App-->
    {{-- @include('exam/partials/_drawers') --}}
    @include('exam/partials/_scrolltop')
    <!--begin::Modals-->
    {{-- @include('exam/partials/modals/_upgrade-plan')
    @include('exam/partials/modals/_invite-friends')
    @include('exam/partials/modals/_new-target')
    @include('exam/partials/modals/_view-users')
    @include('exam/partials/modals/users-search/_main') --}}
    <!--end::Modals-->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('exam/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('exam/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->
    {{-- <script src="{{ asset('exam/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script> --}}
    <script src="{{ asset('exam/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('exam/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('exam/js/custom/widgets.js') }}"></script>
    {{-- <script src="{{ asset('exam/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('exam/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('exam/js/custom/utilities/modals/new-target.js') }}"></script>
    <script src="{{ asset('exam/js/custom/utilities/modals/users-search.js') }}"></script> --}}
    <!--end::Custom Javascript-->
    <!--end::Javascript-->

    @include('sweetalert::alert')

    @livewireScripts
    @stack('scripts')

</body>
<!--end::Body-->

</html>
