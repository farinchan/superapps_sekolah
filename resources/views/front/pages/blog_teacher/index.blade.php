@extends('front.app')

@section('seo')
<title>{{ $title }}</title>
<meta name="description" content="{{ $meta_description }}">
<meta name="keywords" content="{{ $meta_keywords }}">

<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $meta_description }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ route('blog_teacher.index' ) }}">
<link rel="canonical" href="{{ route('blog_teacher.index') }}">
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
                        <h2 class="breadcrumb-head black bold">Semua <span> Blog Guru</span></h2>
                </div>
                <div class="page-breadcrumb-item ul-li">
                    <ul class="breadcrumb text-uppercase black">
                        <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                        <li class="breadcrumb-item active">BlogGuru</li>
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
                                            @foreach ($list_blog_teacher as $blog_teacher)
                                                <div class="col-md-6">
                                                    <div class="blog-post-img-content">
                                                        <div class="blog-img-date relative-position">
                                                            <div class="blog-thumnile">
                                                                <img src="{{ $blog_teacher->getThumbnail() }}"
                                                                    style="height: 300px width: 100%; object-fit: cover;"
                                                                    alt="">
                                                            </div>
                                                            <div class="course-price text-center gradient-bg">
                                                                <span>{{ $blog_teacher->created_at->diffForHumans() }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="course-meta">
                                                            <span class="course-author bold-font"><a
                                                                    href="{{ route('staff.detail', $blog_teacher->teacher->id) }}">{{ $blog_teacher->teacher->name }}</a></span>

                                                        </div>
                                                        <div class="blog-title-content headline">
                                                            <a href="{{ route('blog_teacher.show', $blog_teacher->slug) }}">
                                                                <h3>{{ $blog_teacher->title }}</h3>
                                                            </a>
                                                            <div class="blog-content">
                                                                {{ Str::limit(strip_tags($blog_teacher->content), 100) }}
                                                            </div>

                                                            <div class="course-viewer ul-li">
                                                                <ul>
                                                                    <li>
                                                                        <a href="">
                                                                            <i class="fas fa-user"></i>
                                                                            {{ $blog_teacher->viewers->count() }}
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="">
                                                                            <i class="fas fa-comment-dots"></i>
                                                                            {{ $blog_teacher->comments->count() }}
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="view-all-btn bold-font mt-3">
                                                                <a href="{{ route('blog_teacher.show', $blog_teacher->slug) }}">Read More
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
                                            @foreach ($list_blog_teacher as $blog_teacher)
                                                <div class="list-blog-item">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="blog-post-img-content">
                                                                <div class="blog-img-date relative-position">
                                                                    <div class="blog-thumnile">
                                                                        <img src="{{ $blog_teacher->getThumbnail() }}"
                                                                            alt="">
                                                                    </div>
                                                                    <div class="course-price text-center gradient-bg">
                                                                        <span>
                                                                            {{ $blog_teacher->created_at->diffForHumans() }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="blog-title-content headline">
                                                                <a href="{{ route('blog_teacher.show', $blog_teacher->slug) }}">
                                                                    <h3>{{ $blog_teacher->title }}</h3>
                                                                </a>
                                                                <div class="course-meta">
                                                                    <span class="course-author bold-font"><a
                                                                            href="{{ route('staff.detail', $blog_teacher->teacher->id) }}">{{ $blog_teacher->teacher->name }}</a></span>

                                                                </div>

                                                                <div class="blog-content">
                                                                    {{ Str::limit(strip_tags($blog_teacher->content), 100) }}
                                                                </div>
                                                                <div class="course-viewer ul-li">
                                                                    <ul>
                                                                        <li>
                                                                            <a href=""><i
                                                                                    class="fas fa-user"></i>{{ $blog_teacher->viewers->count() }}
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href=""><i
                                                                                    class="fas fa-comment-dots"></i>
                                                                                {{ $blog_teacher->comments->count() }}
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>

                                                                <div class="view-all-btn bold-font mt-3">
                                                                    <a href="{{ route('blog_teacher.show', $blog_teacher->slug) }}">Read
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
                                    @if ($list_blog_teacher->onFirstPage())
                                        <li class="pg-text"><a href="#">PREV</a></li>
                                    @else
                                        <li class="pg-text">
                                            <a
                                                href="{{ route('blog_teacher.index', ['page' => $list_blog_teacher->currentPage() - 1, 'q' => request()->q]) }}">PREV</a>
                                        </li>
                                    @endif

                                    @php
                                        // Menghitung halaman pertama dan terakhir yang akan ditampilkan
                                        $start = max($list_blog_teacher->currentPage() - 2, 1);
                                        $end = min($start + 4, $list_blog_teacher->lastPage());
                                    @endphp

                                    @if ($start > 1)
                                        <!-- Menampilkan tanda elipsis jika halaman pertama tidak termasuk dalam tampilan -->
                                        <li><a href="#">...</a></li>
                                    @endif

                                    @foreach ($list_blog_teacher->getUrlRange($start, $end) as $page => $url)
                                        @if ($page == $list_blog_teacher->currentPage())
                                            <li class="active"><a href="#">{{ $page }}</a></li>
                                        @else
                                            <li><a
                                                    href="{{ route('blog_teacher.index', ['page' => $page, 'q' => request()->q]) }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    @if ($end < $list_blog_teacher->lastPage())
                                        <li><a href="#">...</a></li>
                                    @endif

                                    @if ($list_blog_teacher->hasMorePages())
                                        <li class="pg-text"><a
                                                href="{{ route('blog_teacher.index', ['page' => $list_blog_teacher->currentPage() + 1, 'q' => request()->q]) }}">NEXT</a>
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

                            @include("front.components.latest-blog-teacher")


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
