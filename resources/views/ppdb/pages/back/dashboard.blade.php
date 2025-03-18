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
                <div class="card mb-5 mb-xl-8">
                    <a href="https://wa.me/6289518457796" target="_blank">
                        <div class="card-body border border-hover-primary rounded">

                            <div class="">


                                <img src="{{ asset('img_ext/help_ppdb.svg') }}" alt="" width="100%">
                            </div>
                        </div>
                    </a>
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
                                Data Keluarga </span>
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
                @if ($path_select_check)
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List Pendaftaran</h3>
                            {{-- <div class="card-toolbar">
                                <button type="button" class="btn btn-sm btn-light">
                                    pilih Jalur Lain
                                </button>
                            </div> --}}
                        </div>
                    </div>
                    @foreach ($my_list_path as $my_path)
                        <div class="border border-hover-primary rounded mt-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-stack pb-3">
                                        <div class="d-flex">
                                            <div class="">
                                                <div class="d-flex align-items-center">
                                                    <a href="#"
                                                        class="text-gray-900 fw-bold text-hover-primary fs-5 me-4">
                                                        {{ $my_path->path->name }}
                                                    </a>
                                                </div>
                                                <span class="text-muted fw-semibold mb-3">
                                                    T.A
                                                    {{ $my_path->path->schoolYear->start_year }}/{{ $my_path->path->schoolYear->end_year }}
                                                </span>
                                            </div>
                                        </div>
                                        <div clas="d-flex">
                                            <div class="text-end pb-3">
                                                <span class="text-muted fs-7">ID Pendaftaran</span><br>
                                                <span class="text-info fw-bold fs-5">
                                                    #{{ $my_path->path->id }}/{{ $my_path->id }}/{{ $my_path->user->nisn }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-0">
                                        <div class="d-flex flex-column">
                                            <p class="text-gray-700 fw-semibold fs-6 mb-4">
                                                {{ $my_path->path->description }}
                                            </p>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <div class="separator separator-dashed border-muted my-5"></div>
                                            <div class="d-flex flex-stack">
                                                <div class="d-flex flex-column mw-300px">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <span class="text-gray-700 fs-6 fw-semibold me-2">Status Berkas:
                                                        </span>
                                                        @if ($my_path->status_berkas == 'sedang diverifikasi')
                                                            <span class="badge badge-light-primary">Sedang
                                                                Diverifikasi</span>
                                                        @elseif($my_path->status_berkas == 'diterima')
                                                            <span class="badge badge-light-success">Diterima</span>
                                                        @elseif($my_path->status_berkas == 'perbaiki')
                                                            <span class="badge badge-light-warning">Perbaiki</span>
                                                        @elseif($my_path->status_berkas == 'ditolak')
                                                            <span class="badge badge-light-danger">Ditolak</span>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <span class="text-gray-700 fs-6 fw-semibold me-2">Status Kelulusan:
                                                        </span>
                                                        @if (
                                                            $my_path->status_kelulusan != 'CADANGAN' &&
                                                                $my_path->status_kelulusan != 'TIDAK LULUS' &&
                                                                $my_path->status_kelulusan != '-')
                                                            <span
                                                                class="badge badge-light-success">{{ $my_path->status_kelulusan }}</span>
                                                        @elseif ($my_path->status_kelulusan == '-')
                                                            <span class="badge badge-light-primary">-</span>
                                                        @elseif ($my_path->status_kelulusan == 'CADANGAN')
                                                            <span class="badge badge-light-warning">CADANGAN</span>
                                                        @elseif ($my_path->status_kelulusan == 'TIDAK LULUS')
                                                            <span class="badge badge-light-danger">TIDAK LULUS</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div>
                                                    <a href="{{ $my_path->path->wa_group }}" target="_blank"
                                                        class="btn btn-sm btn-light" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Bergabung Ke Whatsapp Grup">
                                                        <img src="{{ asset('img_ext/whatsapp.svg') }}" alt="WA Group"
                                                            width="40px">
                                                    </a>
                                                    @if ($my_path->status_berkas == 'diterima')
                                                        <a href="{{ route('ppdb.registerPathCard', $my_path->path->id) }}"
                                                            class="btn btn-sm btn-light" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Cetak Kartu Ujian">
                                                            <img src="{{ asset('img_ext/print.svg') }}" alt="Kartu Ujian"
                                                                width="40px">
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                            @if ($my_path->reason != null && $my_path->reason != '' && isset($my_path->reason))
                                                <div class="separator separator-dashed border-muted my-5"></div>

                                                @if (
                                                    $my_path->status_kelulusan == 'CADANGAN' ||
                                                        $my_path->status_kelulusan == 'TIDAK LULUS' ||
                                                        $my_path->status_kelulusan == '-')
                                                    <div class="d-flex flex-stack">
                                                        <div class="d-flex flex-column ">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <span class="text-gray-700 fs-6 fw-bold me-2">Tanggapan:
                                                                </span>
                                                            </div>
                                                            <p class="fs-6 text-gray-700">
                                                                {{ $my_path->reason }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="d-flex flex-stack">
                                                        <div class="d-flex flex-column ">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <span class="text-gray-700 fs-6 fw-bold me-2">Tanggapan:
                                                                </span>
                                                            </div>
                                                            <p class="fs-6 text-gray-700">
                                                                SELAMAT ANANDA {{ $my_path->status_kelulusan }} DI MAN 1 KOTA PADANG PANJANG
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <a href="#"
                                                               class="ms-3 btn btn-sm btn-success" style="width: 100px" data-bs-toggle="modal"
                                                               data-bs-target="#re_registration">
                                                               Pendaftaran Ulang Disini
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if ($path_rejected_check)
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="card-px text-center pt-15 pb-15">
                                    <h2 class="fs-2x fw-bold mb-0">Pilih Jalur Pendaftaran Lain</h2>
                                    <p class="text-gray-500 fs-4 fw-semibold py-7">
                                        Sepertinya anda dinyatakan tidak lulus pada jalur pendaftaran sebelumnya <br>
                                        Tapi Jangan Sedih kami membuka peluang untuk anda memilih jalur pendaftaran lain😀.
                                    </p>
                                    <a href="#" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_select_users">Jalur Pendaftaran</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="card">
                        <div class="card-body">
                            <div class="card-px text-center pt-15 pb-15">
                                <h2 class="fs-2x fw-bold mb-0">Pilih Jalur Pendaftaran</h2>
                                <p class="text-gray-500 fs-4 fw-semibold py-7">
                                    Anda belum mendaftar pada jalur pendaftaran manapun <br> silahkan pilih jalur
                                    pendaftaran yang sesuai dengan anda.
                                </p>
                                <a href="#" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_select_users">Jalur Pendaftaran</a>
                            </div>
                            <div class="text-center pb-15 px-5">
                                <img src="{{ asset('back/media/illustrations/sketchy-1/17.png') }}" alt=""
                                    class="mw-100 h-200px h-sm-325px" />
                            </div>
                        </div>
                    </div>
                @endif
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
                            <span class="badge badge-circle badge-secondary ms-3">
                                {{ $list_path->count() }}

                            </span>
                        </h1>
                        <div class="text-muted fw-semibold fs-5">Pilih jalur pendaftaran yang sesuai dengan anda.</div>
                        <div class="text-danger fw-semibold fs-5">*Setelah memilih jalur pendaftaran, anda tidak dapat
                            mengubahnya lagi.</div>

                    </div>
                    <div class="mh-475px scroll-y me-n7 pe-7">
                        @forelse ($list_path as $path)
                            <div class="border border-hover-primary p-7 rounded mb-7">
                                <div class="d-flex flex-stack pb-3">
                                    <div class="d-flex">
                                        <div class="">
                                            <div class="d-flex align-items-center">
                                                <a href="#"
                                                    class="text-gray-900 fw-bold text-hover-primary fs-5 me-4">
                                                    {{ $path->name }}
                                                </a>
                                            </div>
                                            <span class="text-muted fw-semibold mb-3">
                                                T.A {{ $path->schoolYear->start_year }}/{{ $path->schoolYear->end_year }}
                                            </span>
                                        </div>
                                    </div>
                                    <div clas="d-flex">
                                        <div class="text-end pb-3">
                                            <span class="text-muted fs-7">Waktu Pendaftaran</span><br>
                                            <span
                                                class="text-gray-900 fw-bold fs-5">{{ \Carbon\Carbon::parse($path->registration_start)->format('d M Y') }}
                                                -
                                                {{ \Carbon\Carbon::parse($path->registration_end)->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-0">
                                    <div class="d-flex flex-column">
                                        <p class="text-gray-700 fw-semibold fs-6 mb-4">
                                            {{ $path->description }}
                                        </p>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div class="separator separator-dashed border-muted my-5"></div>
                                        <div class="d-flex flex-stack">
                                            <div class="d-flex flex-column mw-200px">
                                                <div class="d-flex align-items-center mb-2">
                                                    <span
                                                        class="text-gray-700 fs-6 fw-semibold me-2">{{ $path->registrationUsers->count() }}
                                                        Orang</span>
                                                    <span class="text-muted fs-8">Sudah Mendaftar</span>
                                                </div>
                                            </div>
                                            <form action="{{ route('ppdb.select.path', $path->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-primary">Pilih Jalur</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="border border-hover-primary rounded mt-3">
                                <div class="text-center pt-15 pb-15">
                                    <h2 class="fs-2x fw-bold mb-0">Jalur Pendaftaran Tidak ada</h2>
                                    <p class="text-gray-500 fs-4 fw-semibold py-7">
                                        Maaf, saat ini jalur pendaftaran tidak tersedia <br> silahkan tunggu hingga jalur
                                        pendaftaran dibuka.
                                    </p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="re_registration" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog mw-700px">
            <div class="modal-content">
                <div class="modal-header pb-0 border-0 d-flex justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-10 pt-0 pb-15">
                    <div class="text-center mb-13">
                        <h1 class="d-flex justify-content-center align-items-center mb-3">Pendaftaran Ulang</h1>
                    </div>
                    <div>
                        {!! $information->re_registration_information??"-" !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
