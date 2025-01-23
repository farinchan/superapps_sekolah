@extends('ppdb.app-front')
@section('styles')
@endsection
@section('content')
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div class="row g-5 g-xl-8">
            <div class="row flex-lg-row-reverse align-items-center g-5 py-5 mb-10">
                <div class="col-10 col-sm-8 col-lg-6">
                    <img src="{{ asset('img_ext/ppdb_siswa.png') }}" class="d-block mx-lg-auto img-fluid"
                        alt="Bootstrap Themes" width="700" height="500" loading="lazy">
                </div>
                <div class="col-lg-6">
                    <h1 class="fs-2hx text-gray-900 mb-5">
                        Mari Bergabung Bersama Kami di MAN 1 Padang Panjang
                    </h1>
                    <p class="fs-5 text-muted fw-semibold">PPDB telah dibuka untuk tahun ajaran baru! Nikmati pendidikan berkualitas dengan
                        fasilitas modern, bimbingan dari guru profesional, dan program unggulan yang mendukung prestasi
                        akademik dan pengembangan karakter. Jangan lewatkan kesempatan untuk menjadi bagian dari keluarga
                        besar MAN 1 Padang Panjang, tempat di mana impian masa depan Anda dimulai!"
                    </p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Daftar Sekarang</button>
                        <button type="button" class="btn btn-outline-secondary btn-lg px-4">Login</button>
                    </div>
                </div>
            </div>
            <div class="mb-18">
                <div class="text-center mb-12">
                    <h3 class="fs-2hx  mb-5 ">
                        <a class="text-gray-900 text-hover-primary" href="{{ route('teacher') }}">Bersama Dengan guru Profesional</a>
                    </h3>
                    <div class="fs-5 text-muted fw-semibold">
                        Guru-guru kami adalah profesional yang berpengalaman dan berdedikasi tinggi. <br> Mereka tidak hanya mengajar, tetapi juga memberikan bimbingan dan dukungan untuk meraih prestasi akademik dan pengembangan karakter.
                    </div>
                </div>
                <div class="tns tns-default mb-10">
                    <div data-tns="true" data-tns-loop="true" data-tns-swipe-angle="false" data-tns-speed="2000" data-tns-autoplay="true" data-tns-autoplay-timeout="18000" data-tns-controls="true" data-tns-nav="false" data-tns-items="1" data-tns-center="false" data-tns-dots="false" data-tns-prev-button="#kt_team_slider_prev" data-tns-next-button="#kt_team_slider_next" data-tns-responsive="{1200: {items: 3}, 992: {items: 2}}">
                        @foreach ($list_teacher as $teacher)

                        <div class="text-center">
                            <div class="octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-cover bgi-position-center" style="background-image:url('{{ $teacher->getPhoto() }}')"></div>
                            <div class="mb-0">
                                <a href="{{ route('staff.detail', $teacher->id) }}" class="text-gray-900 fw-bold text-hover-primary fs-3">{{ $teacher->name }}</a>
                                <div class="text-muted fs-6 fw-semibold mt-1">{{ $teacher->position }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_prev">
                        <i class="ki-outline ki-left fs-3x"></i>
                    </button>
                    <button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_next">
                        <i class="ki-outline ki-right fs-3x"></i>
                    </button>
                </div>
            </div>
            <div class="card bg-light mb-18">
                <div class="card-body py-15">
                    <div class="text-center mb-12">
                        <h3 class="fs-2hx  mb-5 ">
                            <a class="text-gray-900 text-hover-primary" href="{{ route('teacher') }}">Mengenai Kami</a>
                        </h3>
                        <div class="fs-5 text-muted fw-semibold">
                            Dengan Tenaga Pendidik yang profesional kami telah menghasilkan lulusan yang berkualitas <br> dan siap bersaing di era global.
                        </div>
                    </div>
                    <div class="d-flex flex-center">
                        <div class="d-flex flex-center flex-wrap mb-10 mx-auto gap-5 w-xl-900px">
                            <div class="octagon d-flex flex-center h-200px w-200px bg-body mx-lg-10">
                                <div class="text-center">
                                    <i class="ki-outline ki-profile-user fs-2tx text-primary"></i>
                                    <div class="mt-1">
                                        <div class="fs-lg-2hx fs-2x fw-bold text-gray-800 d-flex justify-content-center">
                                            <div class="min-w-70px" data-kt-countup="true" data-kt-countup-value="{{ $tenaga_pendidik_kependidikan }}">0
                                            </div>
                                        </div>
                                        <span class="text-gray-600 fw-semibold fs-5 lh-0">Tenaga Pendidik <br> & Kependidikan</span>
                                    </div>
                                </div>
                            </div>
                            <div class="octagon d-flex flex-center h-200px w-200px bg-body mx-lg-10">
                                <div class="text-center">
                                    <i class="ki-outline ki-people fs-2tx text-success"></i>
                                    <div class="mt-1">
                                        <div class="fs-lg-2hx fs-2x fw-bold text-gray-800 d-flex justify-content-center">
                                            <div class="min-w-50px" data-kt-countup="true" data-kt-countup-value="{{ $siswa_count }}">0
                                            </div>
                                        </div>
                                        <span class="text-gray-600 fw-semibold fs-5 lh-0">siswa Aktif</span>
                                    </div>
                                </div>
                            </div>
                            <div class="octagon d-flex flex-center h-200px w-200px bg-body mx-lg-10">
                                <div class="text-center">
                                    <i class="ki-outline ki-user-tick fs-2tx text-info"></i>
                                    <div class="mt-1">
                                        <div class="fs-lg-2hx fs-2x fw-bold text-gray-800 d-flex align-items-center">
                                            <div class="min-w-50px" data-kt-countup="true" data-kt-countup-value="{{ $alumni_count }}">0
                                            </div>RB+
                                        </div>
                                        <span class="text-gray-600 fw-semibold fs-5 lh-0">Alumni</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
