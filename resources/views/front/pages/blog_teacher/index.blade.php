@extends('front.app')

@section('seo')
<title>{{ $title }}</title>
<meta name="description" content="{{ $meta_description }}">
<meta name="keywords" content="{{ $meta_keywords }}">

<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $meta_description }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ route('news.index' ) }}">
<link rel="canonical" href="{{ route('news.index') }}">
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
                    @if (request()->routeIs('news.category'))
                        <h2 class="breadcrumb-head black bold">Kategori <span>{{ $category->name }}</span></h2>

                    @endif
                    @if (request()->routeIs('news.index'))
                        <h2 class="breadcrumb-head black bold">Semua <span>Berita</span></h2>
                    @endif
                </div>
                <div class="page-breadcrumb-item ul-li">
                    <ul class="breadcrumb text-uppercase black">
                        <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                        <li class="breadcrumb-item active">News</li>
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
                        <div class="blog-post-content">
                            <div class="short-filter-tab">
                                @if (request()->routeIs('news.category'))
                                    <div class="shorting-filter  float-left">
                                        <span><b>Kategori</b>:</span>
                                        {{ $category->name }}
                                    </div>
                                @endif

                                <div class="tab-button blog-button ul-li text-center float-right">
                                    <ul class="product-tab">
                                        <li class="active" rel="tab1"><i class="fas fa-th"></i></li>
                                        <li rel="tab2"> <i class="fas fa-list"></i></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="genius-post-item">
                                <div class="tab-container">
                                    <div id="tab1" class="tab-content-1 pt35">
                                        <div class="row">
                                            @foreach ($list_news as $news)
                                                <div class="col-md-6">
                                                    <div class="blog-post-img-content">
                                                        <div class="blog-img-date relative-position">
                                                            <div class="blog-thumnile">
                                                                <img src="{{ $news->getThumbnail() }}"
                                                                    style="height: 300px width: 100%; object-fit: cover;"
                                                                    alt="">
                                                            </div>
                                                            <div class="course-price text-center gradient-bg">
                                                                <span>{{ $news->created_at->diffForHumans() }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="course-meta">
                                                            <span class="course-category bold-font"><a
                                                                    href="{{ route('news.category', $news->category->slug) }}">{{ $news->category->name }}</a></span>
                                                            <span class="course-author bold-font"><a
                                                                    href="#">Humas</a></span>

                                                        </div>
                                                        <div class="blog-title-content headline">
                                                            <a href="{{ route('news.show', $news->slug) }}">
                                                                <h3>{{ $news->title }}</h3>
                                                            </a>
                                                            <div class="blog-content">
                                                                {{ Str::limit(strip_tags($news->content), 100) }}
                                                            </div>

                                                            <div class="course-viewer ul-li">
                                                                <ul>
                                                                    <li>
                                                                        <a href="">
                                                                            <i class="fas fa-user"></i>
                                                                            {{ $news->viewers->count() }}
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="">
                                                                            <i class="fas fa-comment-dots"></i>
                                                                            {{ $news->comments->count() }}
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="view-all-btn bold-font mt-3">
                                                                <a href="{{ route('news.show', $news->slug) }}">Read More
                                                                    <i class="fas fa-chevron-circle-right"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>
                                    </div><!-- 1st tab -->

                                    <div id="tab2" class="tab-content-1 pt35">
                                        <div class="blog-list-view">
                                            @foreach ($list_news as $news)
                                                <div class="list-blog-item">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="blog-post-img-content">
                                                                <div class="blog-img-date relative-position">
                                                                    <div class="blog-thumnile">
                                                                        <img src="{{ $news->getThumbnail() }}"
                                                                            alt="">
                                                                    </div>
                                                                    <div class="course-price text-center gradient-bg">
                                                                        <span>
                                                                            {{ $news->created_at->diffForHumans() }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="blog-title-content headline">
                                                                <a href="{{ route('news.show', $news->slug) }}">
                                                                    <h3>{{ $news->title }}</h3>
                                                                </a>
                                                                <div class="course-meta">
                                                                    <span class="course-category bold-font"><a
                                                                            href="{{ route('news.category', $news->category->slug) }}">{{ $news->category->name }}</a></span>
                                                                    <span class="course-author bold-font"><a
                                                                            href="#">Humas</a></span>

                                                                </div>

                                                                <div class="blog-content">
                                                                    {{ Str::limit(strip_tags($news->content), 100) }}
                                                                </div>
                                                                <div class="course-viewer ul-li">
                                                                    <ul>
                                                                        <li>
                                                                            <a href=""><i
                                                                                    class="fas fa-user"></i>{{ $news->viewers->count() }}
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href=""><i
                                                                                    class="fas fa-comment-dots"></i>
                                                                                {{ $news->comments->count() }}
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>

                                                                <div class="view-all-btn bold-font mt-3">
                                                                    <a href="{{ route('news.show', $news->slug) }}">Read
                                                                        More <i class="fas fa-chevron-circle-right"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>
                                    </div><!-- 2nd tab -->
                                </div>
                            </div>


                            <div class="couse-pagination text-center ul-li">
                                <ul>
                                    @if ($list_news->onFirstPage())
                                        <li class="pg-text"><a href="#">PREV</a></li>
                                    @else
                                        <li class="pg-text">
                                            <a
                                                href="{{ route('news', ['page' => $list_news->currentPage() - 1, 'q' => request()->q]) }}">PREV</a>
                                        </li>
                                    @endif

                                    @php
                                        // Menghitung halaman pertama dan terakhir yang akan ditampilkan
                                        $start = max($list_news->currentPage() - 2, 1);
                                        $end = min($start + 4, $list_news->lastPage());
                                    @endphp

                                    @if ($start > 1)
                                        <!-- Menampilkan tanda elipsis jika halaman pertama tidak termasuk dalam tampilan -->
                                        <li><a href="#">...</a></li>
                                    @endif

                                    @foreach ($list_news->getUrlRange($start, $end) as $page => $url)
                                        @if ($page == $list_news->currentPage())
                                            <li class="active"><a href="#">{{ $page }}</a></li>
                                        @else
                                            <li><a
                                                    href="{{ route('news', ['page' => $page, 'q' => request()->q]) }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    @if ($end < $list_news->lastPage())
                                        <li><a href="#">...</a></li>
                                    @endif

                                    @if ($list_news->hasMorePages())
                                        <li class="pg-text"><a
                                                href="{{ route('news', ['page' => $list_news->currentPage() + 1, 'q' => request()->q]) }}">NEXT</a>
                                        </li>
                                    @else
                                        <li class="pg-text"><a href="#">NEXT</a></li>
                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="side-bar">
                            <div class="side-bar-search">
                                <form action="#" method="get">
                                    <input type="text" class="" placeholder="Search" name="q"
                                        value="{{ request('q') }}">
                                    <button type="submit"><i class="fas fa-search"></i></button>
                                </form>
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
