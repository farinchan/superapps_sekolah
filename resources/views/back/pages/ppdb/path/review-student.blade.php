@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="row">
                <div class="col-md-4">

                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">Navigasi</h3>

                        </div>
                        <div class="card-body">
                            <ul
                                class="nav nav-tabs nav-pills flex-row border-0 flex-md-column me-5 mb-3 mb-md-0 fs-6 min-w-lg-200px">
                                <li class="nav-item w-100 me-0 mb-md-2">
                                    <a class="nav-link w-100 active btn btn-flex btn-active-light-success"
                                        data-bs-toggle="tab" href="#tab1">
                                        <span class="svg-icon fs-2"><svg>...</svg></span>
                                        <span class="d-flex flex-column align-items-start">
                                            <span class="fs-4 fw-bold">Step 1</span>
                                            <span class="fs-7">Data Diri</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item w-100 me-0 mb-md-2">
                                    <a class="nav-link w-100 btn btn-flex btn-active-light-success" data-bs-toggle="tab"
                                        href="#tab2">
                                        <span class="svg-icon fs-2"><svg>...</svg></span>
                                        <span class="d-flex flex-column align-items-start">
                                            <span class="fs-4 fw-bold">Step 2</span>
                                            <span class="fs-7">Data Keluarga</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item w-100">
                                    <a class="nav-link w-100 btn btn-flex btn-active-light-success" data-bs-toggle="tab"
                                        href="#tab3">
                                        <span class="svg-icon fs-2"><svg>...</svg></span>
                                        <span class="d-flex flex-column align-items-start">
                                            <span class="fs-4 fw-bold">Step 3</span>
                                            <span class="fs-7">Data Lainnya dan pemberkasan</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item w-100">
                                    <a class="nav-link w-100 btn btn-flex btn-active-light-success" data-bs-toggle="tab"
                                        href="#tab4">
                                        <span class="svg-icon fs-2"><svg>...</svg></span>
                                        <span class="d-flex flex-column align-items-start">
                                            <span class="fs-4 fw-bold">Verifikasi</span>
                                        </span>
                                    </a>
                                </li>
                                @if (
                                    $registration_user->status_kelulusan != 'CADANGAN' &&
                                        $registration_user->status_kelulusan != 'TIDAK LULUS' &&
                                        $registration_user->status_kelulusan != '-')
                                    <li class="nav-item w-100">
                                        <a class="nav-link w-100 btn btn-flex btn-active-light-success" data-bs-toggle="tab"
                                            href="#tab5">
                                            <span class="svg-icon fs-2"><svg>...</svg></span>
                                            <span class="d-flex flex-column align-items-start">
                                                <span class="fs-4 fw-bold">Pendaftaran Ulang</span>
                                                <span class="fs-7">Data tambahan untuk daftar ulang</span>
                                            </span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                            <div class="card mb-5">
                                <div class="card-header">
                                    <h3 class="card-title">Data Diri</h3>
                                </div>
                                <div class="card-body py-4">
                                    <div class="fv-row">
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="required form-label">NISN</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Nomor Induk Siswa Nasional" name="nisn"
                                                value="{{ $registration_user->user?->nisn }}" required readonly />
                                            @error('nisn')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="required form-label">Nama
                                                Lengkap</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Nama Lengkap" name="name"
                                                value="{{ $registration_user->user?->name }}" required readonly />
                                            @error('name')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-5">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlInput1" class="required form-label">Tempat
                                                        Lahir</label>
                                                    <input type="text" class="form-control form-control-solid"
                                                        placeholder="Tempat Lahir" name="birth_place"
                                                        value="{{ $registration_user->user?->birth_place }}" required
                                                        readonly />
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
                                                        value="{{ $registration_user->user?->birth_date }}" required
                                                        readonly />
                                                    @error('birth_date')
                                                        <small class="text-danger">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="required form-label">Asal
                                                Sekolah</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Asal Sekolah" name="school_origin"
                                                value="{{ $registration_user->user?->school_origin }}" required readonly />
                                            @error('school_origin')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="required form-label">NPSN Sekolah
                                                Asal</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Nomor Pokok Sekolah Nasional" name="npsn"
                                                value="{{ $registration_user->user?->npsn }}" required readonly />
                                            <small class="text-muted">Nomor Pokok Sekolah Nasional (NPSN) adalah kode unik
                                                yang
                                                diberikan oleh Kementerian Pendidikan untuk setiap satuan pendidikan di
                                                Indonesia,
                                                anda dapat melihat rapor untuk mengetahui NPSN sekolah asal anda.</small>
                                        </div>
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="required form-label">No WhatsApp
                                                Orang Tua</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="+628XXXXX" name="whatsapp_number"
                                                value="{{ $registration_user->user?->whatsapp_number }}" required
                                                readonly />
                                            <small class="text-muted">Nomor diawali dengan kode negara <code> +62 </code>
                                                Pastikan
                                                nomor yang anda masukkan benar dan aktif.</small>
                                            @error('whatsapp_number')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1"
                                                class="required form-label">Alamat</label>
                                            <textarea class="form-control form-control-solid" placeholder="Alamat" name="address" required readonly>{{ $registration_user->user?->address }}</textarea>
                                            @error('address')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class=" form-label">Email</label>
                                            <input type="email" class="form-control form-control-solid"
                                                placeholder="Email" name="email"
                                                value="{{ $registration_user->user?->email }}" readonly />
                                            @error('email')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab2" role="tabpanel">
                            <div class="card mb-5">
                                <div class="card-header">
                                    <h3 class="card-title">Data Keluarga</h3>
                                </div>
                                <div class="card-body py-4">
                                    <div class="fv-row">
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="required form-label">No Kartu
                                                Keluarga</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Nomor Kartu Keluarga" name="no_kk"
                                                value="{{ $registration_user->user?->no_kk }}" required readonly />
                                            @error('no_kk')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="required form-label">NIK Calon
                                                Peserta Didik</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Nomor Induk Kependudukan" name="nik"
                                                value="{{ $registration_user->user?->nik }}" required readonly />
                                            @error('nik')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="required form-label">NIK
                                                Ibu</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Nomor Induk Kependudukan" name="mother_nik"
                                                value="{{ $registration_user->user?->mother_nik }}" required readonly />
                                            @error('mother_nik')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="required form-label">Nama
                                                Ibu</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Nama Lengkap" name="mother_name"
                                                value="{{ $registration_user->user?->mother_name }}" required readonly />
                                            @error('mother_name')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="required form-label">No WhatsApp
                                                Ibu</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="+628XXXXX" name="mother_phone_number"
                                                value="{{ $registration_user->user?->mother_phone_number }}" required
                                                readonly />
                                            <small class="text-muted">Nomor diawali dengan kode negara <code> +62 </code>
                                                Pastikan
                                                nomor yang anda masukkan benar dan aktif.</small>
                                            @error('mother_phone_number')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="required form-label">NIK
                                                Ayah</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Nomor Induk Kependudukan" name="father_nik"
                                                value="{{ $registration_user->user?->father_nik }}" required readonly />
                                            @error('father_nik')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="required form-label">Nama
                                                Ayah</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Nama Lengkap" name="father_name"
                                                value="{{ $registration_user->user?->father_name }}" required readonly />
                                            @error('father_name')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="required form-label">No WhatsApp
                                                Ayah</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="+628XXXXX" name="father_phone_number"
                                                value="{{ $registration_user->user?->father_phone_number }}" required
                                                readonly />
                                            <small class="text-muted">Nomor diawali dengan kode negara <code> +62 </code>
                                                Pastikan
                                                nomor yang anda masukkan benar dan aktif.</small>
                                            @error('father_phone_number')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab3" role="tabpanel">
                            <div class="card mb-5">
                                <div class="card-header">
                                    <h3 class="card-title">Data Lainnya</h3>
                                </div>
                                <div class="card-body py-4">
                                    <div class="row">
                                        <div class="mb-10">
                                            <label for="exampleFormControlInput1" class="required form-label">Data
                                                Rapor</label><br>
                                            <small class="text-muted fw-semibold">Masukkan nilai rapor semester 1 - 5,
                                                yaitu nilai dari kelas 7 (semester 1) hingga kelas 9 (semester
                                                1)</small>
                                            <div class="m-5">
                                                <label for="exampleFormControlInput1" class="required form-label">Jenis
                                                    Rapor</label>
                                                <select class="form-select form-select-solid" name="rapor_type"
                                                    id="rapor_type" required disabled>
                                                    <option value="SMP"
                                                        @if ($registration_user->user?->rapor?->rapor_type == 'SMP') selected @endif>SMP</option>
                                                    <option value="MTS"
                                                        @if ($registration_user->user?->rapor?->rapor_type == 'MTS') selected @endif>MTS</option>
                                                </select>
                                                @error('rapor_type')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6 ms-5">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab"
                                                        href="#tab_sem1">Semester 1</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#tab_sem2">Semester
                                                        2</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#tab_sem3">Semester
                                                        3</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#tab_sem4">Semester
                                                        4</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#tab_sem5">Semester
                                                        5</a>
                                                </li>
                                            </ul>

                                            <div class="tab-content ms-5" id="myTabContent">
                                                <div class="tab-pane fade show active" id="tab_sem1" role="tabpanel">
                                                    <div class="mb-10">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr class="fs-5">
                                                                    <th>No</th>
                                                                    <th>Mata pelajaran</th>
                                                                    <th>Nilai</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($registration_user->user?->rapor?->semester1_nilai ?? [] as $rapor_nilai)
                                                                    <tr>
                                                                        <td class="fs-5 fw-semibold">
                                                                            {{ $loop->iteration }}</td>
                                                                        <td class="fs-5 fw-semibold">
                                                                            {{ $rapor_nilai['mapel'] ?? '-' }}</td>
                                                                        <td class="fs-5 fw-bold">
                                                                            {{ $rapor_nilai['nilai'] ?? '-' }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1"
                                                            class="required form-label">File Rapor Semester
                                                            1</label><br>
                                                        <div class="fs-3 fw-semibold">
                                                            <span class="text-muted">File : </span>
                                                            <a href="{{ asset('storage/' . $registration_user->user?->rapor?->semester1_file) }}"
                                                                target="_blank">{{ $registration_user->user?->rapor?->semester1_file }}</a>
                                                        </div>
                                                        @error('sem1_file')
                                                            <small class="text-danger">*{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="tab_sem2" role="tabpanel">
                                                    <div class="mb-10">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr class="fs-5">
                                                                    <th>No</th>
                                                                    <th>Mata pelajaran</th>
                                                                    <th>Nilai</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($registration_user->user?->rapor?->semester2_nilai ?? [] as $rapor_nilai)
                                                                    <tr>
                                                                        <td class="fs-5 fw-semibold">
                                                                            {{ $loop->iteration }}</td>
                                                                        <td class="fs-5 fw-semibold">
                                                                            {{ $rapor_nilai['mapel'] ?? '-' }}</td>
                                                                        <td class="fs-5 fw-bold">
                                                                            {{ $rapor_nilai['nilai'] ?? '-' }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1"
                                                            class="required form-label">File Rapor Semester 2</label>
                                                        <div class="fs-3 fw-semibold">
                                                            <span class="text-muted">File : </span>
                                                            <a href="{{ asset('storage/' . $registration_user->user?->rapor?->semester2_file) }}"
                                                                target="_blank">{{ $registration_user->user?->rapor?->semester2_file }}</a>
                                                        </div> @error('sem2_file')
                                                            <small class="text-danger">*{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="tab_sem3" role="tabpanel">
                                                    <div class="mb-10">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr class="fs-5">
                                                                    <th>No</th>
                                                                    <th>Mata pelajaran</th>
                                                                    <th>Nilai</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($registration_user->user?->rapor?->semester3_nilai ?? [] as $rapor_nilai)
                                                                    <tr>
                                                                        <td class="fs-5 fw-semibold">
                                                                            {{ $loop->iteration }}</td>
                                                                        <td class="fs-5 fw-semibold">
                                                                            {{ $rapor_nilai['mapel'] ?? '-' }}</td>
                                                                        <td class="fs-5 fw-bold">
                                                                            {{ $rapor_nilai['nilai'] ?? '-' }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1"
                                                            class="required form-label">File Rapor Semester 3</label>
                                                        <div class="fs-3 fw-semibold">
                                                            <span class="text-muted">File : </span>
                                                            <a href="{{ asset('storage/' . $registration_user->user?->rapor?->semester3_file) }}"
                                                                target="_blank">{{ $registration_user->user?->rapor?->semester3_file }}</a>
                                                        </div> @error('sem3_file')
                                                            <small class="text-danger">*{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="tab_sem4" role="tabpanel">
                                                    <div class="mb-10">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr class="fs-5">
                                                                    <th>No</th>
                                                                    <th>Mata pelajaran</th>
                                                                    <th>Nilai</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($registration_user->user?->rapor?->semester4_nilai ?? [] as $rapor_nilai)
                                                                    <tr>
                                                                        <td class="fs-5 fw-semibold">
                                                                            {{ $loop->iteration }}</td>
                                                                        <td class="fs-5 fw-semibold">
                                                                            {{ $rapor_nilai['mapel'] ?? '-' }}</td>
                                                                        <td class="fs-5 fw-bold">
                                                                            {{ $rapor_nilai['nilai'] ?? '-' }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1"
                                                            class="required form-label">File Rapor Semester 4</label>
                                                        <div class="fs-3 fw-semibold">
                                                            <span class="text-muted">File : </span>
                                                            <a href="{{ asset('storage/' . $registration_user->user?->rapor?->semester4_file) }}"
                                                                target="_blank">{{ $registration_user->user?->rapor?->semester4_file }}</a>
                                                        </div> @error('sem4_file')
                                                            <small class="text-danger">*{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="tab_sem5" role="tabpanel">
                                                    <div class="mb-10">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr class="fs-5">
                                                                    <th>No</th>
                                                                    <th>Mata pelajaran</th>
                                                                    <th>Nilai</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($registration_user->user?->rapor?->semester5_nilai ?? [] as $rapor_nilai)
                                                                    <tr>
                                                                        <td class="fs-5 fw-semibold">
                                                                            {{ $loop->iteration }}</td>
                                                                        <td class="fs-5 fw-semibold">
                                                                            {{ $rapor_nilai['mapel'] ?? '-' }}</td>
                                                                        <td class="fs-5 fw-bold">
                                                                            {{ $rapor_nilai['nilai'] ?? '-' }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1"
                                                            class="required form-label">File Rapor Semester 5</label>
                                                        <div class="fs-3 fw-semibold">
                                                            <span class="text-muted">File : </span>
                                                            <a href="{{ asset('storage/' . $registration_user->user?->rapor?->semester5_file) }}"
                                                                target="_blank">{{ $registration_user->user?->rapor?->semester5_file }}</a>
                                                        </div>
                                                        @error('sem5_file')
                                                            <small class="text-danger">*{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-10">
                                            <label for="exampleFormControlInput1" class="required form-label">Screenshot
                                                NISN dari
                                                Web Kemendikbud</label>
                                            <!--begin::Overlay-->
                                            <a class="d-block overlay" data-fslightbox="lightbox-basic"
                                                href="{{ asset('storage/' . $registration_user->user?->screenshoot_nisn) }}">
                                                <!--begin::Image-->
                                                <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                                    style="background-image:url('{{ asset('storage/' . $registration_user->user?->screenshoot_nisn) }}')">
                                                </div>
                                                <!--end::Image-->

                                                <!--begin::Action-->
                                                <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                                    <i class="bi bi-eye-fill text-white fs-3x"></i>
                                                </div>
                                                <!--end::Action-->
                                            </a>
                                            <!--end::Overlay-->
                                            @error('screenshoot_nisn')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-10">
                                            <label for="exampleFormControlInput1" class="required form-label">Serifikat
                                                Prestasi</label>

                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="fs-5 ">
                                                        <th>No</th>
                                                        <th>Nama Prestasi</th>
                                                        <th>Peringkat</th>
                                                        <th>File Sertifikat</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($registration_user->user?->certificate as $certificate)
                                                        <tr>
                                                            <td class="fs-5 ">{{ $loop->iteration }}</td>
                                                            <td class="fs-5 ">{{ $certificate?->name ?? '-' }}</td>
                                                            <td class="fs-5 ">{{ $certificate?->rank ?? '-' }}</td>
                                                            <td class="fs-5 ">
                                                                <a href="{{ asset('storage/' . $certificate?->path ?? '#') }}"
                                                                    target="_blank">{{ $certificate?->path ?? '-' }}</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mb-10">
                                            <label for="exampleFormControlInput1" class="required form-label">Dari
                                                Mana Mendapatkan informasi PPDB MAN 1 Padang Panjang</label>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox"
                                                    value="Brosur dan Pamflet sekolah" name="additional_data[]"
                                                    id="flexCheckDefault" @if (in_array('Brosur dan Pamflet sekolah', $registration_user->user?->additional_data ?? [])) checked @endif
                                                    onclick="return false" />
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Brosur dan Pamflet sekolah
                                                </label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox"
                                                    value="Sosmed (IG, FB, Yt, WA Group, Tiktok)" name="additional_data[]"
                                                    id="flexCheckDefault" @if (in_array('Sosmed (IG, FB, Yt, WA Group, Tiktok)', $registration_user->user?->additional_data ?? [])) checked @endif
                                                    onclick="return false" />
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Sosmed (IG, FB, Yt, WA Group, Tiktok)
                                                </label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" value="Keluarga"
                                                    name="additional_data[]" id="flexCheckDefault"
                                                    @if (in_array('Keluarga', $registration_user->user?->additional_data ?? [])) checked @endif
                                                    onclick="return false" />
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Keluarga
                                                </label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox"
                                                    value="Guru/tenaga kependidikan MAN 1 Padang Panjang"
                                                    name="additional_data[]" id="flexCheckDefault"
                                                    @if (in_array('Guru/tenaga kependidikan MAN 1 Padang Panjang', $registration_user->user?->additional_data ?? [])) checked @endif
                                                    onclick="return false" />
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Guru/tenaga kependidikan MAN 1 Padang Panjang
                                                </label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox"
                                                    value="Siswa/Siswi MAN 1 Padang Panjang" name="additional_data[]"
                                                    id="flexCheckDefault" @if (in_array('Siswa/Siswi MAN 1 Padang Panjang', $registration_user->user?->additional_data ?? [])) checked @endif
                                                    onclick="return false" />
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Siswa/Siswi MAN 1 Padang Panjang
                                                </label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox"
                                                    value="Website MAN 1 Padang Padang Panjang" name="additional_data[]"
                                                    id="flexCheckDefault" @if (in_array('Website MAN 1 Padang Padang Panjang', $registration_user->user?->additional_data ?? [])) checked @endif
                                                    onclick="return false" />
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Website MAN 1 Padang Padang Panjang
                                                </label>
                                            </div>
                                            @php
                                                $additional_data_array =
                                                    (array) $registration_user->user?->additional_data ?? [];
                                                $additional_data_other_temp = end($additional_data_array);
                                                $additional_data_other = '';
                                                if (
                                                    $additional_data_other_temp != 'Brosur dan Pamflet sekolah' &&
                                                    $additional_data_other_temp !=
                                                        'Sosmed (IG, FB, Yt, WA Group, Tiktok)' &&
                                                    $additional_data_other_temp != 'Keluarga' &&
                                                    $additional_data_other_temp !=
                                                        'Guru/tenaga kependidikan MAN 1 Padang Panjang' &&
                                                    $additional_data_other_temp != 'Siswa/Siswi MAN 1 Padang Panjang' &&
                                                    $additional_data_other_temp != 'Website MAN 1 Padang Padang Panjang'
                                                ) {
                                                    $additional_data_other = $additional_data_other_temp;
                                                }
                                            @endphp
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" value="Lainnya"
                                                    id="flexCheckLainnya" @if ($additional_data_other != '') checked @endif
                                                    onclick="return false" />
                                                <label class="form-check-label" for="flexCheckLainnya">
                                                    Lainnya
                                                </label>
                                            </div>
                                            <div class="mb-5" id="lainnyaInput">
                                                <label for="exampleFormControlInput1" class="form-label">Sebutkan</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="Sebutkan sumber informasi lainnya"
                                                    name="additional_data_other" id="additional_data_other"
                                                    value="{{ $additional_data_other }}" readonly />
                                            </div>

                                            @error('additional_data')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab4" role="tabpanel">
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    <h3 class="card-title">Verifikasi</h3>
                                </div>
                                <form
                                    action="{{ route('back.ppdb.path.review-student.update', [$path_id, $registration_id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="card-body">
                                        <div class="fv-row">
                                            <div class="m-5">
                                                <label for="exampleFormControlInput1" class="required form-label">Status
                                                    Berkas</label>
                                                <select class="form-select form-select-solid" name="status_berkas"
                                                    id="status_berkas" required>
                                                    <option value="sedang diverifikasi"
                                                        @if ($registration_user->status_berkas == 'sedang diverifikasi') selected @endif>Sedang
                                                        Diverifikasi</option>
                                                    <option value="diterima"
                                                        @if ($registration_user->status_berkas == 'diterima') selected @endif>Diterima
                                                    </option>
                                                    <option value="perbaiki"
                                                        @if ($registration_user->status_berkas == 'perbaiki') selected @endif>Perbaiki
                                                    </option>
                                                    <option value="ditolak"
                                                        @if ($registration_user->status_berkas == 'ditolak') selected @endif>Ditolak</option>
                                                </select>
                                                @error('status_berkas')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="m-5">
                                                <label for="exampleFormControlInput1"
                                                    class="required text-danger form-label">Status Kelulusan</label>
                                                <select class="form-select form-select-solid" name="status_kelulusan"
                                                    id="status_kelulusan" required>

                                                    <option value="-"
                                                        @if ($registration_user->status_kelulusan == '-') selected @endif>-</option>
                                                    <option value="LULUS MADRASAH DAN DITERIMA DI ASRAMA"
                                                        @if ($registration_user->status_kelulusan == 'LULUS MADRASAH DAN DITERIMA DI ASRAMA') selected @endif>LULUS MADRASAH
                                                        DAN DITERIMA DI ASRAMA</option>
                                                    <option value="LULUS MADRASAH DAN TIDAK DITERIMA DI ASRAMA"
                                                        @if ($registration_user->status_kelulusan == 'LULUS MADRASAH DAN TIDAK DITERIMA DI ASRAMA') selected @endif>LULUS MADRASAH
                                                        DAN TIDAK DITERIMA DI ASRAMA</option>
                                                    <option value="LULUS PRESTASI MADRASAH DAN DITERIMA DI ASRAMA"
                                                        @if ($registration_user->status_kelulusan == 'LULUS PRESTASI MADRASAH DAN DITERIMA DI ASRAMA') selected @endif>LULUS PRESTASI
                                                        MADRASAH DAN DITERIMA DI ASRAMA</option>
                                                    <option value="LULUS PRESTASI MADRASAH DAN TIDAK DITERIMA DI ASRAMA"
                                                        @if ($registration_user->status_kelulusan == 'LULUS PRESTASI MADRASAH DAN TIDAK DITERIMA DI ASRAMA') selected @endif>LULUS PRESTASI
                                                        MADRASAH DAN TIDAK DITERIMA DI ASRAMA</option>
                                                    <option value="CADANGAN"
                                                        @if ($registration_user->status_kelulusan == 'CADANGAN') selected @endif>CADANGAN
                                                    </option>
                                                    <option value="TIDAK LULUS"
                                                        @if ($registration_user->status_kelulusan == 'TIDAK LULUS') selected @endif>TIDAK LULUS
                                                    </option>
                                                    <option value="" disabled>&nbsp;</option>
                                                    <option value="LULUS/ DITERIMA ASRAMA"
                                                        @if ($registration_user->status_kelulusan == 'LULUS/ DITERIMA ASRAMA') selected @endif disabled>LULUS/
                                                        DITERIMA ASRAMA</option>
                                                    <option value="LULUS/ TIDAK DIASRAMA"
                                                        @if ($registration_user->status_kelulusan == 'LULUS/ TIDAK DIASRAMA') selected @endif disabled>LULUS/
                                                        TIDAK DIASRAMA</option>
                                                    <option value="LULUS PRESTASI/ASRAMA"
                                                        @if ($registration_user->status_kelulusan == 'LULUS PRESTASI/ASRAMA') selected @endif disabled>LULUS
                                                        PRESTASI/ASRAMA</option>
                                                    <option value="LULUS PRESTASI/TIDAK DIASRAMA"
                                                        @if ($registration_user->status_kelulusan == 'LULUS PRESTASI/TIDAK DIASRAMA') selected @endif disabled>LULUS
                                                        PRESTASI/TIDAK DIASRAMA</option>
                                                </select>
                                                <small class="text-danger">*Status kelulusan siswa jika sudah di set lulus
                                                    maka <b>keputusan tidak dapat diubah lagi</b></small>
                                                @error('status_kelulusan')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="m-5">
                                                <label for="exampleFormControlInput1"
                                                    class="required form-label">Tangapan</label>
                                                <textarea class="form-control form-control-solid" placeholder="Tangapan" rows="9" name="reason" required>{{ $registration_user->reason }}</textarea>
                                                <small class="text-muted">Tangapan yang diberikan kepada calon
                                                    siswa</small>
                                                @error('reason')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-end">
                                        {{-- @if ($registration_user->status_kelulusan == 'CADANGAN' || $registration_user->status_kelulusan == 'TIDAK LULUS' || $registration_user->status_kelulusan == '-') --}}
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        {{-- @else
                                            <span class="text-danger">*Status kelulusan sudah di set tidak dapat diubah lagi</span>
                                        @endif --}}
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab5" role="tabpanel">
                            <div class="card mb-5">
                                <div class="card-header">
                                    <h3 class="card-title">Data Tambahan</h3>
                                </div>
                                <div class="card-body py-4">
                                    <div class="fv-row">
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="required form-label">Jenis
                                                Kelamin</label>
                                            <select class="form-select form-select-solid" name="jenis_kelamin" required
                                                disabled>
                                                <option value="">-</option>
                                                <option value="Laki-laki"
                                                    {{ old('jenis_kelamin', $registration_user->reRegistration?->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                                    Laki-laki</option>
                                                <option value="Perempuan"
                                                    {{ old('jenis_kelamin', $registration_user->reRegistration?->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="form-label required">Penghasilan
                                                Orang Tua</label>
                                            <div class="">
                                                <div class="row">
                                                    @php
                                                        $parent_income_options = [
                                                            'Kurang dari 500.000',
                                                            '500.000 - 1.000.000',
                                                            '1.000.000-2.000.000',
                                                            '2.000.000-3.000.000',
                                                            'Lebih Dari 5.000.000',
                                                            'Tidak ada',
                                                        ];
                                                    @endphp
                                                    @foreach ($parent_income_options as $option)
                                                        <div class="col-md-4 mb-3">
                                                            <div class="form-check form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="radio"
                                                                    name="parent_income" id="income{{ $loop->index }}"
                                                                    value="{{ $option }}"
                                                                    {{ old('parent_income', $registration_user->reRegistration?->parent_income) == $option ? 'checked' : '' }}
                                                                    onclick="return false" />
                                                                <label class="form-check-label"
                                                                    for="income{{ $loop->index }}">{{ $option }}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @error('parent_income')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="form-label required">Surat Pernyataan:</label>
                                            {{-- <input type="file" class="form-control form-control-solid"
                                                name="file_kk" /> --}}
                                            @if ($registration_user->reRegistration?->statement_letter)
                                                <span class="text-muted"> <a
                                                        href="{{ asset('storage/' . $registration_user->reRegistration?->statement_letter) }}"
                                                        target="_blank">Lihat Disini</a></span><br>
                                            @else
                                                -
                                            @endif

                                            @error('file_kk')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="form-label required">File Kartu
                                                Keluarga (KK):</label>
                                            {{-- <input type="file" class="form-control form-control-solid"
                                                name="file_kk" /> --}}
                                            @if ($registration_user->reRegistration?->file_kk)
                                                <span class="text-muted"> <a
                                                        href="{{ asset('storage/' . $registration_user->reRegistration?->file_kk) }}"
                                                        target="_blank">Lihat Disini</a></span><br>
                                            @else
                                                -
                                            @endif

                                            @error('file_kk')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="form-label">File Kartu Indonesia
                                                Pintar (KIP):</label>
                                            {{-- <input type="file" class="form-control form-control-solid"
                                                name="file_kip" /> --}}
                                            @if ($registration_user->reRegistration?->file_kip)
                                                <span class="text-muted"> <a
                                                        href="{{ asset('storage/' . $registration_user->reRegistration?->file_kip) }}"
                                                        target="_blank">Lihat</a></span><br>
                                            @else
                                                -
                                            @endif

                                            @error('file_kip')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="form-label">File Program Keluarga
                                                Harapan (PKH):</label>
                                            {{-- <input type="file" class="form-control form-control-solid"
                                                name="file_pkh" /> --}}
                                            @if ($registration_user->reRegistration?->file_pkh)
                                                <span class="text-muted"> <a
                                                        href="{{ asset('storage/' . $registration_user->reRegistration?->file_pkh) }}"
                                                        target="_blank">Lihat</a></span><br>
                                            @else
                                                -
                                            @endif

                                            @error('file_pkh')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="form-label">File Data Terpadu
                                                Kesejahteraan Sosial (DTKS):</label>
                                            {{-- <input type="file" class="form-control form-control-solid"
                                                name="file_dtks" /> --}}
                                            @if ($registration_user->reRegistration?->file_dtks)
                                                <span class="text-muted"> <a
                                                        href="{{ asset('storage/' . $registration_user->reRegistration?->file_dtks) }}"
                                                        target="_blank">Lihat</a></span><br>
                                            @else
                                                -
                                            @endif

                                            @error('file_dtks')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1" class="form-label">File Kartu Keluarga
                                                Sejahtera (KKS):</label>
                                            {{-- <input type="file" class="form-control form-control-solid"
                                                name="file_kks" /> --}}
                                            @if ($registration_user->reRegistration?->file_kks)
                                                <span class="text-muted"> <a
                                                        href="{{ asset('storage/' . $registration_user->reRegistration?->file_kks) }}"
                                                        target="_blank">Lihat</a></span><br>
                                            @else
                                                -
                                            @endif

                                            @error('file_kks')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('back/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
@endsection
