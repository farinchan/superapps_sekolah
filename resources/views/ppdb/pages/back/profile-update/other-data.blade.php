@extends('ppdb.app-back')
@section('styles')
@endsection
@section('content')
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div class="d-flex flex-column flex-lg-row">
            <div class="card">
                <form method="post" action="#" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body p-lg-17">

                        <div class="d-flex flex-column flex-lg-row ">
                            <div class="flex-lg-row-fluid me-0 me-lg-20">
                                <div class="m-0 ">
                                    <div class="mb-10">
                                        <h4 class="fs-1 text-gray-800 w-bolder mb-6">
                                            Data Lainnya
                                        </h4>
                                        <p class="fw-semibold fs-4 text-gray-600 mb-2">
                                            Ubah data lainnya dengan data yang benar dan valid.
                                        </p>
                                    </div>
                                    <div class="m-0">
                                        <div class="row">
                                            <div class="mb-10">
                                                <label for="exampleFormControlInput1" class="required form-label">Nilai Rapor Semester
                                                    1</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="Nilai Rapor Semester 1" name="rapor_semester_1"
                                                    value="{{ $user->rapor_semester_1 }}" required />
                                                @error('rapor_semester_1')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="mb-10">
                                                <label for="exampleFormControlInput1" class="required form-label">Nilai Rapor Semester
                                                    2</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="Nilai Rapor Semester 2" name="rapor_semester_2"
                                                    value="{{ $user->rapor_semester_2 }}" required />
                                                @error('rapor_semester_2')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-10">
                                                <label for="exampleFormControlInput1" class="required form-label">Nilai Rapor Semester
                                                    3</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="Nilai Rapor Semester 3" name="rapor_semester_3"
                                                    value="{{ $user->rapor_semester_3 }}" required />
                                                @error('rapor_semester_3')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-10">
                                                <label for="exampleFormControlInput1" class="required form-label">Nilai Rapor Semester
                                                    4</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="Nilai Rapor Semester 4" name="rapor_semester_4"
                                                    value="{{ $user->rapor_semester_4 }}" required />
                                                @error('rapor_semester_4')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-10">
                                                <label for="exampleFormControlInput1" class="required form-label">Nilai Rapor Semester
                                                    5</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="Nilai Rapor Semester 5" name="rapor_semester_5"
                                                    value="{{ $user->rapor_semester_5 }}" required />
                                                @error('rapor_semester_5')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-10">
                                                <label for="exampleFormControlInput1" class="required form-label">Screenshot NISN dari
                                                    Web Kemendikbud</label>
                                                <input type="file" class="form-control form-control-solid" name="screenshoot_nisn"
                                                    accept=".png,.jpg,.jpeg" required />
                                                <small class="text-muted fw-semibold">Anda dapat mengambil screenshot NISN dari web
                                                    resmi Kemendikbud yaitu : <a href="https://nisn.data.kemdikbud.go.id"
                                                        target="_blank">https://nisn.data.kemdikbud.go.id/</a></small>
                                                @error('screenshoot_nisn')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('ppdb.dashboard') }}"
                                class="btn btn-light btn-active-light-primary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Content-->
@endsection
@section('scripts')
@endsection
