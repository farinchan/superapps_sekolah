@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card card-flush">
                <div class="card-header">
                    <h3 class="card-title">Setting Register PPDB</h3>
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
                        <div id="kt_docs_quill_basic" name="kt_docs_quill_basic">
                            {!! $information->information ?? '' !!}
                        </div>
                        <input type="hidden" name="information" id="information">
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
        var quill = new Quill('#kt_docs_quill_basic', {
            modules: {
                toolbar: [

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
            },
            placeholder: 'Type your text here...',
            theme: 'snow' // or 'bubble'
        });
        $('#information').val(quill.root.innerHTML);
        quill.on('text-change', function() {
            var html = quill.root.innerHTML;
            $('#information').val(html);
        });

    </script>
@endsection
