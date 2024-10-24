@extends('front.app')

@section('seo')
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $meta_description }}">
    <meta name="keywords" content="{{ $meta_keywords }}">

    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $meta_description }}">
    <meta property="og:type" content="website">
    {{-- <meta property="og:url" content="{{ route('personalia.show', $personalia->slug) }}">
    <link rel="canonical" href="{{ route('personalia.show', $personalia->slug) }}"> --}}
    <meta property="og:image" content="{{ Storage::url($favicon) }}">
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
                        @if (request()->routeIs('achievement.student'))
                            Prestasi Siswa

                        @elseif (request()->routeIs('achievement.teacher'))
                            Prestasi Guru
                            @else
                            ANDA SALAH JALAN
                        @endif

                        </span></h2>

                </div>
                <div class="page-breadcrumb-item ul-li">
                    <ul class="breadcrumb text-uppercase black">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Personalia</li>
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
                        <div class="latest-area-content  ">
                            <div class="section-title mb45 headline text-center ">
                                {{-- <span class="subtitle text-uppercase">COURSES CATEGORIES</span> --}}
                                <h2><span>Prestasi</span> Siswa.</h2>
                            </div>
                            <div class="latest-news-posts">
                                <div class="row">
                                    @foreach ($list_achievement as $achievement)
                                        <div class="col-md-6">
                                            <div class="latest-news-area" style="max-width: 100%;">
                                                <div class="latest-news-thumbnile relative-position">
                                                    <img src="{{ $achievement->getImage() }}" alt="">
                                                    <div class="hover-search">
                                                        <i class="fas fa-search"></i>
                                                    </div>
                                                    <div class="blakish-overlay"></div>
                                                </div>
                                                <div class="date-meta">
                                                    <i class="fas fa-trophy"></i> {{ $achievement->rank }} -
                                                    {{ $achievement->level }}
                                                </div>
                                                <h3 class="latest-title bold-font"><a href="#">
                                                        {{ $achievement->name }} - {{ $achievement->event }}
                                                    </a></h3>
                                                <div class="course-viewer ul-li">
                                                    <ul>
                                                        @if (request()->routeIs('achievement.student'))
                                                            <li><a href=""><i class="fas fa-user"></i>
                                                                    {{ $achievement->student->name }}</a></li>
                                                        @elseif (request()->routeIs('achievement.teacher'))
                                                            <li><a href="{{ route("staff.detail", $achievement->teacher->id ) }}
                                                                "><i class="fas fa-user"></i>
                                                                    {{ Str::limit($achievement->teacher->name, 30) }}</a></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @if(request()->routeIs('achievement.student'))
                            <div class="couse-pagination text-center ul-li">
                                <ul>
                                    @if ($list_achievement->onFirstPage())
                                        <li class="pg-text"><a href="#">PREV</a></li>
                                    @else
                                        <li class="pg-text">
                                            <a
                                                href="{{ route('achievement.student', ['page' => $list_achievement->currentPage() - 1, 'q' => request()->q]) }}">PREV</a>
                                        </li>
                                    @endif

                                    @php
                                        // Menghitung halaman pertama dan terakhir yang akan ditampilkan
                                        $start = max($list_achievement->currentPage() - 2, 1);
                                        $end = min($start + 4, $list_achievement->lastPage());
                                    @endphp

                                    @if ($start > 1)
                                        <!-- Menampilkan tanda elipsis jika halaman pertama tidak termasuk dalam tampilan -->
                                        <li><a href="#">...</a></li>
                                    @endif

                                    @foreach ($list_achievement->getUrlRange($start, $end) as $page => $url)
                                        @if ($page == $list_achievement->currentPage())
                                            <li class="active"><a href="#">{{ $page }}</a></li>
                                        @else
                                            <li><a
                                                    href="{{ route('achievement.student', ['page' => $page, 'q' => request()->q]) }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    @if ($end < $list_achievement->lastPage())
                                        <li><a href="#">...</a></li>
                                    @endif

                                    @if ($list_achievement->hasMorePages())
                                        <li class="pg-text"><a
                                                href="{{ route('achievement.student', ['page' => $list_achievement->currentPage() + 1, 'q' => request()->q]) }}">NEXT</a>
                                        </li>
                                    @else
                                        <li class="pg-text"><a href="#">NEXT</a></li>
                                    @endif

                                </ul>
                            </div>
                            @elseif (request()->routeIs('achievement.teacher'))
                            <div class="couse-pagination text-center ul-li">
                                <ul>
                                    @if ($list_achievement->onFirstPage())
                                        <li class="pg-text"><a href="#">PREV</a></li>
                                    @else
                                        <li class="pg-text">
                                            <a
                                                href="{{ route('achievement.teacher', ['page' => $list_achievement->currentPage() - 1, 'q' => request()->q]) }}">PREV</a>
                                        </li>
                                    @endif

                                    @php
                                        // Menghitung halaman pertama dan terakhir yang akan ditampilkan
                                        $start = max($list_achievement->currentPage() - 2, 1);
                                        $end = min($start + 4, $list_achievement->lastPage());
                                    @endphp

                                    @if ($start > 1)
                                        <!-- Menampilkan tanda elipsis jika halaman pertama tidak termasuk dalam tampilan -->
                                        <li><a href="#">...</a></li>
                                    @endif

                                    @foreach ($list_achievement->getUrlRange($start, $end) as $page => $url)
                                        @if ($page == $list_achievement->currentPage())
                                            <li class="active"><a href="#">{{ $page }}</a></li>
                                        @else
                                            <li><a
                                                    href="{{ route('achievement.teacher', ['page' => $page, 'q' => request()->q]) }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    @if ($end < $list_achievement->lastPage())
                                        <li><a href="#">...</a></li>
                                    @endif

                                    @if ($list_achievement->hasMorePages())
                                        <li class="pg-text"><a
                                                href="{{ route('achievement.teacher', ['page' => $list_achievement->currentPage() + 1, 'q' => request()->q]) }}">NEXT</a>
                                        </li>
                                    @else
                                        <li class="pg-text"><a href="#">NEXT</a></li>
                                    @endif

                                </ul>
                            </div>
                            @endif
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

                            @include('front.components.news-categories')

                            @include('front.components.latest-news')


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
