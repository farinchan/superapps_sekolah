<div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
    @include('exam/layout/partials/_header')
    <!--begin::Wrapper-->
    <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
        <!--begin::Wrapper container-->
        <div class="app-container  container-xxl d-flex flex-row-fluid ">
            {{-- @include('exam/layout/partials/_sidebar') --}}
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
                                        <span><span class="fw-light">Selamat
                                                Datang</span>,&nbsp;{{ Auth::user()->student?->name ?? 'NONE' }}</span>
                                        <span class="page-desc text-gray-600 fs-base fw-semibold">
                                            Apakah kamu siap untuk mengerjakan ujian?, semangat!!
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
                                            class="path5"></span><span class="path6"></span></i>

                                    <h3 class="fw-bold m-0 text-gray-800">Ujian yang kamu ikuti</h3>
                                </div>
                            </div>
                            <div class="card-body py-4">
                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="tabel">
                                    <thead>
                                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                            <th class="min-w-125px">Ujian</th>
                                            <th class="min-w-125px">Guru</th>
                                            {{-- <th class="">Nilai</th> --}}
                                            <th class="text-end "></th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-600 fw-semibold">
                                        @foreach ($exam_list as $exam)
                                            <tr>
                                                <td class="d-flex align-items-center">
                                                    <div class="d-flex flex-column">
                                                        <a href="#" class="text-gray-800 text-hover-primary mb-1">
                                                            @if ($exam->type == 'UH')
                                                                Ujian Harian
                                                            @elseif ($exam->type == 'UTS')
                                                                Sumatif Tengah Semester
                                                            @elseif ($exam->type == 'UAS')
                                                                Sumatif Akhir Semester
                                                            @endif
                                                            - {{ $exam->subject }}
                                                        </a>
                                                        <span>
                                                            Waktu Ujian :
                                                            {{ Carbon\Carbon::parse($exam->start_time)->format('d F Y H:i') }}
                                                            s/d
                                                            {{ Carbon\Carbon::parse($exam->end_time)->format('d F Y H:i') }}
                                                        </span>
                                                        <span>
                                                            Durasi : {{ $exam->duration }} Menit
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" class="text-gray-800 text-hover-primary mb-1">
                                                        {{ $exam->teacher_name }}
                                                    </a>
                                                    <span class="text-muted fw-bold d-block">
                                                        NIP. {{ $exam->teacher_nip }}
                                                    </span>
                                                </td>

                                                {{-- <td>
                                                    {{ $exam->score ?? '-' }}
                                                </td> --}}


                                                <td class="text-end">
                                                    @if ($exam->start_time < now() && $exam->end_time > now())
                                                        @if ($exam->score !== null)
                                                            <span class="badge badge-light-success">Sudah Dinilai</span>
                                                        @else
                                                            @if ($exam->session_start_time && $exam->session_end_time === null)
                                                                <button type="button"
                                                                    wire:click="startExam({{ $exam->id }})"
                                                                    class="btn btn-sm btn-light-success">Lanjutkan
                                                                    Ujian</button>
                                                            @else
                                                                <button type="button"
                                                                    wire:click="startExam({{ $exam->id }})"
                                                                    class="btn btn-sm btn-success">Mulai Ujian</button>
                                                            @endif
                                                        @endif
                                                    @elseif ($exam->start_time > now())
                                                        <span class="badge badge-light-warning">Belum Dimulai</span>
                                                    @elseif ($exam->end_time < now())
                                                        <span class="badge badge-light-danger">Sudah Selesai</span>
                                                    @endif



                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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

</div>

@push('scripts')
    <script>
        $('#tabel').DataTable({
            paging: true,
            searching: false,
        });
    </script>
@endpush
