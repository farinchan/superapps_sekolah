@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            @include('back.pages.exam.detail-header')
            <div class="card">
                <div class="card-header">
                    <div class="card-title fs-3 fw-bold">Setting Ujian</div>
                </div>
                <form id="kt_project_settings_form" class="form" method="POST" action="{{ route('back.exam.setting.update', $exam->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body p-9">
                        <div class="row mb-8">
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">Mata Pelajaran</div>
                            </div>
                            <div class="col-xl-9 fv-row">
                                <select class="form-select form-select-solid form-select-lg fw-bold" name="subject_id" data-control="select2"
                                data-placeholder="Select an option" @role('guru') disabled @endrole >
                                    @foreach ($list_subject as $subject)
                                        <option value="{{ $subject->id }}" @if ($subject->id == $exam->subject_id) selected @endif>
                                            {{ $subject->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-8">
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">Deskripsi</div>
                            </div>
                            <div class="col-xl-9 fv-row">
                                <textarea class="form-control form-control-solid form-control-lg" name="description"
                                    rows="3" @role('guru') disabled @endrole>{{ $exam->description }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-8">
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">Waktu Mulai</div>
                            </div>
                            <div class="col-xl-9 fv-row">
                                <input class="form-control form-control-solid form-control-lg" name="start_time" type="datetime-local"
                                    value="{{ $exam->start_time }}" @role('guru') disabled @endrole/>
                            </div>
                        </div>
                        <div class="row mb-8">
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">Waktu Selesai</div>
                            </div>
                            <div class="col-xl-9 fv-row">
                                <input class="form-control form-control-solid form-control-lg" name="end_time" type="datetime-local"
                                    value="{{ $exam->end_time }}" @role('guru') disabled @endrole/>
                            </div>
                        </div>
                        <div class="row mb-8">
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">Durasi Ujian</div>
                            </div>
                            <div class="col-xl-9 fv-row">
                                <input class="form-control form-control-solid form-control-lg" name="duration"
                                    value="{{ $exam->duration }}" @role('guru') disabled @endrole/>
                            </div>
                        </div>
                        <div class="row mb-8">
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">Guru Pengampu</div>
                            </div>
                            <div class="col-xl-9 fv-row">
                                <select class="form-select form-select-solid form-select-lg fw-bold" name="teacher_id" data-control="select2"
                                data-placeholder="Select an option" @role('guru') disabled @endrole>
                                    @foreach ($list_teacher as $teacher)
                                        <option value="{{ $teacher->id }}" @if ($teacher->id == $exam->teacher_id) selected @endif>
                                            {{ $teacher->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-8">
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">Jenis ujian</div>
                            </div>
                            <div class="col-xl-9 fv-row">
                                <select class="form-select form-select-solid form-select-lg fw-bold" name="type" data-control="select2" data-hide-search="true"
                                data-placeholder="Select an option" @role('guru') disabled @endrole>
                                    <option value="UH" @if ($exam->type == 'UH') selected @endif>Ulangan Harian</option>
                                    <option value="UTS" @if ($exam->type == 'UTS') selected @endif>Ujian Tengah Semester</option>
                                    <option value="UAS" @if ($exam->type == 'UAS') selected @endif>Ujian Akhir Semester</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-8">
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">Tahun Ajaran</div>
                            </div>
                            <div class="col-xl-9 fv-row">
                                <select class="form-select form-select-solid form-select-lg fw-bold" name="school_year_id" data-control="select2" data-hide-search="true"
                                data-placeholder="Select an option" @role('guru') disabled @endrole>
                                    @foreach ($list_school_year as $school_year)
                                        <option value="{{ $school_year->id }}" @if ($school_year->id == $exam->school_year_id) selected @endif>
                                            {{ $school_year->start_year }}/{{ $school_year->end_year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    @role('admin')
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="reset" class="btn btn-light btn-active-light-primary me-2">Batal</button>
                        <button type="submit" class="btn btn-primary" >Update</button>
                    </div>
                    @endrole
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
