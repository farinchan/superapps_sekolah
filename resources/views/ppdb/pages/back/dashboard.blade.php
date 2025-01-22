@extends('ppdb.app-back')
@section('styles')
@endsection
@section('content')
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div class="d-flex flex-column flex-lg-row">
            <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
                <div class="card mb-5 mb-xl-8">
                    <div class="card-body">
                        <div class="d-flex flex-center flex-column py-5">
                            <div class="symbol symbol-100px symbol-circle mb-7">
                                <img src="{{ asset('img_ext/anonim_person.png') }}" alt="image" />
                            </div>
                            <a href="#"
                                class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $user->name }}</a>
                            <div class="mb-9">
                                <div class="badge badge-lg badge-light-primary d-inline">{{ $user->nisn }}</div>
                            </div>
                        </div>
                        <div class="d-flex flex-stack fs-4 py-3">
                            <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details"
                                role="button" aria-expanded="false" aria-controls="kt_user_view_details">Details
                                <span class="ms-2 rotate-180">
                                    <i class="ki-outline ki-down fs-3"></i>
                                </span>
                            </div>
                        </div>
                        <div class="separator"></div>
                        <div id="kt_user_view_details" class="collapse show">
                            <div class="pb-5 fs-6">
                                <div class="fw-bold mt-5">NISN</div>
                                <div class="text-gray-600">{{ $user->nisn }}</div>
                                <div class="fw-bold mt-5">Nama</div>
                                <div class="text-gray-600">{{ $user->name }}</div>
                                <div class="fw-bold mt-5">Asal sekolah</div>
                                <div class="text-gray-600">{{ $user->school_origin }}</div>
                                <div class="fw-bold mt-5">Email</div>
                                <div class="text-gray-600">
                                    <a href="#" class="text-gray-600 text-hover-primary">{{ $user->email }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-lg-row-fluid ms-lg-15">
                <div class="card bgi-position-y-bottom bgi-position-x-end bgi-no-repeat bgi-size-cover min-h-250px bg-body mb-5 mb-xl-8"
                    style="background-position: 100% 50px;background-size: 500px auto;background-image:url('{{ asset('back/media/misc/city.png') }}')"
                    dir="ltr">
                    <div class="card-body d-flex flex-column justify-content-center ps-lg-12">
                        <h3 class="text-gray-900 fs-2qx fw-bold mb-7">
                            Selamat Datang di Dashboard<br />
                            {{ $user->name }}
                        </h3>
                    </div>
                </div>
                <div class="row mb-5 mb-xl-8 g-5 g-xl-8">
                    <div class="col-md-4">
                        <a class="card flex-column justfiy-content-start align-items-start text-start w-100 text-gray-800 text-hover-primary p-10"
                            href="{{ route('ppdb.profile.my-data') }}">
                            <i class="ki-outline ki-user-edit fs-2tx mb-5 ms-n1 text-gray-500">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                            <span class="fs-4 fw-bold">Data Diri </span>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a class="card flex-column justfiy-content-start align-items-start text-start w-100 text-gray-800 text-hover-primary p-10"
                            href="{{ route('ppdb.profile.parent-data') }}">
                            <i class="ki-outline ki-profile-user fs-2tx mb-5 ms-n1 text-gray-500"></i>
                            <span class="fs-4 fw-bold">
                                Data Orang Tua </span>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a class="card flex-column justfiy-content-start align-items-start text-start w-100 text-gray-800 text-hover-primary p-10"
                            href="{{ route('ppdb.profile.other-data') }}">
                            <i class="ki-outline ki-document fs-2tx mb-5 ms-n1 text-gray-500"></i>
                            <span class="fs-4 fw-bold">Data Lainnya </span>
                        </a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-px text-center pt-15 pb-15">
                            <h2 class="fs-2x fw-bold mb-0">Pilih Jalur Pendaftaran</h2>
                            <p class="text-gray-500 fs-4 fw-semibold py-7">
                                Anda belum mendaftar pada jalur pendaftaran manapun <br> silahkan pilih jalur pendaftaran yang sesuai dengan anda.
                            </p>
                            <a href="#" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_select_users">Jalur Pendaftaran</a>
                        </div>
                        <div class="text-center pb-15 px-5">
                            <img src="{{ asset("back/media/illustrations/sketchy-1/17.png") }}" alt=""
                                class="mw-100 h-200px h-sm-325px" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Content-->
    <div class="modal fade" id="kt_modal_select_users" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-700px">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0 d-flex justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-10 pt-0 pb-15">
                    <div class="text-center mb-13">
                        <h1 class="d-flex justify-content-center align-items-center mb-3">Pilih Jalur Pendafaran
                        <span class="badge badge-circle badge-secondary ms-3">2</span></h1>
                        <div class="text-muted fw-semibold fs-5">Pilih jalur pendaftaran yang sesuai dengan anda.</div>
                        <div class="text-danger fw-semibold fs-5">*Setelah memilih jalur pendaftaran, anda tidak dapat mengubahnya lagi.</div>

                    </div>
                    <div class="mh-475px scroll-y me-n7 pe-7">
                        <div class="border border-hover-primary p-7 rounded mb-7">
                            <div class="d-flex flex-stack pb-3">
                                <div class="d-flex">
                                    <div class="symbol symbol-circle symbol-45px">
                                        <img src="assets/media/avatars/300-20.jpg" alt="" />
                                    </div>
                                    <div class="ms-5">
                                        <div class="d-flex align-items-center">
                                            <a href="pages/user-profile/overview.html" class="text-gray-900 fw-bold text-hover-primary fs-5 me-4">Emma Smith</a>
                                            <span class="badge badge-light-success d-flex align-items-center fs-8 fw-semibold">
                                            <i class="ki-outline ki-star fs-8 text-success me-1"></i>Author</span>
                                        </div>
                                        <span class="text-muted fw-semibold mb-3">Art Director</span>
                                    </div>
                                </div>
                                <div clas="d-flex">
                                    <div class="text-end pb-3">
                                        <span class="text-gray-900 fw-bold fs-5">$75.60</span>
                                        <span class="text-muted fs-7">/hr</span>
                                    </div>
                                </div>
                            </div>
                            <div class="p-0">
                                <div class="d-flex flex-column">
                                    <p class="text-gray-700 fw-semibold fs-6 mb-4">First, a disclaimer - the entire process writing a blog post often takes more.</p>
                                    <div class="d-flex text-gray-700 fw-semibold fs-7">
                                        <span class="border border-2 rounded me-3 p-1 px-2">Art Director</span>
                                        <span class="border border-2 rounded me-3 p-1 px-2">UX</span>
                                        <span class="border border-2 rounded me-3 p-1 px-2">Laravel</span>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="separator separator-dashed border-muted my-5"></div>
                                    <div class="d-flex flex-stack">
                                        <div class="d-flex flex-column mw-200px">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="text-gray-700 fs-6 fw-semibold me-2">90%</span>
                                                <span class="text-muted fs-8">Job Success</span>
                                            </div>
                                            <div class="progress h-6px w-200px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <a href="#" class="btn btn-sm btn-primary">Select</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border border-hover-primary p-7 rounded mb-7">
                            <div class="d-flex flex-stack pb-3">
                                <div class="d-flex">
                                    <div class="symbol symbol-circle symbol-45px">
                                        <img src="assets/media/avatars/300-11.jpg" alt="" />
                                    </div>
                                    <div class="ms-5">
                                        <div class="d-flex align-items-center">
                                            <a href="pages/user-profile/overview.html" class="text-gray-900 fw-bold text-hover-primary fs-5 me-4">Sean Bean</a>
                                            <span class="badge badge-light-success d-flex align-items-center fs-8 fw-semibold">
                                            <i class="ki-outline ki-star fs-8 text-success me-1"></i>Author</span>
                                        </div>
                                        <span class="text-muted fw-semibold mb-3">Project Manager</span>
                                    </div>
                                </div>
                                <div clas="d-flex">
                                    <div class="text-end pb-3">
                                        <span class="text-gray-900 fw-bold fs-5">$65.45</span>
                                        <span class="text-muted fs-7">/hr</span>
                                    </div>
                                </div>
                            </div>
                            <div class="p-0">
                                <div class="d-flex flex-column">
                                    <p class="text-gray-700 fw-semibold fs-6 mb-4">Outlines keep you honest. They stop you from indulging.</p>
                                    <div class="d-flex text-gray-700 fw-semibold fs-7">
                                        <span class="border border-2 rounded me-3 p-1 px-2">HTML</span>
                                        <span class="border border-2 rounded me-3 p-1 px-2">Javascript</span>
                                        <span class="border border-2 rounded me-3 p-1 px-2">Python</span>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="separator separator-dashed border-muted my-5"></div>
                                    <div class="d-flex flex-stack">
                                        <div class="d-flex flex-column mw-200px">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="text-gray-700 fs-6 fw-semibold me-2">58%</span>
                                                <span class="text-muted fs-8">Job Success</span>
                                            </div>
                                            <div class="progress h-6px w-200px">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 58%" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <a href="#" class="btn btn-sm btn-primary">Select</a>
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
