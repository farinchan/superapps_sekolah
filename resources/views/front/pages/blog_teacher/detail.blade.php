@extends('front.app')

@section('seo')
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $meta_description }}">
    <meta name="keywords" content="{{ $meta_keywords }}">

    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $meta_description }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('blog_teacher.show', $blog_teacher->slug) }}">
    <link rel="canonical" href="{{ route('blog_teacher.show', $blog_teacher->slug) }}">
    <meta property="og:image" content="{{ $blog_teacher->getThumbnail() }}">
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
                    <h2 class="breadcrumb-head black bold">Detail <span>Blog </span></h2>
                </div>
                <div class="page-breadcrumb-item ul-li">
                    <ul class="breadcrumb text-uppercase black">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">blog_teacher</li>
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
                            <div class="blog-detail-thumbnile mb35">
                                <img src="{{ $blog_teacher->getThumbnail() }}" alt="" style="width: 100%">
                            </div>
                            <h2>{{ $blog_teacher->title }}</h2>

                            <div class="date-meta text-uppercase">
                                <span><i class="fas fa-calendar-alt"></i> {{ $blog_teacher->created_at->format('d M Y') }}
                                </span>
                                <span><i class="fas fa-user"></i> <a
                                        href="{{ route('staff.detail', $blog_teacher->teacher->id) }}">{{ $blog_teacher->teacher->name }}</a>
                                </span>
                                <span><i class="fas fa-comment-dots"></i> {{ $blog_teacher->comments->count() }}
                                    Komentar</span>
                                <span><i class="fas fa-eye"></i> {{ $blog_teacher->viewers->count() }} Dilihat</span>
                            </div>
                            <p>
                                {!! $blog_teacher->content !!}
                            </p>
                        </div>
                        <div class="blog-share-tag">
                            <div class="share-text float-left">
                                Bagikan this blog guru ini
                            </div>
                            <div class="share-social ul-li float-right">
                                <ul>
                                    <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ route('blog_teacher.show', $blog_teacher->slug) }}&t={{ $blog_teacher->title }}"
                                            target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="https://twitter.com/intent/tweet?url={{ route('blog_teacher.show', $blog_teacher->slug) }}&text={{ $blog_teacher->title }}"
                                            target="_blank"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('blog_teacher.show', $blog_teacher->slug) }}&title={{ $blog_teacher->title }}"
                                            target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a href="https://wa.me/?text={{ route('blog_teacher.show', $blog_teacher->slug) }}&title={{ $blog_teacher->title }}"
                                            target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        {{-- <div class="blog-category ul-li">
								<ul>
									<li><a href="#">fruits</a></li>
									<li><a href="#">veegetable</a></li>
									<li><a href="#">juices</a></li>
								</ul>
							</div> --}}
                        <div class="author-comment">
                            <div class="author-img">
                                <img src="{{ $blog_teacher->teacher->getPhoto() }}" alt="">
                            </div>
                            <div class="author-designation-comment">
                                BY: <span>
                                    <a
                                        href="{{ route('staff.detail', $blog_teacher->teacher->id) }}">{{ $blog_teacher->teacher->name }}</a>
                                </span>
                                <p>
                                    {{ Str::limit(strip_tags($blog_teacher->teacher->about), 200) }}
                                </p>
                            </div>
                        </div>
                        <div class="next-prev-post">
                            @if ($prev_blog_teacher)
                                <div class="next-post-item float-left">
                                    <a href="{{ route('blog_teacher.show', $prev_blog_teacher->slug) }}"><i
                                            class="fas fa-arrow-circle-left"></i>Blog Sebelumnya</a>
                                </div>
                            @endif

                            @if ($next_blog_teacher)
                                <div class="next-post-item float-right">
                                    <a href="{{ route('blog_teacher.show', $next_blog_teacher->slug) }}">Blog Selanjutnya<i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if ($related_blog_teacher->count() > 0)
                        <div class="blog-recent-post about-teacher-2">
                            <div class="section-title-2  headline text-left">
                                <h2>Blog <span>Terkait.</span></h2>
                            </div>
                            <div class="recent-post-item">
                                <div class="row">
                                    @foreach ($related_blog_teacher as $related)
                                        <div class="col-md-6">
                                            <div class="blog-post-img-content">
                                                <div class="blog-img-date relative-position">
                                                    <div class="blog-thumnile">
                                                        <img src="{{ $related->getThumbnail() }}" alt="">
                                                    </div>
                                                    <div class="course-price text-center gradient-bg">
                                                        <span>26 April 2018</span>
                                                    </div>
                                                </div>
                                                <div class="blog-title-content headline">
                                                    <h3><a
                                                            href="{{ route('blog_teacher.show', $related->slug) }}">{{ $related->title }}</a>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="blog-comment-area ul-li about-teacher-2">
                        @if ($comments->count() > 0)
                            <div class="section-title-2  headline text-left">
                                <h2><span>Komentar</span></h2>
                            </div>

                            <ul class="comment-list">
                                @foreach ($comments as $comment)
                                    <li style="width: 100%">
                                        <div class=" comment-avater">
                                            <img src="https://ui-avatars.com/api/?background=000C32&color=fff&name={{ $comment->name }}"
                                                alt="" style="border-radius: 50%">
                                        </div>

                                        <div class="author-name-rate">
                                            <div class="author-name float-left">
                                                BY: <span>{{ $comment->name }}</span>
                                            </div>
                                            <div class="time-comment float-right">
                                                {{ $comment->created_at->diffForHumans() }}</div>
                                        </div>
                                        <div class="author-designation-comment">
                                            <p>
                                                {{ $comment->comment }}
                                            </p>
                                        </div>
                                    </li>
                                @endforeach


                            </ul>
                        @endif


                        <div class="reply-comment-box">
                            <div class="section-title-2  headline text-left">
                                <h2>Tambahkan <span>Komentar.</span></h2>
                            </div>

                            <div class="teacher-faq-form">
                                <form method="POST" action="{{ route('blog_teacher.comment', $blog_teacher->slug) }}"
                                    data-lead="Residential">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="name">Nama Anda</label>
                                            <input type="text" name="name" id="name" required="required"
                                                value="{{ old('name') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone">Alamat Email</label>
                                            <input type="tel" name="email" id="email" required="required"
                                                value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <label for="comments">Komentar</label>
                                    <textarea name="comment" id="comment" rows="2" cols="20" required="required">{{ old('comment') }}</textarea>
                                    <div class="nws-button text-center  gradient-bg text-uppercase">
                                        <button type="submit" value="Submit">Send Message now</button>
                                    </div>
                                </form>
                            </div>
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

                        {{-- @include("front.components.blog_teacher-categories") --}}

                        @include('front.components.latest-blog-teacher')


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
