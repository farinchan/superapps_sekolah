<header>
    <div class="runing-text-area">
        <div class="container">
            <div class="row">
                <div class="col-md-3" style="color: #fff; font-size: 14px;">
                    <i class="fas fa-calendar-alt"></i>&nbsp;
                    {{ \Carbon\Carbon::setLocale('id') }}
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                    {{-- /{{ \Alkoumi\LaravelHijriDate\Hijri::Date('l d F Y') }} --}}
                </div>
                <div class="col-md-9">
                    <marquee behavior="scroll" direction="left" class="runing-text" onmouseover="this.stop();"
                        onmouseout="this.start();">
                        Selamat Datang di Website Resmi MAN 1 Padang Panjang
                    </marquee>
                </div>
            </div>
        </div>
    </div>

    <div id="main-menu" class="main-menu-container">
        <div class="main-menu">
            <div class="container">

                <div class="navbar-default">
                    <div class="navbar-header float-left">
                        <a class="navbar-brand text-uppercase" href="{{ route('home') }}"><img
                                src="{{ $setting_web->getLogo() }}" style="height: 60px;" alt="logo"></a>
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
                                                <img src=" {{ Storage::url($setting_web->logo) }} " width="100"
                                                    alt="">
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
                                                    <input class="name" name="identifier" type="text"
                                                        value="{{ old('identifier') }}" placeholder="Identitas (NISN/NIP/NIK)*">
                                                    @error('identifier')
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
                            <a href="{{ route('back.dashboard') }}">Dashboard</a>
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
                                        @php
                                            $profil_menu = \App\Models\MenuProfil::all();
                                        @endphp
                                        @foreach ($profil_menu as $profil)
                                            <li><a
                                                    href="{{ route('profil.show', $profil->slug) }}">{{ $profil->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="menu-item-has-children ul-li-block">
                                    <a href="#!">Personalia</a>
                                    <ul class="sub-menu">
                                        @php
                                            $personalia_menu = \App\Models\MenuPersonalia::all();
                                        @endphp
                                        @foreach ($personalia_menu as $personalia)
                                            <li><a
                                                    href="{{ route('personalia.show', $personalia->slug) }}">{{ $personalia->name }}</a>
                                            </li>
                                        @endforeach
                                        <li><a href="{{ route('teacher') }}">Tenaga Pendidik</a></li>
                                        <li><a href="{{ route('staff') }}">Tenaga Kependidikan</a></li>
                                        <li><a href="{{ route('student') }}">Siswa/Siswi</a></li>

                                    </ul>
                                </li>
                                <li class="menu-item-has-children ul-li-block">
                                    <a href="#!">Ekstrakurikuler</a>
                                    <ul class="sub-menu">
                                        @php
                                            $extracurriculars = \App\Models\Extracurricular::all();
                                        @endphp
                                        @foreach ($extracurriculars as $extracurricular)
                                            <li><a
                                                    href="{{ route('extracurricular.show', $extracurricular->slug) }}">{{ $extracurricular->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="menu-item-has-children ul-li-block">
                                    <a href="#!">Prestasi</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('achievement.student') }}">Prestasi Siswa</a></li>
                                        <li><a href="{{ route('achievement.teacher') }}">Prestasi Guru</a></li>
                                        <li><a href="">Prestasi Sekolah</a></li>
                                    </ul>
                                </li>

                                <li><a href="">E-Learning</a></li>
                                <li><a href="{{ route("ppdb.home") }}">PPDB</a></li>


                            </ul>
                        </div>
                    </nav>

                    <div class="mobile-menu">
                        <div class="logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ $setting_web->getLogo() }}" alt="Logo">
                            </a>
                        </div>
                        <nav>
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li>
                                    <a href="{{ route('news.index') }}">Berita</a>
                                    <ul>
                                        @foreach ($categories as $category)
                                            <li><a
                                                    href="{{ route('news.category', $category->slug) }}">{{ $category->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="#!">Profil</a>
                                    <ul>
                                        @foreach ($profil_menu as $profil)
                                            <li><a
                                                    href="{{ route('profil.show', $profil->slug) }}">{{ $profil->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li>
                                    <a href="#!">Personalia</a>
                                    <ul>
                                        @foreach ($personalia_menu as $personalia)
                                            <li><a
                                                    href="{{ route('personalia.show', $personalia->slug) }}">{{ $personalia->name }}</a>
                                            </li>
                                        @endforeach
                                        <li><a href="{{ route('teacher') }}">Tenaga Pendidik</a></li>
                                        <li><a href="{{ route('staff') }}">Tenaga Kependidikan</a></li>

                                    </ul>
                                </li>
                                <li>
                                    <a href="#!">Ekstrakurikuler</a>
                                    <ul>
                                        @foreach ($extracurriculars as $extracurricular)
                                            <li><a
                                                    href="{{ route('extracurricular.show', $extracurricular->slug) }}\">{{ $extracurricular->name }}</a>
                                                ">{{ $extracurricular->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li>
                                    <a href="#!">Prestasi</a>
                                    <ul>
                                        <li><a href="{{ route('achievement.student') }}">Prestasi Siswa</a></li>
                                        <li><a href="{{ route('achievement.teacher') }}">Prestasi Guru</a></li>
                                        <li><a href="">Prestasi Sekolah</a></li>
                                    </ul>
                                </li>
                                <li><a href="">E-Learning</a></li>
                                <li><a href="">PPDB</a></li>

                            </ul>
                        </nav>

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
