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
                <div class="d-flex flex-column flex-lg-row mb-17">
                    <div class="flex-lg-row-fluid me-0 me-lg-20">
                        <div class="mb-17">
                            <div class="mb-8">
                                <div class="d-flex flex-wrap mb-6">
                                    <div class="me-9 my-1">
                                        <i class="ki-outline ki-element-11 text-primary fs-2 me-1"></i>
                                        <span
                                            class="fw-bold text-gray-500">{{ $news->created_at->format('d F Y H:i') }}</span>
                                    </div>
                                    <div class="me-9 my-1">
                                        <i class="ki-outline ki-briefcase text-primary fs-2 me-1"></i>
                                        <span class="fw-bold text-gray-500">{{ $news->category->name }}</span>
                                    </div>
                                    <div class="my-1">
                                        <i class="ki-outline ki-message-text-2 text-primary fs-2 me-1"></i>
                                        <span class="fw-bold text-gray-500">{{ $news->comments->count() }} Komentar</span>
                                    </div>
                                </div>
                                <a href="#"
                                    class="text-gray-900 text-hover-primary fs-2 fw-bold">{{ $news->title }}</a>
                                <div class="overlay mt-8">
                                    <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-350px"
                                        style="background-image:url('{{ $news->getThumbnail() }}')"></div>
                                </div>
                            </div>
                            <div class="fs-5 ">
                                {!! $news->content !!}
                            </div>
                            <div
                                class="d-flex align-items-center border-1 border-dashed card-rounded p-5 p-lg-10 mb-14 mt-15">
                                <div class="text-center flex-shrink-0 me-7 me-lg-13">
                                    <div class="symbol symbol-70px symbol-circle mb-2">
                                        <img src="{{ $news->user->teacher->getPhoto() }}" class="" alt="" />
                                    </div>
                                    <div class="mb-0">
                                        <a href="pages/user-profile/overview.html"
                                            class="text-gray-700 fw-bold text-hover-primary">{{ $news->user->teacher->name }}</a>
                                        <span
                                            class="text-gray-500 fs-7 fw-semibold d-block mt-1">{{ $news->user->teacher->position }}</span>
                                    </div>
                                </div>
                                <div class="mb-0 fs-6">
                                    <div class="text-muted fw-semibold lh-lg mb-2">
                                        {{ $news->user->teacher->about }}
                                    </div>
                                    <a href="pages/user-profile/overview.html" class="fw-semibold link-primary"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-lg-row-auto w-100 w-lg-275px w-xxl-350px">
                        <div class="mb-15">
                            <h4 class="text-gray-900 mb-7">Berita Terbaru</h4>
                            @foreach ($list_berita_terbaru as $berita_terbaru)

                            <div class="d-flex flex-stack mb-7">
                                <div class="symbol symbol-60px symbol-2by3 me-4">
                                    <div class="symbol-label"
                                        style="background-image: url('{{ $berita_terbaru->getThumbnail() }}')"></div>
                                </div>
                                <div class="m-0">
                                    <a href="{{ route('ppdb.news.detail', $berita_terbaru->slug) }}" class="text-gray-900 fw-bold text-hover-primary fs-6">{{ Str::limit($berita_terbaru->title, 28) }}</a>
                                    <span class="text-gray-600 fw-semibold d-block pt-1 fs-7">
                                        {{ strip_tags(Str::limit($berita_terbaru->content, 80)) }}
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
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
                                                    <div class="text-gray-600 fw-semibold fs-6">{{ $achievement->name }}
                                                    </div>
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
