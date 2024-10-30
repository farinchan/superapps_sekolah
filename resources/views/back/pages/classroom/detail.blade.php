@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card card-flush">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <h2 class="mb-0">Informasi kelas</h2>
                    </div>
                    <div class="card-toolbar">
                        <div class="btn-group">
                            <a href="{{ route('back.classroom.export', $classroom_id) }}"
                            class="btn btn-light-secondary">

                                <i class="ki-duotone ki-file-up fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                </i>Export Excel</a>
                            <a href="#" class="btn btn-light-secondary">
                                <i class="ki-duotone ki-printer fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                                </i>PDF</a>

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
                <div class="card-body p-9">
                    <div class="row mb-7">
                        <label class="col-lg-2 fw-semibold text-muted">Kelas</label>
                        <div class="col-lg-10">
                            <span class="fw-bold fs-6 text-gray-800">
                                {{ $classroom->name }}
                            </span>
                        </div>
                    </div>
                    <div class="row mb-7">
                        <label class="col-lg-2 fw-semibold text-muted">Tahun Ajaran</label>
                        <div class="col-lg-10">
                            <span class="fw-bold fs-6 text-gray-800">
                                {{ $classroom->schoolYear->start_year }}/{{ $classroom->schoolYear->end_year }}
                            </span>
                        </div>
                    </div>
                    <div class="row mb-7">
                        <label class="col-lg-2 fw-semibold text-muted">Jumlah Siswa</label>
                        <div class="col-lg-10">
                            <span class="fw-bold fs-6 text-gray-800">
                                {{ $classroom->classroomStudent->count() }} Siswa
                            </span>
                        </div>
                    </div>
                    <div class="row mb-7">
                        <label class="col-lg-2 fw-semibold text-muted">Wali Kelas</label>
                        <div class="col-lg-10">
                            <span class="fw-bold fs-6 text-gray-800">
                                {{ $classroom->teacher->name }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-user-table-filter="search"
                                class="form-control form-control-solid w-250px ps-13" placeholder="Cari Siswa" />
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
                                        <label class="form-label fs-6 fw-semibold">Jenis Kelamin</label>
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                            data-placeholder="Select option" data-allow-clear="true"
                                            data-kt-user-table-filter="keSiswaan" data-hide-search="true">
                                            <option></option>
                                            <option value="laki-laki">Laki-laki</option>
                                            <option value="perempuan">Perempuan</option>
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

                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
                                <i class="ki-duotone ki-plus fs-2"></i>Tambah Siswa</a>
                        </div>
                        <div class="d-flex justify-content-end align-items-center d-none" {{-- data-kt-user-table-toolbar="selected" --}}>
                            <div class="fw-bold me-5">
                                <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected
                            </div>
                            <button type="button" class="btn btn-danger"
                                data-kt-user-table-select="delete_selected">Delete
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
                                <th class="min-w-125px">Siswa</th>
                                <th class="min-w-125px">Info</th>
                                <th class="min-w-125px">Jenis Kelamin</th>
                                <th class="min-w-125px">Kebutuhan Khusus</th>
                                <th class="min-w-125px">Disabilitas</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach ($students as $student)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td class="d-flex align-items-center">
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <a href="#">
                                                <div class="symbol-label">
                                                    <img src="@if ($student->student?->photo) {{ Storage::url($student->student?->photo) }} @else https://ui-avatars.com/api/?background=000C32&color=fff&name={{ $student->student?->name }} @endif"
                                                        alt="{{ $student->student?->name }}" width="50px" />
                                                </div>
                                            </a>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <a href="#"
                                                class="text-gray-800 text-hover-primary mb-1">{{ $student->student?->name }}</a>
                                            <span> NISN.{{ $student->student?->nisn }}</span>
                                            <span> NIK.{{ $student->student?->nik }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <ul>
                                                <li><span class="fw-bold">Email:</span>{{ $student->student?->email }}
                                                </li>
                                                </li>
                                                <li><span class="fw-bold">No. Telp:
                                                    </span>{{ $student->student?->no_telp }}</li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($student->student?->gender == 'laki-laki')
                                            Laki-laki
                                        @else
                                            Perempuan
                                        @endif
                                    </td>
                                    <td>
                                        @if ($student->student?->kebutuhan_khusus == 0)
                                            Tidak
                                        @else
                                            Ya
                                        @endif
                                    </td>
                                    <td>
                                        @if ($student->student?->disabilitas == 0)
                                            Tidak
                                        @else
                                            Ya
                                        @endif
                                    </td>

                                    <td class="text-end">
                                        <a href="#" class="btn btn-icon btn-light-youtube me-2"
                                            data-bs-toggle="modal" data-bs-target="#delete{{ $student->student?->id }}"
                                            data-bs-toggle="tooltip" data-bs-placement="right"
                                            title="Keluarkan dari kelas?">
                                            <i class="fa-solid fa-xmark fs-4"></i>
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

    <!-- Modal-->
    <div class="modal fade" tabindex="-1" id="add">
        <div class="modal-dialog mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Siswa</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('back.classroom.add.student.store', $classroom_id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Siswa</label>
                            <select class="form-select form-select-solid" name="student_id[]" data-control="select2" multiple="multiple"
                                data-placeholder="Select an option" data-dropdown-parent="#add" required>
                                <option></option>
                                @foreach ($list_student as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} - NISN.{{ $item->nisn }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @foreach ($students as $student)
        <div class="modal fade" tabindex="-1" id="delete{{ $student->student?->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Keluarkan dari kelas</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <form
                        action="{{ route('back.classroom.delete.student.destroy', [$classroom_id, $student->student?->id]) }}"
                        method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <p>Apakah Anda yakin ingin mengeluarkan Siswa <strong>
                                        {{ $student->student?->name }}</strong>
                                    dari kelas ini?
                                </p>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Keluarkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection


@section('scripts')
    <script src="{{ asset('back/js/custom/apps/user-management/users/list/table.js') }}"></script>
@endsection
