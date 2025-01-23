@extends('ppdb.app-back')
@section('styles')
@endsection
@section('content')
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div class="d-flex flex-column flex-lg-row">
            <div class="card">
                <form method="post" action="{{ route('ppdb.profile.my-data.update') }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body p-lg-17">

                        <div class="d-flex flex-column flex-lg-row ">
                            <div class="flex-lg-row-fluid me-0 me-lg-20">
                                <div class="m-0 ">
                                    <div class="mb-10">
                                        <h4 class="fs-1 text-gray-800 w-bolder mb-6">
                                            Data Diri
                                        </h4>
                                        <p class="fw-semibold fs-4 text-gray-600 mb-2">
                                            Ubah data diri anda dengan data yang sesuai dengan identitas anda.
                                        </p>
                                    </div>
                                    <div class="m-0">
                                        <div class="mb-10">
                                            <label for="exampleFormControlInput1" class="required form-label">NISN</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Nomor Induk Siswa Nasional" name="nisn"
                                                value="{{ $user->nisn }}" required />
                                            @error('nisn')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-10">
                                            <label for="exampleFormControlInput1" class="required form-label">Nama
                                                Lengkap</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Nama Lengkap" name="name" value="{{ $user->name }}"
                                                required />
                                            @error('name')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-10">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlInput1" class="required form-label">Tempat
                                                        Lahir</label>
                                                    <input type="text" class="form-control form-control-solid"
                                                        placeholder="Tempat Lahir" name="birth_place"
                                                        value="{{ $user->birth_place }}" required />
                                                    @error('birth_place')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlInput1"
                                                        class="required form-label">Tanggal
                                                        Lahir</label>
                                                    <input type="date" class="form-control form-control-solid"
                                                        placeholder="Tanggal Lahir" name="birth_date"
                                                        value="{{ $user->birth_date }}" required />
                                                    @error('birth_date')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-10">
                                            <label for="exampleFormControlInput1" class="required form-label">Asal
                                                Sekolah</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Asal Sekolah" name="school_origin"
                                                value="{{ $user->school_origin }}" required />
                                            @error('school_origin')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-10">
                                            <label for="exampleFormControlInput1" class="required form-label">NPSN Sekolah
                                                Asal</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Nomor Pokok Sekolah Nasional" name="npsn"
                                                value="{{ $user->npsn }}" required />
                                            <small class="text-muted">Nomor Pokok Sekolah Nasional (NPSN) adalah kode unik
                                                yang
                                                diberikan oleh Kementerian Pendidikan untuk setiap satuan pendidikan di
                                                Indonesia,
                                                anda dapat melihat rapor untuk mengetahui NPSN sekolah asal anda.</small>
                                        </div>
                                        <div class="mb-10">
                                            <label for="exampleFormControlInput1" class="required form-label">No
                                                WhatsApp Orang Tua</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="+628XXXXX" name="whatsapp_number"
                                                value="{{ $user->whatsapp_number }}" required />
                                            <small class="text-muted">Nomor diawali dengan kode negara <code> +62 </code>
                                                Pastikan
                                                nomor yang anda masukkan benar dan aktif.</small>
                                            @error('whatsapp_number')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-10">
                                            <label for="exampleFormControlInput1" class="required form-label">Alamat</label>
                                            <textarea class="form-control form-control-solid" placeholder="Alamat" name="address" required>{{ $user->address }}</textarea>
                                            @error('address')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-10">
                                            <label for="exampleFormControlInput1" class=" form-label">Email</label>
                                            <input type="email" class="form-control form-control-solid"
                                                placeholder="Email" name="email" value="{{ $user->email }}" />
                                            @error('email')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-10">
                                            <label for="exampleFormControlInput1" class="form-label">Password</label>
                                            <input type="password" class="form-control form-control-solid"
                                                placeholder="Password" name="password" />
                                            <small class="text-muted">Password minimal 8 karakter, <b>Kosongkan</b> jika
                                                tidak
                                                ingin mengubah password.</small>
                                            @error('password')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
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
