@extends('front.app')

@section('seo')
<title>{{ $title }}</title>
<meta name="description" content="{{ $meta_description }}">
<meta name="keywords" content="{{ $meta_keywords }}">

<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $meta_description }}">
<meta property="og:type" content="website">
@if(request()->routeIs('achievement.student.detail'))
    <meta property="og:url" content="{{ route('achievement.student.detail', $achievement->id) }}">
    <link rel="canonical" href="{{ route('achievement.student.detail', $achievement->id) }}">
@endif
@if (request()->routeIs('achievement.teacher.detail'))
    <meta property="og:url" content="{{ route('achievement.teacher.detail', $achievement->id) }}">
    <link rel="canonical" href="{{ route('achievement.teacher.detail', $achievement->id) }}">
@endif
<meta property="og:image" content="{{ $achievement->getImage() }}">
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
                            @if(request()->routeIs('achievement.student.detail'))
                                Prestasi Siswa
                            @endif
                            @if (request()->routeIs('achievement.teacher.detail'))
                                Prestasi Guru
                            @endif
                        </span></h2>

                </div>
                <div class="page-breadcrumb-item ul-li">
                    <ul class="breadcrumb text-uppercase black">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">
                            Prestasi
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
                                        <img src="{{ $achievement->getImage() }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="teacher-details-text">
                                        <div class="section-title-2  headline text-left">
                                            <h2><span>{{ $achievement->name . ' - ' . $achievement->event }}</span></h2>
                                            {{-- <div class="teacher-deg">
                                                Posisi: <span>{{ $achievement->position }}.</span>
                                            </div> --}}
                                        </div>

                                        <div class="teacher-address">
                                            <div class="address-details ul-li-block">
                                                <ul>
                                                    <li>
                                                        <div class="addrs-icon">
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                        <div class="add-info">
                                                            <span><b>Nama: </b>

                                                                @if(request()->routeIs('achievement.student.detail'))
                                                                    <a href="#">
                                                                        {{ $achievement->student?->name }}
                                                                    </a>
                                                                @endif
                                                                @if (request()->routeIs('achievement.teacher.detail'))
                                                                    <a href="{{ route('staff.detail', $achievement->teacher->id) }}">
                                                                        {{ $achievement->teacher?->name }}
                                                                    </a>
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="addrs-icon">
                                                            <i class="fas fa-trophy"></i>
                                                        </div>
                                                        <div class="add-info">
                                                            <span><b>Peringkat: </b> {{ $achievement->rank }} - {{ $achievement->level }}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="addrs-icon">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </div>
                                                        <div class="add-info">
                                                            <span><b>Tanggal: </b> {{ $achievement->date }}</span>
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
                                <h2>Deskripsi.</h2>
                            </div>
                            <p>
                                {{ $achievement->description }}
                            </p>
                        </div>

                        <div class="about-teacher mb45">
                            <div class="section-title-2  headline text-left">
                                <h2>Sertifikat</h2>
                            </div>
                            <embed type="application/pdf" src="{{ $achievement->getFile() }}" style="width: 100%; height: 800px;">

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
