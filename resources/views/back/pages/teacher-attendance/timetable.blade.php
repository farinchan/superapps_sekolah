@extends('back.app')
@section('seo')
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="row row gx-6 gx-xl-9">
                <div class="col-lg-12 mb-5">
                    <div class="row">
                        <div class="col-lg-10"></div>
                        <div class="col-lg-2">
                            <div class="input-group d-flex align-items-center position-relative my-1">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
                                    <i class="ki-duotone ki-plus fs-2"></i>
                                    Tambah Jadwal
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body p-10 p-lg-15">
                            <div class="mb-13">
                                <div class="mb-15">
                                    <h4 class="fs-2x text-gray-800 w-bolder mb-6">Jadwal Presensi Guru</h4>
                                    <p class="fw-semibold fs-4 text-gray-600 mb-2">
                                        Jadwal presensi ini dibuat berdasarkan jadwal mengajar guru yang telah ditetapkan sesuai dengan kebijakan dan pengaturan yang ditentukan oleh pihak sekolah. Penjadwalan ini disusun secara sistematis untuk memastikan keselarasan antara jadwal presensi dan jadwal mengajar yang berlaku. Berikut adalah jadwal presensi guru yang telah dirancang.
                                    </p>
                                </div>
                                <div class="row mb-12">
                                    <div class="col-md-6 pe-md-10 mb-10 mb-md-0">
                                        <h2 class="text-gray-800 fw-bold mb-4">Hari Senin</h2>
                                        @foreach ($list_senin as $senin)
                                            <div class="m-0">
                                                <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                                    data-bs-toggle="collapse" data-bs-target="#hari-senin_{{ $senin->id }}">
                                                    <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                        <i
                                                            class="ki-outline ki-minus-square toggle-on text-primary fs-1"></i>
                                                        <i class="ki-outline ki-plus-square toggle-off fs-1"></i>
                                                    </div>
                                                    <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">
                                                        {{ Carbon\Carbon::parse($senin->start)->format('H:i') }} -
                                                        {{ Carbon\Carbon::parse($senin->end)->format('H:i') }} WIB
                                                    </h4>
                                                </div>
                                                <div id="hari-senin_{{ $senin->id }}" class="collapse fs-6 ms-1">
                                                    @foreach ($senin->teachersTimetable as $teacher_timetable)
                                                        <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                            {{ $teacher_timetable->name }} - NIP.
                                                            {{ $teacher_timetable->nip ?? '-' }}
                                                        </div>
                                                    @endforeach

                                                </div>
                                                <div class="separator separator-dashed"></div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-md-6 ps-md-10">
                                        <h2 class="text-gray-800 fw-bold mb-4">Hari Selasa</h2>
                                        @foreach ($list_selasa as $selasa   )
                                            <div class="m-0">
                                                <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                                    data-bs-toggle="collapse" data-bs-target="#hari-selasa_{{ $selasa->id }}">
                                                    <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                        <i
                                                            class="ki-outline ki-minus-square toggle-on text-primary fs-1"></i>
                                                        <i class="ki-outline ki-plus-square toggle-off fs-1"></i>
                                                    </div>
                                                    <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">
                                                        {{ Carbon\Carbon::parse($selasa ->start)->format('H:i') }} -
                                                        {{ Carbon\Carbon::parse($selasa ->end)->format('H:i') }} WIB
                                                    </h4>
                                                </div>
                                                <div id="hari-selasa_{{ $selasa->id }}" class="collapse fs-6 ms-1">
                                                    @foreach ($selasa   ->teachersTimetable as $teacher_timetable)
                                                        <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                            {{ $teacher_timetable->name }} - NIP.
                                                            {{ $teacher_timetable->nip ?? '-' }}
                                                        </div>
                                                    @endforeach

                                                </div>
                                                <div class="separator separator-dashed"></div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                                <div class="row mb-12">
                                    <div class="col-md-6 pe-md-10 mb-10 mb-md-0">
                                        <h2 class="text-gray-800 w-bolder mb-4">Hari Rabu</h2>
                                        @foreach ($list_rabu as $rabu)
                                            <div class="m-0">
                                                <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                                    data-bs-toggle="collapse" data-bs-target="#hari-rabu_{{ $rabu->id }}">
                                                    <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                        <i
                                                            class="ki-outline ki-minus-square toggle-on text-primary fs-1"></i>
                                                        <i class="ki-outline ki-plus-square toggle-off fs-1"></i>
                                                    </div>
                                                    <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">
                                                        {{ Carbon\Carbon::parse($rabu->start)->format('H:i') }} -
                                                        {{ Carbon\Carbon::parse($rabu->end)->format('H:i') }} WIB
                                                    </h4>
                                                </div>
                                                <div id="hari-rabu_{{ $rabu->id }}" class="collapse fs-6 ms-1">
                                                    @foreach ($rabu->teachersTimetable as $teacher_timetable)
                                                        <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                            {{ $teacher_timetable->name }} - NIP.
                                                            {{ $teacher_timetable->nip ?? '-' }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="separator separator-dashed"></div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-md-6 ps-md-10">
                                        <h2 class="text-gray-800 fw-bold mb-4">Hari Kamis</h2>
                                        @foreach ($list_kamis as $kamis)
                                            <div class="m-0">
                                                <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                                    data-bs-toggle="collapse" data-bs-target="#hari-kamis_{{ $kamis->id }}">
                                                    <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                        <i
                                                            class="ki-outline ki-minus-square toggle-on text-primary fs-1"></i>
                                                        <i class="ki-outline ki-plus-square toggle-off fs-1"></i>
                                                    </div>
                                                    <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">
                                                        {{ Carbon\Carbon::parse($kamis->start)->format('H:i') }} -
                                                        {{ Carbon\Carbon::parse($kamis->end)->format('H:i') }} WIB
                                                    </h4>
                                                </div>
                                                <div id="hari-kamis_{{ $kamis->id }}" class="collapse fs-6 ms-1">
                                                    @foreach ($kamis->teachersTimetable as $teacher_timetable)
                                                        <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                            {{ $teacher_timetable->name }} - NIP.
                                                            {{ $teacher_timetable->nip ?? '-' }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="separator separator-dashed"></div>
                                            </div>
                                            @endforeach
                                    </div>
                                </div>
                                <div class="row mb-12">
                                    <div class="col-md-6 pe-md-10 mb-10 mb-md-0">
                                        <h2 class="text-gray-800 w-bolder mb-4">Hari Jum'at</h2>
                                        @foreach ($list_jumat as $jumat)
                                            <div class="m-0">
                                                <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                                    data-bs-toggle="collapse" data-bs-target="#hari-jumat_{{ $jumat->id }}">
                                                    <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                        <i
                                                            class="ki-outline ki-minus-square toggle-on text-primary fs-1"></i>
                                                        <i class="ki-outline ki-plus-square toggle-off fs-1"></i>
                                                    </div>
                                                    <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">
                                                        {{ Carbon\Carbon::parse($jumat->start)->format('H:i') }} -
                                                        {{ Carbon\Carbon::parse($jumat->end)->format('H:i') }} WIB
                                                    </h4>
                                                </div>
                                                <div id="hari-jumat_{{ $jumat->id }}" class="collapse fs-6 ms-1">
                                                    @foreach ($jumat->teachersTimetable as $teacher_timetable)
                                                        <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                            {{ $teacher_timetable->name }} - NIP.
                                                            {{ $teacher_timetable->nip ?? '-' }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="separator separator-dashed"></div>
                                            </div>
                                            @endforeach
                                    </div>
                                    <div class="col-md-6 ps-md-10">
                                        <h2 class="text-gray-800 fw-bold mb-4">Hari Sabtu </h2>
                                        @foreach ($list_sabtu as $sabtu)
                                            <div class="m-0">
                                                <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                                    data-bs-toggle="collapse" data-bs-target="#hari-sabtu_{{ $sabtu->id }}">
                                                    <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                        <i
                                                            class="ki-outline ki-minus-square toggle-on text-primary fs-1"></i>
                                                        <i class="ki-outline ki-plus-square toggle-off fs-1"></i>
                                                    </div>
                                                    <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">
                                                        {{ Carbon\Carbon::parse($sabtu->start)->format('H:i') }} -
                                                        {{ Carbon\Carbon::parse($sabtu->end)->format('H:i') }} WIB
                                                    </h4>
                                                </div>
                                                <div id="hari-sabtu_{{ $sabtu->id }}" class="collapse fs-6 ms-1">
                                                    @foreach ($sabtu->teachersTimetable as $teacher_timetable)
                                                        <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                            {{ $teacher_timetable->name }} - NIP.
                                                            {{ $teacher_timetable->nip ?? '-' }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="separator separator-dashed"></div>
                                            </div>
                                            @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Jadwal</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <form method="POST" action="{{ route('back.teacher-attendance.timetable.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="form-label">Hari</label>
                            <select class="form-select form-select-solid form-select-lg"
                                aria-label=".form-select-lg example" name="day" data-control="select2"
                                data-placeholder="Pilih Hari" data-hide-search="true">
                                <option></option>
                                <option value="1">Senin</option>
                                <option value="2">Selasa</option>
                                <option value="3">Rabu</option>
                                <option value="4">Kamis</option>
                                <option value="5">Jumat</option>
                                <option value="6">Sabtu</option>
                            </select>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="form-label">Jam Mulai</label>
                            <input type="time" class="form-control" id="exampleFormControlInput1" placeholder=" "
                                name="start">
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="form-label">Jam Selesai</label>
                            <input type="time" class="form-control" id="exampleFormControlInput1" placeholder=" "
                                name="end">
                            <div class="form-text">Pastikan jam selesai lebih besar dari jam mulai.</div>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="form-label">Guru Pengajar</label>
                            <select class="form-select form-select-solid form-select-lg"
                                aria-label=".form-select-lg example" data-control="select2" data-placeholder="Pilih Guru"
                                name="teacher_id[]" data-close-on-select="false" data-dropdown-parent="#add"
                                data-allow-clear="true" multiple="multiple">
                                <option></option>
                                @foreach ($list_teacher as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }} - NIP.
                                        {{ $teacher->nip ?? '-' }}</option>
                                @endforeach
                            </select>
                            <div class="form-text">Guru yang akan mengajar pada jadwal ini.</div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
