<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
        <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true"
            data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">


            <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu"
                data-kt-menu="true" data-kt-menu-expand="false">
                <div data-kt-menu-trigger="click"
                    class="menu-item menu-accordion @if (request()->routeIs('back.dashboard') || request()->routeIs('back.dashboard.*')) here show @endif"><span
                        class="menu-link"><span class="menu-icon"><i class="ki-duotone ki-element-11 fs-2"><span
                                    class="path1"></span><span class="path2"></span><span class="path3"></span><span
                                    class="path4"></span></i></span><span class="menu-title">Dashboards</span><span
                            class="menu-arrow"></span></span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link @if (request()->routeIs('back.dashboard')) active @endif"
                                href="{{ route('back.dashboard') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Default</span>
                            </a>
                        </div>
                        @role('humas|kepsek|admin')
                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.dashboard.news')) active @endif"
                                    href="{{ route('back.dashboard.news') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Berita</span>
                                </a>
                            </div>
                        @endrole
                        @role('proktor|kepsek|admin')
                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.dashboard.log')) active @endif"
                                    href="{{ route('back.dashboard.log') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">LOG</span>
                                </a>
                            </div>
                        @endrole
                    </div>
                </div>




                @role('admin|humas|guru')
                    <div class="menu-item pt-5">
                        <div class="menu-content"><span class="menu-heading fw-bold text-uppercase fs-7">Post</span>
                        </div>
                    </div>
                @endrole

                @role('admin|humas')
                    <div class= "menu-item">
                        <a class="menu-link @if (request()->routeIs('back.announcement.*')) active @endif"
                            href=" {{ route('back.announcement.index') }} ">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-information fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                            <span class="menu-title">Pengumuman</span>
                        </a>
                    </div>

                    <div class= "menu-item">
                        <a class="menu-link @if (request()->routeIs('back.event.*')) active @endif"
                            href=" {{ route('back.event.index') }} ">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-pin fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Agenda</span>
                        </a>
                    </div>
                @endrole


                @role('admin|humas')
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion @if (request()->routeIs('back.news.*')) here show @endif">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-book fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </span>
                            <span class="menu-title">Berita</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.news.category')) active @endif"
                                    href="{{ route('back.news.category') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Kategori</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.news.index')) active @endif"
                                    href="{{ route('back.news.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">List Berita</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.news.comment')) active @endif"
                                    href="{{ route('back.news.comment') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Komentar</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endrole

                @role('admin|guru')
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion @if (request()->routeIs('back.blog_teacher.*')) here show @endif">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-award fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                            <span class="menu-title">Blog Guru</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.blog_teacher.index')) active @endif
                            "
                                    href="{{ route('back.blog_teacher.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">List Blog</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.blog_teacher.comment')) active @endif"
                                    href="{{ route('back.blog_teacher.comment') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Komentar</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endrole

                @role('admin|humas')
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion @if (request()->routeIs('back.gallery.*')) here show @endif">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-picture fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Galeri</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.gallery.album')) active @endif"
                                    href="{{ route('back.gallery.album') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Album</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.gallery.index')) active @endif"
                                    href="{{ route('back.gallery.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Foto & Video</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endrole

                @role('admin')
                    <div class= "menu-item">
                        <a class="menu-link @if (request()->routeIs('back.sekapur_sirih')) active @endif"
                            href="{{ route('back.sekapur_sirih') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-star fs-2"></i>
                            </span>
                            <span class="menu-title">Sekapur Sirih</span>
                        </a>
                    </div>
                @endrole

                @role('admin|humas')
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion @if (request()->routeIs('back.achievement.*')) here show @endif">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-medal-star fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </span>
                            <span class="menu-title">Prestasi</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.achievement.student.*')) active @endif"
                                    href="{{ route('back.achievement.student.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Prestasi Siswa</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.achievement.teacher.*')) active @endif"
                                    href="{{ route('back.achievement.teacher.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Prestasi Guru</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endrole

                @role('admin')
                    <div class= "menu-item">
                        <a class="menu-link @if (request()->routeIs('back.calendar.*')) active @endif"
                            href="{{ route('back.calendar.index') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-calendar-2 fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Kalender Akademik</span>
                        </a>
                    </div>
                @endrole

                @role('admin|bendahara')
                    <div class="menu-item pt-5">
                        <div class="menu-content"><span class="menu-heading fw-bold text-uppercase fs-7">
                                Keuangan
                            </span>
                        </div>
                    </div>
                @endrole

                @role('orangtua|siswa')
                    <div class="menu-item">
                        <a class="menu-link @if (request()->routeIs('back.billing.student.index')) active @endif"
                            href="{{ route('back.billing.student.index') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-two-credit-cart fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Tagihan Siswa</span>
                        </a>
                    </div>
                @endrole

                @role('admin|bendahara')
                    <div class="menu-item">
                        <a class="menu-link @if (request()->routeIs('back.billing.index')) active @endif"
                            href="{{ route('back.billing.index') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-two-credit-cart fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Tagihan</span>
                        </a>
                    </div>

                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion @if (request()->routeIs('back.billing.*')) here show @endif">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-bill fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                </i>
                            </span>
                            <span class="menu-title">Pembayaran</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.billing.confirm-payment')) active @endif"
                                    href="{{ route('back.billing.confirm-payment') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Konfirmasi Pembayaran</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.billing.paid-payment')) active @endif"
                                    href="{{ route('back.billing.paid-payment') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Diterima</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.billing.rejected-payment')) active @endif"
                                    href="{{ route('back.billing.rejected-payment') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Ditolak</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endrole


                @role('admin')
                    <div class="menu-item pt-5">
                        <div class="menu-content"><span class="menu-heading fw-bold text-uppercase fs-7">
                                Presensi
                            </span>
                        </div>
                    </div>

                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-user-tick fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                            <span class="menu-title">Presensi Siswa</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.student-attendance.index')) active @endif"
                                    href="{{ route('back.student-attendance.scan') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Scan</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.student-attendance.timetable')) active @endif"
                                    href="{{ route('back.student-attendance.timetable') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Jadwal</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link " href="#">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">History</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="#">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-profile-user fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </span>
                            <span class="menu-title">Presensi Guru</span>
                        </a>
                    </div>
                @endrole


                @role('admin|guru|guru_bk|siswa')
                    <div class="menu-item pt-5">
                        <div class="menu-content"><span class="menu-heading fw-bold text-uppercase fs-7">
                                Kedisiplinan
                            </span>
                        </div>
                    </div>
                @endrole

                @role('admin|guru|guru_bk')
                    <div class="menu-item">
                        <a class="menu-link @if (request()->routeIs('back.discipline.student.create')) active @endif"
                            href="{{ route('back.discipline.student.create') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-notepad-edit fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Catat Pelanggaran</span>
                        </a>
                    </div>

                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion @if (request()->routeIs('back.discipline.rule.*') || request()->routeIs('back.discipline.student.index')) here show @endif">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-shield-cross fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                            <span class="menu-title">Pelanggaran</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.discipline.rule.index')) active @endif"
                                    href="{{ route('back.discipline.rule.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Rules</span>
                                </a>
                            </div>
                        </div>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.discipline.student.index')) active @endif"
                                    href="{{ route('back.discipline.student.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">History</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endrole

                @role('admin|guru|proktor')
                    <div class="menu-item pt-5">
                        <div class="menu-content"><span class="menu-heading fw-bold text-uppercase fs-7">
                                E-Learning
                            </span>
                        </div>
                    </div>
                @endrole

                @role('admin|guru')
                    <div class="menu-item">
                        <a class="menu-link @if (request()->routeIs('back.exam.index')) active @endif"
                            href="{{ route('back.exam.index') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-tablet-book fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Ujian</span>
                        </a>
                    </div>
                @endrole
                @role('admin|proktor')
                    <div class="menu-item">
                        <a class="menu-link @if (request()->routeIs('back.exam.proktor')) active @endif"
                            href="{{ route('back.exam.proktor') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-tablet-down fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                            <span class="menu-title">Proktor Ujian</span>
                        </a>
                    </div>
                @endrole




                @role('admin')
                    <div class="menu-item pt-5">
                        <div class="menu-content"><span class="menu-heading fw-bold text-uppercase fs-7">Menu</span>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link @if (request()->routeIs('back.menu.profil.*')) active @endif"
                            href="{{ route('back.menu.profil.index') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-setting-3 fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Profil Menu</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link @if (request()->routeIs('back.menu.personalia.*')) active @endif"
                            href="{{ route('back.menu.personalia.index') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-setting-3 fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Personalia Menu</span>
                        </a>
                    </div>
                @endrole

                @role('admin')
                    <div class="menu-item pt-5">
                        <div class="menu-content"><span
                                class="menu-heading fw-bold text-uppercase fs-7">Administrator</span>
                        </div>
                    </div>



                    <div class="menu-item">
                        <a class="menu-link" href="">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-sms fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Inbox</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link @if (request()->routeIs('back.partner-link.index')) active @endif"
                            href="{{ route('back.partner-link.index') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-fasten fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Partner Link</span>
                        </a>
                    </div>

                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion @if (request()->routeIs('back.user.*') ||
                                request()->routeIs('back.classroom.*') ||
                                request()->routeIs('back.school-year.*') ||
                                request()->routeIs('back.extracurricular.*')) here show @endif">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-like-folder fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Master Data</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.user.staff.*')) active @endif"
                                    href="{{ route('back.user.staff.index') }}">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-people">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">Tenaga Pendidik & kependidikan</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.user.student.*')) active @endif"
                                    href="{{ route('back.user.student.index') }}">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-user">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">Siswa</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.user.parent.*')) active @endif"
                                    href="{{ route('back.user.parent.index') }}">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-profile-user">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">Orang Tua</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.classroom.*')) active @endif"
                                    href="{{ route('back.classroom.index') }}">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-bank">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">Kelas</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.subject.index')) active @endif"0
                                    href="{{ route('back.subject.index') }}">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-questionnaire-tablet                        ">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">Mata Pelajaran</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.school-year.index')) active @endif"0
                                    href="{{ route('back.school-year.index') }}">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-calendar-8">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                            <span class="path6"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">Tahun Ajaran</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.extracurricular.index')) active @endif"
                                    href="{{ route('back.extracurricular.index') }}">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-scroll">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">Ekstrakurikuler</span>
                                </a>
                            </div>

                        </div>
                    </div>

                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion @if (request()->routeIs('back.setting.*')) here show @endif">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-setting-2 fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Pengaturan</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.setting.website')) active @endif"
                                    href="{{ route('back.setting.website') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Website</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link @if (request()->routeIs('back.setting.banner')) active @endif"
                                    href="{{ route('back.setting.banner') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Banner</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endrole

            </div>
        </div>
    </div>
</div>
