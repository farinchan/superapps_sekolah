@extends('ppdb.app-back')
@section('styles')
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        @if ($information->registration_status)

        <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid gap-10"
            id="kt_create_account_stepper">
            <div
                class="card d-flex justify-content-center justify-content-xl-start flex-row-auto w-100 w-xl-300px w-xxl-400px">
                <div class="card-body px-6 px-lg-10 px-xxl-15 py-20">
                    <div class="stepper-nav">
                        <div class="stepper-item current" data-kt-stepper-element="nav">
                            <div class="stepper-wrapper">
                                <div class="stepper-icon w-40px h-40px">
                                    <i class="ki-outline ki-check fs-2 stepper-check"></i>
                                    <span class="stepper-number">1</span>
                                </div>
                                <div class="stepper-label">
                                    <h3 class="stepper-title">Tahap 1</h3>
                                    <div class="stepper-desc fw-semibold">Daftar Akun</div>
                                </div>
                            </div>
                            <div class="stepper-line h-40px"></div>
                        </div>
                        <div class="stepper-item" data-kt-stepper-element="nav">
                            <div class="stepper-wrapper">
                                <div class="stepper-icon w-40px h-40px">
                                    <i class="ki-outline ki-check fs-2 stepper-check"></i>
                                    <span class="stepper-number">2</span>
                                </div>
                                <div class="stepper-label">
                                    <h3 class="stepper-title">Tahap 2</h3>
                                    <div class="stepper-desc fw-semibold"> Data Keluarga</div>
                                </div>
                            </div>
                            <div class="stepper-line h-40px"></div>
                        </div>
                        <div class="stepper-item" data-kt-stepper-element="nav">
                            <div class="stepper-wrapper">
                                <div class="stepper-icon w-40px h-40px">
                                    <i class="ki-outline ki-check fs-2 stepper-check"></i>
                                    <span class="stepper-number">3</span>
                                </div>
                                <div class="stepper-label">
                                    <h3 class="stepper-title">Tahap 3</h3>
                                    <div class="stepper-desc fw-semibold"> Data Lainnya dan Pemberkasan</div>
                                </div>
                            </div>
                            <div class="stepper-line h-40px"></div>
                        </div>
                        <div class="stepper-item" data-kt-stepper-element="nav">
                            <div class="stepper-wrapper">
                                <div class="stepper-icon w-40px h-40px">
                                    <i class="ki-outline ki-check fs-2 stepper-check"></i>
                                    <span class="stepper-number">4</span>
                                </div>
                                <div class="stepper-label">
                                    <h3 class="stepper-title">Tahap 4</h3>
                                    <div class="stepper-desc fw-semibold">Finalisasi Pendaftaran</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card d-flex flex-row-fluid flex-center">
                <form class="card-body py-20 w-100 mw-xl-700px px-9" id="kt_create_account_form" method="POST"
                    action="{{ route('ppdb.register.process') }}" enctype="multipart/form-data">

                    <div class="current" data-kt-stepper-element="content">
                        @csrf
                        <div class="w-100">
                            <div class="pb-10 pb-lg-15">
                                <h2 class="fw-bold d-flex align-items-center text-gray-900">Buat Akun
                                    <span class="ms-1" data-bs-toggle="tooltip"
                                        title="NISN dan Password akan digunakan untuk login">
                                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                    </span>
                                </h2>
                                <div class="text-muted fw-semibold fs-6">Buat akun baru dengan data yang sesuai
                                    dengan identitas anda.
                                </div>
                            </div>
                            <div class="fv-row">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">NISN</label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Nomor Induk Siswa Nasional" name="nisn" value="{{ old('nisn') }}"
                                        required />
                                    @error('nisn')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Nama Lengkap"
                                        name="name" value="{{ old('name') }}" required />
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
                                                value="{{ old('birth_place') }}" required />
                                            @error('birth_place')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="exampleFormControlInput1" class="required form-label">Tanggal
                                                Lahir</label>
                                            <input type="date" class="form-control form-control-solid"
                                                placeholder="Tanggal Lahir" name="birth_date"
                                                value="{{ old('birth_date') }}" required />
                                            @error('birth_date')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Asal Sekolah</label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Asal Sekolah" name="school_origin"
                                        value="{{ old('school_origin') }}" required />
                                    @error('school_origin')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">NPSN Sekolah
                                        Asal</label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Nomor Pokok Sekolah Nasional" name="npsn"
                                        value="{{ old('npsn') }}" required />
                                    <small class="text-muted">Nomor Pokok Sekolah Nasional (NPSN) adalah kode unik yang
                                        diberikan oleh Kementerian Pendidikan untuk setiap satuan pendidikan di Indonesia,
                                        anda dapat melihat rapor untuk mengetahui NPSN sekolah asal anda.</small>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">No WhatsApp Orang Tua</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="+628XXXXX"
                                        name="whatsapp_number" value="{{ old('whatsapp_number') }}" required />
                                    <small class="text-muted">Nomor diawali dengan kode negara <code> +62 </code> Pastikan
                                        nomor yang anda masukkan benar dan aktif.</small>
                                    @error('whatsapp_number')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Alamat</label>
                                    <textarea class="form-control form-control-solid" placeholder="Alamat" name="address" required>{{ old('address') }}</textarea>
                                    @error('address')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class=" form-label">Email</label>
                                    <input type="email" class="form-control form-control-solid" placeholder="Email"
                                        name="email" value="{{ old('email') }}"  />
                                    @error('email')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Password</label>
                                    <input type="password" class="form-control form-control-solid" placeholder="Password"
                                        name="password" required />
                                    <small class="text-muted">Password minimal 8 karakter</small>
                                    @error('password')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>
                    <div data-kt-stepper-element="content">
                        <div class="w-100">
                            <div class="pb-10 pb-lg-15">
                                <h2 class="fw-bold text-gray-900">Data Keluarga</h2>
                                <div class="text-muted fw-semibold fs-6">Data orang tua dan keluarga</div>
                            </div>
                            <div class="fv-row">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">No Kartu
                                        Keluarga</label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Nomor Kartu Keluarga" name="no_kk" value="{{ old('no_kk') }}"
                                        required />
                                    @error('no_kk')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">NIK Calon Peserta Didik</label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Nomor Induk Kependudukan" name="nik" value="{{ old('nik') }}"
                                        required />
                                    @error('nik')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">NIK Ibu</label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Nomor Induk Kependudukan" name="mother_nik"
                                        value="{{ old('mother_nik') }}" required />
                                    @error('mother_nik')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Nama Ibu</label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Nama Lengkap" name="mother_name" value="{{ old('mother_name') }}"
                                        required />
                                    @error('mother_name')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">No WhatsApp
                                        Ibu</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="+628XXXXX"
                                        name="mother_phone_number" value="{{ old('mother_phone_number') }}" required />
                                    <small class="text-muted">Nomor diawali dengan kode negara <code> +62 </code> Pastikan
                                        nomor yang anda masukkan benar dan aktif.</small>
                                    @error('mother_phone_number')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">NIK Ayah</label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Nomor Induk Kependudukan" name="father_nik"
                                        value="{{ old('father_nik') }}" required />
                                    @error('father_nik')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Nama Ayah</label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Nama Lengkap" name="father_name" value="{{ old('father_name') }}"
                                        required />
                                    @error('father_name')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">No WhatsApp
                                        Ayah</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="+628XXXXX"
                                        name="father_phone_number" value="{{ old('father_phone_number') }}" required />
                                    <small class="text-muted">Nomor diawali dengan kode negara <code> +62 </code> Pastikan
                                        nomor yang anda masukkan benar dan aktif.</small>
                                    @error('father_phone_number')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>
                    <div data-kt-stepper-element="content">
                        <div class="w-100">
                            <div class="pb-10 pb-lg-15">
                                <h2 class="fw-bold text-gray-900">Data Lainnya dan Pemberkasan</h2>
                                <div class="text-muted fw-semibold fs-6">Data lainnya dan pemberkasan yang diperlukan untuk
                                    pendaftaran
                                </div>
                            </div>
                            <div class="fv-row">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Data Rapor</label><br>
                                    <small class="text-muted fw-semibold">Masukkan nilai rapor semester 1 - 5, yaitu nilai dari kelas 7 (semester 1) hingga kelas 9 (semester 1)</small>
                                        <div class="m-5">
                                            <label for="exampleFormControlInput1" class="required form-label">Jenis Rapor</label>
                                            <select class="form-select form-select-solid" name="rapor_type"  id="rapor_type" required>
                                                <option value="SMP" @if (old('rapor_type') == 'SMP') selected @endif>SMP</option>
                                                <option value="MTS" @if (old('rapor_type') == 'MTS') selected @endif>MTS</option>
                                            </select>
                                            @error('rapor_type')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                    <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6 ms-5">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#tab_sem1">Semester 1</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#tab_sem2">Semester 2</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#tab_sem3">Semester 3</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#tab_sem4">Semester 4</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#tab_sem5">Semester 5</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content ms-5" id="myTabContent">
                                        <div class="tab-pane fade show active" id="tab_sem1" role="tabpanel">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">Ilmu Pengetahuan Alam (IPA)</label>
                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai IPA" name="sem1_ipa" value="{{ old('sem1_ipa') }}" required />
                                                @error('sem1_ipa')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">Ilmu Pengetahuan Sosial (IPS)</label>
                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai IPS" name="sem1_ips" value="{{ old('sem1_ips') }}" required />
                                                @error('sem1_ips')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">Bahasa Indonesia</label>
                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Bahasa Indonesia" name="sem1_indonesia" value="{{ old('sem1_indonesia') }}" required />
                                                @error('sem1_indonesia')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">Bahasa Inggris</label>
                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Bahasa Inggris" name="sem1_inggris" value="{{ old('sem1_inggris') }}" required />
                                                @error('sem1_inggris')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">Matematika</label>
                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Matematika" name="sem1_matematika" value="{{ old('sem1_matematika') }}" required />
                                                @error('sem1_matematika')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div id="sem1_type_smp">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="required form-label">Pendidikan Agama</label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Nilai Pendidikan Agama" name="sem1_agama" value="{{ old('sem1_agama') }}"  />
                                                    @error('sem1_agama')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div id="sem1_type_mts">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="required form-label">Alquran Hadits</label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Nilai Alquran Hadits" name="sem1_qhadits" value="{{ old('sem1_qhadits') }}"  />
                                                    @error('sem1_qhadits')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="required form-label">Akidah Akhlak</label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Nilai Akidah Akhlak" name="sem1_akidah" value="{{ old('sem1_akidah') }}"  />
                                                    @error('sem1_akidah')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="required form-label">Fiqih</label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Nilai Fiqih" name="sem1_fiqih" value="{{ old('sem1_fiqih') }}"  />
                                                    @error('sem1_fiqih')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="required form-label">Sejarah Kebudayaan Islam (SKI)</label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Nilai SKI" name="sem1_ski" value="{{ old('sem1_ski') }}"  />
                                                    @error('sem1_ski')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">File Rapor Semester 1</label>
                                                <input type="file" class="form-control form-control-solid" name="sem1_file" accept=".pdf, .png, .jpg, .jpeg" required />
                                                <small class="text-muted">File dengan format PDF, PNG, JPG, JPEG, maksimal 10MB</small>
                                                @error('sem1_file')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab_sem2" role="tabpanel">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">Ilmu Pengetahuan Alam (IPA)</label>
                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai IPA" name="sem2_ipa" value="{{ old('sem2_ipa') }}" required />
                                                @error('sem2_ipa')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">Ilmu Pengetahuan Sosial (IPS)</label>
                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai IPS" name="sem2_ips" value="{{ old('sem2_ips') }}" required />
                                                @error('sem2_ips')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">Bahasa Indonesia</label>
                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Bahasa Indonesia" name="sem2_indonesia" value="{{ old('sem2_indonesia') }}" required />
                                                @error('sem2_indonesia')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">Bahasa Inggris</label>
                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Bahasa Inggris" name="sem2_inggris" value="{{ old('sem2_inggris') }}" required />
                                                @error('sem2_inggris')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">Matematika</label>
                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Matematika" name="sem2_matematika" value="{{ old('sem2_matematika') }}" required />
                                                @error('sem2_matematika')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div id="sem2_type_smp">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="required form-label">Pendidikan Agama</label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Nilai Pendidikan Agama" name="sem2_agama" value="{{ old('sem2_agama') }}"  />
                                                    @error('sem2_agama')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div id="sem2_type_mts">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="required form-label">Alquran Hadits</label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Nilai Alquran Hadits" name="sem2_qhadits" value="{{ old('sem2_qhadits') }}"  />
                                                    @error('sem2_qhadits')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="required form-label">Akidah Akhlak</label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Nilai Akidah Akhlak" name="sem2_akidah" value="{{ old('sem2_akidah') }}"  />
                                                    @error('sem2_akidah')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="required form-label">Fiqih</label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Nilai Fiqih" name="sem2_fiqih" value="{{ old('sem2_fiqih') }}"  />
                                                    @error('sem2_fiqih')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="required form-label">Sejarah Kebudayaan Islam (SKI)</label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Nilai SKI" name="sem2_ski" value="{{ old('sem2_ski') }}"  />
                                                    @error('sem2_ski')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">File Rapor Semester 2</label>
                                                <input type="file" class="form-control form-control-solid" name="sem2_file" accept=".pdf, .png, .jpg, .jpeg" required />
                                                <small class="text-muted">File dengan format PDF, PNG, JPG, JPEG, maksimal 10MB</small>
                                                @error('sem2_file')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab_sem3" role="tabpanel">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">Ilmu Pengetahuan Alam (IPA)</label>
                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai IPA" name="sem3_ipa" value="{{ old('sem3_ipa') }}" required />
                                                @error('sem3_ipa')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">Ilmu Pengetahuan Sosial (IPS)</label>
                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai IPS" name="sem3_ips" value="{{ old('sem3_ips') }}" required />
                                                @error('sem3_ips')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">Bahasa Indonesia</label>
                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Bahasa Indonesia" name="sem3_indonesia" value="{{ old('sem3_indonesia') }}" required />
                                                @error('sem3_indonesia')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">Bahasa Inggris</label>
                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Bahasa Inggris" name="sem3_inggris" value="{{ old('sem3_inggris') }}" required />
                                                @error('sem3_inggris')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">Matematika</label>
                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Matematika" name="sem3_matematika" value="{{ old('sem3_matematika') }}" required />
                                                @error('sem3_matematika')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div id="sem3_type_smp">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="required form-label">Pendidikan Agama</label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Nilai Pendidikan Agama" name="sem3_agama" value="{{ old('sem3_agama') }}"  />
                                                    @error('sem3_agama')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div id="sem3_type_mts">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="required form-label">Alquran Hadits</label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Nilai Alquran Hadits" name="sem3_qhadits" value="{{ old('sem3_qhadits') }}"  />
                                                    @error('sem3_qhadits')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="required form-label">Akidah Akhlak</label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Nilai Akidah Akhlak" name="sem3_akidah" value="{{ old('sem3_akidah') }}"  />
                                                    @error('sem3_akidah')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="required form-label">Fiqih</label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Nilai Fiqih" name="sem3_fiqih" value="{{ old('sem3_fiqih') }}"  />
                                                    @error('sem3_fiqih')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="required form-label">Sejarah Kebudayaan Islam (SKI)</label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Nilai SKI" name="sem3_ski" value="{{ old('sem3_ski') }}"  />
                                                    @error('sem3_ski')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">File Rapor Semester 3</label>
                                                <input type="file" class="form-control form-control-solid" name="sem3_file" accept=".pdf, .png, .jpg, .jpeg" required />
                                                <small class="text-muted">File dengan format PDF, PNG, JPG, JPEG, maksimal 10MB</small>
                                                @error('sem3_file')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab_sem4" role="tabpanel">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">Ilmu Pengetahuan Alam (IPA)</label>
                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai IPA" name="sem4_ipa" value="{{ old('sem4_ipa') }}" required />
                                                @error('sem4_ipa')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">Ilmu Pengetahuan Sosial (IPS)</label>
                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai IPS" name="sem4_ips" value="{{ old('sem4_ips') }}" required />
                                                @error('sem4_ips')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">Bahasa Indonesia</label>
                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Bahasa Indonesia" name="sem4_indonesia" value="{{ old('sem4_indonesia') }}" required />
                                                @error('sem4_indonesia')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">Bahasa Inggris</label>
                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Bahasa Inggris" name="sem4_inggris" value="{{ old('sem4_inggris') }}" required />
                                                @error('sem4_inggris')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">Matematika</label>
                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Matematika" name="sem4_matematika" value="{{ old('sem4_matematika') }}" required />
                                                @error('sem4_matematika')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div id="sem4_type_smp">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="required form-label">Pendidikan Agama</label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Nilai Pendidikan Agama" name="sem4_agama" value="{{ old('sem4_agama') }}"  />
                                                    @error('sem4_agama')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div id="sem4_type_mts">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="required form-label">Alquran Hadits</label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Nilai Alquran Hadits" name="sem4_qhadits" value="{{ old('sem4_qhadits') }}"  />
                                                    @error('sem4_qhadits')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="required form-label">Akidah Akhlak</label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Nilai Akidah Akhlak" name="sem4_akidah" value="{{ old('sem4_akidah') }}"  />
                                                    @error('sem4_akidah')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="required form-label">Fiqih</label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Nilai Fiqih" name="sem4_fiqih" value="{{ old('sem4_fiqih') }}"  />
                                                    @error('sem4_fiqih')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="required form-label">Sejarah Kebudayaan Islam (SKI)</label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Nilai SKI" name="sem4_ski" value="{{ old('sem4_ski') }}"  />
                                                    @error('sem4_ski')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">File Rapor Semester 4</label>
                                                <input type="file" class="form-control form-control-solid" name="sem4_file" accept=".pdf, .png, .jpg, .jpeg" required />
                                                <small class="text-muted">File dengan format PDF, PNG, JPG, JPEG, maksimal 10MB</small>
                                                @error('sem4_file')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab_sem5" role="tabpanel">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">Ilmu Pengetahuan Alam (IPA)</label>
                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai IPA" name="sem5_ipa" value="{{ old('sem5_ipa') }}" required />
                                                @error('sem5_ipa')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">Ilmu Pengetahuan Sosial (IPS)</label>
                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai IPS" name="sem5_ips" value="{{ old('sem5_ips') }}" required />
                                                @error('sem5_ips')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">Bahasa Indonesia</label>
                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Bahasa Indonesia" name="sem5_indonesia" value="{{ old('sem5_indonesia') }}" required />
                                                @error('sem5_indonesia')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">Bahasa Inggris</label>
                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Bahasa Inggris" name="sem5_inggris" value="{{ old('sem5_inggris') }}" required />
                                                @error('sem5_inggris')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">Matematika</label>
                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Matematika" name="sem5_matematika" value="{{ old('sem5_matematika') }}" required />
                                                @error('sem5_matematika')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div id="sem5_type_smp">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="required form-label">Pendidikan Agama</label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Nilai Pendidikan Agama" name="sem5_agama" value="{{ old('sem5_agama') }}"  />
                                                    @error('sem5_agama')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div id="sem5_type_mts">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="required form-label">Alquran Hadits</label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Nilai Alquran Hadits" name="sem5_qhadits" value="{{ old('sem5_qhadits') }}"  />
                                                    @error('sem5_qhadits')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="required form-label">Akidah Akhlak</label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Nilai Akidah Akhlak" name="sem5_akidah" value="{{ old('sem5_akidah') }}"  />
                                                    @error('sem5_akidah')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="required form-label">Fiqih</label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Nilai Fiqih" name="sem5_fiqih" value="{{ old('sem5_fiqih') }}"  />
                                                    @error('sem5_fiqih')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="required form-label">Sejarah Kebudayaan Islam (SKI)</label>
                                                    <input type="number" class="form-control form-control-solid" placeholder="Nilai SKI" name="sem5_ski" value="{{ old('sem5_ski') }}"  />
                                                    @error('sem5_ski')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="required form-label">File Rapor Semester 5</label>
                                                <input type="file" class="form-control form-control-solid" name="sem5_file" accept=".pdf, .png, .jpg, .jpeg" required />
                                                <small class="text-muted">File dengan format PDF, PNG, JPG, JPEG, maksimal 10MB</small>
                                                @error('sem5_file')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
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
                                <div class="mb-10">
                                    <div id="kt_docs_repeater_basic">
                                        <div class="form-group">
                                            <div data-repeater-list="certificates">
                                                <div data-repeater-item>
                                                    <div class="form-group row">
                                                        <div class="col-md-3">
                                                            <label class="form-label ">File Sertifikat:</label>
                                                            <input type="file" class="form-control mb-2 mb-md-0"
                                                                name="certificate_file" placeholder="File Sertifikat" accept=".pdf,.png,.jpg,.jpeg" />
                                                            <small class="text-muted">Berkas maksimal 10MB</small>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label ">Nama Prestasi:</label>
                                                            <input type="text" class="form-control mb-2 mb-md-0"
                                                                name="certificate_name"
                                                                placeholder="Nama Prestasi (Akademik/Non-Akademik)" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label ">Peringkat:</label>
                                                            <select class="form-select form-select-solid"
                                                                name="certificate_rank">
                                                                <option value="Juara 1">Peringkat 1</option>
                                                                <option value="Peringkat 2">Peringkat 2</option>
                                                                <option value="Peringkat 3">Peringkat 3</option>
                                                                <option value="Peringkat Harapan 1">Peringkat Harapan 1</option>
                                                                <option value="Peringkat Harapan 2">Peringkat Harapan 2</option>
                                                                <option value="Peringkat Harapan 3">Peringkat Harapan 3</option>
                                                                <option value="Juara Lainnya">Juara Lainnya</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <a href="javascript:;" data-repeater-delete
                                                                class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                                <i class="ki-duotone ki-trash fs-5"><span
                                                                        class="path1"></span><span
                                                                        class="path2"></span><span
                                                                        class="path3"></span><span
                                                                        class="path4"></span><span
                                                                        class="path5"></span></i>
                                                                Hapus
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-5">
                                            <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                                <i class="ki-duotone ki-plus fs-3"></i>
                                                Add
                                            </a>
                                        </div>
                                    </div>
                                    <small class="text-danger fw-semibold">
                                        <b>Note : </b>Untuk Yang ingin memilih jalur pendaftaran prestasi wajib memasukkan sertifikat/piagam yang dimiliki sesuai dengan informasi yang sudah diberikan
                                    </small><br>
                                    <small >
                                    info lebih lanjut silahkan buka <a href="{{ route("ppdb.information") }}" target="_blank">Link Ini</a>
                                    </small>
                                </div>
                                <div class="mb-10">
                                    <label for="exampleFormControlInput1" class="required form-label">Dari Mana Mendapatkan informasi PPDB MAN 1 Padang Panjang</label>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="Brosur dan Pamflet sekolah" name="additional_data[]" id="flexCheckDefault"  @if (old('additional_data') && in_array('Brosur dan Pamflet sekolah', old('additional_data'))) checked @endif />
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Brosur dan Pamflet sekolah
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="Sosmed (IG, FB, Yt, WA Group, Tiktok)" name="additional_data[]" id="flexCheckDefault" @if (old('additional_data') && in_array('Sosmed (IG, FB, Yt, WA Group, Tiktok)', old('additional_data'))) checked @endif />
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Sosmed (IG, FB, Yt, WA Group, Tiktok)
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="Keluarga" name="additional_data[]" id="flexCheckDefault" @if (old('additional_data') && in_array('Keluarga', old('additional_data'))) checked @endif />
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Keluarga
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="Guru/tenaga kependidikan MAN 1 Padang Panjang" name="additional_data[]" id="flexCheckDefault" @if (old('additional_data') && in_array('Guru/tenaga kependidikan MAN 1 Padang Panjang', old('additional_data'))) checked @endif />
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Guru/tenaga kependidikan MAN 1 Padang Panjang
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="Siswa/Siswi MAN 1 Padang Panjang" name="additional_data[]" id="flexCheckDefault"
                                            @if (old('additional_data') && in_array('Siswa/Siswi MAN 1 Padang Panjang', old('additional_data'))) checked @endif />
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Siswa/Siswi MAN 1 Padang Panjang
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="Website MAN 1 Padang Padang Panjang" name="additional_data[]" id="flexCheckDefault"
                                            @if (old('additional_data') && in_array('Website MAN 1 Padang Padang Panjang', old('additional_data'))) checked @endif />
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Website MAN 1 Padang Padang Panjang
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" value="Lainnya" id="flexCheckLainnya" />
                                            <label class="form-check-label" for="flexCheckLainnya">
                                                Lainnya
                                            </label>
                                        </div>
                                        <div class="mb-10" id="lainnyaInput" style="display: none;">
                                            <label for="exampleFormControlInput1" class="form-label">Sebutkan</label>
                                            <input type="text" class="form-control form-control-solid" placeholder="Sebutkan sumber informasi lainnya" name="additional_data_other" id="additional_data_other" />
                                        </div>

                                    @error('additional_data')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-kt-stepper-element="content">
                        <div class="w-100">
                            <div class="pb-8 pb-lg-10">
                                <h2 class="fw-bold text-gray-900">Finalisasi</h2>
                                <div class="text-muted fw-semibold fs-6">Finalisasi pendaftaran</div>
                            </div>
                            <div class="mb-0">
                                <div class="fs-6 text-gray-600 mb-5">
                                    Sebelum Menekan Tombol Submit, Pastikan Anda Telah Membaca dan memahami Pernyataan
                                    Kebenaran Data di bawah ini.
                                </div>
                                <div
                                    class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
                                    <i class="ki-outline ki-information fs-2tx text-warning me-4"></i>
                                    <div class="d-flex flex-stack flex-grow-1">
                                        <div class="fw-semibold">
                                            <h4 class="text-gray-900 fw-bold">PERNYATAAN KEBENARAN DATA</h4>
                                            <div class="fs-6 text-gray-700">
                                                Dengan ini menyatakan bahwa semua data dan informasi yang saya berikan dalam
                                                Formulir PPDB adalah benar dan sesuai dengan kenyataan. <br>
                                                Apabila di kemudian hari ditemukan adanya ketidaksesuaian atau
                                                ketidakbenaran data yang saya berikan, saya bersedia menerima segala
                                                konsekuensi hukum, termasuk pembatalan hak saya dalam proses ini, serta
                                                tindakan lain sesuai ketentuan yang berlaku.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-stack pt-10">
                        <div class="mr-2">
                            <button type="button" class="btn btn-lg btn-light-primary me-3"
                                data-kt-stepper-action="previous">
                                <i class="ki-outline ki-arrow-left fs-4 me-1"></i>Back</button>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-lg btn-primary me-3" data-kt-stepper-action="submit">
                                <span class="indicator-label">Submit
                                    <i class="ki-outline ki-arrow-right fs-3 ms-2 me-0"></i></span>
                            </button>
                            <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Continue
                                <i class="ki-outline ki-arrow-right fs-4 ms-1 me-0"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @else
        <div class="d-flex flex-wrap justify-content-center pb-lg-0">

            <div class="card d-flex justify-content-xl-start w-600 w-xl-600px w-xxl-600px">
                <div class="card-body px-6 px-lg-10 px-xxl-15 py-20">
                    <div class="pb-5">
                        <h2 class="fw-bold d-flex justify-content-center text-gray-900">Pendaftaran Tutup
                        </h2>
                    </div>
                    <div class="text-center">
                        <p class="fs-6 text-gray-600">
                            {{ $information->registration_message ?? "" }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('back/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script>
        var element = document.querySelector("#kt_create_account_stepper");
        var stepper = new KTStepper(element);

        stepper.on("kt.stepper.next", function(stepper) {
            stepper.goNext(); // go next step
        });

        stepper.on("kt.stepper.previous", function(stepper) {
            stepper.goPrevious(); // go previous step
        });

        $('#kt_docs_repeater_basic').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    </script>
    <script>
        document.getElementById('rapor_type').addEventListener('change', function() {
            var schoolOrigin = document.getElementById('rapor_type').value;
            var sem1TypeSmp = document.getElementById('sem1_type_smp');
            var sem1TypeMts = document.getElementById('sem1_type_mts');
            var sem2TypeSmp = document.getElementById('sem2_type_smp');
            var sem2TypeMts = document.getElementById('sem2_type_mts');
            var sem3TypeSmp = document.getElementById('sem3_type_smp');
            var sem3TypeMts = document.getElementById('sem3_type_mts');
            var sem4TypeSmp = document.getElementById('sem4_type_smp');
            var sem4TypeMts = document.getElementById('sem4_type_mts');
            var sem5TypeSmp = document.getElementById('sem5_type_smp');
            var sem5TypeMts = document.getElementById('sem5_type_mts');
            if (schoolOrigin == 'SMP') {
                sem1TypeSmp.style.display = 'block';
                sem1TypeMts.style.display = 'none';
                sem2TypeSmp.style.display = 'block';
                sem2TypeMts.style.display = 'none';
                sem3TypeSmp.style.display = 'block';
                sem3TypeMts.style.display = 'none';
                sem4TypeSmp.style.display = 'block';
                sem4TypeMts.style.display = 'none';
                sem5TypeSmp.style.display = 'block';
                sem5TypeMts.style.display = 'none';
            } else if (schoolOrigin == 'MTS') {
                sem1TypeSmp.style.display = 'none';
                sem1TypeMts.style.display = 'block';
                sem2TypeSmp.style.display = 'none';
                sem2TypeMts.style.display = 'block';
                sem3TypeSmp.style.display = 'none';
                sem3TypeMts.style.display = 'block';
                sem4TypeSmp.style.display = 'none';
                sem4TypeMts.style.display = 'block';
                sem5TypeSmp.style.display = 'none';
                sem5TypeMts.style.display = 'block';
            } else {
                sem1TypeSmp.style.display = 'none';
                sem1TypeMts.style.display = 'none';
                sem2TypeSmp.style.display = 'none';
                sem2TypeMts.style.display = 'none';
                sem3TypeSmp.style.display = 'none';
                sem3TypeMts.style.display = 'none';
                sem4TypeSmp.style.display = 'none';
                sem4TypeMts.style.display = 'none';
                sem5TypeSmp.style.display = 'none';
                sem5TypeMts.style.display = 'none';
            }
        });

        document.getElementById('rapor_type').dispatchEvent(new Event('change'));


    </script>

<script>
    document.getElementById('flexCheckLainnya').addEventListener('change', function() {
        var lainnyaInput = document.getElementById('lainnyaInput');
        var additionalDataOther = document.getElementById('additional_data_other');
        if (this.checked) {
            lainnyaInput.style.display = 'block';
            additionalDataOther.setAttribute('name', 'additional_data[]');
        } else {
            lainnyaInput.style.display = 'none';
            additionalDataOther.removeAttribute('name');
        }
    });
</script>
@endsection
