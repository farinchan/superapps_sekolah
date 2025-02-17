@extends('back.app')

@section('styles')
    <!-- KaTeX -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.16.7/katex.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.16.7/katex.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.16.7/contrib/auto-render.min.js"></script>
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Buat Soal - Benar/Salah</h3>
                </div>
                <form action="{{ route('back.exam.question.true-false.store', $exam_id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-5">
                            <label for="name" class=" form-label">Gambar Soal</label>
                            <input type="file" class="form-control" id="question_image" name="question_image"
                                accept="image/*">
                            <small class="text-muted mt-2">Maksimal 4MB, format gambar .jpg, .jpeg, .png</small>
                        </div>
                        <div class="mb-3">
                            <label for="name" class=" form-label"> Soal</label>
                            <div id="question_text_quill" style="height: 200px;">
                                <p></p>
                            </div>
                            <input type="hidden" name="question_text" id="question_text">
                        </div>
                        <div class="mb-3">
                            <label for="name" class=" form-label required"> Bobot</label>
                            <input type="number" class="form-control" id="question_score" name="question_score"
                                value="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class=" form-label required"> Opsi Penilaian</label>
                            <select class="form-select" name="true_false_option" required>
                                <option value="fixed">Jawaban harus benar semua baru dianggap benar</option>
                                <option value="calculated">Presentase sesuai jawaban yang benar</option>
                            </select>
                        </div>
                        <div class="separator my-10"></div>

                        <div>
                            <label for="name" class=" form-label">Pernyataan Benar/Salah</label>

                            <!--begin::Repeater-->
                            <div id="kt_docs_repeater_basic">
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <div data-repeater-list="choices">
                                        <div data-repeater-item>
                                            <div class="form-group row mb-5">
                                                <div class="col-md-3">
                                                    <label class="form-label">Gambar:</label>
                                                    <input type="file" class="form-control mb-2 mb-md-0"
                                                        name="choice_image" accept="image/*" />
                                                </div>
                                                <div class="col-md-5">
                                                    <label class="form-label">Text:</label>
                                                    <textarea class="form-control mb-2 mb-md-0 choice-text-editor" rows="2" name="choice_text" placeholder="text"></textarea>
                                                </div>
                                                <div class="col-md-2">
                                                    <div
                                                        class="form-check form-check-custom form-check-solid mt-2 mt-md-11">
                                                        <input class="form-check-input is_correct_radio" type="radio"
                                                            name="true_false_answer" value="1" required />
                                                        <label class="form-check-label" for="form_radio">
                                                            Benar
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="form-check form-check-custom form-check-solid mt-2 mt-md-11">
                                                        <input class="form-check-input is_correct_radio" type="radio"
                                                            name="true_false_answer" value="0" required />
                                                        <label class="form-check-label" for="form_radio">
                                                            Salah
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <a href="javascript:;" data-repeater-delete
                                                        class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                        <i class="ki-duotone ki-trash fs-5"><span
                                                                class="path1"></span><span class="path2"></span><span
                                                                class="path3"></span><span class="path4"></span><span
                                                                class="path5"></span></i>
                                                        Hapus
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Form group-->

                                <!--begin::Form group-->
                                <div class="form-group mt-5">
                                    <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                        <i class="ki-duotone ki-plus fs-3"></i>
                                        Tambah Pilihan
                                    </a>
                                </div>
                                <!--end::Form group-->
                            </div>
                            <!--end::Repeater-->
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('back.exam.question', $exam_id) }}" class="btn btn-light">Batal</a>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('back/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script src="{{ asset('back/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@wiris/mathtype-ckeditor5/build/mathtype.min.js"></script>


    <script>
        var quill = new Quill('#question_text_quill', {
            modules: {
                formula: true,
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline', 'formula'],

                    [{
                        'script': 'sub'
                    }, {
                        'script': 'super'
                    }],
                    [{
                        list: 'ordered'
                    }, {
                        list: 'bullet'
                    }],
                    ['image'],
                    ['clean']
                ]
            },
            placeholder: 'Type your text here...',
            theme: 'snow' // or 'bubble'
        });

        $('#question_text').val(quill.root.innerHTML);
        quill.on('text-change', function() {
            $('#question_text').val(quill.root.innerHTML);
        });
    </script>
    <script>
        function initCKEditor() {
            document.querySelectorAll('.choice-text-editor').forEach(textarea => {
                if (!textarea.classList.contains('ckeditor-initialized')) {
                    ClassicEditor.create(textarea, {
                            toolbar: {
                                items: [
                                    'bold',
                                    'italic',
                                    'underline',
                                    'subscript', // Tambahkan tombol Subscript
                                    'superscript', // Tambahkan tombol Superscript
                                ]
                            },
                            plugins: [
                                'Essentials',
                                'Paragraph',
                                'Bold',
                                'Italic',
                                // 'Underline',
                                // 'Subscript', // Tambahkan plugin Subscript
                                // 'Superscript', // Tambahkan plugin Superscript
                            ]
                        })
                        .then(editor => {
                            textarea.classList.add(
                                'ckeditor-initialized'); // Tandai sebagai sudah diinisialisasi
                            editor.ui.view.editable.element.style.minHeight = '80px';
                        })
                        .catch(error => {
                            console.error(error);
                        });
                }
            });
        }
        $('#kt_docs_repeater_basic').repeater({
            initEmpty: false,

            defaultValues: {
                'choice_text': 'text',
            },

            show: function() {
                $(this).slideDown();
                initCKEditor();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });


        initCKEditor();
    </script>
@endsection
