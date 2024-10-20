<footer>
    <section id="footer-area" class="footer-area-section">
        <div class="container">
            <div class="footer-content pb10">
                <div class="row">
                    <div class="col-md-3">
                        <div class="footer-widget "  >
                            <div class="footer-logo mb35">
                                <img src="assets/img/logo/f-logo.png" alt="">
                            </div>
                            <div class="footer-about-text">
                                <p>
                                    {{ strip_tags(Str::limit($setting_web->about, 200)) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-widget "  >
                            <div class="footer-menu ul-li-block">
                                <h2 class="widget-title">Weblink</h2>
                                <ul>
                                    <li><a href="#"><i class="fas fa-caret-right"></i>Berita</a></li>
                                    <li><a href="#"><i class="fas fa-caret-right"></i>Agenda</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-menu ul-li-block "  >
                            <h2 class="widget-title">External Link</h2>
                            <ul>
                                <li><a href="#"><i class="fas fa-caret-right"></i>PPDB</a></li>
                                <li><a href="#"><i class="fas fa-caret-right"></i>PPID</a></li>
                                <li><a href="#"><i class="fas fa-caret-right"></i>PTSP</a></li>
                                <li><a href="#"><i class="fas fa-caret-right"></i>Pustaka Digital</a></li>
                                <li><a href="#"><i class="fas fa-caret-right"></i>E-learning</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="footer-widget "  >
                            <h2 class="widget-title">Photo Gallery</h2>
                            <div class="photo-list ul-li">
                                <ul>
                                    @php
                                        $foto_gallery = App\Models\Gallery::where('type', 'foto')->latest()->take(6)->get();
                                    @endphp
                                    @foreach ( $foto_gallery as $foto )
                                        <li>
                                            <img src="{{ asset('storage/gallery/' . $foto->image) }}" alt="">
                                            <div class="blakish-overlay"></div>
                                            <div class="pop-up-icon">
                                                <a href="{{ asset('storage/gallery/' . $foto->image) }}" data-lightbox="roadtrip">
                                                    <i class="fas fa-search"></i>
                                                </a>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /footer-widget-content -->
            <div class="footer-social-subscribe mb65">
                <div class="row">
                    <div class="col-md-3">
                        <div class="footer-social ul-li "  >
                            <h2 class="widget-title">Social Network</h2>
                            <ul>
                                @if ($setting_web->facebook)
                                    <li><a href="{{ $setting_web->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                                @endif
                                @if ($setting_web->twitter)
                                    <li><a href="{{ $setting_web->twitter }}"><i class="fab fa-twitter"></i></a></li>
                                @endif
                                @if ($setting_web->instagram)
                                    <li><a href="{{ $setting_web->instagram }}"><i class="fab fa-instagram"></i></a></li>
                                @endif
                                @if ($setting_web->linkedin)
                                    <li><a href="{{ $setting_web->linkedin }}"><i class="fab fa-linkedin"></i></a></li>
                                @endif
                                @if ($setting_web->youtube)
                                    <li><a href="{{ $setting_web->youtube }}"><i class="fab fa-youtube"></i></a></li>
                                @endif
                                @if ($setting_web->whatsapp)
                                    <li><a href="{{ $setting_web->whatsapp }}"><i class="fab fa-whatsapp"></i></a></li>
                                @endif

                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="subscribe-form "  >
                            <h2 class="widget-title">Subscribe Newsletter</h2>

                            <div class="subs-form relative-position">
                                <form action="#" method="post">
                                    <input class="course" name="course" type="email" placeholder="Email Address.">
                                    <div class="nws-button text-center  gradient-bg text-uppercase">
                                        <button type="submit" value="Submit">Subscribe now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="copy-right-menu">
                <div class="row">
                    <div class="col-md-6">
                        <div class="copy-right-text">
                            <p>© {{ date('Y') }} - {{ $setting_web->name?? "" }}. All rights reserved</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="copy-right-menu-item float-right ul-li">
                            <ul>
                                <li><a href="#">License</a></li>
                                <li><a href="#">Ketentuan dan Kebijakan</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</footer>
