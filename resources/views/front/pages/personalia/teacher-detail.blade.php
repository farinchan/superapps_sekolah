@extends('front.app')

@section('seo')
<title>{{ $title }}</title>
<meta name="description" content="{{ $meta_description }}">
<meta name="keywords" content="{{ $meta_keywords }}">

<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $meta_description }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ route('staff.detail', $teacher->id) }}">
<link rel="canonical" href="{{ route('staff.detail', $teacher->id) }}">
<meta property="og:image" content="{{ $teacher->getPhoto() }}">
@endsection

@section('styles')
@endsection

@section('content')
    <!-- Start of breadcrumb section
                                                                  ============================================= -->
    <section id="breadcrumb" class="breadcrumb-section relative-position backgroud-style">
        <div class="blakish-overlay"></div>
        <div class="container">
            <div class="page-breadcrumb-content text-center">
                <div class="page-breadcrumb-title">
                    <h2 class="breadcrumb-head black bold"><span>
                            Detail Staff
                        </span></h2>

                </div>
                <div class="page-breadcrumb-item ul-li">
                    <ul class="breadcrumb text-uppercase black">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">
                            Detail Staff
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of breadcrumb section
                                                                  ============================================= -->

    <!-- Start of blog content
                                                                  ============================================= -->
    <section id="blog-item" class="blog-item-post">
        <div class="container">
            <div class="blog-content-details">
                <div class="row">
                    <div class="col-md-9">
                        <div class="teacher-details-content mb45">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="teacher-details-img">
                                        <img src="{{ $teacher->getPhoto() }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="teacher-details-text">
                                        <div class="section-title-2  headline text-left">
                                            <h2><span>{{ $teacher->name }}</span></h2>
                                            <div class="teacher-deg">
                                                Posisi: <span>{{ $teacher->position }}.</span>
                                            </div>
                                        </div>
                                        <div class="teacher-desc-social ul-li">
                                            <ul>
                                                <li>
                                                    <a href="{{ $teacher->facebook }}">
                                                        <div class="info-social">
                                                            <i class="fab fa-facebook-f"></i>
                                                        </div>
                                                        <span class="info-text">Facebook</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ $teacher->instagram }}">
                                                        <div class="info-social">
                                                            <i class="fab fa-instagram"></i>
                                                        </div>
                                                        <span class="info-text">Instagram</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ $teacher->twitter }}">
                                                        <div class="info-social">
                                                            <i class="fab fa-twitter"></i>
                                                        </div>
                                                        <span class="info-text">Twitter</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="{{ $teacher->linkedin }}">
                                                        <div class="info-social">
                                                            <i class="fab fa-linkedin"></i>
                                                        </div>
                                                        <span class="info-text">Linkedin</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="teacher-address">
                                            <div class="address-details ul-li-block">
                                                <ul>
                                                    <li>
                                                        <div class="addrs-icon">
                                                            <i class="fas fa-map-marker-alt"></i>
                                                        </div>
                                                        <div class="add-info">
                                                            <span><b>Alamat: </b> {{ $teacher->address }}.</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="addrs-icon">
                                                            <i class="fas fa-phone"></i>
                                                        </div>
                                                        <div class="add-info">
                                                            <span><b>Telp: </b> {{ $teacher->no_telp }}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="addrs-icon">
                                                            <i class="fas fa-envelope"></i>
                                                        </div>
                                                        <div class="add-info">
                                                            <span><b>E-mail: </b> {{ $teacher->email }}</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="about-teacher mb45">
                            <div class="section-title-2  headline text-left">
                                <h2>Tentang <span>Saya.</span></h2>
                            </div>
                            <p>
                                {{ $teacher->about }}
                            </p>
                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="side-bar">

                            <div class="side-bar-widget ">
                                <h2 class="widget-title text-capitalize"><span>Tentang</span> MAN 1 Padang Panjang.</h2>

                                <div class="course-desc">
                                    <p>
                                        {{ strip_tags($setting_web->about) }}
                                    </p>
                                </div>
                                {{-- <div class="genius-btn gradient-bg text-center text-uppercase ul-li-block bold-font">
                                    <a href="#">VIEW ONLINE COURSES <i class="fas fa-caret-right"></i></a>
                                </div> --}}
                            </div>

                            @include("front.components.news-categories")


                            @include("front.components.latest-news")


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of blog content
                                                                  ============================================= -->
@endsection

@section('scripts')
@endsection
