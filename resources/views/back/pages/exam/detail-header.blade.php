<div class="card mb-9">
    <div class="card-body pt-9 pb-0">
        <div class="d-flex flex-wrap flex-sm-nowrap mb-6">

            <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center mb-1">
                            <a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bold me-3">
                                @if ($exam->type == 'UH')
                                    Ujian Harian
                                @elseif ($exam->type == 'UTS')
                                    Ujian Tengah Semester
                                @elseif ($exam->type == 'UAS')
                                    Ujian Akhir Semester
                                @endif
                                - {{ $exam->subject?->name }}
                            </a>
                            @if ($exam->start_time < now() && $exam->end_time > now())
                                <span class="badge badge-light-success me-auto">Sedang Berlangsung</span>
                            @elseif($exam->start_time > now())
                                <span class="badge badge-light-warning me-auto">Terjadwal</span>
                            @else
                                <span class="badge badge-light-danger me-auto">Selesai</span>
                            @endif
                        </div>
                        <div class="d-flex flex-wrap fw-semibold mb-4 fs-5 text-gray-500">
                            {{ $exam->description }}
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <a href="#" class="btn btn-sm btn-bg-light btn-active-color-primary me-3">Export
                            Excel</a>
                        <a href="#" class="btn btn-sm btn-danger me-3">Hapus Ujian</a>

                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-start">
                    <div class="d-flex flex-wrap">
                        <div
                            class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="fs-4 fw-bold">
                                    {{ Carbon\Carbon::parse($exam->start_time)->format('d M Y H:i') }} -
                                    {{ Carbon\Carbon::parse($exam->end_time)->format('d M Y H:i') }}
                                </div>
                            </div>
                            <div class="fw-semibold fs-6 text-gray-500">Waktu Ujian</div>
                        </div>
                        <div
                            class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="fs-4 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $exam->duration }} " data-kt-countup-suffix="Menit">
                                    0
                                </div>
                            </div>
                            <div class="fw-semibold fs-6 text-gray-500">Durasi Ujian</div>
                        </div>
                        <div
                            class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="fs-4 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $exam->examQuestion->count() }}">0</div>
                            </div>
                            <div class="fw-semibold fs-6 text-gray-500">Pertanyaan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="separator"></div>
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
            <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 @if (request()->routeIs('back.exam.question')) active @endif"
                href="{{ route("back.exam.question", $exam->id) }}">Soal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 @if (request()->routeIs('back.exam.classroom')) active @endif"
                href="{{ route("back.exam.classroom", $exam->id) }}">Kelas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6  @if (request()->routeIs('back.exam.student')) active @endif"
                    href="{{ route("back.exam.student", $exam->id) }}">Nilai Siswa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 @if (request()->routeIs('back.exam.setting')) active @endif"
                    href="{{ route("back.exam.setting", $exam->id) }}">Settings</a>
            </li>
        </ul>
    </div>
</div>
