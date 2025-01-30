@extends('ppdb.app-front')
@section('styles')
@endsection
@section('content')
    @php
        $setting_website = \App\Models\SettingWebsite::first();
    @endphp
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <div class="card-body p-lg-17">
                <div class="position-relative mb-17">
                    <div class="overlay overlay-show">
                        <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-250px"
                            style="background-image:url('{{ asset("front/img/banner/brt-1.jpg") }}')"></div>
                        <div class="overlay-layer rounded bg-black" style="opacity: 0.4"></div>
                    </div>
                    <div class="position-absolute text-white mb-8 ms-10 bottom-0">
                        <h3 class="text-white fs-2qx fw-bold mb-3 m">Papan Informasi</h3>
                        <div class="fs-5 fw-semibold">
                            Informasi terkait PPDB yang dapat membantu anda dalam melakukan pendaftaran PPDB.
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column flex-lg-row mb-17">
                    <div class="flex-lg-row-fluid me-0 me-lg-20">
                        <div class="mb-17">
                            <div class="mb-15">
                                <h3 class="fs-2hx text-gray-800 w-bolder mb-6">Informasi</h3>
                                {!! $information->information?? "" !!}
                            </div>
                            <div class="m-0">
                                <h4 class="fs-1 text-gray-800 w-bolder mb-6">Jalur Pendaftaran PPDB</h4>
                                <p class="fw-semibold fs-4 text-gray-600 mb-2">
                                    Berikut merupakan jalur pendaftaran PPDB yang tersedia yang dapat diikuti oleh calon siswa baru, silahkan pilih jalur pendaftaran yang sesuai dengan kebutuhan anda. Jika anda memiliki pertanyaan seputar jalur pendaftaran PPDB, silahkan hubungi kami melalui kontak yang tersedia.
                                </p>
                            </div>
                            @foreach ($list_path as $path)

                            <div class="m-0">
                                <div class="d-flex align-items-center collapsible py-3 toggle mb-0"
                                    data-bs-toggle="collapse" data-bs-target="#kt_path_{{ $path->id }}">
                                    <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                        <i class="ki-outline ki-minus-square toggle-on text-primary fs-1"></i>
                                        <i class="ki-outline ki-plus-square toggle-off fs-1"></i>
                                    </div>
                                    <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">{{ $path->name }} T.A. {{ $path->schoolYear->start_year }}/{{ $path->schoolYear->end_year }}</h4>
                                </div>
                                <div id="kt_path_{{ $path->id }}" class="collapse fs-6 ms-1">
                                    <div class="mb-2 ps-10 text-gray-600 fw-semibold fs-5">
                                        {{ $path->description }}
                                    </div>
                                    <div class="mb-4 ps-10 text-gray-600 fw-semibold fs-5">
                                        Waktu Pendaftaran: <strong>{{ \Carbon\Carbon::parse($path->start_date)->format('d F Y') }} - {{ \Carbon\Carbon::parse($path->end_date)->format('d F Y') }}</strong>
                                    </div>
                                </div>
                                <div class="separator separator-dashed"></div>
                            </div>
                            @endforeach
                            <a href="{{ route("ppdb.register") }}" class="btn btn-sm btn-primary mt-5">Daftar Sekarang</a>
                        </div>
                    </div>
                    <div class="flex-lg-row-auto w-100 w-lg-275px w-xxl-350px">
                        <div class="card bg-light">
                            <div class="card-body">
                                <div class="mb-7">
                                    <h2 class="fs-1 text-gray-800 w-bolder mb-6">Tentang Kami</h2>
                                    <p class="fw-semibold fs-6 text-gray-600">
                                        {{ strip_tags($setting_website->about) }}
                                    </p>
                                </div>
                                <div class="mb-8">
                                    <h4 class="text-gray-700 w-bolder mb-0">Prestasi Siswa Kami</h4>
                                    <div class="my-2">
                                        @foreach ($list_achievement as $achievement)
                                            <div class="d-flex align-items-center mb-3">
                                                <span class="bullet me-3"></span>
                                                <a href="{{ route('achievement.student.detail', $achievement->id) }}">
                                                    <div class="text-gray-600 fw-semibold fs-6">{{ $achievement->name }}</div>
                                                </a>
                                            </div>
                                        @endforeach
                                        <div class="d-flex align-items-center mb-3">
                                            <span class="bullet me-3"></span>
                                            <a href="{{ route('achievement.student') }}">
                                                <div class="text-gray-600 fw-semibold fs-6">Lebih Banyak..</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4 bg-light text-center">
                    <div class="card-body py-12">
                        <a href="{{ $setting_website->facebook }}" class="mx-4">
                            <img src="{{ asset('back/media/svg/brand-logos/facebook-4.svg') }}" class="h-30px my-2"
                                alt="" />
                        </a>
                        <a href="{{ $setting_website->instagram }}" class="mx-4">
                            <img src="{{ asset('back/media/svg/brand-logos/instagram-2-1.svg') }}" class="h-30px my-2"
                                alt="" />
                        </a>
                        <a href="{{ $setting_website->twitter }}" class="mx-4">
                            <img src="{{ asset('back/media/svg/brand-logos/twitter.svg') }}" class="h-30px my-2"
                                alt="" />
                        </a>
                        <a href="{{ $setting_website->youtube }}" class="mx-4">
                            <img src="{{ asset('back/media/svg/brand-logos/youtube-play.svg') }}" class="h-30px my-2"
                                alt="" />
                        </a>
                        <a href="{{ $setting_website->telegram }}" class="mx-4">
                            <img src="{{ asset('back/media/svg/brand-logos/telegram.svg') }}" class="h-30px my-2"
                                alt="" />
                        </a>
                        <a href="{{ $setting_website->linkedin }}" class="mx-4">
                            <img src="{{ asset('back/media/svg/brand-logos/linkedin-1.svg') }}" class="h-30px my-2"
                                alt="" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
