@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="d-flex flex-column flex-lg-row">
                <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
                    <div class="card mb-5 mb-xl-8">
                        <div class="card-body">
                            <div class="d-flex flex-center flex-column py-5">
                                {{-- <div class="symbol symbol-100px symbol-circle mb-7">
                                    <img src="{{ $exam_session->PpdbUser?->getPhoto() }}" alt="image" />
                                </div> --}}
                                <a href="#"
                                    class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $exam_session->PpdbUser->name }}</a>
                                <div class="text-center mb-9">
                                    <div class="">NISN. {{ $exam_session->PpdbUser?->nisn }}</div>
                                    <div class="">NIK. {{ $exam_session->PpdbUser?->nik }}</div>
                                </div>
                                {{-- <div class="fw-bold mb-3">Kelas: {{ $exam_session->PpdbUser->classroomStudent }}</div> --}}
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

                                    <div class="fw-bold mt-5">Tempat, Tanggal Lahir</div>
                                    <div class="text-gray-600">{{ $exam_session->PpdbUser?->birth_place }},
                                        {{ $exam_session->PpdbUser?->birth_date }}</div>
                                    <div class="fw-bold mt-5">Jenis Kelamin</div>
                                    <div class="text-gray-600">{{ $exam_session->PpdbUser?->gender ?? '-' }}</div>
                                    <div class="fw-bold mt-5">Alamat</div>
                                    <div class="text-gray-600">{{ $exam_session->PpdbUser?->address ?? '-' }}</div>
                                    <div class="fw-bold mt-5">Email</div>
                                    <div class="text-gray-600">
                                        <a href="mailto:{{ $exam_session->PpdbUser?->email }}"
                                            class="text-gray-600 text-hover-primary">{{ $exam_session->PpdbUser?->email ?? '-' }}</a>
                                    </div>
                                    <div class="fw-bold mt-5">Nomor Telephone</div>
                                    <div class="text-gray-600">
                                        <a href="tel:{{ $exam_session->PpdbUser?->phone }}"
                                            class="text-gray-600 text-hover-primary">{{ $exam_session->PpdbUser?->no_telp ?? '-' }}</a>
                                    </div>
                                    <div class="fw-bold mt-5">Berkebutuhan Khusus</div>
                                    <div class="text-gray-600">
                                        @if ($exam_session->PpdbUser?->kebutuhan_khusus == 1)
                                            Ya
                                        @else
                                            Tidak
                                        @endif
                                    </div>
                                    <div class="fw-bold mt-5">Disabilitas</div>
                                    <div class="text-gray-600">
                                        @if ($exam_session->PpdbUser?->disabilitas == 1)
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
                        <div class="card-body">
                            <div class="d-flex flex-stack fs-4 py-3">
                                Siswa melakukan tindakan Login ulang saat ujian sebanyak: <br>
                            </div>
                            {{-- <span class="fw-bold fs-2x ms-3">{{ $login_count }} Kali</span> --}}
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
                                            href="{{ route('back.ppdb.exam.student.analysis', $exam_session->id) . '?question_id=' . $question->id }}"
                                            class="btn btn-icon btn-outline
                                            @if ($question->examAnswer->isEmpty()) btn-light-dark
                                            @else
                                                @if ($question->examAnswer->first()->is_correct == 1 || $question->examAnswer->first()->score > 0)
                                                    btn-light-success
                                                @elseif ($question->examAnswer->first()->is_correct == 0 || $question->examAnswer->first()->score == 0)
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

                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-header card-header-stretch">
                            <!--begin::Title-->
                            <div class="card-title d-flex align-items-center">
                                <i class="ki-duotone ki-like-shapes fs-1 text-primary me-3 lh-0">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                Nilai Yang Diperoleh : <span class="text-primary">&nbsp;
                                    {{ $exam_question_number->examAnswer->first()->score??"-" }} </span>
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
                            <div class="row">
                                <div class="col-md-4">
                                    <div id="chart"></div>
                                </div>
                                <div class="col-md-8">
                                    <div id="barchart"></div>
                                </div>
                            </div>
                        </div>
                    </div> --}}


                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // Data dan konfigurasi untuk Pie Chart
        var options = {
            chart: {
                type: 'pie',
                height: 350
            },
            series: [{{ $exam_answer_analysis->sum('is_correct') }},
                {{ $exam_answer_analysis->count() - $exam_answer_analysis->sum('is_correct') }}
            ], // Data Chart
            labels: ['Yang Menjawab benar', 'yang menjawab salah'], // Label Kategori
            colors: ['#1BC5BD', '#F64E60'], // Warna Chart
            title: {
                text: 'Total Jawaban Benar dan Salah',
                align: 'left'
            },
            legend: {
                position: 'bottom', // Meletakkan legenda di bawah
                horizontalAlign: 'center', // Meratakan secara horizontal di tengah
            }
        };

        // Inisialisasi chart
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        var exam_answer_analysis = @json($exam_answer_analysis);
        // var exam_analysis_per kelas = [];

        // exam_answer_analysis.forEach(function(item) {
        //     if (exam_analysis_per_kelas[item.classroom_id] == undefined) {
        //         exam_analysis_per_kelas[item.classroom_id] = {
        //             classroom: item.classroom,
        //             correct: 0,
        //             wrong: 0
        //         };
        //     }

        //     if (item.is_correct == 1) {
        //         exam_analysis_per_kelas[item.classroom_id].correct++;
        //     } else {
        //         exam_analysis_per_kelas[item.classroom_id].wrong++;
        //     }
        // });

        // Data dan konfigurasi untuk Bar Chart
        var options = {
            series: [{
                data: [44, 55, 41, 64, 22, 43, 21]
            }, {
                data: [53, 32, 33, 52, 13, 44, 32]
            }],
            chart: {
                type: 'bar',
                height: 430
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    dataLabels: {
                        position: 'top',
                    },
                }
            },
            dataLabels: {
                enabled: true,
                offsetX: -6,
                style: {
                    fontSize: '12px',
                    colors: ['#fff']
                }
            },
            stroke: {
                show: true,
                width: 1,
                colors: ['#fff']
            },
            tooltip: {
                shared: true,
                intersect: false
            },
            xaxis: {
                categories: [2001, 2002, 2003, 2004, 2005, 2006, 2007],
            },
        };

        // Inisialisasi chart
        var barchart = new ApexCharts(document.querySelector("#barchart"), options);
        barchart.render();
    </script>
@endsection
