@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl ">
            <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
                <div class="col-xl-8">
                    <div class="card card-flush h-lg-100">
                        <div class="card-header pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-900">Statistik Pengunjung</span>
                            </h3>
                        </div>
                        <div class="card-body pt-0 px-0">
                            {{-- INI TEMPAT STAT NYA --}}
                            <div class="d-flex align-items-center px-9">
                                <div class="d-flex align-items-center me-6">
                                    <span class="rounded-1 bg-primary me-2 h-10px w-10px"></span>
                                    <span class="fw-semibold fs-6 text-gray-600">Gained</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="rounded-1 bg-success me-2 h-10px w-10px"></span>
                                    <span class="fw-semibold fs-6 text-gray-600">Lost</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card h-md-100" dir="ltr">
                        <div class="card-body d-flex flex-column flex-center">
                            <div class="mb-2">
                                <h1 class="fw-semibold text-gray-800 text-center lh-lg">
                                    Halo Admin 👋<br>
                                    <span class="fw-bolder">{{ Auth::user()->name }}</span>
                                </h1>
                                <div class="py-10 text-center">
                                    <img src="{{ asset("back/media/svg/illustrations/easy/1.svg") }}"
                                        class="theme-light-show w-200px" alt="">
                                    <img src="/metronic8/demo1/assets/media/svg/illustrations/easy/1-dark.svg"
                                        class="theme-dark-show w-200px" alt="">
                                </div>
                            </div>
                            <div class="text-center mb-1">
                               <p>
                                Selamat datang di halaman admin PDM Bukittinggi <br>
                                Dashboard ini adalah tempat untuk melihat data dan statistik dari website PDM Bukittinggi
                               </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5 g-xl-10">
                <div class="col-sm-6 col-xl-2 mb-xl-10">
                    <div class="card h-lg-100">
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">

                            <div class="d-flex flex-column my-7">
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">1</span>
                                <div class="m-0">
                                    <span class="fw-semibold fs-6 text-gray-500">Pengumuman</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-2 mb-xl-10">
                    <div class="card h-lg-100">
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <div class="d-flex flex-column my-7">
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ $berita_count }}</span>
                                <div class="m-0">
                                    <span class="fw-semibold fs-6 text-gray-500">Berita</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-2 mb-xl-10">
                    <div class="card h-lg-100">
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <div class="m-0">
                                <img src="/metronic8/demo1/assets/media/svg/brand-logos/dribbble-icon-1.svg"
                                    class="w-35px" alt="">
                            </div>
                            <div class="d-flex flex-column my-7">
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">84k</span>
                                <div class="m-0">
                                    <span class="fw-semibold fs-6 text-gray-500">Followers</span>
                                </div>
                            </div>
                            <span class="badge badge-light-success fs-base">
                                <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1"><span
                                        class="path1"></span><span class="path2"></span></i>
                                0.6%
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-2 mb-xl-10">
                    <div class="card h-lg-100">
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <div class="m-0">
                                <img src="/metronic8/demo1/assets/media/svg/brand-logos/twitter.svg" class="w-35px"
                                    alt="">
                            </div>
                            <div class="d-flex flex-column my-7">
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">570k</span>
                                <div class="m-0">
                                    <span class="fw-semibold fs-6 text-gray-500">Followers</span>
                                </div>
                            </div>
                            <span class="badge badge-light-success fs-base">
                                <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1"><span
                                        class="path1"></span><span class="path2"></span></i>
                                3%
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 mb-5 mb-xl-10">
                    <div class="card card-flush border-0 h-lg-100" data-bs-theme="light"
                        style="background-color: #7239EA">
                        <div class="card-header pt-2">
                            <h3 class="card-title">
                                <span class="text-white fs-3 fw-bold me-2">Facebook Campaign</span>
                                <span class="badge badge-success">Active</span>
                            </h3>

                        </div>
                        <div class="card-body d-flex justify-content-between flex-column pt-1 px-0 pb-0">
                            <div class="d-flex flex-wrap px-9 mb-5">
                                <div class="rounded min-w-125px py-3 px-4 my-1 me-6"
                                    style="border: 1px dashed rgba(255, 255, 255, 0.2)">
                                    <div class="d-flex align-items-center">
                                        <div class="text-white fs-2 fw-bold counted" data-kt-countup="true"
                                            data-kt-countup-value="4368" data-kt-countup-prefix="$"
                                            data-kt-initialized="1">$4,368</div>
                                    </div>
                                    <div class="fw-semibold fs-6 text-white opacity-50">New Followers</div>
                                </div>
                                <div class="rounded min-w-125px py-3 px-4 my-1"
                                    style="border: 1px dashed rgba(255, 255, 255, 0.2)">
                                    <div class="d-flex align-items-center">
                                        <div class="text-white fs-2 fw-bold counted" data-kt-countup="true"
                                            data-kt-countup-value="120,000" data-kt-initialized="1">120,000</div>
                                    </div>
                                    <div class="fw-semibold fs-6 text-white opacity-50">Followers Goal</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
