@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            @include('back.pages.ppdb.exam.detail-header')
            <div class="card">
                <div class="card-header">
                    <div class="card-title fs-3 fw-bold">Setting Ujian</div>
                </div>
                <form id="kt_project_settings_form" class="form" method="POST" action="{{ route('back.ppdb.exam.setting.update', $exam->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body p-9">
                        <div class="row mb-8">
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">Nama Ujian</div>
                            </div>
                            <div class="col-xl-9 fv-row">
                                <input type="text" class="form-control form-control-solid form-control-lg" name="name"
                                    value="{{ $exam->name }}" @role('admin|ppdb')  @else disabled @endrole/>
                            </div>
                        </div>
                        <div class="row mb-8">
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">Deskripsi</div>
                            </div>
                            <div class="col-xl-9 fv-row">
                                <textarea class="form-control form-control-solid form-control-lg" name="description"
                                    rows="3" @role('admin|ppdb')  @else disabled @endrole>{{ $exam->description }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-8">
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">Durasi Ujian</div>
                            </div>
                            <div class="col-xl-9 fv-row">
                                <input class="form-control form-control-solid form-control-lg" name="duration"
                                    value="{{ $exam->duration }}" @role('admin|ppdb')  @else disabled @endrole/>
                            </div>
                        </div>
                        <div class="row mb-8">
                            <div class="col-xl-3">
                                <div class="fs-6 fw-semibold mt-2 mb-3">Tahun Ajaran</div>
                            </div>
                            <div class="col-xl-9 fv-row">
                                <select class="form-select form-select-solid form-select-lg fw-bold" name="school_year_id" data-control="select2" data-hide-search="true"
                                data-placeholder="Select an option" @role('admin|ppdb')  @else disabled @endrole>
                                    @foreach ($list_school_year as $school_year)
                                        <option value="{{ $school_year->id }}" @if ($school_year->id == $exam->school_year_id) selected @endif>
                                            {{ $school_year->start_year }}/{{ $school_year->end_year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                    </div>
                    @role('admin|ppdb')
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
