@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="d-flex flex-column flex-lg-row">
                <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
                    <div class="card mb-5 mb-xl-8">
                        <div class="card-body">
                            <div class="d-flex flex-center flex-column py-5">
                                <div class="symbol symbol-100px symbol-circle mb-7">
                                    <img src="{{ $exam_session->Student?->getPhoto() }}" alt="image" />
                                </div>
                                <a href="#"
                                    class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $exam_session->Student->name }}</a>
                                <div class="text-center mb-9">
                                    <div class="">NISN. {{ $exam_session->Student?->nisn }}</div>
                                    <div class="">NIK. {{ $exam_session->Student?->nik }}</div>
                                </div>
                                {{-- <div class="fw-bold mb-3">Kelas: {{ $exam_session->Student->classroomStudent }}</div> --}}
                            </div>
                            <div class="d-flex flex-stack fs-4 py-3">
                                <div class="fw-bold rotate collapsible" data-bs-toggle="collapse"
                                    href="#kt_user_view_details" role="button" aria-expanded="false"
                                    aria-controls="kt_user_view_details">Details
                                    <span class="ms-2 rotate-180">
                                        <i class="ki-outline ki-down fs-3"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="separator"></div>
                            <div id="kt_user_view_details" class="collapse">
                                <div class="pb-5 fs-6">
                                    <div class="fw-bold mt-5">Kelas</div>
                                    <div class="text-gray-600">
                                        <ul>
                                            @foreach ($exam_session->Student?->classroomStudent as $classroom)
                                                <li>{{ $classroom->classroom?->name }} -
                                                    {{ $classroom->classroom?->schoolYear?->start_year }} /
                                                    {{ $classroom->classroom?->schoolYear?->end_year }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="fw-bold mt-5">Tempat, Tanggal Lahir</div>
                                    <div class="text-gray-600">{{ $exam_session->Student?->birth_place }},
                                        {{ $exam_session->Student?->birth_date }}</div>
                                    <div class="fw-bold mt-5">Jenis Kelamin</div>
                                    <div class="text-gray-600">{{ $exam_session->Student?->gender ?? '-' }}</div>
                                    <div class="fw-bold mt-5">Alamat</div>
                                    <div class="text-gray-600">{{ $exam_session->Student?->address ?? '-' }}</div>
                                    <div class="fw-bold mt-5">Email</div>
                                    <div class="text-gray-600">
                                        <a href="mailto:{{ $exam_session->Student?->email }}"
                                            class="text-gray-600 text-hover-primary">{{ $exam_session->Student?->email ?? '-' }}</a>
                                    </div>
                                    <div class="fw-bold mt-5">Nomor Telephone</div>
                                    <div class="text-gray-600">
                                        <a href="tel:{{ $exam_session->Student?->phone }}"
                                            class="text-gray-600 text-hover-primary">{{ $exam_session->Student?->no_telp ?? '-' }}</a>
                                    </div>
                                    <div class="fw-bold mt-5">Berkebutuhan Khusus</div>
                                    <div class="text-gray-600">
                                        @if ($exam_session->Student?->kebutuhan_khusus == 1)
                                            Ya
                                        @else
                                            Tidak
                                        @endif
                                    </div>
                                    <div class="fw-bold mt-5">Disabilitas</div>
                                    <div class="text-gray-600">
                                        @if ($exam_session->Student?->disabilitas == 1)
                                            Ya
                                        @else
                                            Tidak
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-5 mb-xl-8">
                        <div class="card-header border-0">
                            <div class="card-title">
                                <h3 class="fw-bold m-0">Nomor Soal Ujian</h3>
                            </div>
                        </div>
                        <div class="card-body pt-2 scroll h-600px ">

                            <div class="row g-5 justify-content-center mb-10">
                                @foreach ($exam_question_n_answer as $question)
                                    <div class="col-4">
                                        <a id="side_question_number"
                                            href="{{ route('back.exam.student.analysis', $exam_session->id) . '?question_id=' . $question->id }}"
                                            class="btn btn-icon btn-outline
                                            @if ($question->examAnswer->isEmpty()) btn-light-dark
                                            @else
                                                @if ($question->examAnswer->first()->is_correct == 1)
                                                    btn-light-success
                                                @elseif ($question->examAnswer->first()->is_correct == 0)
                                                    btn-light-danger @endif
                                            @endif
                                            btn-flex flex-column flex-center w-65px h-65px border-gray-200">
                                            <span class="mb-2" style="font-size: 1.8rem;"> {{ $loop->iteration }}
                                            </span>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
                <div class="flex-lg-row-fluid ms-lg-15">
                    <div class="card">
                        <div class="card-header card-header-stretch">
                            <!--begin::Title-->
                            <div class="card-title d-flex align-items-center">
                                <i class="ki-duotone ki-calendar-8 fs-1 text-primary me-3 lh-0"><span
                                        class="path1"></span><span class="path2"></span><span class="path3"></span><span
                                        class="path4"></span><span class="path5"></span><span class="path6"></span>
                                </i>
                                Soal {{ $exam_question_number->question_type }}


                            </div>
                        </div>
                        <div class="card-body py-4">
                            @if ($exam_question_number->question_image != null)
                                <img class="mb-5 img-fluid" src="{{ $exam_question_number->getImage() }}" alt="">
                            @endif
                            <p>
                                {!! $exam_question_number->question_text !!}
                            </p>

                            <div class="separator my-10"></div>
                            <div class="mb-5">
                                @if ($exam_question_number->question_type == 'pilihan ganda')
                                    @php
                                        $answer = $exam_question_number->examAnswer->first()->answer ?? [
                                            'multiple_choice' => [
                                                'id' => 0,
                                            ],
                                        ];
                                    @endphp
                                    @foreach ($exam_question_number->multipleChoice as $choice)
                                        <div class="d-flex fv-row">
                                            <div class="form-check form-check-custom form-check-solid">
                                                <input class="form-check-input me-3" type="radio"
                                                    name="{{ $exam_question_number->id }}" id="{{ $choice->id }}"
                                                    {{ $answer['multiple_choice']['id'] == $choice->id ? 'checked' : '' }}
                                                    onclick="return false">
                                                <label class="form-check-label">
                                                    @if ($choice->choice_image)
                                                        <img class="img-fluid" src="{{ $choice->getImage() }}"
                                                            alt="">
                                                    @endif
                                                    <div class=" text-gray-800">
                                                        {!! $choice->choice_text !!}
                                                        @if ($choice->is_correct)
                                                            <span class="fw-bold text-success">&nbsp; ( Jawaban Benar )
                                                            </span>
                                                        @endif
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="separator separator-dashed my-5"></div>
                                    @endforeach
                                    {{-- @elseif ($exam_question_number->question_type == 'pilihan ganda kompleks')
                                    @foreach ($exam_question_number->multipleChoiceComplex as $choice)
                                        <div class="d-flex fv-row">
                                            <div class="form-check form-check-custom form-check-solid">
                                                <input class="form-check-input me-3" type="checkbox"
                                                    wire:change="answerMultipleChoiceComplex({{ $choice->id }})"
                                                    @if (in_array($choice->id, $exam_multiple_choice_complex_text)) checked @endif>
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
                                    @endforeach --}}
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card mt-5">
                        <div class="card-header card-header-stretch">
                            <!--begin::Title-->
                            <div class="card-title d-flex align-items-center">
                                <i class="ki-duotone ki-chart-pie-3 fs-1 text-primary me-3 lh-0">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                                Analisis soal
                            </div>
                        </div>
                        <div class="card-body py-4">
                        </div>
                    </div> --}}


                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
