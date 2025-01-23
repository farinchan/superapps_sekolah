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
                                                    value="{{ $user->rapor_semester_1 }}" required readonly/>
                                                @error('rapor_semester_1')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="mb-10">
                                                <label for="exampleFormControlInput1" class="required form-label">Nilai Rapor Semester
                                                    2</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="Nilai Rapor Semester 2" name="rapor_semester_2"
                                                    value="{{ $user->rapor_semester_2 }}" required readonly/>
                                                @error('rapor_semester_2')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-10">
                                                <label for="exampleFormControlInput1" class="required form-label">Nilai Rapor Semester
                                                    3</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="Nilai Rapor Semester 3" name="rapor_semester_3"
                                                    value="{{ $user->rapor_semester_3 }}" required readonly/>
                                                @error('rapor_semester_3')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-10">
                                                <label for="exampleFormControlInput1" class="required form-label">Nilai Rapor Semester
                                                    4</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="Nilai Rapor Semester 4" name="rapor_semester_4"
                                                    value="{{ $user->rapor_semester_4 }}" required readonly/>
                                                @error('rapor_semester_4')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-10">
                                                <label for="exampleFormControlInput1" class="required form-label">Nilai Rapor Semester
                                                    5</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    placeholder="Nilai Rapor Semester 5" name="rapor_semester_5"
                                                    value="{{ $user->rapor_semester_5 }}" required readonly/>
                                                @error('rapor_semester_5')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-10">
                                                <label for="exampleFormControlInput1" class="required form-label">Screenshot NISN dari
                                                    Web Kemendikbud</label>
                                                {{-- <input type="file" class="form-control form-control-solid" name="screenshoot_nisn"
                                                    accept=".png,.jpg,.jpeg" required readonly/>
                                                <small class="text-muted fw-semibold">Anda dapat mengambil screenshot NISN dari web
                                                    resmi Kemendikbud yaitu : <a href="https://nisn.data.kemdikbud.go.id" target="_blank">https://nisn.data.kemdikbud.go.id/</a></small> --}}
                                                    <img src="{{ asset('storage/' . $user->screenshoot_nisn) }}" alt="screenshoot_nisn" class="img-fluid">
                                                @error('screenshoot_nisn')
                                                    <small class="text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-10">
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
                                            <div class="mb-10">
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

                    </div>
                    <div class="card-footer">
                        {{-- <div class="d-flex justify-content-end">
                            <a href="{{ route('ppdb.dashboard') }}"
                                class="btn btn-light btn-active-light-primary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div> --}}
                        <div class="d-flex justify-content-end">
                            <span class="text-muted me-2">
                                *Data tidak dapat diubah.
                            </span>
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
