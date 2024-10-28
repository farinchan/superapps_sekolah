@extends('front.app')

@section('seo')
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $meta_description }}">
    <meta name="keywords" content="{{ $meta_keywords }}">
    <meta name="author" content="Fajri Rinaldi Chan">

    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $meta_description }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('home') }}">
    <link rel="canonical" href="{{ route('home') }}">
    <meta property="og:image" content="{{ Storage::url($favicon) }}">
@endsection

@section('styles')
    <style>
        .mfp-img {
            width: auto;
            max-width: 100%;
            height: auto;
            max-height: 100%;
            display: block;
            margin: 0 auto;
        }
    </style>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth'
            });
            calendar.render();
        });
    </script>
    {{-- <style>
        #calendar {
            max-width: 900px;
            margin: 0 auto;
            padding: 40px 0;
        }
    </style> --}}
@endsection

@section('content')
    <!-- Start of slider section
                                                                                                                                                      ============================================= -->
    <section id="slide" class="slider-section">
        <div id="slider-item" class="slider-item-details">
            @foreach ($list_banner as $banner)
                <div class="slider-area slider-bg-1 relative-position"
                    style="background-image: url({{ $banner->getImage() }});">
                    <div class="slider-text">
                        <div class="section-title mb20 headline text-center ">
                            {{-- <div class="layer-1-1">
                                <span class="subtitle text-uppercase">Selamat Datang di</span>
                            </div> --}}
                            <div class="layer-1-3">
                                <h2 style="font-size: 60px;">{{ $banner->title }}
                                    <br><span>{{ $banner->subtitle }}</span>
                                </h2>
                            </div>
                        </div>
                        <div class="layer-1-4">
                            <div id="course-btn">
                                <div class="genius-btn  text-center text-uppercase ul-li-block bold-font">
                                    <a href="#">Lebih Lanjut <i class="fas fa-caret-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </section>
    <!-- End of slider section
                                                                                                                                                    ============================================= -->

    <!-- Start Latest News
                                                                                                                                                    ============================================= -->
    <section id="popular-course" class="popular-course-section mt-5">
        <div class="container">
            <div class="section-title mb20 headline text-left ">
                <span class="subtitle text-uppercase">MAN 1 Padang Panjang</span>
                <h2><span>Berita</span> Terbaru.</h2>
            </div>
            <div id="course-slide-item" class="course-slide">

                @foreach ($list_news as $news)
                    <div class="course-item-pic-text ">
                        <div class="course-pic relative-position mb25">
                            <img src="{{ $news->getThumbnail() }}" alt="">
                            {{-- <div class="course-price text-center gradient-bg">
                                <span>$99.00</span>
                            </div> --}}
                            <div class="course-details-btn">
                                <a href="{{ route('news.show', $news->slug) }}">selengkapnya <i
                                        class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <div class="course-item-text">
                            <div class="course-meta">
                                <span class="course-category bold-font"><a
                                        href="{{ route('news.category', $news->category->name) }}">{{ $news->category->name }}</a></span>
                                <span class="course-author bold-font"><a href="#">Humas</a></span>

                            </div>
                            <div class="course-title mt10 headline pb45 relative-position">
                                <h3><a href="{{ route('news.show', $news->slug) }}">{{ $news->title }}</a>
                                    @if ($news->created_at->diffInDays() < 7)
                                        <span class="trend-badge text-uppercase bold-font"><i class="fas fa-bolt"></i>
                                            terbaru
                                        </span>
                                    @endif
                                </h3>
                            </div>
                            <div class="course-viewer ul-li">
                                <ul>
                                    <li><a href=""><i class="fas fa-user"></i> {{ $news->viewers->count() }} </a>
                                    </li>
                                    <li><a href=""><i class="fas fa-comment-dots"></i>
                                            {{ $news->comments->count() }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
    <!-- End Latest News
                                                                                                                                                    ============================================= -->

    <!-- Start latest section
                                                                                                                                                    ============================================= -->
    <section id="latest-area" class="latest-area-section">
        <div class="container">
            <div class="row">

                <div class="col-md-7">
                    <div class="latest-area-content ">
                        <div class="section-title-2 mb65 headline text-left">
                            <h2><span>Agenda</span></h2>
                        </div>
                        <div class="row">
                            @foreach ($list_agenda as $agenda)
                                <div class="col-md-6">
                                    <div class="latest-events">
                                        <div class="latest-event-item">
                                            <div class="events-date  relative-position text-center">
                                                <div class="gradient-bdr"></div>
                                                <span
                                                    class="event-date bold-font">{{ Carbon\Carbon::parse($agenda->start)->format('d') }}</span>
                                                {{ Carbon\Carbon::parse($agenda->start)->format('M Y') }}
                                            </div>
                                            <div class="event-text">
                                                <h3 class="latest-title bold-font"><a href="{{ route('event.show', $agenda->slug) }}">
                                                        {{ $agenda->title }}
                                                    </a></h3>
                                                {{-- <div class="course-meta">
                                                    <span class="course-category"><a href="#">HUMAS</a></span>
                                                    <span class="course-author"><a href="#">HUMAS</a></span>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="view-all-btn bold-font">
                            <a href="#">Check Calendar <i class="fas fa-calendar-alt"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="latest-area-content ">
                        <div class="section-title-2 mb65 headline text-left">
                            <h2><span>Kalender</span> Akademik.</h2>
                        </div>
                        <div id='calendar'></div>
                    </div>
                </div>

                <!-- /. -->
            </div>
        </div>
    </section>
    <!-- End latest section
                                                                                                                                                    ============================================= -->

    <!-- Start why choose section
                                                                                                                                                  ========================================= ==== -->
    <section id="why-choose" class="why-choose-section backgroud-style">
        <div class="container">
            <div class="section-title mb20 headline text-center ">
                <span class="subtitle text-uppercase">Sekapur Sirih</span>
                <h2><span>Kepala</span> MAN 1 Padang Panjang</h2>
            </div>
            <div class="extra-features-content">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="extra-pic text-center ">
                            <img src="{{ $sekapur_sirih->getImage() }}" alt="img">
                        </div>
                    </div>

                    <div class="pl-5 col-sm-8">
                        <div class="about-us-text">
                            <div class="section-title relative-position mb20 headline text-left">
                                <h2 style="font-size: 40px;">{{ $sekapur_sirih->name }}</h2>
                            </div>
                            <div class="about-content-text">
                                <p class="text-white">Assalaamu'alaikum Warahmatullahi Wabarakatuh.</p>
                                <p class="text-white">
                                    {{ Str::limit(strip_tags($sekapur_sirih->content), 400) }}
                                </p>

                                <div class="about-btn ">
                                    <div class="genius-btn gradient-bg text-center text-uppercase ul-li-block bold-font">
                                        <a href="{{ route('sekapur_sirih') }}">Lihat Selengkapnya <i
                                                class="fas fa-caret-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /col-sm-3 -->
                </div><!-- /row -->
            </div>
        </div>
    </section>
    <!-- End why choose section
                                                                                                                                                  ============================================= -->


    <!-- Start of Search Courses
                                                                                                                                    ============================================= -->
    <section id="search-course" class="search-course-section">
        <div class="container">
            <div class="section-title mb20 headline text-center mb-5">
                <span class="subtitle text-uppercase">MAN 1 Padang Panjang</span>
                <h2><span>Data</span> Mengenai kami.</h2>
            </div>
            {{-- <div class="search-course mb30 relative-position ">
            <form action="#" method="post">
                <input class="course" name="course" type="text"
                    placeholder="Type what do you want to learn today?">
                <div class="nws-button text-center  gradient-bg text-capitalize">
                    <button type="submit" value="Submit">Search Course</button>
                </div>
            </form>
        </div> --}}
            <div class="search-counter-up">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="counter-icon-number ">
                            <div class="counter-icon">
                                <i class="text-gradiant flaticon-graduation-hat"></i>
                            </div>
                            <div class="counter-number">
                                <span class="counter-count bold-font">
                                    {{ $tenaga_pendidik_count }}
                                </span>
                                <p>Tenaga Pendidik</p>
                            </div>
                        </div>
                    </div>
                    <!-- /counter -->

                    <div class="col-md-3 col-sm-6">
                        <div class="counter-icon-number ">
                            <div class="counter-icon">
                                <i class="text-gradiant flaticon-book"></i>
                            </div>
                            <div class="counter-number">
                                <span class="counter-count bold-font">{{ $tenaga_kependidikan_count }}</span>
                                <p>Tenaga Kependidikan</p>
                            </div>
                        </div>
                    </div>
                    <!-- /counter -->

                    <div class="col-md-3 col-sm-6">
                        <div class="counter-icon-number ">
                            <div class="counter-icon">
                                <i class="text-gradiant flaticon-favorites-button"></i>
                            </div>
                            <div class="counter-number">
                                <span class="counter-count bold-font">{{ $siswa_count }}</span>
                                <p>Siswa Aktif</p>
                            </div>
                        </div>
                    </div>
                    <!-- /counter -->

                    <div class="col-md-3 col-sm-6">
                        <div class="counter-icon-number ">
                            <div class="counter-icon">
                                <i class="text-gradiant flaticon-group"></i>
                            </div>
                            <div class="counter-number">
                                <span class="counter-count bold-font">{{ $alumni_count }}</span><span>RB+</span>
                                <p>Alumni</p>
                            </div>
                        </div>
                    </div>
                    <!-- /counter -->
                </div>
            </div>
        </div>
    </section>
    <!-- End of Search Courses
                                                            ============================================= -->

    <!-- Start prestasi section
                                                               ============================================= -->
    <section id="latest-area" class="latest-area-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-area-content  ">
                        <div class="section-title mb45 headline text-center ">
                            {{-- <span class="subtitle text-uppercase">COURSES CATEGORIES</span> --}}
                            <h2><span>Prestasi</span> Siswa.</h2>
                        </div>
                        <div class="latest-news-posts">
                            <div class="row">
                                @foreach ($list_student_achievement as $student_achievement)
                                    <div class="col-md-4">
                                        <div class="latest-news-area" style="max-width: 100%;">
                                            <div class="latest-news-thumbnile relative-position">
                                                <img src="{{ $student_achievement->getImage() }}" alt="">
                                                <div class="hover-search">
                                                    <i class="fas fa-search"></i>
                                                </div>
                                                <div class="blakish-overlay"></div>
                                            </div>
                                            <div class="date-meta">
                                                <i class="fas fa-trophy"></i> {{ $student_achievement->rank }} -
                                                {{ $student_achievement->level }}
                                            </div>
                                            <h3 class="latest-title bold-font"><a href="{{ route('achievement.student.detail', $student_achievement->id ) }}">
                                                    {{ Str::limit($student_achievement->name . ' - ' . $student_achievement->event, 50) }}
                                                </a></h3>
                                            <div class="course-viewer ul-li">
                                                <ul>
                                                    <li><a href=""><i class="fas fa-user"></i>
                                                            {{ $student_achievement->student->name }}</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="view-all-btn bold-font">
                                <a href="{{ route('achievement.student') }}">Lihat semua prestasi siswa <i
                                        class="fas fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End prestasi section
                                                               ============================================= -->

    <!-- Start Course category
                                                                                                                                        ============================================= -->
    <section id="course-category" class="course-category-section">
        <div class="container">
            <div class="section-title mb45 headline text-center ">
                {{-- <span class="subtitle text-uppercase">COURSES CATEGORIES</span> --}}
                <h2><span> Ekstrakurikuler</span></h2>
            </div>
            <div class="category-item">
                <div class="row">
                    @foreach ($list_extracurricular as $extracurricular)
                        <div class="col-md-3"><a href="{{ route('extracurricular.show', $extracurricular->slug) }}">

                                <div class="category-icon-title text-center ">
                                    <div class="category-icon">
                                        {{-- <i class="text-gradiant flaticon-technology"></i> --}}
                                        <img src="{{ $extracurricular->getLogo() }}" alt=""
                                            style="width: 100px;">
                                    </div>
                                    <div class="category-title">
                                        <h4>{{ $extracurricular->name }}</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    <!-- /category -->

                </div>
            </div>
        </div>
    </section>
    <!-- End Course category
                                                                    ============================================= -->



    <!-- Start of course teacher
                                                                                                                                    ============================================= -->
    <section id="course-teacher" class="course-teacher-section">
        <div class="jarallax">
            <div class="container">
                <div class="section-title mb20 headline text-center ">
                    <span class="subtitle text-uppercase">Tenaga Pendidik</span>
                    <h2><span>Guru</span> MAN 1 Padang Panjang</h2>
                </div>

                <div class="teacher-list">
                    <div class="row justify-content-center">
                        @foreach ($list_teacher as $teacher)
                            <div class="col-md-3">
                                <div class="teacher-img-content ">
                                    <div class="teacher-cntent">
                                        <div class="teacher-social-name ul-li-block">
                                            <ul>
                                                <li><a href="{{ $teacher->facebook }}" target="_blank"><i
                                                            class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="{{ $teacher->instagram }}" target="_blank"><i
                                                            class="fab fa-instagram"></i></a></li>
                                                <li><a href="{{ $teacher->linkedin }}" target="_blank"><i
                                                            class="fab fa-linkedin"></i></a></li>

                                            </ul>
                                            {{-- <div class="teacher-name">
                                                <span>
                                                    {{ $teacher->name }}
                                                </span>
                                            </div> --}}
                                        </div>
                                        <div class="teacher-img-category">
                                            <div class="teacher-img">
                                                <img src="{{ $teacher->getPhoto() }}" alt="">
                                                <div class="course-price text-uppercase text-center gradient-bg">
                                                    <span>Featured</span>
                                                </div>
                                            </div>
                                            <div class="teacher-category float-right">
                                                <a href="{{ route('staff.detail', $teacher->id) }}"><span
                                                        style="font-size: 18px;" class="st-name">{{ $teacher->name }}
                                                    </span></a>

                                                <br>
                                                <div class="float-right" style="font-size: 14px; color: #e0e0e0;">
                                                    {{ $teacher->position }}
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <div class="genius-btn gradient-bg text-center text-uppercase ul-li-block bold-font ">
                        <a href="{{ route('teacher') }}">Lihat Semua Guru <i class="fas fa-caret-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of course teacher
                                                                                                                                    ============================================= -->

    <!-- Start of best course
                                                                                                                                    ============================================= -->
    <section id="best-course" class="best-course-section">
        <div class="container">
            <div class="section-title mb45 headline text-center ">
                <span class="subtitle text-uppercase">Lihat Publikasi Guru Kami</span>
                <h2>Blog<span> Guru</span></h2>
            </div>
            <div class="best-course-area mb45">
                <div class="row">
                    @foreach ($list_blog_teacher as $blog_teacher)
                        <div class="col-md-3">
                            <div class="best-course-pic-text relative-position ">
                                <div class="best-course-pic relative-position">
                                    <img src="{{ $blog_teacher->getThumbnail() }}" alt=""
                                        style="height: 200px; width: 100%; object-fit: cover;">
                                    @if ($blog_teacher->viewers->count() > 100)
                                        <div class="trend-badge-2 text-center text-uppercase">
                                            <i class="fas fa-bolt"></i>
                                            <span>Trending</span>
                                        </div>
                                    @endif
                                    <div class="course-details-btn">
                                        <a href="{{ route('blog_teacher.show', $blog_teacher->slug) }}">Selengkapnya <i
                                                class="fas fa-arrow-right"></i></a>
                                    </div>
                                    <div class="blakish-overlay"></div>
                                </div>
                                <div class="best-course-text">
                                    <div class="course-title mb20 headline relative-position">
                                        <h3><a href="{{ route('blog_teacher.show', $blog_teacher->slug) }}">
                                                {{ Str::limit($blog_teacher->title, 65) }}
                                            </a></h3>
                                    </div>
                                    <div class="course-meta">
                                        <span class="course-category"><a
                                                href=" {{ route('staff.detail', $blog_teacher->teacher->id) }}">{{ $blog_teacher->teacher->name }}</a></span>
                                        <span class="course-author"><a href="#">
                                                {{ $blog_teacher->viewers->count() }} dilihat</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="view-all-btn bold-font">
                <a href="{{ route('blog_teacher.index') }}">Lihat Semua Blog Guru <i class="far fa-newspaper"></i></a>
            </div>
        </div>
    </section>
    <!-- End of best course
          ============================================= -->


    <!-- Start of genius teacher v2
           ============================================= -->
    <section id="genius-teacher-2" class="genius-teacher-section-2 mt-5">
        <div class="container">
            <div class="section-title-2 mb65 headline text-left ">
                <h2><span>Galeri</span> Foto & Video.</h2>
            </div>
            <div class="teacher-third-slide">

                @foreach ($list_album as $album)
                    <div class="best-course-pic-text relative-position ">
                        <div class="best-course-pic relative-position">
                            <img src="{{ $album->getThumbnail() }} " alt="" style="height: 200px; width: 100%; object-fit: cover;">
                            <div class="course-details-btn">
                                <a href=" {{ route('gallery.show', $album->slug) }}">{{ $album->title }} &nbsp; <i class="fas fa-arrow-right"></i></a>
                            </div>
                            <div class="blakish-overlay"></div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- End of genius teacher v2
         ============================================= -->


    <!-- Start of genius teacher v2
           ============================================= -->
    <section id="genius-teacher-2" class="genius-teacher-section-2 mt-5">
        <div class="container">
            <div class="section-title-2 mb65 headline text-left ">
                <h2><span>Instagram</span> Post.</h2>
            </div>
            <div class="teacher-third-slide">
                @foreach ($instagram_feed['feed'] as $instagram)
                    @php
                        $image = '';
                        $popup = '';
                        if ($instagram->type == 'image') {
                            $image = $instagram->url;
                            $popup = $instagram->url;
                        } elseif ($instagram->type == 'video') {
                            $image = $instagram->thumbnail_url;
                            $popup = $instagram->url;
                        } elseif ($instagram->type == 'carousel') {
                            foreach ($instagram->children as $child) {
                                if ($child['type'] == 'image') {
                                    $image = $child['url'];
                                    $popup = $child['url'];
                                    break;
                                } else {
                                    $image = $child['thumbnail_url'];
                                    $popup = $child['url'];
                                    break;
                                }
                            }
                        }
                    @endphp
                    <div class="teacher-img-content relative-position">
                        <img src="{{ $image }}" alt=""
                            style="height: 100%; width: 100%; object-fit: cover;">
                        <div class="teacher-cntent">
                            <div class="teacher-social-name ul-li-block">
                                <ul>
                                    <li><a class="image-popup" href="{{ $popup }}"><i class="fas fa-eye"></i></a>
                                    </li>
                                    <li><a href="{{ $instagram->permalink }}"><i class="fas fa-heart"></i></a></li>
                                    <li><a href="{{ $instagram->permalink }}"><i class="fas fa-comment"></i></i></a></li>
                                    <li><a href="{{ $instagram->permalink }}"><i class="fab fa-telegram-plane"></i></a>
                                    </li>
                                </ul>
                                {{-- <div class="teacher-name">
                                        {{ $loop->iteration }}. {{ $instagram->type }}
                                    </div> --}}
                            </div>
                        </div>
                        {{-- <div class="teacher-category float-right">
                                <span class="st-name">Mobile Apps </span>
                            </div> --}}
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- End of genius teacher v2
         ============================================= -->


    <!-- Start of sponsor section
                                                                                                        ============================================= -->
    <section id="sponsor" class="sponsor-section">
        <div class="container">
            <div class="section-title-2 mb65 headline text-left ">
                <h2><span>Video</span> Youtube Terbaru</h2>
            </div>
            <div class="row" id="youtube">
            </div>
    </section>
    <!-- End of sponsor section
                                                                                                     ============================================= -->

    <!-- Start of sponsor section
                                                                                                        ============================================= -->
    <section id="sponsor" class="sponsor-section">
        <div class="container">
            <div class="section-title-2 mb65 headline text-left ">
                <h2><span>Partner</span> Link</h2>
            </div>
            <div class="sponsor-item sponsor-1 ">
                @foreach ($list_partner as $partner)
                    <div class="sponsor-pic text-center">
                        <a href="{{ $partner->url }}" target="_blank"><img src="{{ $partner->getLogo() }}"
                                alt=""></a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End of sponsor section
                                                                                                     ============================================= -->



    <!-- Start of Search Courses
                                                                                                                                    ============================================= -->
    <section id="search-course" class="search-course-section home-secound-course-search backgroud-style">
        <div class="container">


            <div class="search-app">
                <div class="row">
                    <div class="col-md-6">
                        <div class="app-mock-up">
                            <img src="https://jthemes.net/themes/html/genius-course/assets/img/about/ab-2.png"
                                alt="">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="about-us-text search-app-content">
                            <div class="section-title relative-position mb20 headline text-left">
                                <h2><span>Download</span> Aplikasi MAN 1 Padang Panjang di <span>PlayStore.</span></h2>
                            </div>

                            <div class="app-details-content">
                                <p>
                                    Kami perkenalkan aplikasi MAN 1 Padang Panjang yang dapat membantu siswa, guru, dan
                                    orang tua dalam memperoleh informasi terkait kegiatan sekolah, nilai, dan lainnya.

                                </p>

                                {{-- <div class="about-list mb30 ul-li-block">
                                    <ul>
                                        <li>Professional And Experienced Since 1980</li>
                                        <li>Our Mission Increasing Global Access To Quality Aducation</li>
                                        <li>100K Online Available Courses</li>
                                    </ul>
                                </div> --}}
                                <div class="about-btn">
                                    <div
                                        class="genius-btn gradient-bg text-center text-uppercase ul-li-block bold-font float-left">
                                        <a href="#">Download </a>
                                    </div>

                                    <div class="app-stor ul-li mt10">
                                        <ul>
                                            <li><a href="#"><i class="fab fa-android"></i></a></li>
                                            <li><a href="#"><i class="fab fa-apple"></i></a></li>
                                            <li><a href="#"><i class="fab fa-windows"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of Search Courses
                                                                                                                                                      ============================================= -->
@endsection

@section('scripts')
    <script>
        $('.image-popup').magnificPopup({
            gallery: {
                enabled: true // Aktifkan galeri untuk navigasi antar gambar
            },
            callbacks: {
                elementParse: function(item) {
                    // Hanya jika URL benar-benar berisi ekstensi gambar (.jpg, .png, .gif, .jpeg, .heic)
                    if (item.src.match(/\.(jpg|jpeg|png|gif|heic)$/i)) {
                        item.type = 'image'; // Tetapkan sebagai gambar
                    }
                    // Deteksi video dari ekstensi MP4 atau URL platform (seperti Instagram)
                    else if (item.src.match(/\.(mp4)$/i)) {
                        item.type = 'iframe'; // Tetapkan sebagai iframe untuk video MP4
                    }
                    // Jika ada deteksi spesifik dari platform seperti Instagram
                    else if (item.src.indexOf('instagram') !== -1 && item.src.indexOf('.mp4') !== -1) {
                        item.type = 'iframe'; // Tetapkan iframe untuk video Instagram MP4
                    } else {
                        item.type = 'image'; // Default ke gambar jika tidak jelas
                    }
                }
            }
        });
    </script>
    <script>
        var youtube = document.getElementById('youtube');
        fetch(
                'https://www.googleapis.com/youtube/v3/search?key={{ env('GOOGLE_API_KEY') }}&channelId=UCAWYvs8B_MPdRpKGd1rOWOQ&part=snippet,id&type=video&order=date&maxResults=8'
            )
            .then(response => response.json())
            .then(data => {
                items = data.items;
                items.forEach(item => {

                    if (item.id.kind === 'youtube#video') {
                        youtube.innerHTML += `
                        <div class="col-md-3">
                            <div class="latest-video-poster relative-position mb20">
                                <img src="${item.snippet.thumbnails.high.url}" alt="">
                                <div class="video-play-btn text-center gradient-bg">
                                    <a class="popup-youtube" href="https://www.youtube.com/watch?v=${item.id.videoId}"><i
                                            class="fas fa-play"></i></a>
                                </div>
                            </div>
                            <div class="vidoe-text">
                                <h3 class="latest-title bold-font"><a href="#">${item.snippet.title}</a>
                                </h3>
                                <p class="mb25">${item.snippet.description}</p>
                            </div>
                        </div>
                        `

                        $(`.popup-youtube`).magnificPopup({
                            type: 'iframe',
                            iframe: {
                                markup: '<div class="mfp-iframe-scaler">' +
                                    '<div class="mfp-close"></div>' +
                                    '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
                                    '</div>',
                                patterns: {
                                    youtube: {
                                        index: 'youtube.com/',
                                        id: 'v=',
                                        src: 'https://www.youtube.com/embed/%id%?autoplay=1'
                                    }
                                },
                                srcAction: 'iframe_src',
                            }
                        });
                    }
                });

            });
    </script>
@endsection
