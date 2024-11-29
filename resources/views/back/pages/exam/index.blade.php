@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-user-table-filter="search"
                                class="form-control form-control-solid w-250px ps-13" placeholder="Cari Ujian" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                                data-kt-menu-placement="bottom-end">
                                <i class="ki-duotone ki-filter fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>Filter</button>
                            <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                                </div>
                                <div class="separator border-gray-200"></div>
                                <div class="px-7 py-5" data-kt-user-table-filter="form">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-semibold">Jenis Ujian</label>
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                            data-placeholder="Pilih Jenis Ujian" data-allow-clear="true"
                                            data-kt-user-table-filter="type" data-hide-search="true">
                                            <option></option>
                                            <option value="UH">Ulangan Harian</option>
                                            <option value="UTS">Sumatif Tengah Semester</option>
                                            <option value="UAS">Sumatif Akhir Semester</option>
                                        </select>
                                    </div>
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-semibold">Tahun Ajaran</label>
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                            data-placeholder="Pilih Tahun Ajaran" data-allow-clear="true"
                                            data-kt-user-table-filter="schoolyear" data-hide-search="true">
                                            <option></option>
                                            @foreach ($list_school_year as $school_year)
                                                <option value="{{ $school_year->start_year }}/{{ $school_year->end_year }}">
                                                    {{ $school_year->start_year }}/{{ $school_year->end_year }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-semibold">Semester</label>
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                            data-placeholder="Pilih Semester" data-allow-clear="true"
                                            data-hide-search="true" data-kt-user-table-filter="semester">
                                            <option></option>
                                            <option value="ganjil">Semester Ganjil</option>
                                            <option value="genap">Semester Genap</option>

                                        </select>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="reset"
                                            class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6"
                                            data-kt-menu-dismiss="true" data-kt-user-table-filter="reset">Reset</button>
                                        <button type="submit" class="btn btn-primary fw-semibold px-6"
                                            data-kt-menu-dismiss="true" data-kt-user-table-filter="filter">Apply</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-body py-4">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                                            data-kt-check-target="#kt_table_users .form-check-input" value="1" />
                                    </div>
                                </th>
                                <th class="min-w-125px">Ujian</th>
                                <th class="min-w-125px">Waktu Ujian</th>
                                <th class="min-w-125px">Durasi</th>
                                <th class="min-w-125px">Tipe Ujian</th>
                                <th class="min-w-125px">Tahun Ajaran</th>
                                <th class="min-w-125px">Guru</th>
                                <th class="text-end ">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach ($list_exam as $exam)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td class="d-flex align-items-center">
                                        <div class="d-flex flex-column">
                                            <a href="#"
                                                class="text-gray-800 text-hover-primary mb-1">{{ $exam->subject?->name }}</a>
                                            <span> {{ $exam->description }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($exam->start_time < now() && $exam->end_time > now())
                                            <span class="badge badge-light-success">Sedang Berlangsung</span>
                                        @elseif($exam->start_time > now())
                                            <span class="badge badge-light-warning">Terjadwal</span>
                                        @else
                                            <span class="badge badge-light-danger">Selesai</span>
                                        @endif
                                        <br>
                                        {{ Carbon\Carbon::parse($exam->start_time)->format('d M Y H:i') }} <br>
                                        s/d <br>
                                        {{ Carbon\Carbon::parse($exam->end_time)->format('d M Y H:i') }}
                                    </td>
                                    <td>
                                        {{ $exam->duration }} Menit
                                    </td>
                                    <td>
                                        @if ($exam->type == 'UH')
                                            UH
                                        @elseif ($exam->type == 'UTS')
                                            STS
                                        @elseif ($exam->type == 'UAS')
                                            SAS
                                        @endif
                                    </td>
                                    <td>
                                        @if ($exam->semester == 'ganjil')
                                            Semester Ganjil <br>
                                        @elseif ($exam->semester == 'genap')
                                            Semester Genap <br>
                                        @endif
                                        {{ $exam->schoolYear->start_year }}/{{ $exam->schoolYear->end_year }}
                                    </td>
                                    <td>
                                        {{ $exam->teacher?->name }} <br>
                                        NIP.{{ $exam->teacher?->nip }}
                                    </td>


                                    <td class="text-end">
                                        <a href="{{ route('back.exam.setting', $exam->id) }}"
                                            class="btn btn-icon btn-secondary" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Detail Ujian">
                                            <i class="ki-duotone ki-eye fs-4">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('back/js/custom/apps/user-management/users/list/exam_list.js') }}"></script>
@endsection
