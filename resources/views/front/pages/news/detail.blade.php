@extends('front.app')

@section("seo")
<title>{{ $title }}</title>
<meta name="description" content="{{ $meta_description }}">
<meta name="keywords" content="{{ $meta_keywords }}">

<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $meta_description }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ route('news.show', $news->slug) }}">
<link rel="canonical" href="{{ route('news.show', $news->slug) }}">
<meta property="og:image" content="{{ $news->getThumbnail() }}">

@endsection

@section("styles")

@endsection

@section('content')
<!-- Start of breadcrumb section
		============================================= -->
		<section id="breadcrumb" class="breadcrumb-section relative-position backgroud-style">
			<div class="blakish-overlay"></div>
			<div class="container">
				<div class="page-breadcrumb-content text-center">
					<div class="page-breadcrumb-title">
						<h2 class="breadcrumb-head black bold">Detail <span>Berita  </span></h2>
					</div>
					<div class="page-breadcrumb-item ul-li">
						<ul class="breadcrumb text-uppercase black">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">News</li>
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
									<img src="{{ $news->getThumbnail() }}" alt="" style="width: 100%">
								</div>
								<h2>{{ $news->title }}</h2>

								<div class="date-meta text-uppercase">
									<span><i class="fas fa-calendar-alt"></i> {{ $news->created_at->format('d M Y') }} </span>
									<span><i class="fas fa-user"></i> <a href="{{ route('staff.detail', $news->user?->teacher?->id) }}">{{ $news->user?->teacher?->name }}</a> </span>
									<span><i class="fas fa-comment-dots"></i> {{ $news->comments->count() }} Komentar</span>
                                    <span><i class="fas fa-eye"></i> {{ $news->viewers->count() }} Dilihat</span>
								</div>
                                <p>
                                    {!! $news->content !!}
                                </p>
							</div>
							<div class="blog-share-tag">
								<div class="share-text float-left">
									Share this news
								</div>
								<div class="share-social ul-li float-right">
									<ul>
										<li><a href="https://www.facebook.com/sharer/sharer.php?u={{ route("news.show", $news->slug) }}&t={{ $news->title }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
										<li><a href="https://twitter.com/intent/tweet?url={{ route("news.show", $news->slug) }}&text={{ $news->title }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
										<li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ route("news.show", $news->slug) }}&title={{ $news->title }}" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li><a href="https://wa.me/?text={{ route("news.show", $news->slug) }}&title={{ $news->title }}" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
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
							{{-- <div class="author-comment">
								<div class="author-img">
									<img src="assets/img/blog/ath.jpg" alt="">
								</div>
								<div class="author-designation-comment">
									BY: <span>FRANK LAMPARD</span>
									<p>
										Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
									</p>
								</div>
							</div> --}}
							<div class="next-prev-post">
                                @if ($prev_news)
                                    <div class="next-post-item float-left">
                                        <a href="{{ route("news.show", $prev_news->slug) }}"><i class="fas fa-arrow-circle-left"></i>Berita Sebelumnya</a>
                                    </div>
                                @endif

                                @if ($next_news)
                                    <div class="next-post-item float-right">
                                        <a href="{{ route("news.show", $next_news->slug) }}">Berita Selanjutnya<i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                @endif
							</div>
						</div>

						<div class="blog-recent-post about-teacher-2">
							<div class="section-title-2  headline text-left">
								<h2>Berita <span>Terkait.</span></h2>
							</div>
							<div class="recent-post-item">
								<div class="row">
                                    @foreach ( $related_news as $related )
                                    <div class="col-md-6">
										<div class="blog-post-img-content">
											<div class="blog-img-date relative-position">
												<div class="blog-thumnile">
													<img src="{{ $related->getThumbnail() }}" alt="">
												</div>
												<div class="course-price text-center gradient-bg">
													<span>{{ $related->created_at->format('d M Y') }}</span>
												</div>
											</div>
											<div class="blog-title-content headline">
												<h3><a href="{{ route("news.show", $related->slug) }}">{{ $related->title }}</a></h3>
											</div>
										</div>
									</div>
                                    @endforeach


								</div>
							</div>
						</div>

						<div class="blog-comment-area ul-li about-teacher-2">
							<div class="section-title-2  headline text-left">
								<h2>Post <span>Comments.</span></h2>
							</div>

							<ul class="comment-list">
                                @foreach ($comments as $comment)
                                <li style="width: 100%">
									<div class=" comment-avater">
										<img src="https://ui-avatars.com/api/?background=000C32&color=fff&name={{  $comment->name }}" alt="" style="border-radius: 50%">
									</div>

									<div class="author-name-rate">
										<div class="author-name float-left">
											BY: <span>{{  $comment->name }}</span>
										</div>
										<div class="time-comment float-right">{{  $comment->created_at->diffForHumans() }}</div>
									</div>
									<div class="author-designation-comment">
										<p>
											{{  $comment->comment }}
										</p>
									</div>
								</li>
                                @endforeach


							</ul>

							<div class="reply-comment-box">
								<div class="section-title-2  headline text-left">
									<h2>Tambahkan  <span>Komentar.</span></h2>
								</div>

								<div class="teacher-faq-form">
									<form method="POST" action="{{ route("news.comment", $news->slug ) }}" data-lead="Residential">
                                        @csrf
										<div class="row">
											<div class="col-md-6">
												<label for="name">Nama Anda</label>
												<input type="text" name="name" id="name" required="required" value="{{ old('name') }}">
											</div>
											<div class="col-md-6">
												<label for="phone">Alamat Email</label>
												<input type="tel" name="email" id="email" required="required" value="{{ old('email') }}">
											</div>
										</div>
										<label for="comments">Komentar</label>
										<textarea name="comment" id="comment" rows="2" cols="20" required="required">
                                            {{ old('comment') }}
                                        </textarea>
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
                                    <input type="text" class="" placeholder="Search" name="q" value="{{ request('q') }}">
                                    <button type="submit"><i class="fas fa-search"></i></button>
                                </form>
                            </div>

                           @include("front.components.news-categories")

                           @include("front.components.latest-news")


                        </div>
                    </div>
				</div>
			</div>
		</section>
	<!-- End of Blog single content
		============================================= -->
@endsection

@section("scripts")

@endsection
