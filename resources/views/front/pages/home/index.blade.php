@extends('front.app')

@section('content')
    <!-- Start of slider section
          ============================================= -->
    <section id="slide" class="slider-section">
        <div id="slider-item" class="slider-item-details">
            <div class="slider-area slider-bg-1 relative-position"
                style="background-image: url({{ asset('front/img/banner/s-4.jpg') }});">
                <div class="slider-text">
                    <div class="section-title mb20 headline text-center ">
                        <div class="layer-1-1">
                            <span class="subtitle text-uppercase">Selamat Datang di</span>
                        </div>
                        <div class="layer-1-3">
                            <h2>Website resmi<br><span>MAN 1 Padang Panjang</span></h2>
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
            <div class="slider-area slider-bg-4 relative-position"
                style="background-image: url({{ asset('front/img/banner/s-1.jpg') }});">
                <div class="slider-text">
                    <div class="section-title mb20 headline text-center ">
                        <span class="subtitle text-uppercase">EDUCATION & TRAINING ORGANIZATION</span>
                        <h2 class=""><span>Inventive</span> Solution <br> for <span>Education</span></h2>
                    </div>
                </div>
            </div>
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
                <div class="course-item-pic-text ">
                    <div class="course-pic relative-position mb25">
                        <img src="{{ asset('front/img/course/c-1.jpg') }}" alt="">
                        <div class="course-price text-center gradient-bg">
                            <span>$99.00</span>
                        </div>
                        <div class="course-details-btn">
                            <a href="#">COURSE DETAIL <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="course-item-text">
                        <div class="course-meta">
                            <span class="course-category bold-font"><a href="#">Web Design</a></span>
                            <span class="course-author bold-font"><a href="#">John Luis Fernandes</a></span>
                            <div class="course-rate ul-li">
                                <ul>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="course-title mt10 headline pb45 relative-position">
                            <h3><a href="#">Fully Responsive Web Design & Development.</a> <span
                                    class="trend-badge text-uppercase bold-font"><i class="fas fa-bolt"></i>
                                    TRENDING</span></h3>
                        </div>
                        <div class="course-viewer ul-li">
                            <ul>
                                <li><a href=""><i class="fas fa-user"></i> 1.220</a></li>
                                <li><a href=""><i class="fas fa-comment-dots"></i> 1.015</a></li>
                                <li><a href="">125k Unrolled</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /item -->

                <div class="course-item-pic-text ">
                    <div class="course-pic relative-position mb25">
                        <img src="{{ asset('front/img/course/c-2.jpg') }}" alt="">
                        <div class="course-price text-center gradient-bg">
                            <span>$99.00</span>
                        </div>
                        <div class="course-details-btn">
                            <a href="#">COURSE DETAIL <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="course-item-text">
                        <div class="course-meta">
                            <span class="course-category bold-font"><a href="#">Mobile Apps</a></span>
                            <span class="course-author bold-font"><a href="#">Fernando Torres</a></span>
                            <div class="course-rate ul-li">
                                <ul>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="course-title mt10 headline pb45 relative-position">
                            <h3><a href="#">Introduction to Mobile Application Development.</a></h3>
                        </div>
                        <div class="course-viewer ul-li">
                            <ul>
                                <li><a href=""><i class="fas fa-user"></i> 1.220</a></li>
                                <li><a href=""><i class="fas fa-comment-dots"></i> 1.015</a></li>
                                <li><a href="">125k Unrolled</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /item -->

                <div class="course-item-pic-text ">
                    <div class="course-pic relative-position mb25">
                        <img src="{{ asset('front/img/course/c-3.jpg') }}" alt="">
                        <div class="course-price text-center gradient-bg">
                            <span>$99.00</span>
                        </div>
                        <div class="course-details-btn">
                            <a href="#">COURSE DETAIL <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="course-item-text">
                        <div class="course-meta">
                            <span class="course-category bold-font"><a href="#">Motion Graphic </a></span>
                            <span class="course-author bold-font"><a href="#">enny Garcias</a></span>
                            <div class="course-rate ul-li">
                                <ul>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="course-title mt10 headline pb45 relative-position">
                            <h3><a href="#">Learning IOS Apps Programming & Development.</a></h3>
                        </div>
                        <div class="course-viewer ul-li">
                            <ul>
                                <li><a href=""><i class="fas fa-user"></i> 1.220</a></li>
                                <li><a href=""><i class="fas fa-comment-dots"></i> 1.015</a></li>
                                <li><a href="">125k Unrolled</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /item -->

                <div class="course-item-pic-text">
                    <div class="course-pic relative-position mb25">
                        <img src="{{ asset('front/img/course/c-2.jpg') }}" alt="">
                        <div class="course-price text-center gradient-bg">
                            <span>$99.00</span>
                        </div>
                        <div class="course-details-btn">
                            <a href="#">COURSE DETAIL <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="course-item-text">
                        <div class="course-meta">
                            <span class="course-category bold-font"><a href="#">Web Design</a></span>
                            <span class="course-author bold-font"><a href="#">John Luis Fernandes</a></span>
                            <div class="course-rate ul-li">
                                <ul>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="course-title mt10 headline pb45 relative-position">
                            <h3><a href="#">Fully Responsive Web Design & Development.</a> <span
                                    class="trend-badge text-uppercase bold-font"><i class="fas fa-bolt"></i>
                                    TRENDING</span></h3>
                        </div>
                        <div class="course-viewer ul-li">
                            <ul>
                                <li><a href=""><i class="fas fa-user"></i> 1.220</a></li>
                                <li><a href=""><i class="fas fa-comment-dots"></i> 1.015</a></li>
                                <li><a href="">125k Unrolled</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /item -->

                <div class="course-item-pic-text">
                    <div class="course-pic relative-position mb25">
                        <img src="{{ asset('front/img/course/c-3.jpg') }}" alt="">
                        <div class="course-price text-center gradient-bg">
                            <span>$99.00</span>
                        </div>
                        <div class="course-details-btn">
                            <a href="#">COURSE DETAIL <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="course-item-text">
                        <div class="course-meta">
                            <span class="course-category bold-font"><a href="#">Web Design</a></span>
                            <span class="course-author bold-font"><a href="#">John Luis Fernandes</a></span>
                            <div class="course-rate ul-li">
                                <ul>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="course-title mt10 headline pb45 relative-position">
                            <h3><a href="#">Fully Responsive Web Design & Development.</a> <span
                                    class="trend-badge text-uppercase bold-font"><i class="fas fa-bolt"></i>
                                    TRENDING</span></h3>
                        </div>
                        <div class="course-viewer ul-li">
                            <ul>
                                <li><a href=""><i class="fas fa-user"></i> 1.220</a></li>
                                <li><a href=""><i class="fas fa-comment-dots"></i> 1.015</a></li>
                                <li><a href="">125k Unrolled</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /item -->

                <div class="course-item-pic-text">
                    <div class="course-pic relative-position mb25">
                        <img src="{{ asset('front/img/course/c-1.jpg') }}" alt="">
                        <div class="course-price text-center gradient-bg">
                            <span>$99.00</span>
                        </div>
                        <div class="course-details-btn">
                            <a href="#">COURSE DETAIL <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="course-item-text">
                        <div class="course-meta">
                            <span class="course-category bold-font"><a href="#">Web Design</a></span>
                            <span class="course-author bold-font"><a href="#">John Luis Fernandes</a></span>
                            <div class="course-rate ul-li">
                                <ul>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="course-title mt10 headline pb45 relative-position">
                            <h3><a href="#">Fully Responsive Web Design & Development.</a> <span
                                    class="trend-badge text-uppercase bold-font"><i class="fas fa-bolt"></i>
                                    TRENDING</span></h3>
                        </div>
                        <div class="course-viewer ul-li">
                            <ul>
                                <li><a href=""><i class="fas fa-user"></i> 1.220</a></li>
                                <li><a href=""><i class="fas fa-comment-dots"></i> 1.015</a></li>
                                <li><a href="">125k Unrolled</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /item -->
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

                <div class="col-md-8">
                    <div class="latest-area-content ">
                        <div class="section-title-2 mb65 headline text-left">
                            <h2><span>Agenda</span> Kedepan.</h2>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="latest-events">
                                    <div class="latest-event-item">
                                        <div class="events-date  relative-position text-center">
                                            <div class="gradient-bdr"></div>
                                            <span class="event-date bold-font">22</span>
                                            April 2018
                                        </div>
                                        <div class="event-text">
                                            <h3 class="latest-title bold-font"><a href="#">Fully Responsive Web
                                                    Design &
                                                    Development.</a></h3>
                                            <div class="course-meta">
                                                <span class="course-category"><a href="#">Web Design</a></span>
                                                <span class="course-author"><a href="#">Koke</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="latest-events">
                                    <div class="latest-event-item">
                                        <div class="events-date  relative-position text-center">
                                            <div class="gradient-bdr"></div>
                                            <span class="event-date bold-font">07</span>
                                            August 2018
                                        </div>
                                        <div class="event-text">
                                            <h3 class="latest-title bold-font"><a href="#">Introduction to Mobile
                                                    Application Development.</a></h3>
                                            <div class="course-meta">
                                                <span class="course-category"><a href="#">Web Design</a></span>
                                                <span class="course-author"><a href="#">Koke</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="latest-events">
                                    <div class="latest-event-item">
                                        <div class="events-date  relative-position text-center">
                                            <div class="gradient-bdr"></div>
                                            <span class="event-date bold-font">30</span>
                                            Sept 2018
                                        </div>
                                        <div class="event-text">
                                            <h3 class="latest-title bold-font"><a href="#">IOS Apps Programming &
                                                    Development.</a></h3>
                                            <div class="course-meta">
                                                <span class="course-category"><a href="#">Web Design</a></span>
                                                <span class="course-author"><a href="#">Koke</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>






                        <div class="view-all-btn bold-font">
                            <a href="#">Check Calendar <i class="fas fa-calendar-alt"></i></a>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-4">
                    <div class="latest-area-content ">
                        <div class="section-title-2 mb65 headline text-left">
                            <h2>Upcoming <span>Events.</span></h2>
                        </div>
                        <div class="latest-events">
                            <div class="latest-event-item">
                                <div class="events-date  relative-position text-center">
                                    <div class="gradient-bdr"></div>
                                    <span class="event-date bold-font">22</span>
                                    April 2018
                                </div>
                                <div class="event-text">
                                    <h3 class="latest-title bold-font"><a href="#">Fully Responsive Web Design &
                                            Development.</a></h3>
                                    <div class="course-meta">
                                        <span class="course-category"><a href="#">Web Design</a></span>
                                        <span class="course-author"><a href="#">Koke</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="latest-events">
                            <div class="latest-event-item">
                                <div class="events-date  relative-position text-center">
                                    <div class="gradient-bdr"></div>
                                    <span class="event-date bold-font">07</span>
                                    August 2018
                                </div>
                                <div class="event-text">
                                    <h3 class="latest-title bold-font"><a href="#">Introduction to Mobile
                                            Application Development.</a></h3>
                                    <div class="course-meta">
                                        <span class="course-category"><a href="#">Web Design</a></span>
                                        <span class="course-author"><a href="#">Koke</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="latest-events">
                            <div class="latest-event-item">
                                <div class="events-date  relative-position text-center">
                                    <div class="gradient-bdr"></div>
                                    <span class="event-date bold-font">30</span>
                                    Sept 2018
                                </div>
                                <div class="event-text">
                                    <h3 class="latest-title bold-font"><a href="#">IOS Apps Programming &
                                            Development.</a></h3>
                                    <div class="course-meta">
                                        <span class="course-category"><a href="#">Web Design</a></span>
                                        <span class="course-author"><a href="#">Koke</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="view-all-btn bold-font">
                            <a href="#">Check Calendar <i class="fas fa-calendar-alt"></i></a>
                        </div>
                    </div>
                </div> --}}
                <!-- /events -->

                <div class="col-md-4">
                    <div class="latest-area-content ">
                        <div class="section-title-2 mb65 headline text-left">
                            <h2><span>Video</span> Terbaru.</h2>
                        </div>
                        <div class="latest-video-poster relative-position mb20">
                            <img src="{{ asset('front/img/banner/v-1.jpg') }}" alt="">
                            <div class="video-play-btn text-center gradient-bg">
                                <a class="popup-with-zoom-anim" href="https://www.youtube.com/watch?v=-g4TnixUdSc"><i
                                        class="fas fa-play"></i></a>
                            </div>
                        </div>
                        <div class="vidoe-text">
                            <h3 class="latest-title bold-font"><a href="#">Learning IOS Apps in Amsterdam.</a>
                            </h3>
                            <p class="mb25">Lorem ipsum dolor sit amet, consectetuer delacosta adipiscing elit, sed
                                diam nonummy.</p>
                        </div>
                        <div class="view-all-btn bold-font">
                            <a href="#">View All Videos <i class="fas fa-chevron-circle-right"></i></a>
                        </div>
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
                <span class="subtitle text-uppercase">Kata Sambuatan</span>
                <h2><span>Kepala Sekolah</span> MAN 1 Padang Panjang</h2>
            </div>
            <div class="extra-features-content">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="extra-pic text-center ">
                            <img src="https://jthemes.net/themes/html/genius-course/assets/img/banner/wc-2.png" alt="img">
                        </div>
                    </div>



                    <div class="pl-5 col-sm-8">
                            <div class="about-us-text">
                                <div class="section-title relative-position mb20 headline text-left">
                                    <h2>Julpiadi Hutabarat S.Ag M.S.I</h2>
                                </div>
                                <div class="about-content-text">
                                    <p class="">
                                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam
                                        nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam volutpat. Ut wisi enim ad
                                        minim veniam. magna aliquam volutpat. Ut wisi enim ad minim veniam.
                                        <br>
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum eveniet nostrum vero quis temporibus itaque iure deserunt quasi ducimus deleniti ut laborumusdam odio ipsam officiis officia a blanditiis molestiae sapiente eos quis aperiam omnis doloremque saepe ipsa unde, quaerat veritatis. Quo cumque explicabo aperiam temporibus accusamus inventore? Ex dolorum perspiciatis dolor atque voluptatem sapiente rerum autem ut, impedit nostrum? Debitis corrupti eum velit, officiis minima expedita, dolorem iusto doloribus adipisci vel error recusandae, esse ratione optio?
                                    </p>

                                    <div class="about-btn ">
                                        <div class="genius-btn gradient-bg text-center text-uppercase ul-li-block bold-font">
                                            <a href="#">Lihat Selengkapnya <i class="fas fa-caret-right"></i></a>
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
                                <span class="counter-count bold-font">5 </span><span>M+</span>
                                <p>Students Enrolled</p>
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
                                <span class="counter-count bold-font">122</span><span>.500+</span>
                                <p>Online Available Courses</p>
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
                                <span class="counter-count bold-font">15</span><span>.000+</span>
                                <p>Premium Quality Products</p>
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
                                <span class="counter-count bold-font">7</span><span>.500+</span>
                                <p>Teachers Registered</p>
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





    <!-- Start of about us section
        ============================================= -->
    <section id="about-us" class="about-us-section">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="about-resigter-form backgroud-style relative-position">
                        <div class="register-content">
                            <div class="register-fomr-title text-center">
                                <h3 class="bold-font"><span>Get a</span> Free Registration.</h3>
                                <p>More Than 122K Online Available Courses</p>
                            </div>
                            <div class="register-form-area">
                                <form class="contact_form" action="#" method="POST" enctype="multipart/form-data">
                                    <div class="contact-info">
                                        <input class="name" name="name" type="text" placeholder="Your Name.">
                                    </div>
                                    <div class="contact-info">
                                        <input class="nbm" name="nbm" type="number" placeholder="Your Number">
                                    </div>
                                    <div class="contact-info">
                                        <input class="email" name="email" type="email"
                                            placeholder="Email Address.">
                                    </div>
                                    <select>
                                        <option value="9" selected="">Select Course.</option>
                                        <option value="10">Web Design</option>
                                        <option value="11">Web Development</option>
                                        <option value="12">Php Core</option>
                                    </select>
                                    <div class="contact-info">
                                        <input type="text" id="datepicker" placeholder="Date.">
                                    </div>
                                    <textarea placeholder="Message."></textarea>
                                    <div class="nws-button text-uppercase text-center white text-capitalize">
                                        <button type="submit" value="Submit">SUBMIT REQUEST </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="bg-mockup">
                        <img src="{{ asset('front/img/about/phone.png') }}" alt="">
                    </div>
                </div>
                <!-- /form -->

                <div class="col-md-7">
                    <div class="about-us-text">
                        <div class="section-title relative-position mb20 headline text-left ">
                            <span class="subtitle ml42 text-uppercase">SORT ABOUT US</span>
                            <h2>We are <span>Genius Course</span>
                                work since 1980.</h2>
                            <p>We take our mission of increasing global access to quality education seriously. We
                                connect learners to the best universities and institutions from around the world.</p>
                        </div>
                        <div class="about-content-text">
                            <p class="">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam
                                nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam volutpat. Ut wisi enim ad
                                minim veniam. magna aliquam volutpat. Ut wisi enim ad minim veniam.</p>
                            <div class="about-list mb65 ul-li-block ">
                                <ul>
                                    <li>Professional And Experienced Since 1980</li>
                                    <li>We Connect Learners To The Best Universities From Around The World</li>
                                    <li>Our Mission Increasing Global Access To Quality Aducation</li>
                                    <li>100K Online Available Courses</li>
                                </ul>
                            </div>
                            <div class="about-btn ">
                                <div class="genius-btn gradient-bg text-center text-uppercase ul-li-block bold-font">
                                    <a href="#">About Us <i class="fas fa-caret-right"></i></a>
                                </div>
                                <div class="genius-btn gradient-bg text-center text-uppercase ul-li-block bold-font">
                                    <a href="#">contact us <i class="fas fa-caret-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of about us section
        ============================================= -->


    <!-- Start of why choose us section
        ============================================= -->
    <section id="why-choose-us" class="why-choose-us-section">
        <div class="jarallax  backgroud-style">
            <div class="container">
                <div class="section-title mb20 headline text-center ">
                    <span class="subtitle text-uppercase">GENIUS ADVANTAGES</span>
                    <h2>Reason <span>Why Choose Genius.</span></h2>
                </div>
                <div id="service-slide-item" class="service-slide">
                    <div class="service-text-icon ">
                        <div class="service-icon float-left">
                            <i class="text-gradiant flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i>
                        </div>
                        <div class="service-text">
                            <h3 class="bold-font">The Power Of Education.</h3>
                            <p>Lorem ipsum dolor sit amet consectuerer adipiscing elit set diam nonnumynibh euismod
                                tincidun laoreet.</p>
                        </div>
                    </div>
                    <div class="service-text-icon ">
                        <div class="service-icon float-left">
                            <i class="text-gradiant flaticon-clipboard-with-pencil"></i>
                        </div>
                        <div class="service-text">
                            <h3 class="bold-font">Best Online Education.</h3>
                            <p>Lorem ipsum dolor sit amet consectuerer adipiscing elit set diam nonnumynibh euismod
                                tincidun laoreet.</p>
                        </div>
                    </div>
                    <div class="service-text-icon ">
                        <div class="service-icon float-left">
                            <i class="text-gradiant flaticon-list"></i>
                        </div>
                        <div class="service-text">
                            <h3 class="bold-font">Education For All Student.</h3>
                            <p>Lorem ipsum dolor sit amet consectuerer adipiscing elit set diam nonnumynibh euismod
                                tincidun laoreet.</p>
                        </div>
                    </div>
                    <div class="service-text-icon ">
                        <div class="service-icon float-left">
                            <i class="text-gradiant flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i>
                        </div>
                        <div class="service-text">
                            <h3 class="bold-font">The Power Of Education.</h3>
                            <p>Lorem ipsum dolor sit amet consectuerer adipiscing elit set diam nonnumynibh euismod
                                tincidun laoreet.</p>
                        </div>
                    </div>
                    <div class="service-text-icon">
                        <div class="service-icon float-left">
                            <i class="text-gradiant flaticon-clipboard-with-pencil"></i>
                        </div>
                        <div class="service-text">
                            <h3 class="bold-font">Best Online Education.</h3>
                            <p>Lorem ipsum dolor sit amet consectuerer adipiscing elit set diam nonnumynibh euismod
                                tincidun laoreet.</p>
                        </div>
                    </div>
                    <div class="service-text-icon">
                        <div class="service-icon float-left">
                            <i class="text-gradiant flaticon-list"></i>
                        </div>
                        <div class="service-text">
                            <h3 class="bold-font">Education For All Student.</h3>
                            <p>Lorem ipsum dolor sit amet consectuerer adipiscing elit set diam nonnumynibh euismod
                                tincidun laoreet.</p>
                        </div>
                    </div>
                    <div class="service-text-icon">
                        <div class="service-icon float-left">
                            <i class="text-gradiant flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i>
                        </div>
                        <div class="service-text">
                            <h3 class="bold-font">The Power Of Education.</h3>
                            <p>Lorem ipsum dolor sit amet consectuerer adipiscing elit set diam nonnumynibh euismod
                                tincidun laoreet.</p>
                        </div>
                    </div>
                    <div class="service-text-icon">
                        <div class="service-icon float-left">
                            <i class="text-gradiant flaticon-clipboard-with-pencil"></i>
                        </div>
                        <div class="service-text">
                            <h3 class="bold-font">Best Online Education.</h3>
                            <p>Lorem ipsum dolor sit amet consectuerer adipiscing elit set diam nonnumynibh euismod
                                tincidun laoreet.</p>
                        </div>
                    </div>
                    <div class="service-text-icon">
                        <div class="service-icon float-left">
                            <i class="text-gradiant flaticon-list"></i>
                        </div>
                        <div class="service-text">
                            <h3 class="bold-font">Education For All Student.</h3>
                            <p>Lorem ipsum dolor sit amet consectuerer adipiscing elit set diam nonnumynibh euismod
                                tincidun laoreet.</p>
                        </div>
                    </div>
                </div>
                <!-- /service-slide -->
                <div class="testimonial-slide">
                    <div class="section-title-2 mb65 headline text-left ">
                        <h2>Students <span>Testimonial.</span></h2>
                    </div>

                    <div id="testimonial-slide-item" class="testimonial-slide-area">
                        <div class="student-qoute ">
                            <p>“This was our first time lorem ipsum and we <b> were very pleased with the whole
                                    experience</b>. Your price was lower than other companies. Our experience was good
                                from start to finish, so we’ll be back in the future lorem ipsum diamet.”</p>
                            <div class="student-name-designation">
                                <span class="st-name bold-font">Robertho Garcia </span>
                                <span class="st-designation">Graphic Designer</span>
                            </div>
                        </div>

                        <div class="student-qoute ">
                            <p>“This was our first time lorem ipsum and we <b> were very pleased with the whole
                                    experience</b>. Your price was lower than other companies. Our experience was good
                                from start to finish, so we’ll be back in the future lorem ipsum diamet.”</p>
                            <div class="student-name-designation">
                                <span class="st-name bold-font">Robertho Garcia </span>
                                <span class="st-designation">Graphic Designer</span>
                            </div>
                        </div>

                        <div class="student-qoute ">
                            <p>“This was our first time lorem ipsum and we <b> were very pleased with the whole
                                    experience</b>. Your price was lower than other companies. Our experience was good
                                from start to finish, so we’ll be back in the future lorem ipsum diamet.”</p>
                            <div class="student-name-designation">
                                <span class="st-name bold-font">Robertho Garcia </span>
                                <span class="st-designation">Graphic Designer</span>
                            </div>
                        </div>

                        <div class="student-qoute">
                            <p>“This was our first time lorem ipsum and we <b> were very pleased with the whole
                                    experience</b>. Your price was lower than other companies. Our experience was good
                                from start to finish, so we’ll be back in the future lorem ipsum diamet.”</p>
                            <div class="student-name-designation">
                                <span class="st-name bold-font">Robertho Garcia </span>
                                <span class="st-designation">Graphic Designer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of why choose us section
        ============================================= -->





    <!-- Start of sponsor section
        ============================================= -->
    <section id="sponsor" class="sponsor-section">
        <div class="container">
            <div class="section-title-2 mb65 headline text-left ">
                <h2><span>Partner</span> Link</h2>
            </div>
            <div class="sponsor-item sponsor-1 ">
                <div class="sponsor-pic text-center">
                    <img src="{{ asset('front/img/sponsor/s-1.jpg') }}" alt="">
                </div>
                <div class="sponsor-pic text-center">
                    <img src="{{ asset('front/img/sponsor/s-2.jpg') }}" alt="">
                </div>
                <div class="sponsor-pic text-center">
                    <img src="{{ asset('front/img/sponsor/s-3.jpg') }}" alt="">
                </div>
                <div class="sponsor-pic text-center">
                    <img src="{{ asset('front/img/sponsor/s-4.jpg') }}" alt="">
                </div>
                <div class="sponsor-pic text-center">
                    <img src="{{ asset('front/img/sponsor/s-5.jpg') }}" alt="">
                </div>
                <div class="sponsor-pic text-center">
                    <img src="{{ asset('front/img/sponsor/s-6.jpg') }}" alt="">
                </div>
                <div class="sponsor-pic text-center">
                    <img src="{{ asset('front/img/sponsor/s-6.jpg') }}" alt="">
                </div>
                <div class="sponsor-pic text-center">
                    <img src="{{ asset('front/img/sponsor/s-6.jpg') }}" alt="">
                </div>
                <div class="sponsor-pic text-center">
                    <img src="{{ asset('front/img/sponsor/s-6.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- End of sponsor section
        ============================================= -->


    <!-- Start of best course
        ============================================= -->
    <section id="best-course" class="best-course-section">
        <div class="container">
            <div class="section-title mb45 headline text-center ">
                <span class="subtitle text-uppercase">SEARCH OUR COURSES</span>
                <h2>Browse Our<span> Best Course.</span></h2>
            </div>
            <div class="best-course-area mb45">
                <div class="row">
                    <div class="col-md-3">
                        <div class="best-course-pic-text relative-position ">
                            <div class="best-course-pic relative-position">
                                <img src="{{ asset('front/img/course/bc-1.jpg') }}" alt="">
                                <div class="trend-badge-2 text-center text-uppercase">
                                    <i class="fas fa-bolt"></i>
                                    <span>Trending</span>
                                </div>
                                <div class="course-price text-center gradient-bg">
                                    <span>$99.00</span>
                                </div>
                                <div class="course-rate ul-li">
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                </div>
                                <div class="course-details-btn">
                                    <a href="#">COURSE DETAIL <i class="fas fa-arrow-right"></i></a>
                                </div>
                                <div class="blakish-overlay"></div>
                            </div>
                            <div class="best-course-text">
                                <div class="course-title mb20 headline relative-position">
                                    <h3><a href="#">Fully Responsive Web Design &amp; Development.</a></h3>
                                </div>
                                <div class="course-meta">
                                    <span class="course-category"><a href="#">Web Design</a></span>
                                    <span class="course-author"><a href="#">250 Students</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /course -->

                    <div class="col-md-3">
                        <div class="best-course-pic-text relative-position ">
                            <div class="best-course-pic relative-position">
                                <img src="{{ asset('front/img/course/bc-2.jpg') }}" alt="">
                                <div class="course-price text-center gradient-bg">
                                    <span>$99.00</span>
                                </div>
                                <div class="course-rate ul-li">
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                </div>
                                <div class="course-details-btn">
                                    <a href="#">COURSE DETAIL <i class="fas fa-arrow-right"></i></a>
                                </div>
                                <div class="blakish-overlay"></div>
                            </div>
                            <div class="best-course-text">
                                <div class="course-title mb20 headline relative-position">
                                    <h3><a href="#">Fully Responsive Web Design &amp; Development.</a></h3>
                                </div>
                                <div class="course-meta">
                                    <span class="course-category"><a href="#">Web Design</a></span>
                                    <span class="course-author"><a href="#">250 Students</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /course -->

                    <div class="col-md-3">
                        <div class="best-course-pic-text relative-position ">
                            <div class="best-course-pic relative-position">
                                <img src="{{ asset('front/img/course/bc-3.jpg') }}" alt="">
                                <div class="course-price text-center gradient-bg">
                                    <span>$99.00</span>
                                </div>
                                <div class="course-rate ul-li">
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                </div>
                                <div class="course-details-btn">
                                    <a href="#">COURSE DETAIL <i class="fas fa-arrow-right"></i></a>
                                </div>
                                <div class="blakish-overlay"></div>
                            </div>
                            <div class="best-course-text">
                                <div class="course-title mb20 headline relative-position">
                                    <h3><a href="#">Fully Responsive Web Design &amp; Development.</a></h3>
                                </div>
                                <div class="course-meta">
                                    <span class="course-category"><a href="#">Web Design</a></span>
                                    <span class="course-author"><a href="#">250 Students</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /course -->

                    <div class="col-md-3">
                        <div class="best-course-pic-text relative-position ">
                            <div class="best-course-pic relative-position">
                                <img src="{{ asset('front/img/course/bc-4.jpg') }}" alt="">
                                <div class="course-price text-center gradient-bg">
                                    <span>$99.00</span>
                                </div>
                                <div class="course-rate ul-li">
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                </div>
                                <div class="course-details-btn">
                                    <a href="#">COURSE DETAIL <i class="fas fa-arrow-right"></i></a>
                                </div>
                                <div class="blakish-overlay"></div>
                            </div>
                            <div class="best-course-text">
                                <div class="course-title mb20 headline relative-position">
                                    <h3><a href="#">Fully Responsive Web Design &amp; Development.</a></h3>
                                </div>
                                <div class="course-meta">
                                    <span class="course-category"><a href="#">Web Design</a></span>
                                    <span class="course-author"><a href="#">250 Students</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /course -->

                    <div class="col-md-3">
                        <div class="best-course-pic-text relative-position ">
                            <div class="best-course-pic relative-position">
                                <img src="{{ asset('front/img/course/bc-5.jpg') }}" alt="">
                                <div class="course-price text-center gradient-bg">
                                    <span>$99.00</span>
                                </div>
                                <div class="course-rate ul-li">
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                </div>
                                <div class="course-details-btn">
                                    <a href="#">COURSE DETAIL <i class="fas fa-arrow-right"></i></a>
                                </div>
                                <div class="blakish-overlay"></div>
                            </div>
                            <div class="best-course-text">
                                <div class="course-title mb20 headline relative-position">
                                    <h3><a href="#">Fully Responsive Web Design &amp; Development.</a></h3>
                                </div>
                                <div class="course-meta">
                                    <span class="course-category"><a href="#">Web Design</a></span>
                                    <span class="course-author"><a href="#">250 Students</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /course -->

                    <div class="col-md-3">
                        <div class="best-course-pic-text relative-position ">
                            <div class="best-course-pic relative-position">
                                <img src="{{ asset('front/img/course/bc-6.jpg') }}" alt="">
                                <div class="trend-badge-2 text-center text-uppercase">
                                    <i class="fas fa-bolt"></i>
                                    <span>Trending</span>
                                </div>
                                <div class="course-price text-center gradient-bg">
                                    <span>$99.00</span>
                                </div>
                                <div class="course-rate ul-li">
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                </div>
                                <div class="course-details-btn">
                                    <a href="#">COURSE DETAIL <i class="fas fa-arrow-right"></i></a>
                                </div>
                                <div class="blakish-overlay"></div>
                            </div>
                            <div class="best-course-text">
                                <div class="course-title mb20 headline relative-position">
                                    <h3><a href="#">Fully Responsive Web Design &amp; Development.</a></h3>
                                </div>
                                <div class="course-meta">
                                    <span class="course-category"><a href="#">Web Design</a></span>
                                    <span class="course-author"><a href="#">250 Students</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /course -->

                    <div class="col-md-3">
                        <div class="best-course-pic-text relative-position ">
                            <div class="best-course-pic relative-position">
                                <img src="{{ asset('front/img/course/bc-7.jpg') }}" alt="">
                                <div class="course-price text-center gradient-bg">
                                    <span>$99.00</span>
                                </div>
                                <div class="course-rate ul-li">
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                </div>
                                <div class="course-details-btn">
                                    <a href="#">COURSE DETAIL <i class="fas fa-arrow-right"></i></a>
                                </div>
                                <div class="blakish-overlay"></div>
                            </div>
                            <div class="best-course-text">
                                <div class="course-title mb20 headline relative-position">
                                    <h3><a href="#">Fully Responsive Web Design &amp; Development.</a></h3>
                                </div>
                                <div class="course-meta">
                                    <span class="course-category"><a href="#">Web Design</a></span>
                                    <span class="course-author"><a href="#">250 Students</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /course -->

                    <div class="col-md-3">
                        <div class="best-course-pic-text relative-position ">
                            <div class="best-course-pic relative-position">
                                <img src="{{ asset('front/img/course/bc-8.jpg') }}" alt="">
                                <div class="course-price text-center gradient-bg">
                                    <span>$99.00</span>
                                </div>
                                <div class="course-rate ul-li">
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                </div>
                                <div class="course-details-btn">
                                    <a href="#">COURSE DETAIL <i class="fas fa-arrow-right"></i></a>
                                </div>
                                <div class="blakish-overlay"></div>
                            </div>
                            <div class="best-course-text">
                                <div class="course-title mb20 headline relative-position">
                                    <h3><a href="#">Fully Responsive Web Design &amp; Development.</a></h3>
                                </div>
                                <div class="course-meta">
                                    <span class="course-category"><a href="#">Web Design</a></span>
                                    <span class="course-author"><a href="#">250 Students</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /course -->
                </div>
            </div>


        </div>
    </section>
    <!-- End of best course
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
                        <div class="col-md-3">
                            <div class="teacher-img-content ">
                                <div class="teacher-cntent">
                                    <div class="teacher-social-name ul-li-block">
                                        <ul>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                        </ul>
                                        <div class="teacher-name">
                                            <span>Daniel
                                                Alvares</span>
                                        </div>
                                    </div>
                                    <div class="teacher-img-category">
                                        <div class="teacher-img">
                                            <img src="{{ asset('front/img/teacher/t-1.jpg') }}" alt="">
                                            <div class="course-price text-uppercase text-center gradient-bg">
                                                <span>Featured</span>
                                            </div>
                                        </div>
                                        <div class="teacher-category float-right">
                                            <span class="st-name">Mobile Apps </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /teacher -->
                        <div class="col-md-3">
                            <div class="teacher-img-content ">
                                <div class="teacher-cntent">
                                    <div class="teacher-social-name ul-li-block">
                                        <ul>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                        </ul>
                                        <div class="teacher-name">
                                            <span>Juliana Hernandes</span>
                                        </div>
                                    </div>
                                    <div class="teacher-img-category">
                                        <div class="teacher-img">
                                            <img src="{{ asset('front/img/teacher/t-2.jpg') }}" alt="">
                                            <div class="course-price text-uppercase text-center gradient-bg">
                                                <span>Featured</span>
                                            </div>
                                        </div>
                                        <div class="teacher-category float-right">
                                            <span class="st-name">Mobile Apps </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /teacher -->
                        <div class="col-md-3">
                            <div class="teacher-img-content ">
                                <div class="teacher-cntent">
                                    <div class="teacher-social-name ul-li-block">
                                        <ul>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                        </ul>
                                        <div class="teacher-name">
                                            <span>Berliana
                                                Luis</span>
                                        </div>
                                    </div>
                                    <div class="teacher-img-category">
                                        <div class="teacher-img">
                                            <img src="{{ asset('front/img/teacher/t-3.jpg') }}" alt="">
                                            <div class="course-price text-uppercase text-center gradient-bg">
                                                <span>Featured</span>
                                            </div>
                                        </div>
                                        <div class="teacher-category float-right">
                                            <span class="st-name">IOS Apps </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /teacher -->
                        <div class="col-md-3">
                            <div class="teacher-img-content ">
                                <div class="teacher-cntent">
                                    <div class="teacher-social-name ul-li-block">
                                        <ul>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                        </ul>
                                        <div class="teacher-name">
                                            <span>Johansen
                                                Doe</span>
                                        </div>
                                    </div>
                                    <div class="teacher-img-category">
                                        <div class="teacher-img">
                                            <img src="{{ asset('front/img/teacher/t-4.jpg') }}" alt="">
                                            <div class="course-price text-uppercase text-center gradient-bg">
                                                <span>Featured</span>
                                            </div>
                                        </div>
                                        <div class="teacher-category float-right">
                                            <span class="st-name">Graphic </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /teacher -->
                        <div class="col-md-3">
                            <div class="teacher-img-content ">
                                <div class="teacher-cntent">
                                    <div class="teacher-social-name ul-li-block">
                                        <ul>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                        </ul>
                                        <div class="teacher-name">
                                            <span>Lisha
                                                Chambelt</span>
                                        </div>
                                    </div>
                                    <div class="teacher-img-category">
                                        <div class="teacher-img">
                                            <img src="{{ asset('front/img/teacher/t-6.jpg') }}" alt="">
                                            <div class="course-price text-uppercase text-center gradient-bg">
                                                <span>Featured</span>
                                            </div>
                                        </div>
                                        <div class="teacher-category float-right">
                                            <span class="st-name">Mobile Apps </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /teacher -->
                        <div class="col-md-3">
                            <div class="teacher-img-content ">
                                <div class="teacher-cntent">
                                    <div class="teacher-social-name ul-li-block">
                                        <ul>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                        </ul>
                                        <div class="teacher-name">
                                            <span>Checilia
                                                Yeoung</span>
                                        </div>
                                    </div>
                                    <div class="teacher-img-category">
                                        <div class="teacher-img">
                                            <img src="{{ asset('front/img/teacher/t-5.jpg') }}" alt="">
                                            <div class="course-price text-uppercase text-center gradient-bg">
                                                <span>Featured</span>
                                            </div>
                                        </div>
                                        <div class="teacher-category float-right">
                                            <span class="st-name">Mobile Apps </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /teacher -->
                        <div class="col-md-3">
                            <div class="teacher-img-content ">
                                <div class="teacher-cntent">
                                    <div class="teacher-social-name ul-li-block">
                                        <ul>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                        </ul>
                                        <div class="teacher-name">
                                            <span>Sean
                                                Fernandes</span>
                                        </div>
                                    </div>
                                    <div class="teacher-img-category">
                                        <div class="teacher-img">
                                            <img src="{{ asset('front/img/teacher/t-7.jpg') }}" alt="">
                                            <div class="course-price text-uppercase text-center gradient-bg">
                                                <span>Featured</span>
                                            </div>
                                        </div>
                                        <div class="teacher-category float-right">
                                            <span class="st-name">Mobile Apps </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /teacher -->
                    </div>

                    <div class="genius-btn gradient-bg text-center text-uppercase ul-li-block bold-font ">
                        <a href="#">Lihat Semua Guru <i class="fas fa-caret-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of course teacher
        ============================================= -->



    <!-- Start of best product section
        ============================================= -->
    <section id="best-product" class="best-product-section">
        <div class="container">
            <div class="section-title-2 mb65 headline text-left ">
                <h2>Genius <span>Best Products.</span></h2>
            </div>
            <div id="best-product-slide-item" class="best-product-slide">
                <div class="product-img-text ">
                    <div class="product-img text-center mb20">
                        <img src="{{ asset('front/img/product/bp-1.png') }}" alt="">
                    </div>
                    <div class="product-text-content relative-position">
                        <div class="best-title-price float-left">
                            <div class="course-title headline">
                                <h3><a href="#">Mobile Apps Books.</a></h3>
                            </div>
                            <div class="price-start">
                                Start from
                                <span>$55.25</span>
                            </div>
                        </div>
                        <div class="add-cart text-center">
                            <i class="fas fa-cart-plus"></i>
                        </div>
                    </div>
                </div>

                <div class="product-img-text ">
                    <div class="product-img text-center mb20">
                        <img src="{{ asset('front/img/product/bp-2.png') }}" alt="">
                    </div>
                    <div class="product-text-content relative-position">
                        <div class="best-title-price float-left">
                            <div class="course-title headline">
                                <h3><a href="#">Mobile Apps Books.</a></h3>
                            </div>
                            <div class="price-start">
                                Start from
                                <span>$55.25</span>
                            </div>
                        </div>
                        <div class="add-cart text-center">
                            <i class="fas fa-cart-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="product-img-text ">
                    <div class="product-img text-center mb20">
                        <img src="{{ asset('front/img/product/bp-3.png') }}" alt="">
                    </div>
                    <div class="product-text-content relative-position">
                        <div class="best-title-price float-left">
                            <div class="course-title headline">
                                <h3><a href="#">Mobile Apps Books.</a></h3>
                            </div>
                            <div class="price-start">
                                Start from
                                <span>$55.25</span>
                            </div>
                        </div>
                        <div class="add-cart text-center">
                            <i class="fas fa-cart-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="product-img-text ">
                    <div class="product-img text-center mb20">
                        <img src="{{ asset('front/img/product/bp-4.png') }}" alt="">
                    </div>
                    <div class="product-text-content relative-position">
                        <div class="best-title-price float-left">
                            <div class="course-title headline">
                                <h3><a href="#">Mobile Apps Books.</a></h3>
                            </div>
                            <div class="price-start">
                                Start from
                                <span>$55.25</span>
                            </div>
                        </div>
                        <div class="add-cart text-center">
                            <i class="fas fa-cart-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="product-img-text ">
                    <div class="product-img text-center mb20">
                        <img src="{{ asset('front/img/product/bp-1.png') }}" alt="">
                    </div>
                    <div class="product-text-content relative-position">
                        <div class="best-title-price float-left">
                            <div class="course-title headline">
                                <h3><a href="#">Mobile Apps Books.</a></h3>
                            </div>
                            <div class="price-start">
                                Start from
                                <span>$55.25</span>
                            </div>
                        </div>
                        <div class="add-cart text-center">
                            <i class="fas fa-cart-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="product-img-text">
                    <div class="product-img text-center mb20">
                        <img src="{{ asset('front/img/product/bp-2.png') }}" alt="">
                    </div>
                    <div class="product-text-content relative-position">
                        <div class="best-title-price float-left">
                            <div class="course-title headline">
                                <h3><a href="#">Mobile Apps Books.</a></h3>
                            </div>
                            <div class="price-start">
                                Start from
                                <span>$55.25</span>
                            </div>
                        </div>
                        <div class="add-cart text-center">
                            <i class="fas fa-cart-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="product-img-text">
                    <div class="product-img text-center mb20">
                        <img src="{{ asset('front/img/product/bp-3.png') }}" alt="">
                    </div>
                    <div class="product-text-content relative-position">
                        <div class="best-title-price float-left">
                            <div class="course-title headline">
                                <h3><a href="#">Mobile Apps Books.</a></h3>
                            </div>
                            <div class="price-start">
                                Start from
                                <span>$55.25</span>
                            </div>
                        </div>
                        <div class="add-cart text-center">
                            <i class="fas fa-cart-plus"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End  of best product section
        ============================================= -->


    <!-- Start FAQ section
        ============================================= -->
    <section id="faq" class="faq-section">
        <div class="container">
            <div class="section-title mb45 headline text-center ">
                <span class="subtitle text-uppercase">GENIUS COURSE FAQ</span>
                <h2>Frequently<span> Ask & Questions</span></h2>
            </div>
            <div class="faq-tab">
                <div class="faq-tab-ques ul-li">
                    <div class="tab-button text-center mb65 ">
                        <ul class="product-tab">
                            <li class="active" rel="tab1">GENERAL </li>
                            <li rel="tab2"> COURSES </li>
                            <li rel="tab3"> TEACHERS </li>
                            <li rel="tab4"> EVENTS </li>
                            <li rel="tab5"> OTHERS </li>
                        </ul>
                    </div>
                    <!-- /tab-head -->

                    <!-- tab content -->
                    <div class="tab-container">

                        <!-- 1st tab -->
                        <div id="tab1" class="tab-content-1 pt35">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="ques-ans mb45 headline ">
                                        <h3> What is Genius Courses?</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                                            nibh euismod tincidunt ut laoreet dolore magna aliquam volutpat. Ut wisi
                                            enim ad minim veniam.</p>
                                    </div>

                                    <div class="ques-ans mb45 headline ">
                                        <h3> What Lorem Ipsum Dolor Sit Amet Consectuerer?</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                                            nibh euismod tincidunt ut laoreet dolore magna aliquam volutpat. Ut wisi
                                            enim ad minim veniam.</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="ques-ans mb45 headline ">
                                        <h3> How to Register or Make An Account in Genius?</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                                            nibh euismod tincidunt ut laoreet dolore magna aliquam volutpat. Ut wisi
                                            enim ad minim veniam.</p>
                                    </div>

                                    <div class="ques-ans mb45 headline ">
                                        <h3> Adipiscing Diamet Nonnumy Nibh Euismod?</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                                            nibh euismod tincidunt ut laoreet dolore magna aliquam volutpat. Ut wisi
                                            enim ad minim veniam.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- #tab1 -->

                        <div id="tab2" class="tab-content-1 pt35">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="ques-ans mb45 headline ">
                                        <h3> What is Genius Courses?</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                                            nibh euismod tincidunt ut laoreet dolore magna aliquam volutpat. Ut wisi
                                            enim ad minim veniam.</p>
                                    </div>

                                    <div class="ques-ans mb45 headline ">
                                        <h3> What Lorem Ipsum Dolor Sit Amet Consectuerer?</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                                            nibh euismod tincidunt ut laoreet dolore magna aliquam volutpat. Ut wisi
                                            enim ad minim veniam.</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="ques-ans mb45 headline ">
                                        <h3> How to Register or Make An Account in Genius?</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                                            nibh euismod tincidunt ut laoreet dolore magna aliquam volutpat. Ut wisi
                                            enim ad minim veniam.</p>
                                    </div>

                                    <div class="ques-ans mb45 headline ">
                                        <h3> Adipiscing Diamet Nonnumy Nibh Euismod?</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                                            nibh euismod tincidunt ut laoreet dolore magna aliquam volutpat. Ut wisi
                                            enim ad minim veniam.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- #tab2 -->

                        <div id="tab3" class="tab-content-1 pt35">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="ques-ans mb45 headline">
                                        <h3> What is Genius Courses?</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                                            nibh euismod tincidunt ut laoreet dolore magna aliquam volutpat. Ut wisi
                                            enim ad minim veniam.</p>
                                    </div>

                                    <div class="ques-ans mb45 headline">
                                        <h3> What Lorem Ipsum Dolor Sit Amet Consectuerer?</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                                            nibh euismod tincidunt ut laoreet dolore magna aliquam volutpat. Ut wisi
                                            enim ad minim veniam.</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="ques-ans mb45 headline">
                                        <h3> How to Register or Make An Account in Genius?</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                                            nibh euismod tincidunt ut laoreet dolore magna aliquam volutpat. Ut wisi
                                            enim ad minim veniam.</p>
                                    </div>

                                    <div class="ques-ans mb45 headline">
                                        <h3> Adipiscing Diamet Nonnumy Nibh Euismod?</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                                            nibh euismod tincidunt ut laoreet dolore magna aliquam volutpat. Ut wisi
                                            enim ad minim veniam.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- #tab3 -->

                        <div id="tab4" class="tab-content-1 pt35">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="ques-ans mb45 headline">
                                        <h3> What is Genius Courses?</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                                            nibh euismod tincidunt ut laoreet dolore magna aliquam volutpat. Ut wisi
                                            enim ad minim veniam.</p>
                                    </div>

                                    <div class="ques-ans mb45 headline">
                                        <h3> What Lorem Ipsum Dolor Sit Amet Consectuerer?</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                                            nibh euismod tincidunt ut laoreet dolore magna aliquam volutpat. Ut wisi
                                            enim ad minim veniam.</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="ques-ans mb45 headline">
                                        <h3> How to Register or Make An Account in Genius?</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                                            nibh euismod tincidunt ut laoreet dolore magna aliquam volutpat. Ut wisi
                                            enim ad minim veniam.</p>
                                    </div>

                                    <div class="ques-ans mb45 headline">
                                        <h3> Adipiscing Diamet Nonnumy Nibh Euismod?</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                                            nibh euismod tincidunt ut laoreet dolore magna aliquam volutpat. Ut wisi
                                            enim ad minim veniam.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- #tab3 -->

                        <div id="tab5" class="tab-content-1 pt35">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="ques-ans mb45 headline">
                                        <h3> What is Genius Courses?</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                                            nibh euismod tincidunt ut laoreet dolore magna aliquam volutpat. Ut wisi
                                            enim ad minim veniam.</p>
                                    </div>

                                    <div class="ques-ans mb45 headline">
                                        <h3> What Lorem Ipsum Dolor Sit Amet Consectuerer?</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                                            nibh euismod tincidunt ut laoreet dolore magna aliquam volutpat. Ut wisi
                                            enim ad minim veniam.</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="ques-ans mb45 headline">
                                        <h3> How to Register or Make An Account in Genius?</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                                            nibh euismod tincidunt ut laoreet dolore magna aliquam volutpat. Ut wisi
                                            enim ad minim veniam.</p>
                                    </div>

                                    <div class="ques-ans mb45 headline">
                                        <h3> Adipiscing Diamet Nonnumy Nibh Euismod?</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                                            nibh euismod tincidunt ut laoreet dolore magna aliquam volutpat. Ut wisi
                                            enim ad minim veniam.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- #tab3 -->
                    </div>
                    <div class="view-all-btn bold-font ">
                        <a href="#">Make a Question <i class="fas fa-chevron-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End FAQ section
        ============================================= -->


    <!-- Start Course category
        ============================================= -->
    <section id="course-category" class="course-category-section">
        <div class="container">
            <div class="section-title mb45 headline text-center ">
                <span class="subtitle text-uppercase">COURSES CATEGORIES</span>
                <h2>Browse Courses<span> By Category.</span></h2>
            </div>
            <div class="category-item">
                <div class="row">
                    <div class="col-md-3">
                        <div class="category-icon-title text-center ">
                            <div class="category-icon">
                                <i class="text-gradiant flaticon-technology"></i>
                            </div>
                            <div class="category-title">
                                <h4>Responsive Website</h4>
                            </div>
                        </div>
                    </div>
                    <!-- /category -->

                    <div class="col-md-3">
                        <div class="category-icon-title text-center ">
                            <div class="category-icon">
                                <i class="text-gradiant flaticon-app-store"></i>
                            </div>
                            <div class="category-title">
                                <h4>IOS Applications</h4>
                            </div>
                        </div>
                    </div>
                    <!-- /category -->

                    <div class="col-md-3">
                        <div class="category-icon-title text-center ">
                            <div class="category-icon">
                                <i class="text-gradiant flaticon-artist-tools"></i>
                            </div>
                            <div class="category-title">
                                <h4>Graphic Design</h4>
                            </div>
                        </div>
                    </div>
                    <!-- /category -->

                    <div class="col-md-3">
                        <div class="category-icon-title text-center ">
                            <div class="category-icon">
                                <i class="text-gradiant flaticon-business"></i>
                            </div>
                            <div class="category-title">
                                <h4>Marketing</h4>
                            </div>
                        </div>
                    </div>
                    <!-- /category -->

                    <div class="col-md-3">
                        <div class="category-icon-title text-center ">
                            <div class="category-icon">
                                <i class="text-gradiant flaticon-dna"></i>
                            </div>
                            <div class="category-title">
                                <h4>Science</h4>
                            </div>
                        </div>
                    </div>
                    <!-- /category -->

                    <div class="col-md-3">
                        <div class="category-icon-title text-center ">
                            <div class="category-icon">
                                <i class="text-gradiant flaticon-cogwheel"></i>
                            </div>
                            <div class="category-title">
                                <h4>Enginering</h4>
                            </div>
                        </div>
                    </div>
                    <!-- /category -->

                    <div class="col-md-3">
                        <div class="category-icon-title text-center ">
                            <div class="category-icon">
                                <i class="text-gradiant flaticon-technology-1"></i>
                            </div>
                            <div class="category-title">
                                <h4>Photography</h4>
                            </div>
                        </div>
                    </div>
                    <!-- /category -->

                    <div class="col-md-3">
                        <div class="category-icon-title text-center ">
                            <div class="category-icon">
                                <i class="text-gradiant flaticon-technology-2"></i>
                            </div>
                            <div class="category-title">
                                <h4>Mobile Application</h4>
                            </div>
                        </div>
                    </div>
                    <!-- /category -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Course category
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
