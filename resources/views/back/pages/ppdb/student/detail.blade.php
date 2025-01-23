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
                    <div class="fv-row">
                        <div class="mb-5">
                            <label for="exampleFormControlInput1" class="required form-label">Nilai Rapor Semester
                                1</label>
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Nilai Rapor Semester 1" name="rapor_semester_1"
                                value="{{ $user->rapor_semester_1 }}" required />
                            @error('rapor_semester_1')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="exampleFormControlInput1" class="required form-label">Nilai Rapor Semester
                                2</label>
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Nilai Rapor Semester 2" name="rapor_semester_2"
                                value="{{ $user->rapor_semester_2 }}" required />
                            @error('rapor_semester_2')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="exampleFormControlInput1" class="required form-label">Nilai Rapor Semester
                                3</label>
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Nilai Rapor Semester 3" name="rapor_semester_3"
                                value="{{ $user->rapor_semester_3 }}" required />
                            @error('rapor_semester_3')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="exampleFormControlInput1" class="required form-label">Nilai Rapor Semester
                                4</label>
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Nilai Rapor Semester 4" name="rapor_semester_4"
                                value="{{ $user->rapor_semester_4 }}" required />
                            @error('rapor_semester_4')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="exampleFormControlInput1" class="required form-label">Nilai Rapor Semester
                                5</label>
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Nilai Rapor Semester 5" name="rapor_semester_5"
                                value="{{ $user->rapor_semester_5 }}" required />
                            @error('rapor_semester_5')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="exampleFormControlInput1" class="required form-label">Screenshot NISN dari
                                Web Kemendikbud</label>
                            {{-- <input type="file" class="form-control form-control-solid" name="screenshoot_nisn"
                                accept=".png,.jpg,.jpeg" required />
                            <small class="text-muted fw-semibold">Anda dapat mengambil screenshot NISN dari web
                                resmi Kemendikbud yaitu : <a href="https://nisn.data.kemdikbud.go.id" target="_blank">https://nisn.data.kemdikbud.go.id/</a></small> --}}
                                <img src="{{ asset('storage/' . $user->screenshoot_nisn) }}" alt="screenshoot_nisn" class="img-fluid">
                            @error('screenshoot_nisn')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="exampleFormControlInput1" class="required form-label">Serifikat Prestasi</label>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Prestasi</th>
                                        <th>File Sertifikat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->certificate as $certificate)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $certificate->name ?? "-" }}</td>
                                            <td>
                                                <a href="{{ asset('storage/' . $certificate->path) }}" target="_blank">{{ $certificate->path }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mb-5">
                            <label for="exampleFormControlInput1" class="required form-label">Dari Mana Mendapatkan informasi PPDB MAN 1 Padang Panjang</label>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="Brosur dan Pamflet sekolah" name="additional_data[]" id="flexCheckDefault"  @if (in_array('Brosur dan Pamflet sekolah', $user->additional_data)) checked @endif onclick="return false"/>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Brosur dan Pamflet sekolah
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="Sosmed (IG, FB, Yt, WA Group, Tiktok)" name="additional_data[]" id="flexCheckDefault" @if (in_array('Sosmed (IG, FB, Yt, WA Group, Tiktok)', $user->additional_data)) checked @endif onclick="return false"/>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Sosmed (IG, FB, Yt, WA Group, Tiktok)
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="Keluarga" name="additional_data[]" id="flexCheckDefault" @if (in_array('Keluarga', $user->additional_data)) checked @endif onclick="return false"/>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Keluarga
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="Guru/tenaga kependidikan MAN 1 Padang Panjang" name="additional_data[]" id="flexCheckDefault" @if (in_array('Guru/tenaga kependidikan MAN 1 Padang Panjang', $user->additional_data)) checked @endif onclick="return false"/>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Guru/tenaga kependidikan MAN 1 Padang Panjang
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="Siswa/Siswi MAN 1 Padang Panjang" name="additional_data[]" id="flexCheckDefault"
                                    @if (in_array('Siswa/Siswi MAN 1 Padang Panjang', $user->additional_data)) checked @endif onclick="return false"/>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Siswa/Siswi MAN 1 Padang Panjang
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="Website MAN 1 Padang Padang Panjang" name="additional_data[]" id="flexCheckDefault"
                                    @if (in_array('Website MAN 1 Padang Padang Panjang', $user->additional_data)) checked @endif onclick="return false"/>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Website MAN 1 Padang Padang Panjang
                                    </label>
                                </div>
                                @php
                                    $additional_data_array = (array) $user->additional_data;
                                    $additional_data_other_temp = end($additional_data_array);
                                    $additional_data_other = "";
                                    if($additional_data_other_temp != "Brosur dan Pamflet sekolah" && $additional_data_other_temp != "Sosmed (IG, FB, Yt, WA Group, Tiktok)" && $additional_data_other_temp != "Keluarga" && $additional_data_other_temp != "Guru/tenaga kependidikan MAN 1 Padang Panjang" && $additional_data_other_temp != "Siswa/Siswi MAN 1 Padang Panjang" && $additional_data_other_temp != "Website MAN 1 Padang Padang Panjang"){
                                        $additional_data_other = $additional_data_other_temp;
                                    }

                                @endphp
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="Lainnya" id="flexCheckLainnya" @if ($additional_data_other != "") checked @endif onclick="return false"/>
                                    <label class="form-check-label" for="flexCheckLainnya">
                                        Lainnya
                                    </label>
                                </div>
                                <div class="mb-5" id="lainnyaInput" >
                                    <label for="exampleFormControlInput1" class="form-label">Sebutkan</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="Sebutkan sumber informasi lainnya" name="additional_data_other" id="additional_data_other" value="{{ $additional_data_other }}" readonly/>
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
@endsection
