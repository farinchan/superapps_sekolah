@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            @include('back.pages.exam.detail-header')
            <div class="d-flex flex-wrap flex-stack my-5">
                <h3 class="fw-bold my-2">Soal Ujian
                    <span class="fs-6 text-gray-500 fw-semibold ms-1">
                        ( {{ $list_exam_question->count() }} soal )
                    </span>
                    <span class="fs-6 text-gray-500 fw-semibold ms-1">
                        ( Total Bobot : {{ $list_exam_question->sum('question_score') }} )
                    </span>
                </h3>
                @if ($exam->end_time > now())
                    <div class="d-flex my-2">
                        {{-- <div class="d-flex align-items-center position-relative me-4">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute translate-middle-y top-50 ms-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <form action="" method="get">

                            <input type="text"
                                class="form-control form-control-sm form-control-solid bg-body fw-semibold fs-7 w-150px ps-11"
                                placeholder="Cari" name="q" value="{{ request()->q }}" />
                        </form>
                    </div> --}}
                        <a href="#" class='btn btn-bg-light btn-active-color-danger btn-sm' data-bs-toggle="modal"
                            data-bs-target="#reset">
                            <i class="ki-duotone ki-file-deleted fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Reset Soal</a>
                        <a href="#" class='btn btn-bg-light btn-active-color-primary btn-sm' data-bs-toggle="modal"
                            data-bs-target="#import">
                            <i class="ki-duotone ki-file-down fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Import</a>
                        <a href="#" class='btn btn-primary btn-sm fw-bolder' class="btn btn-primary"
                            data-bs-toggle="modal" data-bs-target="#jenis_soal">
                            <i class="ki-duotone ki-plus fs-2"></i>
                            Tambah Soal</a>
                    </div>
                @endif
            </div>
            <div class="row g-6 g-xl-9">
                @foreach ($list_exam_question as $question)
                    <div class="col-md-6 col-xl-4">
                        <a href="
                        @if ($question->question_type == 'pilihan ganda') {{ route('back.exam.question.multiple-choice.edit', [$exam->id, $question->id]) }}
                        @elseif ($question->question_type == 'pilihan ganda kompleks')
                            {{ route('back.exam.question.multiple-choice-complex.edit', [$exam->id, $question->id]) }}
                        @elseif ($question->question_type == 'benar salah')
                            {{ route('back.exam.question.true-false.edit', [$exam->id, $question->id]) }}
                        @elseif ($question->question_type == 'menjodohkan')
                            {{-- {{ route("back.exam.question.matching.edit", [$exam->id, $question->id]) }} --}} @endif
                        "
                            class="card border-hover-primary">
                            {{-- <div class="card-header border-0 pt-5">
                                <div class="card-title m-0">
                                    @if ($question->question_type == 'pilihan ganda')
                                        <span class="badge badge-light-primary me-2">Pilihan Ganda</span>
                                    @elseif ($question->question_type == 'pilihan ganda kompleks')
                                        <span class="badge badge-light-warning me-2">Pilihan Ganda Kompleks</span>
                                    @elseif ($question->question_type == 'menjodohkan')
                                        <span class="badge badge-light-success me-2">Menjodohkan</span>
                                    @endif
                                </div>
                            </div> --}}
                            <div class="card-body p-9">
                                <div class="fs-3 fw-bold text-gray-900">
                                    No. {{ $loop->iteration }} - {{ $question->question_type }}
                                </div>

                                <p class="text-gray-500 fw-semibold fs-5 mt-1 mb-7">
                                    Soal: {{ Str::limit(strip_tags($question->question_text), 100) }}
                                </p>
                                <div class="fs-5 text-gray-900">
                                    Bobot: {{ $question->question_score }}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="jenis_soal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Pilih Jenis Soal</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('back.exam.question.multiple-choice.create', $exam->id) }}"
                                class="card hover-elevate-up shadow-sm parent-hover">
                                <div class="card-body d-flex align-items">
                                    <i class="ki-duotone ki-abstract-8 fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>

                                    <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
                                        Pilihan Ganda
                                    </span>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-12">
                            <a href="{{ route('back.exam.question.multiple-choice-complex.create', $exam->id) }}"
                                class="card hover-elevate-up shadow-sm parent-hover">
                                <div class="card-body d-flex align-items">
                                    <i class="ki-duotone ki-abstract-9 fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>

                                    <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
                                        Pilihan Ganda Kompleks
                                    </span>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-12">
                            <a href="{{ route('back.exam.question.true-false.create', $exam->id) }}"
                                class="card hover-elevate-up shadow-sm parent-hover">
                                <div class="card-body d-flex align-items">
                                    <i class="ki-duotone ki-abstract-5 fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>

                                    <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
                                        Benar Salah
                                    </span>
                                </div>
                            </a>
                        </div>
                        {{-- <div class="col-md-12">
                            <a href="{{ route('back.exam.question.matching-pair.create', $exam->id) }}"
                                class="card hover-elevate-up shadow-sm parent-hover">
                                <div class="card-body d-flex align-items">
                                    <i class="ki-duotone ki-abstract-28 fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>

                                    <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
                                        Menjodohkan
                                    </span>
                                </div>
                            </a>
                        </div> --}}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="import">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Import Soal</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>
                <form action="{{ route('back.exam.question.import', $exam->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf


                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="teacher" class="form-label required">Tipe Soal</label>
                            <select class="form-select" data-control="select2" data-placeholder="Select an option"
                                data-hide-search="true" data-dropdown-parent="#import" name="question_type" required>
                                <option value="pilihan ganda">Pilihan Ganda</option>
                                <option value="pilihan ganda kompleks">Pilihan Ganda Kompleks</option>
                                <option value="benar salah">Benar Salah</option>
                                {{-- <option value="menjodohkan">Menjodohkan</option> --}}
                            </select>
                            <small class="text-muted">pastikan tipe soal yang dipilih sesuai dengan file yang akan diimport
                                dan
                                sudah
                                sesuai dengan format yang telah ditentukan</small><br>
                            <small class="text-muted">Format file pilihan ganda: <a
                                    href="{{ asset('exam/pdf/multiple_choice.xlsx') }}"
                                    download>Download</a></small><br>
                            <small class="text-muted">Format file pilihan ganda kompleks: <a
                                    href="{{ asset('exam/pdf/multiple_choice_complex.xlsx') }}"
                                    download>Download</a></small><br>
                            <small class="text-muted">Format file benar salah: <a
                                    href="{{ asset('exam/pdf/true_false.xlsx') }}"
                                    download>Download</a></small><br>
                            <small class="text-muted text-danger">Format file menjodohkan: <a
                                    href="#"
                                    download>Download</a></small>
                        </div>

                        <div class="mb-3">
                            <label for="teacher" class="form-label required">Soal</label>
                            <input type="file" class="form-control" name="file" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="reset">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Reset Soal</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>
                <form action="{{ route('back.exam.question.reset', $exam->id) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <p>Apakah anda yakin akan mereset semua soal pada ujian ini?</p>
                            <p class="text-danger"><strong>Perhatian</strong> : Setelah direset, semua soal yang telah
                                diinputkan akan
                                dihapus
                                dan tidak dapat dikembalikan lagi.</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
