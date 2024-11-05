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
                                            <option value="UTS">Ujian Tengah Semester</option>
                                            <option value="UAS">Ujian Akhir Semester</option>
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
                                        <label class="form-label fs-6 fw-semibold">Guru</label>
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                            data-placeholder="Pilih Guru" data-allow-clear="true"
                                            data-kt-user-table-filter="teacher" >
                                            <option></option>
                                            @foreach ($list_teacher as $teacher)
                                                <option value="{{ $teacher->name }}">{{ $teacher->name }} -
                                                    {{ $teacher->nip }} </option>
                                            @endforeach

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

                            <a href="#" class="btn btn-primary me-3" data-bs-toggle="modal"
                                data-bs-target="#add_exam">
                                <i class="ki-duotone ki-plus fs-2"></i>Tambah Ujian</a>
                            <div class="btn-group">
                                <a class="btn btn-secondary" href="#">
                                    <i class="ki-duotone ki-file-up fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Export
                                </a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end align-items-center d-none" {{-- data-kt-user-table-toolbar="selected" --}}>
                            <div class="fw-bold me-5">
                                <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected
                            </div>
                            <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete
                                Selected</button>
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
                                <th class="text-end min-w-100px">Actions</th>
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
                                                class="text-gray-800 text-hover-primary mb-1">{{ $exam->name }}</a>
                                            <span> {{ $exam->description }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        {{ Carbon\Carbon::parse($exam->start_time)->format('d M Y H:i') }} <br>
                                        s/d <br>
                                        {{ Carbon\Carbon::parse($exam->end_time)->format('d M Y H:i') }}
                                    </td>
                                    <td>
                                        {{ $exam->duration }} Menit
                                    </td>
                                    <td>
                                        {{ $exam->type }}
                                    </td>
                                    <td>
                                        {{ $exam->schoolYear->start_year }}/{{ $exam->schoolYear->end_year }}
                                    </td>
                                    <td>
                                        {{ $exam->teacher?->name }} <br>
                                        NIP.{{ $exam->teacher?->nip }}
                                    </td>


                                    <td class="text-end">
                                        <a href="#"
                                            class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true">

                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                    data-bs-target="#kt_modal_delete_user{{ $exam->id }}">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Add Exam -->
    <div class="modal fade" tabindex="-1" id="add_exam">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Modal title</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('back.exam.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label required">Nama Ujian</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Ujian" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Deskripsi" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="start_time" class="form-label required">Waktu Mulai</label>
                                    <input type="datetime-local" class="form-control" id="start_time" name="start_time"
                                        required>
                                </div>
                                <div class="col">
                                    <label for="end_time" class="form-label required">Waktu Selesai</label>
                                    <input type="datetime-local" class="form-control" id="end_time" name="end_time"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="duration" class="form-label">Durasi</label>
                            <div class="input-group mb-5">
                                <input type="number" class="form-control" id="duration" name="duration" placeholder="60" required>
                                <span class="input-group-text">Menit</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Tipe Ujian</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="UH">Ulangan Harian</option>
                                <option value="UTS">Ujian Tengah Semester</option>
                                <option value="UAS">Ujian Akhir Semester</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="school_year" class="form-label">Tahun Ajaran</label>
                            <select class="form-select" id="school_year_id" name="school_year_id" required>
                                @foreach ($list_school_year as $school_year)
                                    <option value="{{ $school_year->id }}">
                                        {{ $school_year->start_year }}/{{ $school_year->end_year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="teacher" class="form-label">Guru</label>
                            <select class="form-select" id="teacher_id" name="teacher_id" data-control="select2" data-placeholder="Select an option" data-dropdown-parent="#add_exam" required>
                                @foreach ($list_teacher as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }} - NIP.{{ $teacher->nip }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('back/js/custom/apps/user-management/users/list/exam_list.js') }}"></script>
@endsection
