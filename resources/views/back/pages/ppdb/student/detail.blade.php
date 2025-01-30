@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="card-title">Data Diri</h3>
                </div>
                <div class="card-body py-4">
                    <div class="fv-row">
                        <div class="mb-5">
                            <label for="exampleFormControlInput1" class="required form-label">NISN</label>
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Nomor Induk Siswa Nasional" name="nisn" value="{{ $user->nisn }}"
                                required readonly />
                            @error('nisn')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="exampleFormControlInput1" class="required form-label">Nama Lengkap</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Nama Lengkap"
                                name="name" value="{{ $user->name }}" required readonly />
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
                                        value="{{ $user->birth_place }}" required readonly />
                                    @error('birth_place')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleFormControlInput1" class="required form-label">Tanggal
                                        Lahir</label>
                                    <input type="date" class="form-control form-control-solid"
                                        placeholder="Tanggal Lahir" name="birth_date"
                                        value="{{ $user->birth_date }}" required readonly />
                                    @error('birth_date')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="exampleFormControlInput1" class="required form-label">Asal Sekolah</label>
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Asal Sekolah" name="school_origin"
                                value="{{ $user->school_origin }}" required readonly />
                            @error('school_origin')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="exampleFormControlInput1" class="required form-label">NPSN Sekolah
                                Asal</label>
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Nomor Pokok Sekolah Nasional" name="npsn"
                                value="{{ $user->npsn }}" required readonly />
                            <small class="text-muted">Nomor Pokok Sekolah Nasional (NPSN) adalah kode unik yang
                                diberikan oleh Kementerian Pendidikan untuk setiap satuan pendidikan di Indonesia,
                                anda dapat melihat rapor untuk mengetahui NPSN sekolah asal anda.</small>
                        </div>
                        <div class="mb-5">
                            <label for="exampleFormControlInput1" class="required form-label">No WhatsApp Orang Tua</label>
                            <input type="text" class="form-control form-control-solid" placeholder="+628XXXXX"
                                name="whatsapp_number" value="{{ $user->whatsapp_number }}" required readonly />
                            <small class="text-muted">Nomor diawali dengan kode negara <code> +62 </code> Pastikan
                                nomor yang anda masukkan benar dan aktif.</small>
                            @error('whatsapp_number')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="exampleFormControlInput1" class="required form-label">Alamat</label>
                            <textarea class="form-control form-control-solid" placeholder="Alamat" name="address" required readonly>{{ $user->address }}</textarea>
                            @error('address')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="exampleFormControlInput1" class=" form-label">Email</label>
                            <input type="email" class="form-control form-control-solid" placeholder="Email"
                                name="email" value="{{ $user->email }}" readonly />
                            @error('email')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

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
                                placeholder="Nomor Kartu Keluarga" name="no_kk" value="{{ $user->no_kk }}"
                                required readonly />
                            @error('no_kk')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="exampleFormControlInput1" class="required form-label">NIK Calon Peserta Didik</label>
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Nomor Induk Kependudukan" name="nik" value="{{ $user->nik }}"
                                required readonly />
                            @error('nik')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="exampleFormControlInput1" class="required form-label">NIK Ibu</label>
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Nomor Induk Kependudukan" name="mother_nik"
                                value="{{ $user->mother_nik }}" required readonly />
                            @error('mother_nik')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="exampleFormControlInput1" class="required form-label">Nama Ibu</label>
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Nama Lengkap" name="mother_name" value="{{ $user->mother_name }}"
                                required readonly />
                            @error('mother_name')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="exampleFormControlInput1" class="required form-label">No WhatsApp
                                Ibu</label>
                            <input type="text" class="form-control form-control-solid" placeholder="+628XXXXX"
                                name="mother_phone_number" value="{{ $user->mother_phone_number }}" required readonly />
                            <small class="text-muted">Nomor diawali dengan kode negara <code> +62 </code> Pastikan
                                nomor yang anda masukkan benar dan aktif.</small>
                            @error('mother_phone_number')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="exampleFormControlInput1" class="required form-label">NIK Ayah</label>
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Nomor Induk Kependudukan" name="father_nik"
                                value="{{ $user->father_nik }}" required readonly />
                            @error('father_nik')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="exampleFormControlInput1" class="required form-label">Nama Ayah</label>
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Nama Lengkap" name="father_name" value="{{ $user->father_name }}"
                                required readonly />
                            @error('father_name')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="exampleFormControlInput1" class="required form-label">No WhatsApp
                                Ayah</label>
                            <input type="text" class="form-control form-control-solid" placeholder="+628XXXXX"
                                name="father_phone_number" value="{{ $user->father_phone_number }}" required readonly />
                            <small class="text-muted">Nomor diawali dengan kode negara <code> +62 </code> Pastikan
                                nomor yang anda masukkan benar dan aktif.</small>
                            @error('father_phone_number')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

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
                                        @if ($user->rapor->rapor_type == 'SMP') selected @endif>SMP</option>
                                    <option value="MTS"
                                        @if ($user->rapor->rapor_type == 'MTS') selected @endif>MTS</option>
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
                                                @foreach ($user->rapor->semester1_nilai as $rapor_nilai)
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
                                            <a href="{{ asset('storage/' . $user->rapor->semester1_file) }}"
                                                target="_blank">{{ $user->rapor->semester1_file }}</a>
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
                                                @foreach ($user->rapor->semester2_nilai as $rapor_nilai)
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
                                            <a href="{{ asset('storage/' . $user->rapor->semester2_file) }}"
                                                target="_blank">{{ $user->rapor->semester2_file }}</a>
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
                                                @foreach ($user->rapor->semester3_nilai as $rapor_nilai)
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
                                            <a href="{{ asset('storage/' . $user->rapor->semester3_file) }}"
                                                target="_blank">{{ $user->rapor->semester3_file }}</a>
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
                                                @foreach ($user->rapor->semester4_nilai as $rapor_nilai)
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
                                            <a href="{{ asset('storage/' . $user->rapor->semester4_file) }}"
                                                target="_blank">{{ $user->rapor->semester4_file }}</a>
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
                                                @foreach ($user->rapor->semester5_nilai as $rapor_nilai)
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
                                            <a href="{{ asset('storage/' . $user->rapor->semester5_file) }}"
                                                target="_blank">{{ $user->rapor->semester5_file }}</a>
                                        </div>
                                        @error('sem5_file')
                                            <small class="text-danger">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1"
                                class="required form-label">Screenshot NISN dari
                                Web Kemendikbud</label>
                                <!--begin::Overlay-->
                            <a class="d-block overlay" data-fslightbox="lightbox-basic" href="{{ asset('storage/' . $user->screenshoot_nisn) }}">
                                <!--begin::Image-->
                                <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                    style="background-image:url('{{ asset('storage/' . $user->screenshoot_nisn) }}')">
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
                            <label for="exampleFormControlInput1"
                                class="required form-label">Serifikat Prestasi</label>

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
                                    @foreach ($user->certificate as $certificate)
                                        <tr>
                                            <td class="fs-5 ">{{ $loop->iteration }}</td>
                                            <td class="fs-5 ">{{ $certificate->name ?? '-' }}</td>
                                            <td class="fs-5 ">{{ $certificate->rank ?? '-' }}</td>
                                            <td class="fs-5 ">
                                                <a href="{{ asset('storage/' . $certificate->path) }}"
                                                    target="_blank">{{ $certificate->path }}</a>
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
                                    id="flexCheckDefault"
                                    @if (in_array('Brosur dan Pamflet sekolah', $user->additional_data)) checked @endif
                                    onclick="return false" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    Brosur dan Pamflet sekolah
                                </label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox"
                                    value="Sosmed (IG, FB, Yt, WA Group, Tiktok)"
                                    name="additional_data[]" id="flexCheckDefault"
                                    @if (in_array('Sosmed (IG, FB, Yt, WA Group, Tiktok)', $user->additional_data)) checked @endif
                                    onclick="return false" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    Sosmed (IG, FB, Yt, WA Group, Tiktok)
                                </label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="Keluarga"
                                    name="additional_data[]" id="flexCheckDefault"
                                    @if (in_array('Keluarga', $user->additional_data)) checked @endif
                                    onclick="return false" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    Keluarga
                                </label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox"
                                    value="Guru/tenaga kependidikan MAN 1 Padang Panjang"
                                    name="additional_data[]" id="flexCheckDefault"
                                    @if (in_array('Guru/tenaga kependidikan MAN 1 Padang Panjang', $user->additional_data)) checked @endif
                                    onclick="return false" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    Guru/tenaga kependidikan MAN 1 Padang Panjang
                                </label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox"
                                    value="Siswa/Siswi MAN 1 Padang Panjang" name="additional_data[]"
                                    id="flexCheckDefault"
                                    @if (in_array('Siswa/Siswi MAN 1 Padang Panjang', $user->additional_data)) checked @endif
                                    onclick="return false" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    Siswa/Siswi MAN 1 Padang Panjang
                                </label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox"
                                    value="Website MAN 1 Padang Padang Panjang"
                                    name="additional_data[]" id="flexCheckDefault"
                                    @if (in_array('Website MAN 1 Padang Padang Panjang', $user->additional_data)) checked @endif
                                    onclick="return false" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    Website MAN 1 Padang Padang Panjang
                                </label>
                            </div>
                            @php
                                $additional_data_array = (array) $user->additional_data;
                                $additional_data_other_temp = end($additional_data_array);
                                $additional_data_other = '';
                                if (
                                    $additional_data_other_temp != 'Brosur dan Pamflet sekolah' &&
                                    $additional_data_other_temp !=
                                        'Sosmed (IG, FB, Yt, WA Group, Tiktok)' &&
                                    $additional_data_other_temp != 'Keluarga' &&
                                    $additional_data_other_temp !=
                                        'Guru/tenaga kependidikan MAN 1 Padang Panjang' &&
                                    $additional_data_other_temp !=
                                        'Siswa/Siswi MAN 1 Padang Panjang' &&
                                    $additional_data_other_temp !=
                                        'Website MAN 1 Padang Padang Panjang'
                                ) {
                                    $additional_data_other = $additional_data_other_temp;
                                }

                            @endphp
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="Lainnya"
                                    id="flexCheckLainnya"
                                    @if ($additional_data_other != '') checked @endif
                                    onclick="return false" />
                                <label class="form-check-label" for="flexCheckLainnya">
                                    Lainnya
                                </label>
                            </div>
                            <div class="mb-5" id="lainnyaInput">
                                <label for="exampleFormControlInput1"
                                    class="form-label">Sebutkan</label>
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
    </div>

@endsection

@section('scripts')
<script src="{{ asset("back/plugins/custom/fslightbox/fslightbox.bundle.js") }}"></script>

@endsection
