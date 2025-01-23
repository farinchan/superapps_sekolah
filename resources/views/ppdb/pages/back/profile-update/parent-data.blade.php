@extends('ppdb.app-back')
@section('styles')
@endsection
@section('content')
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div class="d-flex flex-column flex-lg-row">
            <div class="card">
                <form method="post" action="{{ route('ppdb.profile.parent-data.update') }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body p-lg-17">

                        <div class="d-flex flex-column flex-lg-row ">
                            <div class="flex-lg-row-fluid me-0 me-lg-20">
                                <div class="m-0 ">
                                    <div class="mb-10">
                                        <h4 class="fs-1 text-gray-800 w-bolder mb-6">
                                            Data Keluarga
                                        </h4>
                                        <p class="fw-semibold fs-4 text-gray-600 mb-2">
                                            Ubah data orang tua dengan data orang tua atau wali yang dapat dihubungi.
                                        </p>
                                    </div>
                                    <div class="m-0">
                                        <div class="row">
                                            <div class="mb-10">
                                                <label for="exampleFormControlInput1" class="required form-label">No Kartu
                                                    Keluarga</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="Nomor Kartu Keluarga" name="no_kk"
                                                    value="{{ $user->no_kk }}" required />
                                                @error('no_kk')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-10">
                                                <label for="exampleFormControlInput1" class="required form-label">NIK Calon Peserta Didik</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="Nomor Induk Kependudukan" name="nik"
                                                    value="{{ $user->nik }}" required />
                                                @error('nik')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-10">
                                                <label for="exampleFormControlInput1" class="required form-label">NIK
                                                    Ibu</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="Nomor Induk Kependudukan" name="mother_nik"
                                                    value="{{ $user->mother_nik }}" required />
                                                @error('mother_nik')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-10">
                                                <label for="exampleFormControlInput1" class="required form-label">Nama
                                                    Ibu</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="Nama Lengkap" name="mother_name"
                                                    value="{{ $user->mother_name }}" required />
                                                @error('mother_name')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-10">
                                                <label for="exampleFormControlInput1" class="required form-label">No
                                                    WhatsApp
                                                    Ibu</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="+628XXXXX" name="mother_phone_number"
                                                    value="{{ $user->mother_phone_number }}" required />
                                                <small class="text-muted">Nomor diawali dengan kode negara <code> +62
                                                    </code> Pastikan
                                                    nomor yang anda masukkan benar dan aktif.</small>
                                                @error('mother_phone_number')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-10">
                                                <label for="exampleFormControlInput1" class="required form-label">NIK
                                                    Ayah</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="Nomor Induk Kependudukan" name="father_nik"
                                                    value="{{ $user->father_nik }}" required />
                                                @error('father_nik')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-10">
                                                <label for="exampleFormControlInput1" class="required form-label">Nama
                                                    Ayah</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="Nama Lengkap" name="father_name"
                                                    value="{{ $user->father_name }}" required />
                                                @error('father_name')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-10">
                                                <label for="exampleFormControlInput1" class="required form-label">No
                                                    WhatsApp
                                                    Ayah</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="+628XXXXX" name="father_phone_number"
                                                    value="{{ $user->father_phone_number }}" required />
                                                <small class="text-muted">Nomor diawali dengan kode negara <code> +62
                                                    </code> Pastikan
                                                    nomor yang anda masukkan benar dan aktif.</small>
                                                @error('father_phone_number')
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
                            <button type="submit" class="btn btn-warning">Update</button>
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
