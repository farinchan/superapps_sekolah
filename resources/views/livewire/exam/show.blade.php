@push('styles')
    <style>
        .img-fluid {
            max-width: 100%;
            height: auto;
        }
    </style>
@endpush

@push('timer')
    <div class="app-navbar-item ms-1 ms-lg-5 text-end">
        <div class="d-flex align-items-center flex-column ">
            <div class="d-flex  fw-bolder fs-7 text-gray-800  mt-auto ">
                <span>Sisa Waktu Pengerjaan</span>
            </div>
            <div class="fw-semibold fs-5 text-danger mt-auto text-end">
                <span id="timer"> </span>
            </div>
        </div>
    </div>
@endpush

<div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
    @include('exam/layout/partials/_header')
    <!--begin::Wrapper-->
    <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
        <!--begin::Wrapper container-->
        <div class="app-container  container-xxl d-flex flex-row-fluid ">
            <!--begin::Sidebar-->
            <div id="kt_app_sidebar" class="app-sidebar flex-column " data-kt-drawer="true" data-button-nav="kt_nav"
                data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}"
                data-kt-drawer-overlay="true" data-kt-drawer-width="275px" data-kt-drawer-direction="start"
                data-kt-drawer-toggle="#kt_app_sidebar_toggle">
                <div class="app-sidebar-wrapper py-8 py-lg-10" id="kt_app_sidebar_wrapper">
                    <div id="kt_app_sidebar_nav_wrapper" class="d-flex flex-column px-8 px-lg-10 hover-scroll-y"
                        data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="{default: false, lg: '#kt_app_header'}"
                        data-kt-scroll-wrappers="#kt_app_sidebar, #kt_app_sidebar_wrapper"
                        data-kt-scroll-offset="{default: '10px', lg: '40px'}" style="max-height: 930px;">
                        @include('exam/layout/partials/sidebar/_goal')
                        <div class="mb-0">
                            <h3 class="text-gray-800 fw-bold mb-8">Soal</h3>
                            <div class="row g-5 justify-content-center mb-10">
                                @foreach ($exam_question_state as $state)
                                    @if ($state->id == $exam_question->id)
                                        <div class="col-4">
                                            <button wire:click.prevent="changeQuestion({{ $state->id }})"
                                                id="side_question_number"
                                                class="btn btn-icon btn-outline btn-light-primary btn-active-light-primary btn-flex flex-column flex-center w-65px h-65px border-gray-200"
                                                data-kt-button="true" data-kt-drawer-dismiss="true">
                                                <span class="mb-2" style="font-size: 1.8rem;"> {{ $loop->iteration }}
                                                </span>
                                            </button>
                                        </div>
                                    @else
                                        @if ($state->answer)
                                            <div class="col-4">
                                                <button wire:click.prevent="changeQuestion({{ $state->id }})"
                                                    id="side_question_number"
                                                    class="btn btn-icon btn-outline btn-light-success btn-active-light-primary btn-flex flex-column flex-center w-65px h-65px border-gray-200"
                                                    data-kt-button="true" data-kt-drawer-dismiss="true">
                                                    <span class="mb-2" style="font-size: 1.8rem;">
                                                        {{ $loop->iteration }}
                                                    </span>
                                                </button>
                                            </div>
                                        @else
                                            <div class="col-4">
                                                <button wire:click.prevent="changeQuestion({{ $state->id }})"
                                                    id="side_question_number"
                                                    class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-65px h-65px border-gray-200"
                                                    data-kt-button="true" data-kt-drawer-dismiss="true">
                                                    <span class="mb-2"
                                                        style="font-size: 1.8rem;">{{ $loop->iteration }}
                                                    </span>
                                                </button>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach


                            </div>
                            <button class="btn btn-light-success fs-5 w-100 py-4" data-bs-toggle="modal"
                                data-bs-target="#end_exam">
                                Selesaikan Ujian
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                <!--begin::Content wrapper-->
                <div class="d-flex flex-column flex-column-fluid">
                    <div id="kt_app_toolbar" class="app-toolbar  d-flex pb-3 pb-lg-5 ">
                        <div class="d-flex flex-stack flex-row-fluid">
                            <div class="d-flex flex-column flex-row-fluid">
                                <div class="page-title d-flex align-items-center me-3">
                                    <h1
                                        class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-lg-2x gap-2">
                                        <span><span class="fw-light">
                                                @if ($exam->type == 'UH')
                                                    Ujian Harian
                                                @elseif ($exam->type == 'UTS')
                                                    Ujian Tengah Semester
                                                @elseif ($exam->type == 'UAS')
                                                    Ujian Akhir Semester
                                                @endif
                                                -
                                            </span>&nbsp;{{ $exam->subject?->name }}</span>
                                        <span class="page-desc text-gray-600 fs-base fw-semibold">
                                            Selamat mengerjakan ujian dan semoga sukses!
                                        </span>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div id="kt_app_content" class="app-content  flex-column-fluid ">
                        <div class="card">
                            <div class="card-header card-header-stretch">
                                <!--begin::Title-->
                                <div class="card-title d-flex align-items-center">
                                    <i class="ki-duotone ki-calendar-8 fs-1 text-primary me-3 lh-0"><span
                                            class="path1"></span><span class="path2"></span><span
                                            class="path3"></span><span class="path4"></span><span
                                            class="path5"></span><span class="path6"></span>
                                    </i>
                                    Soal {{ $exam_question->question_type }}


                                </div>
                            </div>
                            <div class="card-body py-4">
                                @if ($exam_question->question_image != null)
                                    <img class="mb-5 img-fluid" src="{{ $exam_question->getImage() }}" alt="">
                                @endif
                                <p>

                                    {!! $exam_question->question_text !!}
                                </p>

                                <div class="separator my-10"></div>
                                <div class="mb-5">
                                    @if ($exam_question->question_type == 'pilihan ganda')
                                        @php
                                            $id_answer = $exam_answer?->answer['multiple_choice']['id'];
                                            $text_answer = $exam_answer?->answer['multiple_choice']['text'];
                                        @endphp
                                        @foreach ($exam_question->multipleChoice as $choice)
                                            <div class="d-flex fv-row">
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input me-3" type="radio"
                                                        wire:click="answerMultipleChoice({{ $choice->id }})"
                                                        name="{{ $exam_question->id }}" id="{{ $choice->id }}"
                                                        onload="@if ($id_answer != $choice->id) unchecked({{ $choice->id }}); @endif"
                                                        {{ $id_answer == $choice->id ? 'checked' : '' }}>
                                                    <label class="form-check-label">
                                                        @if ($choice->choice_image)
                                                            <img class="img-fluid" src="{{ $choice->getImage() }}"
                                                                alt="">
                                                        @endif
                                                        <div class=" text-gray-800">{!! $choice->choice_text !!}
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="separator separator-dashed my-5"></div>
                                        @endforeach
                                    @elseif ($exam_question->question_type == 'pilihan ganda kompleks')
                                        @foreach ($exam_question->multipleChoiceComplex as $choice)
                                            @php
                                                $answer = $exam_answer?->answer['multiple_choice_complex'];
                                                $answer_id = array_column($answer ?? [], 'id');
                                            @endphp
                                            {{-- @dd([
                                            $answer_id,
                                            $exam_question->multipleChoiceComplex
                                        ]) --}}
                                            <div class="d-flex fv-row">
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input me-3" type="checkbox"
                                                        id="{{ $choice->id }}"
                                                        wire:change="answerMultipleChoiceComplex({{ $choice->id }})"
                                                        onload="@if (!in_array($choice->id, $answer_id)) unchecked({{ $choice->id }}); @endif"
                                                        @if (in_array($choice->id, $answer_id)) checked @endif>
                                                    <label class="form-check-label">
                                                        @if ($choice->choice_image)
                                                            <img class="img-fluid" src="{{ $choice->getImage() }}"
                                                                alt="">
                                                        @endif
                                                        <div class="fw-bold text-gray-800">{{ $choice->choice_text }}
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="separator separator-dashed my-5"></div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            @php
                                $end_question = $exam_question_state->last();
                            @endphp
                            <div class="card-footer d-flex justify-content-end">
                                @if ($exam_question->id == $end_question->id)
                                    <button type="button" class="btn btn-light-success" data-bs-toggle="modal"
                                        data-bs-target="#end_exam">Selesaikan Ujian</button>
                                @else
                                    <button type="button" class="btn btn-light-primary"
                                        wire:click.prevent="nextQuestion">Selanjutnya</button>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <!--end::Content wrapper-->
                @include('exam/layout/partials/_footer')
            </div>
            <!--end:::Main-->
        </div>
        <!--end::Wrapper container-->
    </div>

    <div class="modal fade" tabindex="-1" id="end_exam">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Selesaikan Ujian?</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <p>
                        <strong>Perhatian!</strong> Apakah kamu yakin ingin menyelesaikan ujian ini?, setelah kamu
                        menyelesaikan ujian ini, kamu tidak bisa kembali lagi.
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" wire:click.prevent="endExam"
                        data-bs-dismiss="modal">Ya,
                        Selesai</button>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
    <script src="{{ asset('exam/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
    <script>
        $('#kt_app_sidebar_toggle').on('click', function(e) {
            console.log('clicked');
            $('[data-button-nav="kt_nav"]').addClass('drawer drawer-start');
        });
    </script>
    <script>
        function unchecked(id) {
            document.getElementById(id).checked = false;
        }
    </script>
    <script>
        var exam = @json($exam);
        var exam_session = @json($exam_session);

        console.log(exam);
        console.log(exam_session);

        // Durasi dalam menit diambil dari exam.durasi
        var durationInMinutes = exam.duration;

        // Waktu mulai diambil dari exam_session.start_time
        var startTime = new Date(exam_session.start_time).getTime();

        console.log(startTime);
        console.log(durationInMinutes);

        // Hitung waktu selesai berdasarkan startTime + durasi
        var countDownDate = new Date(startTime + durationInMinutes * 60 * 1000).getTime();

        var x = setInterval(function() {
            var now = new Date().getTime();

            var distance = countDownDate - now;

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("timer").innerHTML = days + "d " + hours + "h " +
                minutes + "m " + seconds + "s ";

            if (distance < 0) {
                clearInterval(x);
                document.getElementById("timer").innerHTML = "EXPIRED";

                alert('Waktu pengerjaan ujian telah habis', 'warning', 5000);
                @this.call('endExam');
            }
        }, 1000);
    </script>
@endpush
