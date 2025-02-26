@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            @include('back.pages.ppdb.exam.detail-header')

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Jadwal Ujian</h3>
                    <div class="card-toolbar">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#add_schedule"
                            class='btn btn-primary btn-sm fw-bolder' class="btn btn-primary">
                            <i class="ki-duotone ki-plus fs-2"></i>
                            Tambah Jadwal
                        </a>
                    </div>
                </div>
            </div>
                @forelse ($list_exam_schedule as $exam_schedule)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="py-0" data-kt-customer-payment-method="row">
                                <div class="py-3 d-flex flex-stack flex-wrap">
                                    <div class="d-flex align-items-center collapsible collapsed rotate"
                                        data-bs-toggle="collapse"
                                        href="#kt_customer_view_payment_method_{{ $exam_schedule->id }}" role="button"
                                        aria-expanded="false"
                                        aria-controls="kt_customer_view_payment_method_{{ $exam_schedule->id }}">
                                        <div class="me-3 rotate-90">
                                            <i class="ki-outline ki-right fs-3"></i>
                                        </div>
                                        <div class="me-3">
                                            <div class="d-flex align-items-center">
                                                <div class="text-gray-800 fw-bold">Tanggal Ujian :
                                                    {{ Carbon\Carbon::parse($exam_schedule->start_time)->format('d F Y H:i') }}
                                                    s/d
                                                    {{ Carbon\Carbon::parse($exam_schedule->end_time)->format('d F Y H:i') }}
                                                </div>
                                            </div>
                                            <div class="text-muted">Lokasi : {{ $exam_schedule->location }}</div>
                                        </div>

                                    </div>
                                    <a href="#" class="btn btn-light-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#edit_schedule_{{ $exam_schedule->id }}">
                                        <i class="ki-duotone ki-pencil fs-5">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>

                                </div>
                                <div id="kt_customer_view_payment_method_{{ $exam_schedule->id }}"
                                    class="collapse fs-6 ps-10" data-bs-parent="#kt_customer_view_payment_method">

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="fw-bold fs-6 text-gray-800">
                                                    <th>NISN</th>
                                                    <th>Nama</th>
                                                    <th>Asal Sekolah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($exam_schedule->scheduleUser as $user)
                                                    <tr>
                                                        <td>
                                                            {{ $user->ppdbUser?->nisn }}
                                                        </td>
                                                        <td>
                                                            {{ $user->ppdbUser?->name }}
                                                        </td>
                                                        <td>
                                                            {{ $user->ppdbUser?->school_origin }}

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="{{ asset('assets/media/illustrations/empty.svg') }}" class="w-50px mb-5"
                                    alt="" />
                                <h3>Belum ada jadwal ujian</h3>
                                <p class="text-muted">Tambahkan jadwal ujian untuk peserta</p>
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#add_schedule">Tambah
                                    Jadwal</a>
                            </div>
                        </div>
                    </div>
                @endforelse

        </div>
    </div>


    <div class="modal fade" tabindex="-1" id="add_schedule">
        <div class="modal-dialog modal-lg">
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

                <form action="{{ route('back.ppdb.exam.schedule.store', $exam->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="form-label required">Waktu Mulai Ujian</label>
                                    <input type="datetime-local" class="form-control" id="start_time" name="start_time"
                                        placeholder="" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="name" class="form-label required">Waktu Berakhir Ujian</label>
                                    <input type="datetime-local" class="form-control" id="end_time" name="end_time"
                                        placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" id="location" name="location"
                                placeholder="Lokasi Ujian">

                            <div class="mb-3">
                                <label for="school_year" class="form-label required">Calon Siswa</label>
                                <select class="form-select" name="ppdb_user_id[]" data-control="select2"
                                    data-dropdown-parent="#add_schedule" data-placeholder="Pilih Siswa"
                                    data-allow-clear="true" multiple="multiple" data-close-on-select="false" required>
                                    <option></option>
                                    @foreach ($list_user_ppdb as $user)
                                        <option value="{{ $user->id }}">{{ $user->nisn }}-{{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @foreach ($list_exam_schedule as $exam_schedule)
        <div class="modal fade" tabindex="-1" id="edit_schedule_{{ $exam_schedule->id }}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Edit Jadwal</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <form action="{{ route('back.ppdb.exam.schedule.update', [$exam->id, $exam_schedule->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label required">Waktu Mulai Ujian</label>
                                        <input type="datetime-local" class="form-control" id="start_time"
                                            name="start_time" placeholder="" required
                                            value="{{ $exam_schedule->start_time }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name" class="form-label required">Waktu Berakhir Ujian</label>
                                        <input type="datetime-local" class="form-control" id="end_time" name="end_time"
                                            placeholder="" required value="{{ $exam_schedule->end_time }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Lokasi</label>
                                <input type="text" class="form-control" id="location" name="location"
                                    placeholder="Lokasi Ujian" value="{{ $exam_schedule->location }}">

                                <div class="mb-3">
                                    <label for="school_year" class="form-label required">Calon Siswa</label>
                                    <select class="form-select" name="ppdb_user_id[]" data-control="select2"
                                        data-dropdown-parent="#edit_schedule_{{ $exam_schedule->id }}"
                                        data-placeholder="Pilih Siswa" data-allow-clear="true" multiple="multiple"
                                        data-close-on-select="false" required>
                                        <option></option>
                                        @foreach ($list_user_ppdb_all as $user)
                                            <option value="{{ $user->id }}"
                                                {{ $exam_schedule->scheduleUser->contains('ppdb_user_id', $user->id) ? 'selected' : '' }}>
                                                {{ $user->nisn }}-{{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@endsection
@section('scripts')
@endsection
