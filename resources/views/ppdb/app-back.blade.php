<!DOCTYPE html>
<html lang="en">
@php
    $setting_website = \App\Models\SettingWebsite::first();
@endphp

<head>
    <base href="" />
    <title> PPDB Online {{ $setting_website->name }} @isset($page_title)
            | {{ $page_title }}
        @endisset
    </title>
    <meta charset="utf-8" />
    <meta name="description" content="
            {{ $setting_website->about }}
        " />
    <meta name="keywords"
        content="
            {{ $setting_website->name }}, PPDB, Sumatera barat, Madrasah, Madrasah Aliyah, Kementrian Agama, Pendidikan, Pendaftaran, Online, Padang Panjang, Sumatera, Sumatera barat
        " />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="id_ID" />
    <meta property="og:type" content="article" />
    <meta property="og:title"
        content="PPDB Online {{ $setting_website->name }} @isset($title) | {{ $page_title }} @endisset" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="PPDB Online {{ $setting_website->name }}" />
    <link rel="canonical" href="{{ url()->current() }}" />
    <link rel="shortcut icon" href="{{ Storage::url($setting_website->favicon) }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" /> <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('back/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('back/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('back/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('ppdb/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    @yield('styles')
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

<body id="kt_app_body" data-kt-app-header-fixed-mobile="true" data-kt-app-toolbar-enabled="true" class="app-default">
    @include('ppdb/partials/theme-mode/_init')
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
            @include('ppdb/layout/partials/_header')
            <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
                <div id="kt_app_toolbar" class="app-toolbar  py-6 ">
                    <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex align-items-start ">
                        <div class="d-flex flex-column flex-row-fluid">
                            <div class="d-flex align-items-center pt-1">
                                @include('ppdb/layout/partials/toolbar/_breadcrumb')
                            </div>
                            <div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-4 gap-lg-10 pt-13 pb-6">
                                @include('ppdb/layout/partials/toolbar/_page-title')
                                {{-- @include('ppdb/layout/partials/toolbar/_stats') --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-container  container-xxl ">
                    <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                        <div class="d-flex flex-column flex-column-fluid">
                            @yield('content')
                        </div>
                        @include('ppdb/layout/partials/_footer')
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @include('ppdb/partials/_drawers') --}}
    @include('ppdb/partials/_scrolltop')
    <!--begin::Modals-->
    {{-- @include('ppdb/partials/modals/_upgrade-plan')
    @include('ppdb/partials/modals/_invite-friends')
    @include('ppdb/partials/modals/_new-target')
    @include('ppdb/partials/modals/create-app/_main')
    @include('ppdb/partials/modals/users-search/_main') --}}
    <!--end::Modals-->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('back/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('ppdb/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->
    {{-- <script src="{{ asset('back/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
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
    <script src="{{ asset('back/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('ppdb/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('back/js/custom/widgets.js') }}"></script>
    {{-- <script src="{{ asset('back/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('back/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('back/js/custom/utilities/modals/new-target.js') }}"></script>
    <script src="{{ asset('back/js/custom/utilities/modals/create-app.js') }}"></script>
    <script src="{{ asset('back/js/custom/utilities/modals/users-search.js') }}"></script> --}}
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
    @yield('scripts')
    @include('sweetalert::alert')
</body>
<!--end::Body-->

</html>
