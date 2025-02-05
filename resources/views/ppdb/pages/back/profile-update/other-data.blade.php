@extends('ppdb.app-back')
@section('styles')
@endsection
@section('content')
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div class="d-flex flex-column flex-lg-row">
            <div class="card">
                <form method="post" action="{{ route("ppdb.profile.other-data.update") }}" enctype="multipart/form-data">
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
                                                <label for="exampleFormControlInput1" class="required form-label">Data
                                                    Rapor</label><br>
                                                <small class="text-muted fw-semibold">Masukkan nilai rapor semester 1 - 5,
                                                    yaitu nilai dari kelas 7 (semester 1) hingga kelas 9 (semester
                                                    1)</small>
                                                <div class="m-5">
                                                    <label for="exampleFormControlInput1" class="required form-label">Jenis
                                                        Rapor</label>
                                                    <select class="form-select form-select-solid" name="rapor_type"
                                                        id="rapor_type" required >
                                                        <option value="SMP"
                                                            @if ($rapor?->rapor_type == 'SMP') selected @endif>SMP</option>
                                                        <option value="MTS"
                                                            @if ($rapor?->rapor_type == 'MTS') selected @endif>MTS</option>
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
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">Ilmu Pengetahuan Alam (IPA)</label>
                                                            <input type="number" class="form-control form-control-solid" placeholder="Nilai IPA" name="sem1_ipa" value="{{ $sem1_ipa ?? old('sem1_ipa') }}" required />
                                                            @error('sem1_ipa')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">Ilmu Pengetahuan Sosial (IPS)</label>
                                                            <input type="number" class="form-control form-control-solid" placeholder="Nilai IPS" name="sem1_ips" value="{{ $sem1_ips ?? old('sem1_ips') }}" required />
                                                            @error('sem1_ips')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">Bahasa Indonesia</label>
                                                            <input type="number" class="form-control form-control-solid" placeholder="Nilai Bahasa Indonesia" name="sem1_indonesia" value="{{ $sem1_indonesia ?? old('sem1_indonesia') }}" required />
                                                            @error('sem1_indonesia')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">Bahasa Inggris</label>
                                                            <input type="number" class="form-control form-control-solid" placeholder="Nilai Bahasa Inggris" name="sem1_inggris" value="{{ $sem1_inggris ?? old('sem1_inggris') }}" required />
                                                            @error('sem1_inggris')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">Matematika</label>
                                                            <input type="number" class="form-control form-control-solid" placeholder="Nilai Matematika" name="sem1_matematika" value="{{ $sem1_matematika ?? old('sem1_matematika') }}" required />
                                                            @error('sem1_matematika')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div id="sem1_type_smp">
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="required form-label">Pendidikan Agama</label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Pendidikan Agama" name="sem1_agama" value="{{ $sem1_agama ?? old('sem1_agama') }}"  />
                                                                @error('sem1_agama')
                                                                    <small class="text-danger">*{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div id="sem1_type_mts">
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="required form-label">Alquran Hadits</label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Alquran Hadits" name="sem1_qhadits" value="{{ $sem1_qhadits ?? old('sem1_qhadits') }}"  />
                                                                @error('sem1_qhadits')
                                                                    <small class="text-danger">*{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="required form-label">Akidah Akhlak</label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Akidah Akhlak" name="sem1_akidah" value="{{ $sem1_akidah ?? old('sem1_akidah') }}"  />
                                                                @error('sem1_akidah')
                                                                    <small class="text-danger">*{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="required form-label">Fiqih</label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Fiqih" name="sem1_fiqih" value="{{ $sem1_fiqih ?? old('sem1_fiqih') }}"  />
                                                                @error('sem1_fiqih')
                                                                    <small class="text-danger">*{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="required form-label">Sejarah Kebudayaan Islam (SKI)</label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai SKI" name="sem1_ski" value="{{ $sem1_ski ?? old('sem1_ski') }}"  />
                                                                @error('sem1_ski')
                                                                    <small class="text-danger">*{{ $message }}</small>
                                                                @enderror
                                                            </div>

                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">File Rapor Semester 1</label>
                                                            <input type="file" class="form-control form-control-solid" name="sem1_file" accept=".pdf, .png, .jpg, .jpeg"/>
                                                            <small class="text-muted">File dengan format PDF, PNG, JPG, JPEG, maksimal 10MB</small><br>
                                                            <small class="text-gray700">File Sebelumnya : <a href="{{ asset('storage/' . $rapor->semester1_file) }}" target="_blank">{{ $rapor->semester1_file ?? "-" }}</a>
                                                                @if ($rapor->semester1_file)
                                                                    <span class="text-danger">(Kosongkan jika tidak ingin mengganti)</span>
                                                                @endif
                                                            </small>
                                                            @error('sem1_file')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="tab_sem2" role="tabpanel">
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">Ilmu Pengetahuan Alam (IPA)</label>
                                                            <input type="number" class="form-control form-control-solid" placeholder="Nilai IPA" name="sem2_ipa" value="{{ $sem2_ipa ?? old('sem2_ipa') }}" required />
                                                            @error('sem2_ipa')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">Ilmu Pengetahuan Sosial (IPS)</label>
                                                            <input type="number" class="form-control form-control-solid" placeholder="Nilai IPS" name="sem2_ips" value="{{ $sem2_ips ?? old('sem2_ips') }}" required />
                                                            @error('sem2_ips')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">Bahasa Indonesia</label>
                                                            <input type="number" class="form-control form-control-solid" placeholder="Nilai Bahasa Indonesia" name="sem2_indonesia" value="{{ $sem2_indonesia ?? old('sem2_indonesia') }}" required />
                                                            @error('sem2_indonesia')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">Bahasa Inggris</label>
                                                            <input type="number" class="form-control form-control-solid" placeholder="Nilai Bahasa Inggris" name="sem2_inggris" value="{{ $sem2_inggris ?? old('sem2_inggris') }}" required />
                                                            @error('sem2_inggris')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">Matematika</label>
                                                            <input type="number" class="form-control form-control-solid" placeholder="Nilai Matematika" name="sem2_matematika" value="{{ $sem2_matematika ?? old('sem2_matematika') }}" required />
                                                            @error('sem2_matematika')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div id="sem2_type_smp">
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="required form-label">Pendidikan Agama</label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Pendidikan Agama" name="sem2_agama" value="{{ $sem2_agama ?? old('sem2_agama') }}"  />
                                                                @error('sem2_agama')
                                                                    <small class="text-danger">*{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div id="sem2_type_mts">
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="required form-label">Alquran Hadits</label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Alquran Hadits" name="sem2_qhadits" value="{{ $sem2_qhadits ?? old('sem2_qhadits') }}"  />
                                                                @error('sem2_qhadits')
                                                                    <small class="text-danger">*{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="required form-label">Akidah Akhlak</label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Akidah Akhlak" name="sem2_akidah" value="{{ $sem2_akidah ?? old('sem2_akidah') }}"  />
                                                                @error('sem2_akidah')
                                                                    <small class="text-danger">*{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="required form-label">Fiqih</label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Fiqih" name="sem2_fiqih" value="{{ $sem2_fiqih ?? old('sem2_fiqih') }}"  />
                                                                @error('sem2_fiqih')
                                                                    <small class="text-danger">*{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="required form-label">Sejarah Kebudayaan Islam (SKI)</label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai SKI" name="sem2_ski" value="{{ $sem2_ski ?? old('sem2_ski') }}"  />
                                                                @error('sem2_ski')
                                                                    <small class="text-danger">*{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">File Rapor Semester 2</label>
                                                            <input type="file" class="form-control form-control-solid" name="sem2_file" accept=".pdf, .png, .jpg, .jpeg"/>
                                                            <small class="text-muted">File dengan format PDF, PNG, JPG, JPEG, maksimal 10MB</small><br>
                                                            <small class="text-gray700">File Sebelumnya : <a href="{{ asset('storage/' . $rapor->semester2_file) }}" target="_blank">{{ $rapor->semester2_file ?? "-" }}</a>
                                                                @if ($rapor->semester2_file)
                                                                    <span class="text-danger">(Kosongkan jika tidak ingin mengganti)</span>
                                                                @endif
                                                            </small>
                                                            @error('sem2_file')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="tab_sem3" role="tabpanel">
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">Ilmu Pengetahuan Alam (IPA)</label>
                                                            <input type="number" class="form-control form-control-solid" placeholder="Nilai IPA" name="sem3_ipa" value="{{ $sem3_ipa ?? old('sem3_ipa') }}" required />
                                                            @error('sem3_ipa')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">Ilmu Pengetahuan Sosial (IPS)</label>
                                                            <input type="number" class="form-control form-control-solid" placeholder="Nilai IPS" name="sem3_ips" value="{{ $sem3_ips ?? old('sem3_ips') }}" required />
                                                            @error('sem3_ips')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">Bahasa Indonesia</label>
                                                            <input type="number" class="form-control form-control-solid" placeholder="Nilai Bahasa Indonesia" name="sem3_indonesia" value="{{ $sem3_indonesia ?? old('sem3_indonesia') }}" required />
                                                            @error('sem3_indonesia')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">Bahasa Inggris</label>
                                                            <input type="number" class="form-control form-control-solid" placeholder="Nilai Bahasa Inggris" name="sem3_inggris" value="{{ $sem3_inggris ?? old('sem3_inggris') }}" required />
                                                            @error('sem3_inggris')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">Matematika</label>
                                                            <input type="number" class="form-control form-control-solid" placeholder="Nilai Matematika" name="sem3_matematika" value="{{ $sem3_matematika ?? old('sem3_matematika') }}" required />
                                                            @error('sem3_matematika')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div id="sem3_type_smp">
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="required form-label">Pendidikan Agama</label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Pendidikan Agama" name="sem3_agama" value="{{ $sem3_agama ?? old('sem3_agama') }}"  />
                                                                @error('sem3_agama')
                                                                    <small class="text-danger">*{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div id="sem3_type_mts">
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="required form-label">Alquran Hadits</label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Alquran Hadits" name="sem3_qhadits" value="{{ $sem3_qhadits ?? old('sem3_qhadits') }}"  />
                                                                @error('sem3_qhadits')
                                                                    <small class="text-danger">*{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="required form-label">Akidah Akhlak</label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Akidah Akhlak" name="sem3_akidah" value="{{ $sem3_akidah ?? old('sem3_akidah') }}"  />
                                                                @error('sem3_akidah')
                                                                    <small class="text-danger">*{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="required form-label">Fiqih</label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Fiqih" name="sem3_fiqih" value="{{ $sem3_fiqih ?? old('sem3_fiqih') }}"  />
                                                                @error('sem3_fiqih')
                                                                    <small class="text-danger">*{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="required form-label">Sejarah Kebudayaan Islam (SKI)</label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai SKI" name="sem3_ski" value="{{ $sem3_ski ?? old('sem3_ski') }}"  />
                                                                @error('sem3_ski')
                                                                    <small class="text-danger">*{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">File Rapor Semester 3</label>
                                                            <input type="file" class="form-control form-control-solid" name="sem3_file" accept=".pdf, .png, .jpg, .jpeg"/>
                                                            <small class="text-muted">File dengan format PDF, PNG, JPG, JPEG, maksimal 10MB</small><br>
                                                            <small class="text-gray700">File Sebelumnya : <a href="{{ asset('storage/' . $rapor->semester3_file) }}" target="_blank">{{ $rapor->semester3_file ?? "-" }}</a>
                                                                @if ($rapor->semester3_file)
                                                                    <span class="text-danger">(Kosongkan jika tidak ingin mengganti)</span>
                                                                @endif
                                                            </small>
                                                            @error('sem3_file')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="tab_sem4" role="tabpanel">
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">Ilmu Pengetahuan Alam (IPA)</label>
                                                            <input type="number" class="form-control form-control-solid" placeholder="Nilai IPA" name="sem4_ipa" value="{{ $sem4_ipa ?? old('sem4_ipa') }}" required />
                                                            @error('sem4_ipa')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">Ilmu Pengetahuan Sosial (IPS)</label>
                                                            <input type="number" class="form-control form-control-solid" placeholder="Nilai IPS" name="sem4_ips" value="{{ $sem4_ips ?? old('sem4_ips') }}" required />
                                                            @error('sem4_ips')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">Bahasa Indonesia</label>
                                                            <input type="number" class="form-control form-control-solid" placeholder="Nilai Bahasa Indonesia" name="sem4_indonesia" value="{{ $sem4_indonesia ?? old('sem4_indonesia') }}" required />
                                                            @error('sem4_indonesia')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">Bahasa Inggris</label>
                                                            <input type="number" class="form-control form-control-solid" placeholder="Nilai Bahasa Inggris" name="sem4_inggris" value="{{ $sem4_inggris ?? old('sem4_inggris') }}" required />
                                                            @error('sem4_inggris')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">Matematika</label>
                                                            <input type="number" class="form-control form-control-solid" placeholder="Nilai Matematika" name="sem4_matematika" value="{{ $sem4_matematika ?? old('sem4_matematika') }}" required />
                                                            @error('sem4_matematika')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div id="sem4_type_smp">
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="required form-label">Pendidikan Agama</label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Pendidikan Agama" name="sem4_agama" value="{{ $sem4_agama ?? old('sem4_agama') }}"  />
                                                                @error('sem4_agama')
                                                                    <small class="text-danger">*{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div id="sem4_type_mts">
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="required form-label">Alquran Hadits</label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Alquran Hadits" name="sem4_qhadits" value="{{ $sem4_qhadits ?? old('sem4_qhadits') }}"  />
                                                                @error('sem4_qhadits')
                                                                    <small class="text-danger">*{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="required form-label">Akidah Akhlak</label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Akidah Akhlak" name="sem4_akidah" value="{{ $sem4_akidah ?? old('sem4_akidah') }}"  />
                                                                @error('sem4_akidah')
                                                                    <small class="text-danger">*{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="required form-label">Fiqih</label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Fiqih" name="sem4_fiqih" value="{{ $sem4_fiqih ?? old('sem4_fiqih') }}"  />
                                                                @error('sem4_fiqih')
                                                                    <small class="text-danger">*{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="required form-label">Sejarah Kebudayaan Islam (SKI)</label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai SKI" name="sem4_ski" value="{{ $sem4_ski ?? old('sem4_ski') }}"  />
                                                                @error('sem4_ski')
                                                                    <small class="text-danger">*{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">File Rapor Semester 4</label>
                                                            <input type="file" class="form-control form-control-solid" name="sem4_file" accept=".pdf, .png, .jpg, .jpeg"/>
                                                            <small class="text-muted">File dengan format PDF, PNG, JPG, JPEG, maksimal 10MB</small><br>
                                                            <small class="text-gray700">File Sebelumnya : <a href="{{ asset('storage/' . $rapor->semester4_file) }}" target="_blank">{{ $rapor->semester4_file ?? "-" }}</a>
                                                                @if ($rapor->semester4_file)
                                                                    <span class="text-danger">(Kosongkan jika tidak ingin mengganti)</span>
                                                                @endif
                                                            </small>
                                                            @error('sem4_file')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="tab_sem5" role="tabpanel">
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">Ilmu Pengetahuan Alam (IPA)</label>
                                                            <input type="number" class="form-control form-control-solid" placeholder="Nilai IPA" name="sem5_ipa" value="{{ $sem5_ipa ?? old('sem5_ipa') }}" required />
                                                            @error('sem5_ipa')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">Ilmu Pengetahuan Sosial (IPS)</label>
                                                            <input type="number" class="form-control form-control-solid" placeholder="Nilai IPS" name="sem5_ips" value="{{ $sem5_ips ?? old('sem5_ips') }}" required />
                                                            @error('sem5_ips')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">Bahasa Indonesia</label>
                                                            <input type="number" class="form-control form-control-solid" placeholder="Nilai Bahasa Indonesia" name="sem5_indonesia" value="{{ $sem5_indonesia ?? old('sem5_indonesia') }}" required />
                                                            @error('sem5_indonesia')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">Bahasa Inggris</label>
                                                            <input type="number" class="form-control form-control-solid" placeholder="Nilai Bahasa Inggris" name="sem5_inggris" value="{{ $sem5_inggris ?? old('sem5_inggris') }}" required />
                                                            @error('sem5_inggris')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">Matematika</label>
                                                            <input type="number" class="form-control form-control-solid" placeholder="Nilai Matematika" name="sem5_matematika" value="{{ $sem5_matematika ?? old('sem5_matematika') }}" required />
                                                            @error('sem5_matematika')
                                                                <small class="text-danger">*{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div id="sem5_type_smp">
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="required form-label">Pendidikan Agama</label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Pendidikan Agama" name="sem5_agama" value="{{ $sem5_agama ?? old('sem5_agama') }}"  />
                                                                @error('sem5_agama')
                                                                    <small class="text-danger">*{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div id="sem5_type_mts">
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="required form-label">Alquran Hadits</label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Alquran Hadits" name="sem5_qhadits" value="{{ $sem5_qhadits ?? old('sem5_qhadits') }}"  />
                                                                @error('sem5_qhadits')
                                                                    <small class="text-danger">*{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="required form-label">Akidah Akhlak</label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Akidah Akhlak" name="sem5_akidah" value="{{ $sem5_akidah ?? old('sem5_akidah') }}"  />
                                                                @error('sem5_akidah')
                                                                    <small class="text-danger">*{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="required form-label">Fiqih</label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai Fiqih" name="sem5_fiqih" value="{{ $sem5_fiqih ?? old('sem5_fiqih') }}"  />
                                                                @error('sem5_fiqih')
                                                                    <small class="text-danger">*{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleFormControlInput1" class="required form-label">Sejarah Kebudayaan Islam (SKI)</label>
                                                                <input type="number" class="form-control form-control-solid" placeholder="Nilai SKI" name="sem5_ski" value="{{ $sem5_ski ?? old('sem5_ski') }}"  />
                                                                @error('sem5_ski')
                                                                    <small class="text-danger">*{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="required form-label">File Rapor Semester 5</label>
                                                            <input type="file" class="form-control form-control-solid" name="sem5_file" accept=".pdf, .png, .jpg, .jpeg"/>
                                                            <small class="text-muted">File dengan format PDF, PNG, JPG, JPEG, maksimal 10MB</small><br>
                                                            <small class="text-gray700">File Sebelumnya : <a href="{{ asset('storage/' . $rapor->semester5_file) }}" target="_blank">{{ $rapor->semester5_file ?? "-" }}</a>
                                                                @if ($rapor->semester5_file)
                                                                    <span class="text-danger">(Kosongkan jika tidak ingin mengganti)</span>
                                                                @endif
                                                            </small>
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
                                                    <input type="file" class="form-control form-control-solid" name="screenshoot_nisn"
                                                    accept=".png,.jpg,.jpeg" />
                                                <small class="text-muted fw-semibold">Anda dapat mengambil screenshot NISN dari web
                                                    resmi Kemendikbud yaitu : <a href="https://nisn.data.kemdikbud.go.id"
                                                        target="_blank">https://nisn.data.kemdikbud.go.id/</a>
                                                    </small><br>
                                                    <small class="text-gray700">File Sebelumnya : <a href="{{ asset('storage/' . $user->screenshoot_nisn) }}" target="_blank">{{ $user->screenshoot_nisn ?? "-" }}</a>
                                                        @if ($user->screenshoot_nisn)
                                                            <span class="text-danger">(Kosongkan jika tidak ingin mengganti)</span>
                                                        @endif
                                                    </small>
                                                @error('screenshoot_nisn')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-10">
                                                <div id="kt_docs_repeater_basic">
                                                    <div class="form-group">
                                                        <div data-repeater-list="certificates">
                                                            @foreach ($certificates as $certificate)

                                                            <div data-repeater-item>
                                                                <input type="hidden" name="certificate_id" value="{{ $certificate->id ?? '' }}" id="certificate_id">
                                                                <div class="form-group row mb-5">
                                                                    <div class="col-md-3">
                                                                        <label class="form-label ">File Sertifikat:</label>
                                                                        <input type="file" class="form-control mb-2 mb-md-0"
                                                                            name="certificate_file" placeholder="File Sertifikat" accept=".pdf,.png,.jpg,.jpeg" />

                                                                        <small class="text-muted">Berkas maksimal 10MB</small>

                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="form-label ">Nama Prestasi:</label>
                                                                        <input type="text" class="form-control mb-2 mb-md-0"
                                                                            name="certificate_name" value="{{ $certificate->name ?? old('certificate_name') }}"
                                                                            placeholder="Nama Prestasi (Akademik/Non-Akademik)" />
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label class="form-label ">Peringkat:</label>
                                                                        <select class="form-select form-select-solid"
                                                                            name="certificate_rank">
                                                                            <option value="Juara 1" @if ($certificate->rank == 'Juara 1') selected @endif>Peringkat 1</option>
                                                                            <option value="Peringkat 2" @if ($certificate->rank == 'Peringkat 2') selected @endif>Peringkat 2</option>
                                                                            <option value="Peringkat 3" @if ($certificate->rank == 'Peringkat 3') selected @endif>Peringkat 3</option>
                                                                            <option value="Peringkat Harapan 1" @if ($certificate->rank == 'Peringkat Harapan 1') selected @endif>Peringkat Harapan 1</option>
                                                                            <option value="Peringkat Harapan 2" @if ($certificate->rank == 'Peringkat Harapan 2') selected @endif>Peringkat Harapan 2</option>
                                                                            <option value="Peringkat Harapan 3" @if ($certificate->rank == 'Peringkat Harapan 3') selected @endif>Peringkat Harapan 3</option>
                                                                            <option value="Juara Lainnya" @if ($certificate->rank == 'Juara Lainnya') selected @endif>Juara Lainnya</option>
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
                                                                    <div id="certificate_file_info">
                                                                        <small class="text-gray700">File Sebelumnya : <a href="{{ asset('storage/' . $certificate->path) }}" target="_blank">{{ $certificate->path ?? "-" }}</a>
                                                                            @if ($certificate->path)
                                                                                <span class="text-danger">(Kosongkan jika tidak ingin mengganti)</span>
                                                                            @endif
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @endforeach
                                                        </div>
                                                        <input type="hidden" name="delete_certificate" id="delete_certificate" value="">
                                                    </div>
                                                    <div class="form-group mt-5">
                                                        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                                            <i class="ki-duotone ki-plus fs-3"></i>
                                                            Tambah
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
                                            {{-- <div class="mb-10">
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
                                                        value="{{ $additional_data_other }}"  />
                                                </div>

                                                @error('additional_data')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div> --}}
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
                        {{-- <div class="d-flex justify-content-end">
                            <span class="text-muted me-2">
                                *Data tidak dapat diubah.
                            </span>
                        </div> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Content-->
@endsection
@section('scripts')
<script src="{{ asset("back/plugins/custom/fslightbox/fslightbox.bundle.js") }}"></script>
<script src="{{ asset('back/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script>


        $('#kt_docs_repeater_basic').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function() {
                $(this).slideDown();
                // Sembunyikan informasi file sebelumnya di item yang baru
                $(this).find('#certificate_file_info').remove();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);

                // Ambil id sertifikat yang dihapus
                var certificate_id = $(this).find('#certificate_id').val();
                console.log(certificate_id);
                // Tambahkan id sertifikat yang dihapus ke inputan delete_certificate
                var delete_certificate = $('#delete_certificate').val();
                if (certificate_id != '') {
                    if (delete_certificate == '') {
                        $('#delete_certificate').val('[' + certificate_id + ']');
                    } else {
                        delete_certificate = delete_certificate.slice(0, -1) + ',' + certificate_id + ']';
                        $('#delete_certificate').val(delete_certificate);
                    }
                }
                console.log($('#delete_certificate').val());

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

@endsection
