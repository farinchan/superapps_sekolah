@extends('ppdb.app-back')
@section('styles')
@endsection
@section('content')
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div class="">
            <div class="card">
                <form method="post" action="{{ route('ppdb.re-registration.update', $registration_id) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body p-lg-17">

                        <div class="d-flex flex-column flex-lg-row ">
                            <div class="flex-lg-row-fluid me-0 me-lg-20">
                                <div class="m-0 ">
                                    <div class="mb-10">
                                        <h4 class="fs-1 text-gray-800 w-bolder mb-6">
                                            Data Tambahan
                                        </h4>
                                        <p class="fw-semibold fs-4 text-gray-600 mb-2">
                                            Silahkan lengkapi data tambahan ini sesuai dengan data diri anda.
                                        </p>
                                    </div>
                                    <div class="m-0">
                                        <div class="mb-10">
                                            <label for="exampleFormControlInput1" class="required form-label">Jenis Kelamin</label>
                                            <select class="form-select form-select-solid" name="jenis_kelamin" required>
                                                <option value="Laki-laki" {{ old('jenis_kelamin', $re_registration?->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="Perempuan" {{ old('jenis_kelamin', $re_registration?->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-10">
                                            <label for="exampleFormControlInput1" class="form-label required">Penghasilan Orang Tua</label>
                                            <div class="">
                                                <div class="row">
                                                    @php
                                                        $parent_income_options = [
                                                            'Kurang dari 500.000',
                                                            '500.000 - 1.000.000',
                                                            '1.000.000-2.000.000',
                                                            '2.000.000-3.000.000',
                                                            'Lebih Dari 5.000.000',
                                                            'Tidak ada'
                                                        ];
                                                    @endphp
                                                    @foreach ($parent_income_options as $option)
                                                        <div class="col-md-4 mb-3">
                                                            <div class="form-check form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="radio" name="parent_income" id="income{{ $loop->index }}" value="{{ $option }}" {{ old('parent_income', $re_registration?->parent_income) == $option ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="income{{ $loop->index }}">{{ $option }}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @error('parent_income')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-10">
                                            <label for="exampleFormControlInput1" class="form-label required">Surat Pernyataan</label>
                                            <input type="file" class="form-control form-control-solid" name="statement_letter"/>

                                            @if($re_registration?->statement_letter)
                                                <span class="text-muted">File saat ini: <a href="{{ asset('storage/' . $re_registration?->statement_letter) }}" target="_blank">Lihat Disini</a>, Kosongkan jika ingin mengganti file</span><br>
                                            @endif
                                            <small class="text-muted">Surat penyataan bisa anda donwload <a href="{{ Storage::url($information->statement_letter) }}" target="_blank">disini</a>, File harus berformat pdf. Maksimal ukuran 4MB</small>
                                            @error('statement_letter')
                                            <br>
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-10">
                                            <label for="exampleFormControlInput1" class="form-label required">File Kartu Keluarga (KK)</label>
                                            <input type="file" class="form-control form-control-solid" name="file_kk"/>

                                            @if($re_registration?->file_kk)
                                                <span class="text-muted">File saat ini: <a href="{{ asset('storage/' . $re_registration?->file_kk) }}" target="_blank">Lihat Disini</a>, Kosongkan jika ingin mengganti file</span><br>
                                            @endif
                                            <small class="text-muted">File harus berformat pdf. Maksimal ukuran 4MB</small>
                                            @error('file_kk')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-10">
                                            <label for="exampleFormControlInput1" class="form-label">File Kartu Indonesia Pintar (KIP)</label>
                                            <input type="file" class="form-control form-control-solid" name="file_kip" />
                                            @if($re_registration?->file_kip)
                                                <span class="text-muted">File saat ini: <a href="{{ asset('storage/' . $re_registration?->file_kip) }}" target="_blank">Lihat</a></span><br>
                                            @endif
                                            <small class="text-muted">File harus berformat pdf. Maksimal ukuran 4MB</small>
                                            @error('file_kip')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-10">
                                            <label for="exampleFormControlInput1" class="form-label">File Program Keluarga Harapan (PKH)</label>
                                            <input type="file" class="form-control form-control-solid" name="file_pkh" />
                                            @if($re_registration?->file_pkh)
                                                <span class="text-muted">File saat ini: <a href="{{ asset('storage/' . $re_registration?->file_pkh) }}" target="_blank">Lihat</a>, Kosongkan jika ingin mengganti file</span><br>
                                            @endif
                                            <small class="text-muted">File harus berformat pdf. Maksimal ukuran 4MB</small>
                                            @error('file_pkh')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-10">
                                            <label for="exampleFormControlInput1" class="form-label">File Data Terpadu Kesejahteraan Sosial (DTKS)</label>
                                            <input type="file" class="form-control form-control-solid" name="file_dtks" />
                                            @if($re_registration?->file_dtks)
                                                <span class="text-muted">File saat ini: <a href="{{ asset('storage/' . $re_registration?->file_dtks) }}" target="_blank">Lihat</a>, Kosongkan jika ingin mengganti file</span><br>
                                            @endif
                                            <small class="text-muted">File harus berformat pdf. Maksimal ukuran 4MB</small>
                                            @error('file_dtks')
                                                <small class="text-danger">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-10">
                                            <label for="exampleFormControlInput1" class="form-label">File Kartu Keluarga Sejahtera (KKS)</label>
                                            <input type="file" class="form-control form-control-solid" name="file_kks" />
                                            @if($re_registration?->file_kks)
                                                <span class="text-muted">File saat ini: <a href="{{ asset('storage/' . $re_registration?->file_kks) }}" target="_blank">Lihat</a>, Kosongkan jika ingin mengganti file</span><br>
                                            @endif
                                            <small class="text-muted">File harus berformat pdf. Maksimal ukuran 4MB</small>
                                            @error('file_kks')
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
                            <button type="submit" class="btn btn-primary">Simpan</button>
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
