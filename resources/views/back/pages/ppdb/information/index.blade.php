@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card card-flush">
                <div class="card-header">
                    <h3 class="card-title">Setting PPDB</h3>
                </div>

                <form action="{{ route('back.ppdb.information-setting.register.update') }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card-body py-4">
                        <div class="mb-10">
                            <div class="d-flex flex-stack w-lg-50">
                                <div class="me-5">
                                    <label class="fs-6 fw-semibold form-label">Pengaturan Registrasi PPDB?</label>
                                    <div class="fs-7 fw-semibold text-muted">
                                        Atur status pendaftaran PPDB, jika diaktifkan maka calon peserta didik dapat
                                        mendaftarkan akunnya.
                                    </div>
                                </div>
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1"
                                        name="registration_status"
                                        {{ $information->registration_status ?? '' == 1 ? 'checked' : '' }} />
                                    <span class="form-check-label fw-semibold text-muted">
                                        Status Registrasi
                                    </span>
                                </label>


                            </div>
                        </div>

                        <div class="mb-10">
                            <label class="form-label">Pesan jika registrasi non-aktif</label>
                            <textarea class="form-control form-control-solid" rows="3" name="registration_message">{{ $information->registration_message ?? '' }}</textarea>
                        </div>

                        <div class="mb-10">
                            <div class="d-flex flex-stack w-lg-50">
                                <div class="me-5">
                                    <label class="fs-6 fw-semibold form-label">Pengaturan Login PPDB?</label>
                                    <div class="fs-7 fw-semibold text-muted">
                                        Atur status login PPDB, jika diaktifkan maka calon peserta didik dapat login ke
                                        akunnya. Jika tidak diaktifkan maka calon peserta didik tidak dapat login ke akunnya.
                                    </div>
                                </div>
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1" name="login_status"
                                        {{ $information->login_status ?? '' == 1 ? 'checked' : '' }} />
                                    <span class="form-check
                                        label fw-semibold text-muted">Status Login</span>
                                </label>


                            </div>
                        </div>

                        <div class="mb-10">
                            <label class="form-label fs-6 fw-semibold">Pesan jika login non-aktif</label>
                            <textarea class="form-control form-control-solid" rows="3" name="login_message">{{ $information->login_message ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <div class="card mt-5">
                <div class="card-header">
                    <h3 class="card-title">Informasi PPDB</h3>
                </div>
                <form action="{{ route('back.ppdb.information-setting.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body py-4">
                        <div class="mb-10">
                            <div id="kt_docs_quill_basic" name="kt_docs_quill_basic">
                                {!! $information->information ?? '' !!}
                            </div>
                        </div>
                        <input type="hidden" name="information" id="information">
                        <div class="mb-2">
                            <label class="form-label">No.Telp Admin</label>
                            <input type="text" class="form-control" name="phone_admin"
                                value="{{ $information->phone_admin ?? '' }}" />
                            <span class="form-text text-muted">Nomor telepon yang bisa dihubungi oleh calon peserta didik
                                jika ada pertanyaan seputar PPDB. No Telp diawali dengan Kode Negara contoh
                                <code>(+62)</code>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

            </div>
            <div class="card mt-5">
                <div class="card-header">
                    <h3 class="card-title">Informasi Pendaftaran Ulang</h3>
                </div>
                <form action="{{ route('back.ppdb.information-setting.another') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body py-4">
                        <div class="mb-10">
                            <div id="re_registration_information_quill" name="re_registration_information_quill">
                                {!! $information->re_registration_information ?? '' !!}
                            </div>
                        </div>
                        <input type="hidden" name="re_registration_information" id="re_registration_information">
                        <div class="mb-2">
                            <label class="form-label">File Surat Pernyataan</label>
                            <input type="file" class="form-control" name="statement_letter"
                                value="{{ $information->statement_letter ?? '' }}" />
                                <span class="form-text text-muted">Link: <a href="{{ url(Storage::url($information->statement_letter ?? '')) }}" target="_blank">{{ url(Storage::url($information->statement_letter ?? '')) }}</a></span><br>
                            <span class="form-text text-muted">File Surat Pernyataan yang harus diupload oleh calon peserta
                                didik saat melakukan pendaftaran ulang</span>

                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        var toolbar = [

            [{
                'font': []
            }, {
                'size': []
            }],
            ['bold', 'italic', 'underline', 'strike'],
            [{
                'color': []
            }, {
                'background': []
            }],
            [{
                'script': 'super'
            }, {
                'script': 'sub'
            }],
            [{
                'header': '1'
            }, {
                'header': '2'
            }, 'blockquote', 'code-block'],
            [{
                'list': 'ordered'
            }, {
                'list': 'bullet'
            }, {
                'indent': '-1'
            }, {
                'indent': '+1'
            }],
            [{
                'direction': 'rtl'
            }, {
                'align': []
            }],
            ['link', 'image', 'video'],
            ['clean']

        ]
        var quill = new Quill('#kt_docs_quill_basic', {
            modules: {
                toolbar: toolbar
            },
            placeholder: 'Type your text here...',
            theme: 'snow' // or 'bubble'
        });
        $('#information').val(quill.root.innerHTML);
        quill.on('text-change', function() {
            var html = quill.root.innerHTML;
            $('#information').val(html);
        });

        var re_registration_information_quill = new Quill('#re_registration_information_quill', {
            modules: {
                toolbar: toolbar
            },
            placeholder: 'Type your text here...',
            theme: 'snow' // or 'bubble'
        });
        $('#re_registration_information').val(re_registration_information_quill.root.innerHTML);
        re_registration_information_quill.on('text-change', function() {
            var html = re_registration_information_quill.root.innerHTML;
            $('#re_registration_information').val(html);
        });
    </script>
@endsection
