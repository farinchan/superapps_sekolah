@extends('front.app')

@section('seo')
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $meta_description }}">
    <meta name="keywords" content="{{ $meta_keywords }}">

    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $meta_description }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('announcement.show', $announcement->slug) }}">
    <link rel="canonical" href="{{ route('announcement.show', $announcement->slug) }}">
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
                    <h2 class="breadcrumb-head black bold">Detail <span>Pengumuman </span></h2>
                </div>
                <div class="page-breadcrumb-item ul-li">
                    <ul class="breadcrumb text-uppercase black">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pengumuman</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of breadcrumb section
              ============================================= -->


    <!-- Start of Blog single content
              ============================================= -->
    <section id="blog-detail" class="blog-details-section">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="blog-details-content">
                        <div class="post-content-details">
                            <h2>{{ $announcement->title }}</h2>

                            <div class="date-meta text-uppercase">
                                <span><i class="fas fa-calendar-alt"></i> {{ $announcement->created_at->format('d M Y') }} </span>
                                <span><i class="fas fa-user"></i> Humas </span>
                            </div>
                            <p>
                                {!! $announcement->content !!}
                            </p>
                            <br>
                            @if ($announcement->file != null)
                                <object data="{{ $announcement->getFile() }}" type="application/pdf" width="100%"
                                    height="800px">
                                    <embed src="{{ $announcement->getFile() }}" type="application/pdf" />
                                </object>
                            @endif
                        </div>
                        <div class="blog-share-tag">
                            <div class="share-text float-left">
                                Share Pengumuman ini
                            </div>
                            <div class="share-social ul-li float-right">
                                <ul>
                                    <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ route('news.show', $announcement->slug) }}&t={{ $announcement->title }}"
                                            target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="https://twitter.com/intent/tweet?url={{ route('news.show', $announcement->slug) }}&text={{ $announcement->title }}"
                                            target="_blank"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('news.show', $announcement->slug) }}&title={{ $announcement->title }}"
                                            target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a href="https://wa.me/?text={{ route('news.show', $announcement->slug) }}&title={{ $announcement->title }}"
                                            target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                                </ul>
                            </div>
                        </div>
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
    </section>
    <!-- End of Blog single content
              ============================================= -->
@endsection

@section('scripts')
@endsection
