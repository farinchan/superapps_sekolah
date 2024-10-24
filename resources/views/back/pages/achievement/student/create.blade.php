@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <form id="kt_ecommerce_add_category_form" class="form d-flex flex-column flex-lg-row" action="{{ route("back.event.store") }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Gambar</h2>
                            </div>
                        </div>
                        <div class="card-body text-center pt-0">
                            <style>
                                .image-input-placeholder {
                                    background-image: url('{{ asset('back/media/svg/files/blank-image.svg') }}');
                                }

                                [data-bs-theme="dark"] .image-input-placeholder {
                                    background-image: url('{{ asset('back/media/svg/files/blank-image-dark.svg') }}');
                                }
                            </style>
                            <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                                data-kt-image-input="true">
                                <div class="image-input-wrapper w-150px h-150px"></div>
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Ubah Thumbnail">
                                    <i class="ki-duotone ki-pencil fs-7">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                </label>
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Batalkan Thumbnail">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus Thumbnail">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                            </div>
                            <div class="text-muted fs-7">
                                Set Gambar Prestasi, Hanya menerima file dengan ekstensi png, jpg, jpeg
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>prestasi</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="mb-10 fv-row">
                                <label class="required form-label">Nama Perlombaan</label>
                                <input type="text" name="name" class="form-control form-control-solid mb-2" value="{{ old("name") }}" required />
                                @error('name')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-10">
                                <label class="form-label required">Event</label>
                                <input type="text" name="event" class="form-control form-control-solid mb-2" value="{{ old("event") }}" required />
                                @error('event')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-10">
                                <label class="form-label required">Tingkat</label>
                                <select name="level" class="form-select form-select-solid mb-2" required>
                                    <option value="">Pilih Tingkat</option>
                                    <option value="1" {{ old("level") == "Sekolah" ? "selected" : "" }}>Sekolah</option>
                                    <option value="2" {{ old("level") == "Kabupaten" ? "selected" : "" }}>Kabupaten</option>
                                    <option value="3" {{ old("level") == "Provinsi" ? "selected" : "" }}>Provinsi</option>
                                    <option value="4" {{ old("level") == "Nasional" ? "selected" : "" }}>Nasional</option>
                                    <option value="5" {{ old("level") == "Internasional" ? "selected" : "" }}>Internasional</option>
                                </select>
                                @error('level')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-10">
                                <label class="form-label required">Peringkat</label>
                                <select name="rank" class="form-select form-select-solid mb-2" required>
                                    <option value="">Pilih Peringkat</option>
                                    <option value="1" {{ old("rank") == "Juara 1" ? "selected" : "" }}>Juara 1</option>
                                    <option value="2" {{ old("rank") == "Juara 2" ? "selected" : "" }}>Juara 2</option>
                                    <option value="3" {{ old("rank") == "Juara 3" ? "selected" : "" }}>Juara 3</option>
                                    <option value="4" {{ old("rank") == "Juara Harapan 1" ? "selected" : "" }}>Juara Harapan 1</option>
                                    <option value="5" {{ old("rank") == "Juara Harapan 2" ? "selected" : "" }}>Juara Harapan 2</option>
                                    <option value="6" {{ old("rank") == "Juara Harapan 3" ? "selected" : "" }}>Juara Harapan 3</option>
                                    <option value="7" {{ old("rank") == "Juara Lainnya" ? "selected" : "" }}>Juara Lainnya</option>
                                </select>
                                @error('rank')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-10">
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label required">Tanggal Mulai</label>
                                        <input type="datetime-local" name="start" class="form-control mb-2"
                                            value="{{ old("start") }}" required />
                                        @error('start')
                                            <div class="text-danger fs-7">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label class="form-label required">Tanggal Selesai</label>
                                        <input type="datetime-local" name="end" class="form-control mb-2"
                                            value="{{ old("end") }}" required />
                                        @error('end')
                                            <div class="text-danger fs-7">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="form-label">Meta Tag Keywords</label>
                                <input id="keyword_tagify" name="meta_keywords"
                                    class="form-control mb-2" value="{{ old("meta_keywords") }}" />
                                @error('meta_keywords')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                                <div class="text-muted fs-7">
                                    Meta Tag Keywords digunakan untuk SEO, pisahkan dengan koma <code>,</code> jika lebih
                                    dari satu keywoard yang digunakan
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('back.event.index') }}" id="kt_ecommerce_add_product_cancel"
                            class="btn btn-light me-5">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Simpan Perubahan</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var quill = new Quill('#quill_content', {
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'], // toggled buttons
                    ['blockquote', 'code-block'],
                    ['link', 'image', 'video', 'formula'],

                    [{
                        header: [1, 2, 3, 4, 5, 6, false]
                    }], // custom button values
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }, {
                        'list': 'check'
                    }],
                    [{
                        'script': 'sub'
                    }, {
                        'script': 'super'
                    }], // superscript/subscript
                    [{
                        'indent': '-1'
                    }, {
                        'indent': '+1'
                    }], // outdent/indent
                    [{
                        'direction': 'rtl'
                    }], // text direction

                    [{
                        'color': []
                    }, {
                        'background': []
                    }], // dropdown with defaults from theme
                    [{
                        'font': []
                    }],
                    [{
                        'align': []
                    }],
                    ['clean'] // remove formatting button
                ]
            },
            placeholder: 'Tulis prestasi disini...',
            theme: 'snow' // or 'bubble'
        });

        $("#content").val(quill.root.innerHTML);
        quill.on('text-change', function() {
            $("#content").val(quill.root.innerHTML);
        });

        var tagify = new Tagify(document.querySelector("#keyword_tagify"), {
            whitelist: [],
            dropdown: {
                maxItems: 20, // <- mixumum allowed rendered suggestions
                classname: "tags-look",
                enabled: 0,
                closeOnSelect: true
            }
        });
    </script>
@endsection
