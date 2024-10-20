<header>
    <div id="main-menu" class="main-menu-container">
        <div class="main-menu">
            <div class="container">
                <div class="navbar-default">
                    <div class="navbar-header float-left">
                        <a class="navbar-brand text-uppercase" href="#"><img src="assets/img/logo/logo.png"
                                alt="logo"></a>
                    </div><!-- /.navbar-header -->

                    {{-- <div class="select-lang">
                        <select>
                            <option value="9" selected="">ENG</option>
                            <option value="10">BAN</option>
                            <option value="11">ARB</option>
                            <option value="12">FRN</option>
                        </select>
                    </div> --}}
                    <div class="cart-search float-right ul-li">
                        <ul>
                            <li>
                                <button type="button" class="toggle-overlay search-btn">
                                    <i class="fas fa-search"></i>
                                </button>
                                <div class="search-body">
                                    <div class="search-form">
                                        <form action="#">
                                            <input class="search-input" type="search" placeholder="Search Here">
                                            <div class="outer-close toggle-overlay">
                                                <button type="button" class="search-close">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    @guest
                        <div class="log-in float-right">
                            <a data-toggle="modal" data-target="#myModal" href="#">log in</a>
                            <!-- The Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header backgroud-style">
                                            <div class="gradient-bg"></div>
                                            <div class="popup-logo">
                                                <img src="https://i.pinimg.com/originals/01/8d/35/018d35a1404ba58c9f80f4ac345a2c9c.png"
                                                    width="100" alt="">
                                            </div>
                                            <div class="popup-text text-center">
                                                <h2> <span>Masuk</span> Ke Akun Kamu.</h2>
                                                <p>Belum punya akun? silahkan hubungi Staff TU</p>
                                            </div>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form class="contact_form" action="{{ route('login.process') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="contact-info">
                                                    <input class="name" name="email" type="email"
                                                        value="{{ old('email') }}" placeholder="Your@email.com*">
                                                    @error('email')
                                                        <small class="text-danger">
                                                            {{ $message }}
                                                        </small>
                                                    @enderror
                                                </div>

                                                <div class="contact-info">
                                                    <input class="pass" name="password" type="password"
                                                        placeholder="Your password*">
                                                    @error('password')
                                                        <small class="text-danger">
                                                            {{ $message }}
                                                        </small>
                                                    @enderror
                                                </div>
                                                <p class="text-right mb-3">
                                                    <a href="#" class="text-info">Lupa Password?</a>
                                                </p>
                                                <div class="nws-button text-center white text-capitalize">
                                                    <button type="submit" value="Submit">Masuk Sekarang</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="log-in float-right">
                            <a href="{{ route('logout') }}">Logout</a>
                        </div>
                    @endguest

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <nav class="navbar-menu float-right">
                        <div class="nav-menu ul-li">
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>

                                <li class="menu-item-has-children ul-li-block">
                                    <a href="{{ route('news.index') }}">Berita</a>
                                    <ul class="sub-menu">
                                        @php
                                            $categories = \App\Models\NewsCategory::all();
                                        @endphp
                                        @foreach ($categories as $category)
                                            <li><a
                                                    href="{{ route('news.category', $category->slug) }}">{{ $category->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="menu-item-has-children ul-li-block">
                                    <a href="#!">Profil</a>
                                    <ul class="sub-menu">
                                        <li><a href="teacher.html">Teacher</a></li>
                                        <li><a href="teacher-details.html">Teacher Details</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children ul-li-block">
                                    <a href="#!">Personalia</a>
                                    <ul class="sub-menu">
                                        <li><a href="teacher.html">Teacher</a></li>
                                        <li><a href="teacher-details.html">Teacher Details</a></li>
                                    </ul>
                                </li>
                                <li><a href="">E-Learning</a></li>
                                <li><a href="">PPDB</a></li>


                            </ul>
                        </div>
                    </nav>

                    <div class="mobile-menu">
                        <div class="logo"><a href="index-1.html"><img src="assets/img/logo/logo.png"
                                    alt="Logo"></a></div>
                        <nav>
                            <ul>
                                <li><a href="index-1.html">Home</a>
                                </li>
                                <li><a href="about.html">About</a></li>
                                <li><a href="blog.html">Blog</a>
                                    <ul>
                                        <li><a href="blog.html">Blog</a></li>
                                        <li><a href="blog-single.html">Blog sinlge</a></li>
                                    </ul>
                                </li>
                                <li><a href="shop.html">Shop</a>
                                </li>
                                <li><a href="contact.html">Contact</a></li>
                                <li><a href="#">Pages</a>
                                    <ul>
                                        <li><a href="course.html">Course</a></li>
                                        <li><a href="course-details.html">course sinlge</a></li>
                                        <li><a href="teacher.html">teacher</a></li>
                                        <li><a href="teacher-details.html">teacher details</a></li>
                                        <li><a href="faq.html">FAQ</a></li>
                                        <li><a href="check-out.html">Check Out</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
