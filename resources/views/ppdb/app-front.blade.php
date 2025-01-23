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
    <link href="{{ asset('back/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
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

                @if (request()->routeIs('ppdb.home'))
                    <div class="mb-10" id="home">
                        <div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom landing-dark-bg"
                            style="background-image: url({{ asset('back/media/svg/illustrations/landing.svg') }})">

                            <div class="d-flex flex-column flex-center w-100 min-h-350px min-h-lg-500px px-9">
                                <div class="text-center mb-5 mb-lg-10 py-10 py-lg-20">
                                    <h1 class="text-white lh-base fw-bold fs-2x fs-lg-3x mb-15">
                                        Penerimaan Peserta Didik Baru <br>
                                        <span
                                            style="background: linear-gradient(to right, #12CE5D 0%, #FFD80C 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;">
                                            <span id="kt_landing_hero_text">MAN 1 Padang Panjang</span>
                                        </span>
                                    </h1>
                                    <a href="{{ route("ppdb.register") }}" class="btn btn-primary">Daftar Sekarang</a>
                                </div>
                                <div class="d-flex flex-center flex-wrap position-relative px-5">
                                    <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip"
                                        aria-label="Fujifilm" data-bs-original-title="Fujifilm" data-kt-initialized="1">
                                        <img src="{{ asset('back/media/svg/brand-logos/fujifilm.svg') }}"
                                            class="mh-30px mh-lg-40px" alt="">
                                    </div>
                                    <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip"
                                        aria-label="Vodafone" data-bs-original-title="Vodafone" data-kt-initialized="1">
                                        <img src="{{ asset('back/media/svg/brand-logos/vodafone.svg') }}"
                                            class="mh-30px mh-lg-40px" alt="">
                                    </div>
                                    <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip"
                                        aria-label="KPMG International" data-bs-original-title="KPMG International"
                                        data-kt-initialized="1">
                                        <img src="{{ asset('back/media/svg/brand-logos/kpmg.svg') }}"
                                            class="mh-30px mh-lg-40px" alt="">
                                    </div>
                                    <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip"
                                        aria-label="Nasa" data-bs-original-title="Nasa" data-kt-initialized="1">
                                        <img src="{{ asset('back/media/svg/brand-logos/nasa.svg') }}"
                                            class="mh-30px mh-lg-40px" alt="">
                                    </div>
                                    <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip"
                                        aria-label="Aspnetzero" data-bs-original-title="Aspnetzero"
                                        data-kt-initialized="1">
                                        <img src="{{ asset('back/media/svg/brand-logos/aspnetzero.svg') }}"
                                            class="mh-30px mh-lg-40px" alt="">
                                    </div>
                                    <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip"
                                        aria-label="AON - Empower Results"
                                        data-bs-original-title="AON - Empower Results" data-kt-initialized="1">
                                        <img src="{{ asset('back/media/svg/brand-logos/aon.svg') }}"
                                            class="mh-30px mh-lg-40px" alt="">
                                    </div>
                                    <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip"
                                        aria-label="Hewlett-Packard" data-bs-original-title="Hewlett-Packard"
                                        data-kt-initialized="1">
                                        <img src="{{ asset('back/media/svg/brand-logos/hp-3.svg') }}"
                                            class="mh-30px mh-lg-40px" alt="">
                                    </div>
                                    <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip"
                                        aria-label="Truman" data-bs-original-title="Truman" data-kt-initialized="1">
                                        <img src="{{ asset('back/media/svg/brand-logos/truman.svg') }}"
                                            class="mh-30px mh-lg-40px" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="landing-curve landing-dark-color mb-10 mb-lg-20">
                            <svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z"
                                    fill="currentColor"></path>
                            </svg>
                        </div>
                    </div>
                @else
                    <div id="kt_app_toolbar" class="app-toolbar  py-6 ">
                        <div id="kt_app_toolbar_container"
                            class="app-container  container-xxl d-flex align-items-start ">
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
                @endif



                <div class="app-container  container-xxl ">
                    <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                        <div class="d-flex flex-column flex-column-fluid">
                            @yield('content')
                        </div>
                        {{-- @include('ppdb/layout/partials/_footer') --}}
                    </div>
                </div>
                <div class="mt-20 mb-n20 position-relative z-index-2">
                    <div class="container">
                        {{-- <div class="text-center mb-17">
                            <h3 class="fs-2hx text-gray-900 mb-5" id="clients"
                                data-kt-scroll-offset="{default: 125, lg: 150}">What Our Clients Say</h3>
                            <div class="fs-5 text-muted fw-bold">
                                Save thousands to millions of bucks by using single tool <br>
                                for different amazing and great useful admin
                            </div>
                        </div>
                        <div class="row g-lg-10 mb-10 mb-lg-20">
                            <div class="col-lg-4">
                                <div
                                    class="d-flex flex-column justify-content-between h-lg-100 px-10 px-lg-0 pe-lg-10 mb-15 mb-lg-0">
                                    <div class="mb-7">
                                        <div class="rating mb-6">
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-outline ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-outline ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-outline ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-outline ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-outline ki-star fs-5"></i>
                                            </div>
                                        </div>
                                        <div class="fs-2 fw-bold text-gray-900 mb-3">
                                            This is by far the cleanest template <br>
                                            and the most well structured
                                        </div>
                                        <div class="text-gray-500 fw-semibold fs-4">
                                            The most well thought out design theme I have ever used. The codes are up to
                                            tandard. The css styles are very clean.
                                            In fact the cleanest and the most up to standard I have ever seen.
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-circle symbol-50px me-5">
                                            <img src="{{ asset("back/") }}media/avatars/300-1.jpg" class=""
                                                alt="">
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="#" class="text-gray-900 fw-bold text-hover-primary fs-6">Paul
                                                Miles</a>
                                            <span class="text-muted d-block fw-bold">Development Lead</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div
                                    class="d-flex flex-column justify-content-between h-lg-100 px-10 px-lg-0 pe-lg-10 mb-15 mb-lg-0">
                                    <div class="mb-7">
                                        <div class="rating mb-6">
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-outline ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-outline ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-outline ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-outline ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-outline ki-star fs-5"></i>
                                            </div>
                                        </div>
                                        <div class="fs-2 fw-bold text-gray-900 mb-3">
                                            This is by far the cleanest template <br>
                                            and the most well structured
                                        </div>
                                        <div class="text-gray-500 fw-semibold fs-4">
                                            The most well thought out design theme I have ever used. The codes are up to
                                            tandard. The css styles are very clean.
                                            In fact the cleanest and the most up to standard I have ever seen.
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-circle symbol-50px me-5">
                                            <img src="{{ asset("back/") }}media/avatars/300-2.jpg" class=""
                                                alt="">
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="#"
                                                class="text-gray-900 fw-bold text-hover-primary fs-6">Janya Clebert</a>
                                            <span class="text-muted d-block fw-bold">Development Lead</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div
                                    class="d-flex flex-column justify-content-between h-lg-100 px-10 px-lg-0 pe-lg-10 mb-15 mb-lg-0">
                                    <div class="mb-7">
                                        <div class="rating mb-6">
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-outline ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-outline ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-outline ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-outline ki-star fs-5"></i>
                                            </div>
                                            <div class="rating-label me-2 checked">
                                                <i class="ki-outline ki-star fs-5"></i>
                                            </div>
                                        </div>
                                        <div class="fs-2 fw-bold text-gray-900 mb-3">
                                            This is by far the cleanest template <br>
                                            and the most well structured
                                        </div>
                                        <div class="text-gray-500 fw-semibold fs-4">
                                            The most well thought out design theme I have ever used. The codes are up to
                                            tandard. The css styles are very clean.
                                            In fact the cleanest and the most up to standard I have ever seen.
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-circle symbol-50px me-5">
                                            <img src="{{ asset("back/") }}media/avatars/300-16.jpg"
                                                class="" alt="">
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="#"
                                                class="text-gray-900 fw-bold text-hover-primary fs-6">Steave Brown</a>
                                            <span class="text-muted d-block fw-bold">Development Lead</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="d-flex flex-stack flex-wrap flex-md-nowrap card-rounded shadow p-8 p-lg-12 mb-n5 mb-lg-n13"
                            style="background: linear-gradient(90deg, #20AA3E 0%, #03A588 100%);">
                            <div class="my-2 me-5">
                                <div class="fs-1 fs-lg-2qx fw-bold text-white mb-2">
                                    Tertarik untuk bergabung?
                                    <span class="fw-normal"> MAN 1 Padang Panjang!</span>
                                </div>
                                <div class="fs-6 fs-lg-5 text-white fw-semibold opacity-75">
                                    Bergabunglah dengan ribuan siswa yang telah bergabung dengan kami di MAN 1 Padang Panjang.
                                </div>
                            </div>
                            <a href="{{ route("ppdb.register") }}"
                                class="btn btn-lg btn-outline border-2 btn-outline-white flex-shrink-0 my-2 text-white fw-bold">
                                Daftar Sekarang
                            </a>
                        </div>
                    </div>
                </div>
                <div class="mb-0">
                    <div class="landing-curve landing-dark-color ">
                        <svg viewBox="15 -1 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1 48C4.93573 47.6644 8.85984 47.3311 12.7725 47H1489.16C1493.1 47.3311 1497.04 47.6644 1501 48V47H1489.16C914.668 -1.34764 587.282 -1.61174 12.7725 47H1V48Z"
                                fill="currentColor"></path>
                        </svg>
                    </div>
                    <div class="landing-dark-bg pt-20">
                        <div class="container">
                            <div class="row py-10 py-lg-20">flu
                                <div class="col-lg-5 pe-lg-16 mb-10 mb-lg-0">
                                    <div class="rounded landing-dark-border p-9 mb-10">
                                        <h2 class="text-white">Butuh Bantuan Melalui Email?</h2>
                                        <span class="fw-normal fs-4 text-gray-700">
                                            Kirim email ke
                                            <a href="mailto:{{ $setting_website->email }}?subject=Halo%20MAN%201%20Padang%20Panjang"
                                                class="text-white opacity-50 text-hover-primary">{{ $setting_website->email }}</a>
                                        </span>
                                    </div>
                                    <div class="rounded landing-dark-border p-9">
                                        <h2 class="text-white">Butuh Bantuan Melalui Telepon/WhatsApp?</h2>
                                        <span class="fw-normal fs-4 text-gray-700">
                                            Hubungi kami di
                                            <a href="https://wa.me/{{ $setting_website->phone }}?text=Halo%20MAN%201%20Padang%20Panjang"
                                                class="text-white opacity-50 text-hover-primary"
                                                target="_blank">{{ $setting_website->phone }}</a>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6 ps-lg-16">
                                    <div class="d-flex justify-content-center">
                                        <div class="d-flex fw-semibold flex-column me-20">
                                            <h4 class="fw-bold text-gray-500 mb-6">Internal Link</h4>
                                            <a href="{{ route('ppdb.home') }}"
                                                class="text-white opacity-50 text-hover-primary fs-5 mb-6">Beranda</a>
                                            <a href="{{ route('ppdb.information') }}"
                                                class="text-white opacity-50 text-hover-primary fs-5 mb-6">Informasi</a>
                                            <a href="{{ route('ppdb.contact') }}"
                                                class="text-white opacity-50 text-hover-primary fs-5 mb-6">Hubungi
                                                Kami</a>
                                        </div>
                                        <div class="d-flex fw-semibold flex-column ">
                                            <h4 class="fw-bold text-gray-500 mb-6">External Link</h4>
                                            <a href="{{ route('home') }}"
                                                class="text-white opacity-50 text-hover-primary fs-5 mb-6">Website</a>
                                            <a href="{{ route('ppdb.home') }}"
                                                class="text-white opacity-50 text-hover-primary fs-5 mb-6">PPDB</a>
                                            <a href="#"
                                                class="text-white opacity-50 text-hover-primary fs-5 mb-6">PPID</a>
                                            <a href="#"
                                                class="text-white opacity-50 text-hover-primary fs-5 mb-6">PTSP</a>
                                            <a href="#"
                                                class="text-white opacity-50 text-hover-primary fs-5 mb-6">Pustaka Digital</a>
                                        </div>
                                        <div class="d-flex fw-semibold flex-column ms-lg-20">
                                            <h4 class="fw-bold text-gray-500 mb-6">Social Media</h4>
                                            <a href="https://www.facebook.com/keenthemes" class="mb-6">
                                                <img src="{{ asset('back/media/svg/brand-logos/facebook-4.svg') }}"
                                                    class="h-20px me-2" alt="">
                                                <span
                                                    class="text-white opacity-50 text-hover-primary fs-5 mb-6">Facebook</span>
                                            </a>
                                            <a href="https://github.com/KeenthemesHub" class="mb-6">
                                                <img src="{{ asset('back/media/svg/brand-logos/github.svg') }}"
                                                    class="h-20px me-2" alt="">
                                                <span
                                                    class="text-white opacity-50 text-hover-primary fs-5 mb-6">Github</span>
                                            </a>
                                            <a href="https://twitter.com/keenthemes" class="mb-6">
                                                <img src="{{ asset('back/media/svg/brand-logos/twitter.svg') }}"
                                                    class="h-20px me-2" alt="">
                                                <span
                                                    class="text-white opacity-50 text-hover-primary fs-5 mb-6">Twitter</span>
                                            </a>
                                            <a href="https://dribbble.com/keenthemes" class="mb-6">
                                                <img src="{{ asset('back/media/svg/brand-logos/dribbble-icon-1.svg') }}"
                                                    class="h-20px me-2" alt="">
                                                <span
                                                    class="text-white opacity-50 text-hover-primary fs-5 mb-6">Dribbble</span>
                                            </a>
                                            <a href="https://www.instagram.com/keenthemes" class="mb-6">
                                                <img src="{{ asset('back/media/svg/brand-logos/instagram-2-1.svg') }}"
                                                    class="h-20px me-2" alt="">
                                                <span
                                                    class="text-white opacity-50 text-hover-primary fs-5 mb-6">Instagram</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="landing-dark-separator"></div>
                        <div class="container">
                            <div class="d-flex flex-column flex-md-row flex-stack py-7 py-lg-10">
                                <div class="d-flex align-items-center order-2 order-md-1">
                                    <a href="#">
                                        <img alt="Logo" src="{{ Storage::url($setting_website->logo) }}"
                                            class="h-15px h-md-20px">
                                    </a>
                                    <span class="mx-5 fs-6 fw-semibold text-gray-600 pt-1"
                                        href="https://keenthemes.com">
                                        © {{ date('Y') }} {{ $setting_website->name }}
                                    </span>
                                </div>
                                <ul
                                    class="menu menu-gray-600 menu-hover-primary fw-semibold fs-6 fs-md-5 order-1 mb-5 mb-md-0">
                                    <li class="menu-item">
                                        <a href="https://keenthemes.com" target="_blank"
                                            class="menu-link px-2">Website</a>
                                    </li>
                                    <li class="menu-item mx-5">
                                        <a href="https://devs.keenthemes.com" target="_blank"
                                            class="menu-link px-2">Support</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
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
    {{-- <script src="{{ asset('back/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script> --}}
    {{-- <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
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
    {{-- <script src="{{ asset('back/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('back/js/custom/apps/chat/chat.js') }}"></script>
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
