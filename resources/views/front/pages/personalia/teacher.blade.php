@extends('front.app')

@section('seo')
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
                            @if (request()->routeIs('teacher'))
                                Tenaga Pendidik
                            @endif
                            @if (request()->routeIs('staff'))
                                Tenaga Kependidikan
                            @endif

                        </span></h2>

                </div>
                <div class="page-breadcrumb-item ul-li">
                    <ul class="breadcrumb text-uppercase black">
                        <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                        <li class="breadcrumb-item active">Tenaga Pendidik</li>
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
							<div class="row">
                                @foreach ($list_teacher as $teacher)

								<div class="col-md-4 col-sm-6">
									<div class="teacher-pic-content">
										<div class="teacher-img-content relative-position">
											<img src="{{ $teacher->getPhoto() }}" alt="">
											<div class="teacher-hover-item">
												<div class="teacher-social-name ul-li-block">
													<ul>
														<li><a href="{{ $teacher->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                                                        <li><a href="{{ $teacher->instagram }}"><i class="fab fa-instagram"></i></a></li>
                                                        <li><a href="{{ $teacher->linkedin }}"><i class="fab fa-linkedin"></i></a></li>
													</ul>
												</div>
												<div class="teacher-text">
													{{ Str::limit(strip_tags($teacher->about), 70) }}
												</div>
											</div>
											<div class="teacher-next text-center">
												<a href="{{ route("staff.detail", $teacher->id) }}"><i class="text-gradiant fas fa-arrow-right"></i></a>
											</div>
										</div>
										<div class="teacher-name-designation">
                                            <a href="{{ route("staff.detail", $teacher->id) }}"><span class="teacher-name">{{ $teacher->name }}</span></a>

											<span class="teacher-designation">{{ $teacher->position }}</span>
										</div>
									</div>
								</div>
                                @endforeach
							</div>
							<div class="couse-pagination text-center ul-li">
                                <ul>
                                    @if ($list_teacher->onFirstPage())
                                        <li class="pg-text"><a href="#">PREV</a></li>
                                    @else
                                        <li class="pg-text">
                                            <a
                                                href="{{ route('teacher', ['page' => $list_teacher->currentPage() - 1, 'q' => request()->q]) }}">PREV</a>
                                        </li>
                                    @endif

                                    @php
                                        // Menghitung halaman pertama dan terakhir yang akan ditampilkan
                                        $start = max($list_teacher->currentPage() - 2, 1);
                                        $end = min($start + 4, $list_teacher->lastPage());
                                    @endphp

                                    @if ($start > 1)
                                        <!-- Menampilkan tanda elipsis jika halaman pertama tidak termasuk dalam tampilan -->
                                        <li><a href="#">...</a></li>
                                    @endif

                                    @foreach ($list_teacher->getUrlRange($start, $end) as $page => $url)
                                        @if ($page == $list_teacher->currentPage())
                                            <li class="active"><a href="#">{{ $page }}</a></li>
                                        @else
                                            <li><a
                                                    href="{{ route('teacher', ['page' => $page, 'q' => request()->q]) }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    @if ($end < $list_teacher->lastPage())
                                        <li><a href="#">...</a></li>
                                    @endif

                                    @if ($list_teacher->hasMorePages())
                                        <li class="pg-text"><a
                                                href="{{ route('teacher', ['page' => $list_teacher->currentPage() + 1, 'q' => request()->q]) }}">NEXT</a>
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

                            <div class="side-bar-widget">
                                <h2 class="widget-title text-capitalize"><span>Kategori</span> berita.</h2>
                                <div class="post-categori ul-li-block">
                                    <ul>
                                        @foreach ($categories as $category)
                                            <li class="cat-item"><a
                                                    href="{{ route('news.category', $category->id) }}">{{ $category->name }}
                                                    ({{ $category->news->count() }})
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

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
