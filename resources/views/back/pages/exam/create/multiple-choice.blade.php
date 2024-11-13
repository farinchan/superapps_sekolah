@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Buat Soal - PIlihan Ganda</h3>
                </div>
                <form action="{{ route("back.exam.question.multiple-choice.store", $exam_id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-5">
                            <label for="name" class=" form-label">Gambar Soal</label>
                            <input type="file" class="form-control" id="question_image" name="question_image"
                                accept="image/*">
                            <small class="text-muted mt-2">Maksimal 4MB, format gambar .jpg, .jpeg, .png</small>
                        </div>
                        <div class="mb">
                            <label for="name" class=" form-label required"> Soal</label>
                            <div id="question_text_quill" style="height: 200px;">
                                <p></p>
                            </div>
                            <input type="hidden" name="question_text" id="question_text">
                        </div>
                        <div class="mb">
                            <label for="name" class=" form-label required"> Bobot</label>
                            <input type="number" class="form-control" id="question_score" name="question_score" value="1" required>
                        </div>
                        <div class="separator my-10"></div>

                        <div>
                            <label for="name" class=" form-label">Pilihan ganda</label>

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
                                                    <label class="form-label required">Text:</label>
                                                    <textarea class="form-control mb-2 mb-md-0" rows="1" name="choice_text" placeholder="text"></textarea>
                                                </div>
                                                <div class="col-md-2">
                                                    <div
                                                        class="form-check form-check-custom form-check-solid mt-2 mt-md-11">
                                                        <input class="form-check-input is_correct_radio" type="radio" name="is_correct" value="0" required />
                                                        <label class="form-check-label" for="form_radio">
                                                            Jawaban Benar
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
        $('#question_text').val(quill.root.innerHTML);
        quill.on('text-change', function() {
            $('#question_text').val(quill.root.innerHTML);
        });
    </script>
    <script>
        $('#kt_docs_repeater_basic').repeater({
            initEmpty: false,

            defaultValues: {
                'choice_text': 'text',
            },

            show: function() {
                $(this).slideDown();
                updateRadioValues();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });

        function updateRadioValues() {
            var questionName = 'is_correct'; // All radio buttons will have this name

            $('#kt_docs_repeater_basic').find('[data-repeater-item]').each(function(index, item) {
                $(item).find('input[type="radio"]').attr('name', questionName).val(index);
            });
        }

        updateRadioValues();
    </script>
@endsection
