@extends('front.app')

@section('seo')
<title>{{ $title }}</title>
<meta name="description" content="{{ $meta_description }}">
<meta name="keywords" content="{{ $meta_keywords }}">

<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $meta_description }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ route('personalia.show', $personalia->slug) }}">
<link rel="canonical" href="{{ route('personalia.show', $personalia->slug) }}">
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
                            {{ $personalia->name }}

                        </span></h2>

                </div>
                <div class="page-breadcrumb-item ul-li">
                    <ul class="breadcrumb text-uppercase black">
                        <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
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
						<div class="teachers-archive">
                            <h2 class="widget-title text-capitalize"><span>{{ $personalia->name }}</span></h2>
							{!! $personalia->content !!}
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

                            <div class="side-bar-widget">
                                <h2 class="widget-title text-capitalize"><span>Berita </span>Terbaru.</h2>
                                <div class="latest-news-posts">
                                    @foreach ($latest_news as $latest)
                                        <div class="latest-news-area">
                                            <div class="latest-news-thumbnile relative-position">
                                                <img src="{{ $latest->getThumbnail() }}" alt="">
                                                <div class="hover-search">
                                                    <i class="fas fa-search"></i>
                                                </div>
                                                <div class="blakish-overlay"></div>
                                            </div>
                                            <div class="date-meta">
                                                <i class="fas fa-calendar-alt"></i>
                                                {{ $latest->created_at->diffForHumans() }}
                                            </div>
                                            <h3 class="latest-title bold-font"><a
                                                    href="{{ route('news.show', $latest->slug) }}">
                                                    {{ Str::limit($latest->title, 50) }}
                                                </a>
                                            </h3>
                                        </div>
                                    @endforeach


                                    <div class="view-all-btn bold-font">
                                        <a href="{{ route('news.index') }}">View All News <i
                                                class="fas fa-chevron-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>

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
