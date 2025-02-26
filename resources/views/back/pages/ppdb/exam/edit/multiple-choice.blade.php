@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update Soal - Pilihan Ganda</h3>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-light-danger" data-bs-toggle="modal"
                            data-bs-target="#delete_question">
                            <i class="ki-duotone ki-trash fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </button>
                        <div class="modal fade" tabindex="-1" id="delete_question">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Hapus Soal</h3>

                                        <!--begin::Close-->
                                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                            data-bs-dismiss="modal" aria-label="Close">
                                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                                    class="path2"></span></i>
                                        </div>
                                        <!--end::Close-->
                                    </div>
                                    <form action="{{ route('back.ppdb.exam.question.destroy', $question->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <div class="modal-body">
                                            <p>Apakah anda yakin akan menghapus soal ini?</p>
                                            <p class="text-danger"><strong>Perhatian</strong> : Seluruh data yang terkait
                                                dengan
                                                soal ini akan dihapus dan tidak dapat dikembalikan.
                                            </p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">batal</button>
                                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('back.ppdb.exam.question.multiple-choice.update', [$exam_id, $question->id]) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Untuk mengarahkan ke method update -->

                    <div class="card-body">
                        <div class="mb-5">
                            <label for="name" class=" form-label">Gambar Soal</label>
                            <input type="file" class="form-control" id="question_image" name="question_image"
                                accept="image/*">
                            <small class="text-muted mt-2">Maksimal 4MB, format gambar .jpg, .jpeg, .png</small>
                            @if ($question->question_image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $question->question_image) }}" alt="Gambar Soal"
                                        style="max-height: 150px;">
                                </div>
                            @endif
                        </div>
                        <div class="mb">
                            <label for="name" class="form-label"> Soal</label>
                            <div id="question_text_quill" style="height: 200px;">
                                {!! $question->question_text !!}
                            </div>
                            <input type="hidden" name="question_text" id="question_text"
                                value="{{ $question->question_text }}">
                        </div>
                        <div class="mb">
                            <label for="name" class=" form-label required"> Bobot</label>
                            <input type="number" class="form-control" id="question_score" name="question_score"
                                value="{{ $question->question_score }}" required>
                        </div>
                        <div class="separator my-10"></div>

                        <div>
                            <label for="name" class="form-label">Pilihan Ganda</label>

                            <!--begin::Repeater-->
                            <div id="kt_docs_repeater_basic">
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <div data-repeater-list="choices">
                                        @foreach ($question->multipleChoice as $index => $choice)
                                            <div data-repeater-item>
                                                <input type="hidden" name="choices[{{ $index }}][id]"
                                                    value="{{ $choice->id }}">
                                                <input type="hidden" name="choices[{{ $index }}][is_deleted]"
                                                    value="0" class="is_deleted">
                                                <div class="form-group row mb-10">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Gambar:</label>
                                                        <input type="file" class="form-control mb-2 mb-md-0"
                                                            name="choices[{{ isset($choice) ? $loop->index : 'new' }}][choice_image]"
                                                            accept="image/*" />

                                                        {{-- Hanya tampilkan gambar jika pilihan sudah ada dan punya gambar --}}
                                                        @if (isset($choice) && $choice->choice_image)
                                                            <div class="mt-2">
                                                                <label class="form-label">Gambar saat ini:</label><br>
                                                                <img src="{{ asset('storage/' . $choice->choice_image) }}"
                                                                    alt="Gambar Pilihan" style="max-height: 100px;">
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label class="form-label ">Text:</label>
                                                        <textarea class="form-control mb-2 mb-md-0 choice-text-editor" rows="1" name="choices[{{ $index }}][choice_text]"
                                                            placeholder="text">{{ $choice->choice_text }}</textarea>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div
                                                            class="form-check form-check-custom form-check-solid mt-2 mt-md-11">
                                                            <input class="form-check-input" type="radio"
                                                                name="is_correct" value="{{ $index }}"
                                                                id="form_radio_{{ $index }}"
                                                                {{ $choice->is_correct ? 'checked' : '' }} required>
                                                            <label class="form-check-label"
                                                                for="form_radio_{{ $index }}">Jawaban Benar</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <a href="javascript:;" data-repeater-delete
                                                            class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                            <i class="ki-duotone ki-trash fs-5"><span
                                                                    class="path1"></span><span
                                                                    class="path2"></span><span
                                                                    class="path3"></span><span
                                                                    class="path4"></span><span class="path5"></span></i>
                                                            Hapus
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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
                        <a href="{{ route('back.ppdb.exam.question', $exam_id) }}" class="btn btn-light">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('back/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script src="{{ asset('back/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>


    <script>
        var quill = new Quill('#question_text_quill', {
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            },
            placeholder: 'Type your text here...',
            theme: 'snow' // or 'bubble'
        });
        quill.on('text-change', function() {
            $('#question_text').val(quill.root.innerHTML);
        });
    </script>

    <script>
        function initCKEditor() {
        document.querySelectorAll('.choice-text-editor').forEach(textarea => {
            if (!textarea.classList.contains('ckeditor-initialized')) {
                ClassicEditor.create(textarea, {
                    toolbar: ['bold', 'italic'], // Toolbar hanya Bold dan Italic
                })
                .then(editor => {
                    textarea.classList.add('ckeditor-initialized'); // Tandai sudah diinisialisasi
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
                'choice_text': '',
            },

            show: function() {
                $(this).slideDown();
                updateRadioValues();
                initCKEditor();
            },

            hide: function(deleteElement) {
                // Tandai item yang dihapus dengan mengubah nilai input hidden 'is_deleted'
                $(this).find('.is_deleted').val('1');

                $(this).slideUp(deleteElement, function() {
                    // Tetap perbarui radio button setelah item dihapus
                    updateRadioValues();
                });
            }
        });

        // Function to update the name attribute of radio buttons
        function updateRadioValues() {
            var questionName = 'is_correct'; // Nama yang sama untuk semua radio button

            $('#kt_docs_repeater_basic').find('[data-repeater-item]').each(function(index, item) {
                $(item).find('input[type="radio"]').attr('name',
                    questionName); // Tetapkan nama yang sama ke semua radio
            });
        }

        // Panggil saat awal untuk memastikan name radio terupdate
        updateRadioValues();
        initCKEditor();
    </script>
@endsection
