@extends('back.app')

@section('styles')
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card card-flush">

                <div class="card-header mt-6">
                    <h2 class="mb-5">
                        Jadwal Masuk dan Pulang Siswa
                    </h2>
                </div>

                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="kt_modal_create_discipline_rule_form" class="form"
                                action="{{ route('back.student-attendance.timetable.update') }}" method="POST">
                                @method('PUT')
                                @csrf

                                <div class="mb-10">
                                    <div class="row mb-4">
                                        <div class="col-md-12 mb-2">
                                            <h3>Hari Senin</h3>
                                        </div>
                                        <div class="col-md-6">

                                            <label for="exampleFormControlInput1" class="required form-label">Jam
                                                Masuk</label>
                                            <input type="time" class="form-control form-control-solid" value="{{ $senin_time_in }}"
                                                name="senin_time_in" placeholder="Jam Masuk" required />
                                            @error('senin_time_in')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="exampleFormControlInput1" class="required form-label">Jam
                                                Pulang</label>
                                            <input type="time" class="form-control form-control-solid" value="{{ $senin_time_out }}"
                                                name="senin_time_out" placeholder="Jam Pulang" required />
                                            @error('senin_time_out')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="mb-10">
                                    <div class="row mb-4">
                                        <div class="col-md-12 mb-2">
                                            <h3>Hari Selasa</h3>
                                        </div>
                                        <div class="col-md-6">

                                            <label for="exampleFormControlInput1" class="required form-label">Jam
                                                Masuk</label>
                                            <input type="time" class="form-control form-control-solid" value="{{ $selasa_time_in }}"
                                                name="selasa_time_in" placeholder="Jam Masuk" required />
                                            @error('selasa_time_in')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="exampleFormControlInput1" class="required form-label">Jam
                                                Pulang</label>
                                            <input type="time" class="form-control form-control-solid" value="{{ $selasa_time_out }}"
                                                name="selasa_time_out" placeholder="Jam Pulang" required />
                                            @error('selasa_time_out')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="mb-10">
                                    <div class="row mb-4">
                                        <div class="col-md-12 mb-2">
                                            <h3>Hari Rabu</h3>
                                        </div>
                                        <div class="col-md-6">

                                            <label for="exampleFormControlInput1" class="required form-label">Jam
                                                Masuk</label>
                                            <input type="time" class="form-control form-control-solid" value="{{ $rabu_time_in }}"
                                                name="rabu_time_in" placeholder="Jam Masuk" required />
                                            @error('rabu_time_in')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="exampleFormControlInput1" class="required form-label">Jam
                                                Pulang</label>
                                            <input type="time" class="form-control form-control-solid" value="{{ $rabu_time_out }}"
                                                name="rabu_time_out" placeholder="Jam Pulang" required />
                                            @error('rabu_time_out')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                    </div>

                                </div>

                                <div class="mb-10">
                                    <div class="row mb-4">
                                        <div class="col-md-12 mb-2">
                                            <h3>Hari Kamis</h3>
                                        </div>
                                        <div class="col-md-6">

                                            <label for="exampleFormControlInput1" class="required form-label">Jam
                                                Masuk</label>
                                            <input type="time" class="form-control form-control-solid" value="{{ $kamis_time_in }}"
                                                name="kamis_time_in" placeholder="Jam Masuk" required />
                                            @error('kamis_time_in')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="exampleFormControlInput1" class="required form-label">Jam
                                                Pulang</label>
                                            <input type="time" class="form-control form-control-solid" value="{{ $kamis_time_out }}"
                                                name="kamis_time_out" placeholder="Jam Pulang" required />
                                            @error('kamis_time_out')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                    </div>

                                </div>

                                <div class="mb-10">
                                    <div class="row mb-4">
                                        <div class="col-md-12 mb-2">
                                            <h3>Hari Jumat</h3>
                                        </div>
                                        <div class="col-md-6">

                                            <label for="exampleFormControlInput1" class="required form-label">Jam
                                                Masuk</label>
                                            <input type="time" class="form-control form-control-solid" value="{{ $jumat_time_in }}"
                                                name="jumat_time_in" placeholder="Jam Masuk" required />
                                            @error('jumat_time_in')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="exampleFormControlInput1" class="required form-label">Jam
                                                Pulang</label>
                                            <input type="time" class="form-control form-control-solid" value="{{ $jumat_time_out }}"
                                                name="jumat_time_out" placeholder="Jam Pulang" required />
                                            @error('jumat_time_out')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                    </div>

                                </div>

                                <div class="mb-10">
                                    <div class="row mb-4">
                                        <div class="col-md-12 mb-2">
                                            <h3>Hari Sabtu</h3>
                                        </div>
                                        <div class="col-md-6">

                                            <label for="exampleFormControlInput1" class="required form-label">Jam
                                                Masuk</label>
                                            <input type="time" class="form-control form-control-solid" value="{{ $sabtu_time_in }}"
                                                name="sabtu_time_in" placeholder="Jam Masuk" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="exampleFormControlInput1" class="required form-label">Jam
                                                Pulang</label>
                                            <input type="time" class="form-control form-control-solid" value="{{ $sabtu_time_out }}"
                                                name="sabtu_time_out" placeholder="Jam Pulang" required />
                                        </div>

                                    </div>

                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-info">
                                        <span class="indicator-label">Update Data</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>



                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
@endsection
